<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\SemesterAjaran;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Data dosen tidak ditemukan.');
        }

        // 1. Get Active Semester
        $activeSemester = SemesterAjaran::where('is_active', true)->first() ?? SemesterAjaran::orderBy('semester_ajaran_id', 'desc')->first();

        // 2. Fetch Jadwal with filters
        $query = Jadwal::whereHas('kelas.dosenPengampu', function($q) use ($dosen) {
            $q->where('dosen_id', $dosen->dosen_id);
        })->whereHas('kelas', function($q) use ($activeSemester) {
            $q->where('semester_ajaran_id', $activeSemester->semester_ajaran_id);
        })->with(['kelas.matakuliah', 'kelas.krsDetails']);

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('kelas.matakuliah', function($mq) use ($search) {
                    $mq->where('nama_mk', 'like', "%$search%")
                       ->orWhere('kode_mk', 'like', "%$search%");
                })->orWhereHas('kelas', function($kq) use ($search) {
                    $kq->where('kode_kelas', 'like', "%$search%");
                })->orWhere('ruangan', 'like', "%$search%");
            });
        }

        // Day filter
        if ($request->has('hari') && $request->hari != 'Semua Hari' && $request->hari != '') {
            $query->where('hari', $request->hari);
        }

        $jadwals = $query->orderByRaw("FIELD(hari, 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun')")
                         ->orderBy('jam_mulai', 'asc')
                         ->get();

        // 3. Stats calculation
        $totalMatkul = $jadwals->pluck('kelas.matakuliah_id')->unique()->count();
        
        $totalSks = Kelas::whereHas('dosenPengampu', function($q) use ($dosen) {
            $q->where('dosen_id', $dosen->dosen_id);
        })->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
          ->with('matakuliah')
          ->get()
          ->sum(function($k) {
              return $k->matakuliah->sks;
          });

        $totalMahasiswa = Kelas::whereHas('dosenPengampu', function($q) use ($dosen) {
            $q->where('dosen_id', $dosen->dosen_id);
        })->where('semester_ajaran_id', $activeSemester->semester_ajaran_id)
          ->withCount('krsDetails')
          ->get()
          ->sum('krs_details_count');

        $totalPertemuan = $jadwals->count();
        $totalRuangan = $jadwals->pluck('ruangan')->unique()->count();

        // 4. Unique Matakuliah List for Summary
        $daftarMatkul = $jadwals->map(function($j) {
            return $j->kelas->matakuliah;
        })->unique('matakuliah_id');

        // Handle AJAX Request for Instant Search/Filter
        if ($request->ajax()) {
            return view('dosen.partials.jadwal_table', compact('jadwals'))->render();
        }

        return view('dosen.jadwal', compact(
            'jadwals',
            'activeSemester',
            'totalMatkul',
            'totalSks',
            'totalMahasiswa',
            'totalPertemuan',
            'totalRuangan',
            'daftarMatkul'
        ));
    }

    public function exportPdf()
    {
        $user = Auth::user();
        $dosen = $user->dosen;
        $activeSemester = SemesterAjaran::where('is_active', true)->first() ?? SemesterAjaran::orderBy('semester_ajaran_id', 'desc')->first();

        $jadwals = Jadwal::whereHas('kelas.dosenPengampu', function($q) use ($dosen) {
            $q->where('dosen_id', $dosen->dosen_id);
        })->whereHas('kelas', function($q) use ($activeSemester) {
            $q->where('semester_ajaran_id', $activeSemester->semester_ajaran_id);
        })->with(['kelas.matakuliah'])
          ->orderByRaw("FIELD(hari, 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun')")
          ->orderBy('jam_mulai', 'asc')
          ->get();

        $pdf = Pdf::loadView('dosen.pdf.jadwal', compact('jadwals', 'dosen', 'activeSemester'));
        return $pdf->download('Jadwal_Mengajar_' . $dosen->nip . '.pdf');
    }

    public function peserta($id)
    {
        $user = Auth::user();
        $dosen = $user->dosen;
        $activeSemester = SemesterAjaran::where('is_active', true)->first() ?? SemesterAjaran::orderBy('semester_ajaran_id', 'desc')->first();

        $jadwal = Jadwal::whereHas('kelas.dosenPengampu', function($q) use ($dosen) {
            $q->where('dosen_id', $dosen->dosen_id);
        })->with(['kelas.matakuliah', 'kelas.krsDetails.krs.mahasiswa'])
          ->findOrFail($id);

        return view('dosen.jadwal.peserta', compact('jadwal', 'activeSemester'));
    }
}
