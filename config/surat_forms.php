<?php
return [

    // 1. Surat Permohonan Studi Praktek Akuntansi
    'Surat Permohonan Studi Praktek Akuntansi' => [
        ['name' => 'lampiran', 'label' => 'Lampiran', 'type' => 'text'],
        ['name' => 'perihal', 'label' => 'Perihal', 'type' => 'text'],
        ['name' => 'tgl_mulai', 'label' => 'Tanggal Mulai', 'type' => 'date'],
        ['name' => 'tgl_selesai', 'label' => 'Tanggal Selesai', 'type' => 'date'],
        ['name' => 'kepada_yth', 'label' => 'Kepada Yth', 'type' => 'text'],
        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'npm', 'label' => 'NPM', 'type' => 'text'],
        ['name' => 'tingkat_semester', 'label' => 'Tingkat Semester', 'type' => 'text'],
        ['name' => 'konsentrasi', 'label' => 'Konsentrasi', 'type' => 'text'],
        ['name' => 'no_hp', 'label' => 'Nomor HP', 'type' => 'text'],
    ],

    // 2. Surat Permohonan Izin Penelitian
    'Surat Permohonan Izin Penelitian' => [
        ['name' => 'lampiran', 'label' => 'Lampiran', 'type' => 'text'],
        ['name' => 'perihal', 'label' => 'Perihal', 'type' => 'text'],
        ['name' => 'kepada_yth', 'label' => 'Kepada Yth', 'type' => 'text'],
        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'npm', 'label' => 'NPM', 'type' => 'text'],
        ['name' => 'tingkat_semester', 'label' => 'Tingkat Semester', 'type' => 'text'],
        ['name' => 'prodi_konsen', 'label' => 'Program Studi / Konsentrasi', 'type' => 'text'],
        ['name' => 'no_hp', 'label' => 'Nomor HP', 'type' => 'text'],
        ['name' => 'dosen_kolab', 'label' => 'Dosen Kolaborasi', 'type' => 'text'],
        ['name' => 'tmpt_penelitian', 'label' => 'Tempat Penelitian', 'type' => 'text'],
    ],

    // 3. Surat Permohonan Studi Praktek Manajemen
    'Surat Permohonan Studi Praktek Manajemen' => [
        ['name' => 'lampiran', 'label' => 'Lampiran', 'type' => 'text'],
        ['name' => 'perihal', 'label' => 'Perihal', 'type' => 'text'],
        ['name' => 'kepada_yth', 'label' => 'Kepada Yth', 'type' => 'text'],
        ['name' => 'tgl_mulai', 'label' => 'Tanggal Mulai', 'type' => 'date'],
        ['name' => 'tgl_selesai', 'label' => 'Tanggal Selesai', 'type' => 'date'],
        ['name' => 'nim', 'label' => 'NIM', 'type' => 'text'],
        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'tingkat_semester', 'label' => 'Tingkat Semester', 'type' => 'text'],
        ['name' => 'konsentrasi', 'label' => 'Konsentrasi', 'type' => 'text'],
        ['name' => 'no_hp', 'label' => 'Nomor HP', 'type' => 'text'],
    ],

    // 4. Surat Permohonan Izin Observasi
    'Surat Permohonan Izin Observasi' => [
        ['name' => 'lampiran', 'label' => 'Lampiran', 'type' => 'text'],
        ['name' => 'perihal', 'label' => 'Perihal', 'type' => 'text'],
        ['name' => 'kepada_yth', 'label' => 'Kepada Yth', 'type' => 'text'],
        ['name' => 'tgl_pelaksanaan', 'label' => 'Tanggal Pelaksanaan', 'type' => 'date'],

        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'nim', 'label' => 'NIM', 'type' => 'text'],
        ['name' => 'prodi', 'label' => 'Program Studi', 'type' => 'text'],
        ['name' => 'no_hp', 'label' => 'Nomor HP', 'type' => 'text'],
        ['name' => 'dosen_pembimbing', 'label' => 'Dosen Pembimbing', 'type' => 'text'],
    ],

    // 5. Surat Keterangan Masih Kuliah
    'Surat Keterangan Masih Kuliah' => [
        ['name' => 'nama_dosen', 'label' => 'Nama Dosen', 'type' => 'text'],
        ['name' => 'nidn', 'label' => 'NIDN', 'type' => 'text'],
        ['name' => 'jabatan_dosen', 'label' => 'Jabatan Dosen', 'type' => 'text'],
        ['name' => 'pada_perguruan_tinggi', 'label' => 'Nama Perguruan Tinggi', 'type' => 'text'],

        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'nim', 'label' => 'NIM', 'type' => 'text'],
        ['name' => 'prodi', 'label' => 'Program Studi', 'type' => 'text'],
        ['name' => 'tingkat_semester', 'label' => 'Tingkat Semester', 'type' => 'text'],
        ['name' => 'thn_akademik', 'label' => 'Tahun Akademik', 'type' => 'text'],
    ],

    // 6. Surat Keterangan Masih Kuliah (Ortu)
    'Surat Keterangan Masih Kuliah (Ortu)' => [
        ['name' => 'nama_dosen', 'label' => 'Nama Dosen', 'type' => 'text'],
        ['name' => 'nidn', 'label' => 'NIDN', 'type' => 'text'],
        ['name' => 'jabatan_dosen', 'label' => 'Jabatan Dosen', 'type' => 'text'],
        ['name' => 'pada_perguruan_tinggi', 'label' => 'Nama Perguruan Tinggi', 'type' => 'text'],

        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'npm', 'label' => 'NPM', 'type' => 'text'],
        ['name' => 'tk_semester', 'label' => 'Tingkat Semester', 'type' => 'text'],
        ['name' => 'prodi', 'label' => 'Program Studi', 'type' => 'text'],
        ['name' => 'thn_akademik', 'label' => 'Tahun Akademik', 'type' => 'text'],
        ['name' => 'no_hp', 'label' => 'Nomor HP', 'type' => 'text'],

        ['name' => 'nama_ortu', 'label' => 'Nama Orang Tua', 'type' => 'text'],
        ['name' => 'nip_nrp_nik', 'label' => 'NIP/NRP/NIK', 'type' => 'text'],
        ['name' => 'pangkat_gol_ruang', 'label' => 'Pangkat / Golongan', 'type' => 'text'],
        ['name' => 'instansi_perusahaan', 'label' => 'Instansi / Perusahaan', 'type' => 'text'],
    ],

    // 7. Surat Permohonan Aktif Kuliah
    'Surat Permohonan Aktif Kuliah' => [
        ['name' => 'perihal', 'label' => 'Perihal', 'type' => 'text'],
        ['name' => 'yth', 'label' => 'Yth', 'type' => 'text'],

        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'npm', 'label' => 'NPM', 'type' => 'text'],
        ['name' => 'prodi', 'label' => 'Program Studi', 'type' => 'text'],
        ['name' => 'fakultas', 'label' => 'Fakultas', 'type' => 'text'],
        ['name' => 'no_hp', 'label' => 'Nomor HP', 'type' => 'text'],

        ['name' => 'semester', 'label' => 'Semester', 'type' => 'text'],
        ['name' => 'thn_akademik', 'label' => 'Tahun Akademik', 'type' => 'text'],
        ['name' => 'alasan', 'label' => 'Alasan', 'type' => 'textarea'],
    ],

    // 8. Surat Perpindahan ke Kelas Sore
    'Surat Perpindahan ke Kelas Sore' => [
        ['name' => 'yth', 'label' => 'Yth', 'type' => 'text'],

        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'npm', 'label' => 'NPM', 'type' => 'text'],
        ['name' => 'prodi', 'label' => 'Program Studi', 'type' => 'text'],
        ['name' => 'no_hp', 'label' => 'Nomor HP', 'type' => 'text'],

        ['name' => 'semester', 'label' => 'Semester', 'type' => 'text'],
        ['name' => 'thn_akademik', 'label' => 'Tahun Akademik', 'type' => 'text'],
        ['name' => 'alasan', 'label' => 'Alasan Perpindahan', 'type' => 'textarea'],
    ],

    // 9. Surat Permohonan Cuti / Aktif / Mengundurkan Diri
    'Surat Permohonan Cuti / Aktif / Mengundurkan Diri' => [
        ['name' => 'perihal', 'label' => 'Perihal', 'type' => 'text'],
        ['name' => 'yth', 'label' => 'Yth', 'type' => 'text'],

        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'npm', 'label' => 'NPM', 'type' => 'text'],
        ['name' => 'prodi', 'label' => 'Program Studi', 'type' => 'text'],
        ['name' => 'fakultas', 'label' => 'Fakultas', 'type' => 'text'],
        ['name' => 'no_hp', 'label' => 'Nomor HP', 'type' => 'text'],

        ['name' => 'semester', 'label' => 'Semester', 'type' => 'text'],
        ['name' => 'thn_akademik', 'label' => 'Tahun Akademik', 'type' => 'text'],
        ['name' => 'alasan', 'label' => 'Alasan', 'type' => 'textarea'],
        ['name' => 'nama_ortu', 'label' => 'Nama Orang Tua', 'type' => 'text'],
    ],

    // 10. Surat Permohonan Pindah Kuliah
    'Surat Permohonan Pindah Kuliah' => [
        ['name' => 'yth', 'label' => 'Yth', 'type' => 'text'],

        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'npm', 'label' => 'NPM', 'type' => 'text'],
        ['name' => 'prodi', 'label' => 'Program Studi', 'type' => 'text'],
        ['name' => 'fakultas', 'label' => 'Fakultas', 'type' => 'text'],
        ['name' => 'no_hp', 'label' => 'Nomor HP', 'type' => 'text'],

        ['name' => 'nama_ortu', 'label' => 'Nama Orang Tua', 'type' => 'text'],
    ],

    // 11. Surat Pengunduran Diri
    'Surat Pengunduran Diri' => [
        ['name' => 'yth', 'label' => 'Yth', 'type' => 'text'],

        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'npm', 'label' => 'NPM', 'type' => 'text'],
        ['name' => 'tingkat_semester', 'label' => 'Tingkat Semester', 'type' => 'text'],
        ['name' => 'prodi', 'label' => 'Program Studi', 'type' => 'text'],

        ['name' => 'nama_ortu', 'label' => 'Nama Orang Tua', 'type' => 'text'],
    ],

    // 12. Surat Ujian Susulan
    'Surat Ujian Susulan' => [
        ['name' => 'lampiran', 'label' => 'Lampiran', 'type' => 'text'],
        ['name' => 'perihal', 'label' => 'Perihal', 'type' => 'text'],
        ['name' => 'kepada', 'label' => 'Kepada Yth', 'type' => 'text'],

        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'npm', 'label' => 'NPM', 'type' => 'text'],
        ['name' => 'tingkat_semester', 'label' => 'Tingkat Semester', 'type' => 'text'],
        ['name' => 'prodi', 'label' => 'Program Studi', 'type' => 'text'],
    ],

    // 13. Surat Ujian Susulan Matkul
    'Surat Ujian Susulan Matkul' => [
        ['name' => 'lampiran', 'label' => 'Lampiran', 'type' => 'text'],
        ['name' => 'perihal', 'label' => 'Perihal', 'type' => 'text'],
        ['name' => 'kepada', 'label' => 'Kepada Yth', 'type' => 'text'],

        ['name' => 'nama_mhs', 'label' => 'Nama Mahasiswa', 'type' => 'text'],
        ['name' => 'npm', 'label' => 'NPM', 'type' => 'text'],
        ['name' => 'tingkat_semester', 'label' => 'Tingkat Semester', 'type' => 'text'],
        ['name' => 'prodi', 'label' => 'Program Studi', 'type' => 'text'],
        ['name' => 'matkul', 'label' => 'Mata Kuliah', 'type' => 'text'],
    ],

    // 14. Surat Tugas Mengajar
    'Surat Tugas Mengajar' => [
        ['name' => 'nama_dosen', 'label' => 'Nama Dosen', 'type' => 'text'],
        ['name' => 'nidn_nidk', 'label' => 'NIDN / NIDK', 'type' => 'text'],
        ['name' => 'prodi', 'label' => 'Program Studi', 'type' => 'text'],
        ['name' => 'thn_akademik', 'label' => 'Tahun Akademik', 'type' => 'text'],
        ['name' => 'semester', 'label' => 'Semester', 'type' => 'text'],
    ],

];
