<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Jadwal;
use App\Models\Presensi;
use App\Models\Mahasiswa;
use App\Models\KrsDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PertemuanController extends Controller
{
    public function index(Request $request)
    {
        $dosen = Auth::user()->dosen;
        $jadwalId = $request->get('jadwal_id');
        
        $query = Pertemuan::whereHas('jadwal.kelas.dosenPengampu', function($q) use ($dosen) {
            $q->where('dosen_id', $dosen->dosen_id);
        });

        if ($jadwalId) {
            $query->where('jadwal_id', $jadwalId);
        }

        $pertemuans = $query->with(['jadwal.kelas.matakuliah'])
                            ->orderBy('tanggal', 'desc')
                            ->orderBy('pertemuan_ke', 'desc')
                            ->get();

        return view('dosen.pertemuan.index', compact('pertemuans', 'jadwalId'));
    }

    public function mulaiKelas($jadwal_id)
    {
        $jadwal = Jadwal::findOrFail($jadwal_id);
        
        $today = Carbon::today();
        $pertemuan = Pertemuan::where('jadwal_id', $jadwal_id)
                              ->where('tanggal', $today)
                              ->first();

        if (!$pertemuan) {
            $lastPertemuanKe = Pertemuan::where('jadwal_id', $jadwal_id)->max('pertemuan_ke') ?? 0;
            $pertemuan = Pertemuan::create([
                'jadwal_id' => $jadwal_id,
                'tanggal' => $today,
                'pertemuan_ke' => $lastPertemuanKe + 1,
                'materi_pembahasan' => '',
                'catatan' => ''
            ]);
        }

        return redirect()->route('dosen.pertemuan.presensi', $pertemuan->pertemuan_id)
                         ->with('success', 'Silakan isi Jurnal Mengajar (BAP) untuk hari ini.');
    }

    public function presensi($pertemuan_id)
    {
        $pertemuan = Pertemuan::with(['jadwal.kelas.matakuliah'])->findOrFail($pertemuan_id);
        
        $mahasiswas = Mahasiswa::whereHas('krs.krsDetails', function($q) use ($pertemuan) {
            $q->where('kelas_id', $pertemuan->jadwal->kelas_id)
              ->whereHas('krs', function($kq) {
                  $kq->whereIn('status', ['disetujui_wali', 'verified']);
              });
        })->get();

        $existingPresensi = Presensi::where('pertemuan_id', $pertemuan_id)
                                     ->get()
                                     ->pluck('status', 'mahasiswa_id');

        return view('dosen.pertemuan.presensi', compact('pertemuan', 'mahasiswas', 'existingPresensi'));
    }

    public function simpanPresensi(Request $request)
    {
        $pertemuan = Pertemuan::findOrFail($request->pertemuan_id);
        
        // Save BAP Info
        $pertemuan->update([
            'materi_pembahasan' => $request->materi_pembahasan,
            'catatan' => $request->catatan,
        ]);

        // Save Attendance (SIAKAD still needs official record of who was in class)
        $presensiData = $request->presensi ?? []; 

        foreach ($presensiData as $mahasiswa_id => $status) {
            Presensi::updateOrCreate(
                ['pertemuan_id' => $pertemuan->pertemuan_id, 'mahasiswa_id' => $mahasiswa_id],
                ['status' => strtolower($status), 'waktu_absen' => now()]
            );
        }

        return redirect()->back()->with('success', 'Jurnal Mengajar dan Presensi berhasil disimpan.');
    }

    public function exportPdf($pertemuan_id)
    {
        $pertemuan = Pertemuan::with(['jadwal.kelas.matakuliah', 'jadwal.kelas.dosenPengampu', 'presensis.mahasiswa'])
                              ->findOrFail($pertemuan_id);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('dosen.pdf.pertemuan_bap', compact('pertemuan'));
        return $pdf->download('BAP-Pertemuan-' . $pertemuan->pertemuan_ke . '-' . $pertemuan->jadwal->kelas->kode_kelas . '.pdf');
    }
}
