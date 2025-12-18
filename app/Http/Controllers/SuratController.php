<?php
namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use App\Models\TransaksiSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
// use App\Notifications\SuratBaruNotification;5ew
use Carbon\Carbon;

class SuratController extends Controller
{
    private $templateMap = [
        'surat-permohonan-studi-praktek-akuntansi' => \App\Models\Surat\SuratPermohonanStudiPraktekAkuntansi::class,
        'surat-permohonan-izin-penelitian' => \App\Models\Surat\SuratPermohonanIzinPenelitian::class,
        'surat-permohonan-studi-praktek-manajemen' => \App\Models\Surat\SuratPermohonanStudiPraktekManajemen::class,
        'surat-permohonan-izin-observasi' => \App\Models\Surat\SuratPermohonanIzinObservasi::class,
        'surat-keterangan-masih-kuliah' => \App\Models\Surat\SuratKeteranganMasihKuliah::class,
        'surat-keterangan-masih-kuliah-dengan-orang-tua' => \App\Models\Surat\SuratKeteranganMasihKuliahOrtuDetail::class,
        'surat-permohonan-aktif-kuliah' => \App\Models\Surat\SuratPermohonanAktifKuliah::class,
        'surat-pengajuan-permohonan-perpindahan-ke-kelas-reguler-sore' => \App\Models\Surat\SuratPerpindahanKeKelasSore::class,
        'surat-permohonan-cuti-aktif-mengundurkan-diri' => \App\Models\Surat\SuratPermohonanCutiAktifMengundurkanDiri::class,
        'surat-permohonan-pindah-kuliah' => \App\Models\Surat\SuratPermohonanPindahKuliah::class,
        'surat-pengunduran-diri' => \App\Models\Surat\SuratPengunduranDiri::class,
        'surat-ujian-susulan' => \App\Models\Surat\SuratUjianSusulan::class,
        'surat-ujian-susulan-dengan-matkul' => \App\Models\Surat\SuratUjianSusulanMatkul::class,
        'surat-tugas-mengajar' => \App\Models\Surat\SuratTugasMengajar::class,
    ];

    // =====================
    // 1. TAMPILKAN SEMUA TEMPLATE
    // =====================
    public function index()
    {
        $templates = TemplateSurat::with('jenis')->get();
        return view('surat.surat', compact('templates'));
    }

    // =====================
    // 2. TAMPILKAN TEMPLATE TERPILIH
    // =====================

    public function show($slug)
    {
        // ambil template berdasarkan slug
        $dataTemplate = TemplateSurat::with('pimpinan.user')
            ->where('slug', $slug)
            ->firstOrFail();

        // tentukan model final
        $modelClass = $this->templateMap[$slug] ?? null;
        $fillable = $modelClass ? (new $modelClass)->getFillable() : [];

        // field yang TIDAK BOLEH dirender di form
        $reserved = [
            'nomor_surat',
            'lampiran',
            'perihal',
            'pimpinan_nama',
            'pimpinan_jabatan',
            'pimpinan_ttd',
            'tgl_surat',
            'id',
            'ts_id',    // otomatis, disembunyikan
            'user_id',  // otomatis, disembunyikan
        ];

        // generate fields untuk form (selain reserved)
        $fields = [];
        foreach (array_diff($fillable, $reserved) as $f) {
            $fields[] = [
                'label' => ucwords(str_replace('_', ' ', $f)),
                'name' => $f,
                'type' => str_contains($f, 'tgl') ? 'date' : 'text',
            ];
        }

        // data pimpinan
        $pimpinan = $dataTemplate->pimpinan;
        $userPimpinan = optional($pimpinan)->user; // akses relasi user

        // default values
        $defaults = [
            'nomor_surat' => $this->generateNomorSurat($dataTemplate->id),
            'lampiran' => '',
            'perihal' => $dataTemplate->nama_template ?? '',
            'pimpinan_nama' => $userPimpinan->name ?? '',   // dari tabel users
            'pimpinan_jabatan' => $pimpinan->jabatan ?? '',
            'pimpinan_ttd' => $pimpinan->ttd ?? '',
            'tgl_surat' => now()->toDateString(),
        ];

        $bodyTemplateRaw = $dataTemplate->body_template;

        return view('surat.show', compact(
            'dataTemplate',
            'fields',
            'defaults',
            'bodyTemplateRaw',
            'fillable'
        ));
    }

    public function store(Request $request, $slug)
    {
        $dataTemplate = TemplateSurat::where('slug', $slug)->firstOrFail();
        $modelClass = $this->templateMap[$slug] ?? null;

        if (!$modelClass) {
            return back()->with('error', 'Model final surat belum dikonfigurasi.');
        }

        $fillable = (new $modelClass)->getFillable();

        // ambil hanya field yang ada di fillable
        $payload = $request->only($fillable);

        // override otomatis (tidak boleh datang dari form)
        $payload['user_id'] = Auth::id();

        // nomor surat
        $payload['nomor_surat'] = $payload['nomor_surat']
            ?? $this->generateNomorSurat($dataTemplate->id);

        // lampiran boleh kosong
        if (empty($payload['lampiran'])) {
            $payload['lampiran'] = '';
        }

        // create final surat
        $suratFinal = $modelClass::create($payload);

        // buat transaksi surat
        $transaksi = TransaksiSurat::create([
            'template_surat_id' => $dataTemplate->id,
            'surat_id' => $suratFinal->id,
            'nomor_surat' => $payload['nomor_surat'],
            'tahun' => date('Y'),
        ]);

        // update ts_id otomatis
        if (in_array('ts_id', $fillable)) {
            $suratFinal->update(['ts_id' => $transaksi->id]);
        }

        // kirim notifikasi ke semua user role kaprodi (role_id = 4)
        // $kaprodiUsers = User::where('role_id', 4)->get();

        // foreach ($kaprodiUsers as $kaprodi) {
        //     $kaprodi->notify(new SuratBaruNotification($suratFinal));
        // }

        return redirect()->route('surat.show', $dataTemplate->slug)
            ->with('success', 'Surat berhasil dibuat!');
    }

    // =====================
    // 4. GENERATE NO SURAT
    // =====================
    private function generateNomorSurat($templateId)
    {
        $count = TransaksiSurat::where('template_surat_id', $templateId)->count() + 1;
        return sprintf("%03d", $count) . "/FTI/" . date('Y');
    }
}
