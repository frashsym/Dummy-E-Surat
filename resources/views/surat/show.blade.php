<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $dataTemplate->nama_template }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 grid grid-cols-1 md:grid-cols-12 gap-6">
        {{-- Preview (kiri) --}}
        <div class="md:col-span-8 bg-white p-6 rounded shadow">
            <h3 class="font-semibold mb-4">Preview Surat</h3>
            <div id="suratPreview" class="prose max-w-none">
                {{-- initial rendered content will be filled by JS --}}
            </div>
        </div>

        {{-- Edit / Form (kanan) --}}
        <div class="md:col-span-4 bg-white p-6 rounded shadow">
            <h3 class="font-semibold mb-4">Isi / Edit Surat</h3>

            <form id="suratForm" method="POST" action="{{ route('surat.store', $dataTemplate->slug) }}">
                @csrf

                {{-- tampilkan beberapa field default yg sering auto-prefill --}}
                <div class="mb-3">
                    <label class="block text-sm font-medium">Nomor Surat</label>
                    <input name="nomor_surat" type="text" value="{{ $defaults['nomor_surat'] }}"
                        class="w-full border rounded p-2" />
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Lampiran</label>
                    <input name="lampiran" type="text" value="{{ $defaults['lampiran'] }}"
                        class="w-full border rounded p-2" />
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Perihal</label>
                    <input name="perihal" type="text" value="{{ $defaults['perihal'] }}"
                        class="w-full border rounded p-2" />
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Tanggal Surat</label>
                    <input name="tgl_surat" type="date" value="{{ $defaults['tgl_surat'] }}"
                        class="w-full border rounded p-2" />
                </div>

                {{-- pimpinan (readonly, ambil dari template.pimpinan) --}}
                <div class="mb-3">
                    <label class="block text-sm font-medium">Penandatangan (Nama)</label>
                    <input name="pimpinan_nama" type="text" value="{{ $defaults['pimpinan_nama'] }}"
                        class="w-full border rounded p-2" readonly />
                </div>

                <div class="mb-3">
                    <label class="block text-sm font-medium">Penandatangan (Jabatan)</label>
                    <input name="pimpinan_jabatan" type="text" value="{{ $defaults['pimpinan_jabatan'] }}"
                        class="w-full border rounded p-2" readonly />
                </div>

                {{-- Render form fields dinamis (fields dari model final) --}}
                @foreach ($fields as $f)
                    <div class="mb-3">
                        <label class="block text-sm font-medium">{{ $f['label'] }}</label>
                        @if($f['type'] === 'date')
                            <input type="date" name="{{ $f['name'] }}" class="w-full border rounded p-2" />
                        @else
                            <input type="text" name="{{ $f['name'] }}" class="w-full border rounded p-2" />
                        @endif
                    </div>
                @endforeach

                <div class="flex gap-2 mt-4">
                    <button type="button" id="previewBtn" class="px-4 py-2 bg-gray-200 rounded">Render Preview</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan Surat</button>
                </div>
            </form>

            <p class="text-xs text-gray-500 mt-4">Tip: Ketik di kolom, lalu klik <em>Render Preview</em> untuk melihat
                perubahan langsung.</p>
        </div>
    </div>

    {{-- JS: live rendering of template placeholders --}}
    <script>
        (function () {
            const rawTemplate = {!! json_encode($bodyTemplateRaw) !!};

            // helper: ambil semua input values (form)
            function gatherValues() {
                const values = {};

                // default prefilled fields (nomor, lampiran, perihal, pimpinan_x, tgl_surat)
                const defaults = ['nomor_surat', 'lampiran', 'perihal', 'pimpinan_nama', 'pimpinan_jabatan', 'pimpinan_ttd', 'tgl_surat'];
                defaults.forEach(k => {
                    const el = document.querySelector(`[name="${k}"]`);
                    if (el) values[k] = el.value;
                });

                // semua input lainnya
                document.querySelectorAll('#suratForm [name]').forEach(inp => {
                    values[inp.name] = inp.value;
                });

                return values;
            }

            // render function: replace placeholder  with values
            function renderTemplate(values) {
                // clone rawTemplate to avoid mutating original
                let out = rawTemplate;

                // replace all placeholders like key
                out = out.replace(new RegExp('\\{\\{\\s*([a-zA-Z0-9_]+)\\s*\\}\\}', 'g'), function (match, key) {
                    // `key` here is the first capture group
                    return (values[key] !== undefined && values[key] !== null) ? values[key] : '';
                });

                return out;
            }

            // initial render with defaults from server
            document.addEventListener('DOMContentLoaded', function () {
                const initialValues = {};
                // populate initial values from server-provided defaults object
                const serverDefaults = {!! json_encode($defaults) !!};
                Object.assign(initialValues, serverDefaults);

                // also set form values to defaults (ensures UI matches)
                for (const k in serverDefaults) {
                    const el = document.querySelector(`[name="${k}"]`);
                    if (el) el.value = serverDefaults[k];
                }

                const previewEl = document.getElementById('suratPreview');
                previewEl.innerHTML = renderTemplate(initialValues);
            });

            // preview button listener
            document.getElementById('previewBtn').addEventListener('click', function () {
                const values = gatherValues();
                document.getElementById('suratPreview').innerHTML = renderTemplate(values);
            });

            // optional: live update while typing (debounced)
            let timer;
            document.getElementById('suratForm').addEventListener('input', function () {
                clearTimeout(timer);
                timer = setTimeout(function () {
                    const values = gatherValues();
                    document.getElementById('suratPreview').innerHTML = renderTemplate(values);
                }, 300);
            });

        })();
    </script>
</x-app-layout>
