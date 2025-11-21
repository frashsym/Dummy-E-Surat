<x-app-layout>
    <div class="py-6">
        <h2 class="text-2xl font-bold mb-6">Daftar Template Surat</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($templates as $t)
                <a href="{{ route('surat.show', $t->nama_template) }}">
                    <div class="bg-white shadow-md border border-gray-200 rounded-xl p-5 hover:shadow-lg transition">

                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold">{{ $t->nama_template }}</h3>
                            <span class="text-sm text-gray-500 px-2 py-1 bg-gray-100 rounded-md">
                                {{ $t->jenis->nama }}
                            </span>
                        </div>

                        <p class="mt-3 text-sm text-gray-600">
                            Klik untuk membuat surat berdasarkan template ini.
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
