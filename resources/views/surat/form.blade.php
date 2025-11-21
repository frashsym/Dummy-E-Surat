<x-app-layout>
    <div class="py-6">

        <a href="{{ route('surat.index') }}" class="text-blue-600 text-sm mb-4 inline-block">← Kembali</a>

        <h2 class="text-2xl font-bold mb-6">{{ $dataTemplate->nama_template }}</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- PREVIEW TEMPLATE -->
            <div class="bg-white p-5 border rounded-xl shadow-sm">
                <h3 class="text-lg font-semibold mb-4">Preview Template</h3>

                <div id="templatePreview" class="border p-4 rounded-md bg-gray-50 min-h-[300px]">
                    <p><strong>Jenis:</strong> {{ $dataTemplate->jenis->nama }}</p>

                    <div class="mt-3 text-gray-700 text-sm">
                        <p><strong>Catatan:</strong> Silakan isi form di kanan, dan bagian yang sesuai akan tergantikan
                            otomatis ketika generate PDF nanti.</p>
                    </div>
                </div>
            </div>

            <!-- FORM FIELD -->
            <div class="bg-white p-6 border rounded-xl shadow-sm">
                <h3 class="text-lg font-semibold mb-4">Isi Data Surat</h3>

                <form method="POST" action="{{ route('surat.store', $template) }}">
                    @csrf

                    @foreach ($fields as $field)
                        @if(!in_array($field, ['id', 'ts_id', 'created_at', 'updated_at']))
                            <div class="mb-4">
                                <label class="block mb-1 font-medium capitalize">
                                    {{ str_replace('_', ' ', $field) }}
                                </label>
                                <input type="text" name="{{ $field }}" class="w-full border rounded-md p-2" required>
                            </div>
                        @endif
                    @endforeach

                    <button class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                        Simpan Surat
                    </button>
                </form>

            </div>
        </div>

    </div>
</x-app-layout>
