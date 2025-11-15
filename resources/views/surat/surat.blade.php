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
                                        {{-- optional short preview dari HTML (strip tags untuk ringkas) --}}
                                        {!! Str::limit(strip_tags($template->html_template), 200) !!}
                                    </div>

                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                        Editable fields: {{ implode(', ', array_map(function ($f) {
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
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-3xl p-6 overflow-auto max-h-[90vh]">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h2 id="templateTitle" class="text-xl font-bold text-gray-800 dark:text-gray-100">Template</h2>
                    <p id="templateSubtitle" class="text-sm text-gray-500 dark:text-gray-300">Isi field sesuai kebutuhan
                        lalu klik Simpan.</p>
                </div>
                <button onclick="closeTemplateModal()" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <form id="templateForm" method="POST">
                @csrf

                <input type="hidden" name="template_id" id="template_id">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    {{-- Left: Preview HTML template --}}
                    <div>
                        <h3 class="font-semibold mb-2 text-gray-700 dark:text-gray-200">Preview Template</h3>
                        <div id="templatePreview"
                            class="prose max-w-none dark:prose-invert p-4 border rounded-md bg-gray-50 dark:bg-gray-900 overflow-auto"
                            style="min-height: 200px;"></div>
                    </div>

                    {{-- Right: Generated inputs from editable_fields --}}
                    <div>
                        <h3 class="font-semibold mb-2 text-gray-700 dark:text-gray-200">Isi Kolom</h3>
                        <div id="dynamicFields" class="space-y-3">
                            {{-- JS akan generate input di sini --}}
                        </div>

                        {{-- Common fields (nomor/perihal/tanggal) — kalau ada di editable_fields akan digenerate juga,
                        tapi sedia optional --}}
                        <div class="mt-4">
                            <label class="block text-sm font-medium">Nomor Surat (opsional)</label>
                            <input type="text" name="nomor" id="nomor"
                                class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                        </div>
                        <div class="mt-3">
                            <label class="block text-sm font-medium">Perihal (opsional)</label>
                            <input type="text" name="perihal" id="perihal"
                                class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                        </div>
                        <div class="mt-3">
                            <label class="block text-sm font-medium">Tanggal Surat (opsional)</label>
                            <input type="date" name="tanggal_surat" id="tanggal_surat"
                                class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="closeTemplateModal()"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">Simpan Surat</button>
                </div>
            </form>
        </div>
    </div>

    {{-- JS --}}
    <script>
        const templateModal = document.getElementById('templateModal');
        const templateModalContent = document.getElementById('templateModalContent');
        const templateTitle = document.getElementById('templateTitle');
        const templateSubtitle = document.getElementById('templateSubtitle');
        const templatePreview = document.getElementById('templatePreview');
        const dynamicFields = document.getElementById('dynamicFields');
        const templateForm = document.getElementById('templateForm');
        const templateIdInput = document.getElementById('template_id');

        // open modal dengan object templateData
        function openTemplateModal(templateData) {
            // set title & preview
            templateTitle.textContent = templateData.nama_template ?? 'Template';
            templatePreview.innerHTML = templateData.html_template ?? '';

            // set template id for form action and hidden input
            templateIdInput.value = templateData.id;

            // generate form inputs berdasarkan editable_fields
            generateDynamicFields(templateData.editable_fields || []);

            // set form action: POST /user/surat/{template}
            templateForm.action = `/user/surat/${templateData.id}`;

            // show modal
            templateModal.classList.remove('hidden');
            setTimeout(() => {
                templateModalContent.classList.remove('scale-95', 'opacity-0');
            }, 10);
        }

        function closeTemplateModal() {
            templateModal.classList.add('hidden');
            // clear dynamic fields
            dynamicFields.innerHTML = '';
            templatePreview.innerHTML = '';
            templateForm.reset();
        }

        // generate inputs from editable_fields array
        function generateDynamicFields(fields) {
            dynamicFields.innerHTML = '';

            // support dua bentuk: array of strings OR array of objects [{name,label,type}]
            fields.forEach(f => {
                let name, label, type;
                if (typeof f === 'string') {
                    name = f;
                    label = f.replace(/_/g, ' ');
                    type = 'text';
                } else if (typeof f === 'object') {
                    name = f.name || (f.field || 'field');
                    label = f.label || name.replace(/_/g, ' ');
                    type = f.type || 'text';
                } else {
                    return;
                }

                const id = `field_${name}`;

                const wrapper = document.createElement('div');
                wrapper.className = 'space-y-1';

                const lbl = document.createElement('label');
                lbl.className = 'block text-sm font-medium';
                lbl.textContent = label.charAt(0).toUpperCase() + label.slice(1);
                wrapper.appendChild(lbl);

                if (type === 'textarea') {
                    const ta = document.createElement('textarea');
                    ta.name = `editable_fields[${name}]`;
                    ta.id = id;
                    ta.rows = 4;
                    ta.className = 'mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100';
                    wrapper.appendChild(ta);
                } else if (type === 'date') {
                    const inp = document.createElement('input');
                    inp.type = 'date';
                    inp.name = `editable_fields[${name}]`;
                    inp.id = id;
                    inp.className = 'mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100';
                    wrapper.appendChild(inp);
                } else {
                    // default text
                    const inp = document.createElement('input');
                    inp.type = 'text';
                    inp.name = `editable_fields[${name}]`;
                    inp.id = id;
                    inp.className = 'mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100';
                    wrapper.appendChild(inp);
                }

                dynamicFields.appendChild(wrapper);
            });

            if (fields.length === 0) {
                const note = document.createElement('p');
                note.className = 'text-sm text-gray-500';
                note.textContent = 'Template ini tidak memiliki field yang dapat di-edit.';
                dynamicFields.appendChild(note);
            }
        }

        // close when click outside
        templateModal.addEventListener('click', (e) => {
            if (e.target === templateModal) closeTemplateModal();
        });
    </script>
</x-app-layout>
