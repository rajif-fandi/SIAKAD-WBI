<!DOCTYPE html>
<html>
<head>
    <title>Berita Acara Perkuliahan - Pertemuan {{ $pertemuan->pertemuan_ke }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 3px double #000; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 12px; }
        .info-table { width: 100%; margin-bottom: 20px; font-size: 12px; border-collapse: collapse; }
        .info-table td { padding: 5px 0; vertical-align: top; }
        .info-table td:first-child { width: 150px; font-weight: bold; }
        .section-title { font-size: 14px; font-weight: bold; text-transform: uppercase; border-bottom: 1px solid #eee; padding-bottom: 5px; margin-bottom: 10px; margin-top: 20px; color: #1e3a8a; }
        .content-box { border: 1px solid #eee; padding: 15px; border-radius: 5px; background: #fafafa; font-size: 12px; min-height: 50px; }
        .attendance-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 10px; }
        .attendance-table th, .attendance-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .attendance-table th { background-color: #f8fafc; font-weight: bold; text-transform: uppercase; }
        .footer { margin-top: 50px; font-size: 12px; }
        .signature-box { float: right; width: 200px; text-align: center; }
        .signature-space { height: 80px; }
        .status-badge { padding: 2px 6px; border-radius: 4px; font-weight: bold; font-size: 9px; text-transform: uppercase; }
        .hadir { background: #dcfce7; color: #166534; }
        .izin { background: #ffedd5; color: #9a3412; }
        .sakit { background: #dbeafe; color: #1e40af; }
        .alpa { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Wiyata Bhakti Indonesia</h1>
        <p>Berita Acara Perkuliahan (BAP)</p>
    </div>

    <table class="info-table">
        <tr>
            <td>Mata Kuliah</td>
            <td>: {{ $pertemuan->jadwal->kelas->matakuliah->nama_mk }} ({{ $pertemuan->jadwal->kelas->kode_kelas }})</td>
        </tr>
        <tr>
            <td>Dosen Pengampu</td>
            <td>: {{ Auth::user()->name }}</td>
        </tr>
        <tr>
            <td>Pertemuan Ke</td>
            <td>: {{ $pertemuan->pertemuan_ke }}</td>
        </tr>
        <tr>
            <td>Hari / Tanggal</td>
            <td>: {{ \Carbon\Carbon::parse($pertemuan->tanggal)->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
            <td>Ruangan</td>
            <td>: {{ $pertemuan->jadwal->ruangan }}</td>
        </tr>
    </table>

    <div class="section-title">Materi Pembahasan</div>
    <div class="content-box">
        {{ $pertemuan->materi_pembahasan ?: 'Materi belum diisi.' }}
    </div>

    <div class="section-title">Catatan Perkuliahan</div>
    <div class="content-box">
        {{ $pertemuan->catatan ?: 'Tidak ada catatan.' }}
    </div>

    <div class="section-title">Daftar Kehadiran Mahasiswa</div>
    <table class="attendance-table">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th style="width: 100px;">NPM</th>
                <th>Nama Mahasiswa</th>
                <th style="width: 80px; text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pertemuan->presensis as $index => $ps)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $ps->mahasiswa->npm }}</td>
                <td>{{ $ps->mahasiswa->nama }}</td>
                <td style="text-align: center;">
                    <span class="status-badge {{ strtolower($ps->status) }}">{{ $ps->status }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->translatedFormat('d F Y H:i:s') }}</p>
        <div class="signature-box">
            <p>Dosen Pengampu,</p>
            <div class="signature-space"></div>
            <p><strong>{{ Auth::user()->name }}</strong></p>
            <p>NIDN. {{ Auth::user()->dosen->nidn ?? '-' }}</p>
        </div>
    </div>
</body>
</html>
