<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Mengajar - {{ $dosen->nama }}</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; font-size: 12px; }
        th { background-color: #2E7D55; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h2>JADWAL MENGAJAR DOSEN</h2>
        <h3>SIAKAD WBI - {{ $activeSemester->nama_semester }}</h3>
        <p>Nama: {{ $dosen->nama }} ({{ $dosen->nip }})</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Hari</th>
                <th>Waktu</th>
                <th>Mata Kuliah</th>
                <th>Kode MK</th>
                <th>Kelas</th>
                <th>SKS</th>
                <th>Ruangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwals as $jadwal)
            @php
                $dayMap = ['Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu', 'Sun' => 'Minggu'];
            @endphp
            <tr>
                <td>{{ $dayMap[$jadwal->hari] }}</td>
                <td>{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</td>
                <td>{{ $jadwal->kelas->matakuliah->nama_mk }}</td>
                <td>{{ $jadwal->kelas->matakuliah->kode_mk }}</td>
                <td>{{ $jadwal->kelas->kode_kelas }}</td>
                <td>{{ $jadwal->kelas->matakuliah->sks }}</td>
                <td>{{ $jadwal->ruangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 50px; text-align: right;">
        <p>Medan, {{ now()->translatedFormat('d F Y') }}</p>
        <br><br><br>
        <p><strong>{{ $dosen->nama }}</strong></p>
    </div>
</body>
</html>
