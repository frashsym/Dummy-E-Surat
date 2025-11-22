<?php
namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use App\Models\TransaksiSurat;
use Illuminate\Http\Request;

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
    public function show($template)
    {
        $dataTemplate = TemplateSurat::where('slug', $template)->firstOrFail();

        // tentukan model target tabel final
        $model = $this->templateMap[$dataTemplate->slug] ?? null;
        if (!$model) {
            abort(404, "Template surat tidak ditemukan.");
        }

        // ambil field dari model final
        $fillable = (new $model)->getFillable();

        $fields = [];
        foreach ($fillable as $f) {
            $fields[] = [
                'label' => ucwords(str_replace('_', ' ', $f)),
                'name' => $f,
                'type' => str_contains($f, 'tgl') ? 'date' : 'text',
            ];
        }

        return view('surat.show', compact('template', 'dataTemplate', 'fields'));
    }

    // =====================
    // 3. SIMPAN SURAT KE TABEL FINAL
    // =====================
    public function store(Request $request, $template)
    {
        $dataTemplate = TemplateSurat::where('nama_template', $template)->firstOrFail();

        // dapatkan model final
        $model = $this->templateMap[$template] ?? null;
        if (!$model) {
            abort(404, "Model final surat tidak ditemukan.");
        }

        // simpan ke tabel surat final
        $suratFinal = $model::create(
            $request->only((new $model)->getFillable())
        );

        // generate nomor surat otomatis
        $nomor = $this->generateNomorSurat($dataTemplate->id);

        // simpan transaksi surat
        TransaksiSurat::create([
            'template_surat_id' => $dataTemplate->id,
            'surat_id' => $suratFinal->id,
            'nomor_surat' => $nomor,
            'tahun' => date('Y'),
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat!');
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
