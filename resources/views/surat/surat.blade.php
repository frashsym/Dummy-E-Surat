<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pilih Template Surat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alerts --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Grid template cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($templates as $template)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 flex flex-col">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                                        {{ $template->nama_template }}
                                    </h3>

                                    <div class="text-sm text-gray-600 dark:text-gray-300 mb-3 line-clamp-4">
                                        {!! Str::limit(strip_tags($template->html_template), 200) !!}
                                    </div>

                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                        Editable fields:
                                        {{ implode(', ', array_map(function ($f) {
                    return is_string($f) ? $f : ($f['name'] ?? 'field'); }, $template->editable_fields ?: [])) }}
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-end gap-2">
                                    <button onclick='openTemplateModal(@json($template))'
                                        class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                                        Gunakan Template
                                    </button>
                                </div>
                            </div>
                @empty
                    <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                        Belum ada template surat.
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $templates->links() }}
            </div>
        </div>
    </div>

    {{-- Modal: Isi Template dan Simpan ke Surats --}}
    <div id="templateModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div id="templateModalContent"
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-3xl p-6 overflow-auto max-h-[90vh] scale-95 opacity-0 transition-all duration-150">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h2 id="templateTitle" class="text-xl font-bold text-gray-800 dark:text-gray-100">Template</h2>
                    <p id="templateSubtitle" class="text-sm text-gray-500 dark:text-gray-300">Isi field sesuai kebutuhan
                        lalu klik Simpan atau lihat Preview.</p>
                </div>
                <button onclick="closeTemplateModal()" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <form id="templateForm" method="POST">
                @csrf

                <input type="hidden" name="template_id" id="template_id">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    {{-- Left: Preview HTML template (rendered as letter) --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-semibold text-gray-700 dark:text-gray-200">Preview Template (Surat)</h3>
                            <div class="space-x-2">
                                <button type="button" onclick="buildPreview()"
                                    class="px-3 py-1 bg-yellow-500 rounded text-white">Update Preview</button>
                                <button type="button" onclick="printPreview()"
                                    class="px-3 py-1 bg-green-600 rounded text-white">Print</button>
                                <button type="button" onclick="openPreviewModal()"
                                    class="px-3 py-1 bg-blue-600 rounded text-white">Perbesar Preview</button>
                            </div>
                        </div>

                        <!-- Modal Preview Besar -->
                        <div id="previewModal"
                            class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">

                            <div class="bg-white w-11/12 h-5/6 p-4 rounded shadow overflow-auto">
                                <div class="flex justify-between items-center mb-2">
                                    <h2 class="text-lg font-semibold">Preview Surat (Perbesar)</h2>
                                    <button type="button" onclick="closePreviewModal()"
                                        class="text-red-600 font-bold text-xl">&times;</button>
                                </div>

                                <div id="modalPreviewContent" class="p-4 border">
                                    <!-- isi HTML surat akan dimasukkan otomatis -->
                                </div>
                            </div>
                        </div>

                        <div id="previewArea" class="p-6 bg-white text-black rounded shadow overflow-auto border"
                            style="width:100%; min-height:520px;">
                            {{-- JS akan render surat di sini dalam layout kertas A4-like --}}
                        </div>
                    </div>

                    {{-- Right: Generated inputs from editable_fields --}}
                    <div>
                        <h3 class="font-semibold mb-2 text-gray-700 dark:text-gray-200">Isi Kolom</h3>
                        <div id="dynamicFields" class="space-y-3">
                            {{-- JS akan generate input di sini --}}
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="closeTemplateModal()"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md">Batal</button>
                    <!-- Hidden: hasil render HTML yg akan disimpan ke kolom isi_html -->
                    <input type="hidden" name="isi_html" id="isi_html" value="">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">Simpan Surat</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tailwind + Custom CSS for the letter preview --}}
    <style>
        /* make preview look like A4 paper with margin */
        #previewArea .paper {
            box-sizing: border-box;
            width: 210mm;
            /* A4 width */
            min-height: 297mm;
            /* A4 height */
            padding: 22mm;
            background: white;
            color: #111827;
            font-family: 'Times New Roman', Georgia, serif;
            font-size: 14px;
            line-height: 1.45;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
        }

        .kop-surat {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .kop-surat img {
            width: 110px;
            height: auto;
        }

        .kop-surat .info {
            font-size: 12px;
        }

        .kop-surat .info strong {
            font-size: 16px;
            display: block;
        }

        hr.sep {
            border: none;
            border-top: 3px solid #222;
            margin: 12px 0 18px;
        }

        .header-surat table {
            width: 100%;
        }

        .header-right {
            text-align: right;
        }

        .body-content {
            margin-top: 10px;
            text-align: justify;
        }

        .data-table {
            margin-top: 14px;
            width: 100%;
        }

        .data-table td {
            padding: 4px 6px;
            vertical-align: top;
        }

        .signature {
            margin-top: 28px;
            width: 100%;
        }

        .signature .right {
            float: right;
            text-align: center;
        }

        .signature img.sig {
            width: 160px;
            height: auto;
            display: block;
            margin: 6px auto 0;
        }

        /* small screens in modal: scale paper to fit */
        #previewArea {
            display: flex;
            justify-content: center;
        }

        #previewArea .paper {
            transform-origin: top left;
        }

        @media (max-width: 1100px) {
            #previewArea .paper {
                transform: scale(0.8);
            }
        }

        @media (max-width: 800px) {
            #previewArea .paper {
                transform: scale(0.65);
            }
        }

        /* print styles */
        @media print {
            body * {
                visibility: hidden;
            }

            #printablePaper,
            #printablePaper * {
                visibility: visible;
            }

            #printablePaper {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>

    {{-- JS --}}
    <script>

        function openPreviewModal() {
            // ambil preview utama
            const previewHTML = document.getElementById('previewArea').innerHTML;

            // masukkan ke modal
            document.getElementById('modalPreviewContent').innerHTML = previewHTML;

            // tampilkan modal
            document.getElementById('previewModal').classList.remove('hidden');
        }

        function closePreviewModal() {
            document.getElementById('previewModal').classList.add('hidden');
        }

        const templateModal = document.getElementById('templateModal');
        const templateModalContent = document.getElementById('templateModalContent');
        const templateTitle = document.getElementById('templateTitle');
        const dynamicFields = document.getElementById('dynamicFields');
        const templateForm = document.getElementById('templateForm');
        const templateIdInput = document.getElementById('template_id');
        const previewArea = document.getElementById('previewArea');
        const isiHtmlInput = document.getElementById('isi_html');

        let currentTemplateHtml = ''; // keep raw html_template here

        function openTemplateModal(templateData) {
            templateTitle.textContent = templateData.nama_template ?? 'Template';

            // raw html template (store)
            currentTemplateHtml = templateData.html_template ?? '';
            templateModal.dataset.rawHtml = currentTemplateHtml;

            templateIdInput.value = templateData.id;

            // Parse editable_fields - can be JSON string or array
            let editable = templateData.editable_fields ?? [];
            try {
                if (typeof editable === 'string') {
                    editable = JSON.parse(editable);
                }
            } catch (err) {
                // jika JSON parsing gagal, fallback ke array dengan string terpisah
                editable = Array.isArray(editable) ? editable : [];
            }

            // Extract placeholders from html_template like {perihal}
            const placeholders = Array.from(new Set(extractPlaceholders(currentTemplateHtml)));

            // Union between editable array and placeholders -> generate fields
            const fieldsToGenerate = Array.from(new Set([...(editable || []), ...placeholders]));

            generateDynamicFields(fieldsToGenerate);

            // Set form action (sesuaikan route mu)
            templateForm.action = `/user/surat/template/${templateData.id}`;

            // show modal
            templateModal.classList.remove('hidden');
            setTimeout(() => templateModalContent.classList.remove('scale-95', 'opacity-0'), 10);

            // initial preview
            buildPreview();
        }

        function extractPlaceholders(html) {
            const re = /\{([^}\s]+)\}/g;
            let m;
            const arr = [];
            while ((m = re.exec(html)) !== null) {
                arr.push(m[1]);
            }
            return arr;
        }

        function closeTemplateModal() {
            templateModal.classList.add('hidden');
            dynamicFields.innerHTML = '';
            previewArea.innerHTML = '';
            templateForm.reset();
            currentTemplateHtml = '';
            isiHtmlInput.value = '';
        }

        function generateDynamicFields(fields) {
            dynamicFields.innerHTML = '';

            if (!fields || fields.length === 0) {
                const note = document.createElement('p');
                note.className = 'text-sm text-gray-500';
                note.textContent = 'Template ini tidak memiliki field yang dapat di-edit.';
                dynamicFields.appendChild(note);
                return;
            }

            fields.forEach(f => {
                const name = (typeof f === 'string') ? f : (f.name || f.field || 'field');
                const label = name.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
                const wrapper = document.createElement('div');
                wrapper.className = 'space-y-1';

                const lbl = document.createElement('label');
                lbl.className = 'block text-sm font-medium';
                lbl.textContent = label;
                wrapper.appendChild(lbl);

                // gunakan input text default; jika ada kata 'isi' atau 'keterangan' gunakan textarea
                if (/isi|keterangan|deskripsi|paragraph|body/i.test(name)) {
                    const ta = document.createElement('textarea');
                    ta.name = name; // NOTE: name langsung -> server menerima 'perihal', 'kepada_yth', dsb
                    ta.id = `field_${name}`;
                    ta.rows = 4;
                    ta.className = 'mt-1 w-full rounded-md border-gray-300';
                    wrapper.appendChild(ta);
                } else if (/tanggal|tgl|date/i.test(name)) {
                    const inp = document.createElement('input');
                    inp.type = 'date';
                    inp.name = name;
                    inp.id = `field_${name}`;
                    inp.className = 'mt-1 w-full rounded-md border-gray-300';
                    wrapper.appendChild(inp);
                } else {
                    const inp = document.createElement('input');
                    inp.type = 'text';
                    inp.name = name;
                    inp.id = `field_${name}`;
                    inp.className = 'mt-1 w-full rounded-md border-gray-300';
                    wrapper.appendChild(inp);
                }

                dynamicFields.appendChild(wrapper);
            });
        }

        // Build preview by replacing placeholders in currentTemplateHtml
        function buildPreview() {
            // get values from all generated inputs + common fields
            const inputs = dynamicFields.querySelectorAll('[name]');
            const values = {};
            inputs.forEach(i => values[i.name] = i.value || '');

            // also include nomor/perihal/tanggal umum jika ada inputs with those ids outside dynamic fields
            ['nomor', 'perihal', 'tanggal_surat', 'perihal'].forEach(k => {
                const el = document.getElementById(k);
                if (el && el.value) values[k] = el.value;
            });

            // Replace placeholders in template html
            let rendered = currentTemplateHtml || '';
            // perform replace for each placeholder {key} -> value (escape not applied here; if user wants html in isi, allow)
            rendered = rendered.replace(/\{([^}\s]+)\}/g, (match, key) => {
                // fallbacks: if values[key] exists use, else empty string
                return values[key] ?? '';
            });

            // If template html is minimal and user wants paper layout, wrap in our paper wrapper.
            const paper = document.createElement('div');
            paper.className = 'paper';
            paper.id = 'printablePaper';

            // create full letter structure: kop + hr + rendered content
            const kop = document.createElement('div');
            kop.className = 'kop-surat';
            const img = document.createElement('img');
            img.src = '{{ asset("/assets/img/ugj.png") }}';
            img.alt = 'logo';
            kop.appendChild(img);
            const info = document.createElement('div');
            info.className = 'info';
            info.innerHTML = `<strong>UNIVERSITAS GUNUNG JATI CIREBON</strong><br>Jl. Pemuda No.32 Kota Cirebon<br>`;
            kop.appendChild(info);

            paper.appendChild(kop);
            const hr = document.createElement('hr'); hr.className = 'sep'; paper.appendChild(hr);

            // place the rendered HTML (safe innerHTML, assume admin templates are trusted)
            const contentWrap = document.createElement('div');
            contentWrap.className = 'body-content';
            contentWrap.innerHTML = rendered;
            paper.appendChild(contentWrap);

            // signature area (try to use input sign fields if exist)
            const signName = document.getElementById('sign_name')?.value || '';
            const signTitle = document.getElementById('sign_title')?.value || '';
            const signDiv = document.createElement('div'); signDiv.className = 'signature';
            signDiv.innerHTML = `
        <div class="right">
            <div>${signTitle}</div>
            <div style="height:70px"></div>
            <div style="font-weight:700">${signName}</div>
        </div>
        <div style="clear:both"></div>
    `;
            paper.appendChild(signDiv);

            previewArea.innerHTML = '';
            previewArea.appendChild(paper);

            // set hidden isi_html with rendered HTML (server-side will persist)
            isiHtmlInput.value = rendered;
        }

        // ensure isi_html diupdate juga saat submit (safety)
        templateForm.addEventListener('submit', function (e) {
            // update preview first to get latest isi_html
            buildPreview();
            // allow form submit to continue
        });

        // close modal by clicking backdrop
        templateModal.addEventListener('click', (e) => {
            if (e.target === templateModal) closeTemplateModal();
        });
    </script>

</x-app-layout>
