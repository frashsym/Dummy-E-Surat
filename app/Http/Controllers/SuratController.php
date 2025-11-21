<?php
namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use App\Models\TransaksiSurat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    private $templateMap = [
        'studi_praktek_akuntansi' => \App\Models\SuratPermohonanStudiPraktekAkuntansi::class,
        'izin_penelitian' => \App\Models\SuratPermohonanIzinPenelitian::class,
        'studi_praktek_manajemen' => \App\Models\SuratPermohonanStudiPraktekManajemen::class,
        'izin_observasi' => \App\Models\SuratPermohonanIzinObservasi::class,
        'keterangan_masih_kuliah' => \App\Models\SuratKeteranganMasihKuliah::class,
        'keterangan_masih_kuliah_ortu' => \App\Models\SuratKeteranganMasihKuliahOrtuDetail::class,
        'aktif_kuliah' => \App\Models\SuratPermohonanAktifKuliah::class,
        'perpindahan_kelas_reguler' => \App\Models\SuratPerpindahanKeKelasSore::class,
        'cuti_aktif_mundur' => \App\Models\SuratPermohonanCutiAktifMengundurkanDiri::class,
        'pindah_kuliah' => \App\Models\SuratPermohonanPindahKuliah::class,
        'pengunduran_diri' => \App\Models\SuratPengunduranDiri::class,
        'ujian_susulan' => \App\Models\SuratUjianSusulan::class,
        'ujian_susulan_matkul' => \App\Models\SuratUjianSusulanMatkul::class,
        'tugas_mengajar' => \App\Models\SuratTugasMengajar::class,
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
        $dataTemplate = TemplateSurat::where('nama_template', $template)->firstOrFail();

        // tentukan model target tabel final
        $model = $this->templateMap[$template] ?? null;
        if (!$model) {
            abort(404, "Template surat tidak ditemukan.");
        }

        // dapatkan field yg akan diedit
        // opsional: ambil dari file json / dari Blade
        $fields = (new $model)->getFillable();

        return view('surat.form', compact('template', 'dataTemplate', 'fields'));
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
