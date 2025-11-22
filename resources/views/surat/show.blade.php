<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $dataTemplate->nama_template }}
        </h2>
    </x-slot>

    <br><br>
    <button onclick="openSuratModal()"
        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
        Buat Surat
    </button>

    {{-- Modal --}}
    <div id="suratModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
        <div class="bg-white w-11/12 md:w-2/3 mx-auto mt-20 rounded-lg p-6 flex gap-6">

            {{-- Form Dinamis --}}
            <div class="w-1/2 space-y-4">
                <h3 class="text-lg font-semibold">Isi Form Surat</h3>

                @foreach ($fields as $f)
                    <div>
                        <label class="block text-sm font-medium mb-1">{{ $f['label'] }}</label>

                        @if($f['type'] === 'text')
                            <input type="text" name="{{ $f['name'] }}"
                                class="w-full border rounded p-2" />
                        @elseif($f['type'] === 'date')
                            <input type="date" name="{{ $f['name'] }}"
                                class="w-full border rounded p-2" />
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Preview Dinamis --}}
            {{-- <div class="w-1/2">
                <h3 class="text-lg font-semibold mb-2">Preview</h3>
                <iframe src="{{ route('surat.preview', $dataTemplate->nama_template) }}"
                        class="w-full h-96 border rounded"></iframe>
            </div> --}}

        </div>
    </div>

</x-app-layout>
