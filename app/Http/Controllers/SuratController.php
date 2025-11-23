<?php
namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use App\Models\TransaksiSurat;
use Illuminate\Http\Request;
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
        $dataTemplate = TemplateSurat::with('pimpinan')->where('slug', $slug)->firstOrFail();

        // tentukan model target tabel final (assume keys di $templateMap pakai slug)
        $modelClass = $this->templateMap[$slug] ?? null;
        if (!$modelClass) {
            // kalau lo tidak ingin pakai model mapping, tetap generate fields dari contoh model:
            // abort(404, "Template surat tidak ditemukan.");
            $fillable = []; // kosong: form dinamis nanti dari $_templateModel atau manual
        } else {
            $fillable = (new $modelClass)->getFillable();
        }

        // siapkan fields array untuk form (mirip versi sebelumnya)
        $fields = [];
        foreach ($fillable as $f) {
            $fields[] = [
                'label' => ucwords(str_replace('_', ' ', $f)),
                'name' => $f,
                'type' => str_contains($f, 'tgl') ? 'date' : 'text',
            ];
        }

        // default values (prefill)
        $defaultNomor = $this->generateNomorSurat($dataTemplate->id);
        $defaultLampiran = $dataTemplate->nama_template;
        $defaultPerihal = $dataTemplate->nama_template; // atau $dataTemplate->perihal jika ada
        $pimpinan = $dataTemplate->pimpinan; // hasOne relation to pimpinans

        $defaults = [
            'nomor_surat' => $defaultNomor,
            'lampiran' => $defaultLampiran,
            'perihal' => $defaultPerihal,
            'pimpinan_nama' => $pimpinan->nama ?? '',
            'pimpinan_jabatan' => $pimpinan->jabatan ?? '',
            'pimpinan_ttd' => $pimpinan->ttd ?? '',
            'tgl_surat' => Carbon::now()->toDateString(),
        ];

        // pass juga body_template mentah supaya JS bisa render live preview
        $bodyTemplateRaw = $dataTemplate->body_template;

        return view('surat.show', compact('dataTemplate', 'fields', 'defaults', 'bodyTemplateRaw', 'fillable'));
    }

    // =====================
    // 3. SIMPAN SURAT KE TABEL FINAL
    // =====================
    public function store(Request $request, $slug)
    {
        // temukan template by slug
        $dataTemplate = TemplateSurat::where('slug', $slug)->firstOrFail();

        // tentukan model final si surat
        $modelClass = $this->templateMap[$slug] ?? null;
        if (!$modelClass) {
            return back()->with('error', 'Model final surat belum dikonfigurasi.');
        }

        // ambil fillable dari model
        $fillable = (new $modelClass)->getFillable();

        // siapkan data untuk isi tabel final, ambil hanya field yang boleh diisi
        $payload = $request->only($fillable);

        // jika lampiran tidak dikirim, set otomatis dari template
        if (empty($payload['lampiran'])) {
            $payload['lampiran'] = $dataTemplate->nama_template;
        }

        // set ts_id nanti saat create final? tergantung struktur model final
        // contoh model final mengharuskan ts_id diisi: jika iya, kita buat transaksi dulu, tapi sesuai flow lo di code awal:
        $suratFinal = $modelClass::create($payload);

        // generate nomor surat final
        $nomor = $this->generateNomorSurat($dataTemplate->id);

        // simpan transaksi surat (sesuaikan kolom di TransaksiSurat)
        TransaksiSurat::create([
            'template_surat_id' => $dataTemplate->id,
            'surat_id' => $suratFinal->id,
            'nomor_surat' => $nomor,
            'tahun' => date('Y'),
        ]);

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
