<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Template Surat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                @foreach ($templates as $t)
                    <a href="{{ route('surat.show', $t->slug) }}" class="block group">

                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                                    rounded-xl shadow p-5 flex flex-col justify-between h-full
                                    transition-all duration-200 group-hover:-translate-y-1 group-hover:shadow-lg">

                            {{-- Judul --}}
                            <div class="flex justify-between items-start">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 leading-snug">
                                    {{ $t->nama_template }}
                                </h3>

                                <span class="px-3 py-1 text-xs bg-gray-200 dark:bg-gray-700
                                             text-gray-700 dark:text-gray-300 rounded-full">
                                    {{ $t->jenis->nama }}
                                </span>
                            </div>

                            {{-- Deskripsi --}}
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-3">
                                Klik untuk membuat surat berdasarkan template ini.
                            </p>

                        </div>

                    </a>
                @endforeach

            </div>

        </div>
    </div>

</x-app-layout>
