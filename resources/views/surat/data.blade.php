<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Surat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Alert --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @elseif(session('updated'))
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Diperbarui!</strong>
                    <span class="block sm:inline">{{ session('updated') }}</span>
                </div>
            @elseif(session('deleted'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Dihapus!</strong>
                    <span class="block sm:inline">{{ session('deleted') }}</span>
                </div>
            @endif

            {{-- Tombol aksi utama --}}
            <div class="flex justify-between items-center">
                <div>
                    <a href="{{ route('user.template.index') }}"
                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md">Pilih Template</a>
                </div>

                <div class="flex items-center gap-2">
                    <form method="GET" action="{{ route('user.surat.index') }}" class="flex items-center">
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="Cari nomor / perihal / pengirim"
                            class="rounded-md border-gray-300 px-3 py-2" />
                        <button type="submit"
                            class="ml-2 px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">Cari</button>
                    </form>
                </div>
            </div>

            {{-- Tabel daftar surat --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Daftar Surat</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nomor</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Perihal</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Pengirim</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Penerima</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($surats as $surat)
                                    <tr>
                                        <td class="px-6 py-4 text-sm">{{ $surats->firstItem() + $loop->index }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $surat->nomor ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            {{ Str::limit($surat->perihal ?? ($surat->isi_html ? strip_tags($surat->isi_html) : '-'), 60) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            {{ optional($surat->tanggal_surat)->format('d-m-Y') ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $surat->pengirim ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm">{{ $surat->penerima ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm">{{ ucfirst($surat->status ?? 'draft') }}</td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <button onclick="openViewModal(@json($surat))"
                                                class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md inline-flex items-center gap-1 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path d="M2 10s3-6 8-6 8 6 8 6-3 6-8 6-8-6-8-6z" />
                                                    <path d="M10 13a3 3 0 100-6 3 3 0 000 6z" />
                                                </svg>
                                                Lihat
                                            </button>

                                            {{-- Edit: jika punya route edit, user bisa menambahkan --}}
                                            <a href="{{ url('/user/surat/edit/' . $surat->id) }}"
                                                class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md inline-flex items-center gap-1 transition">Edit</a>

                                            <button onclick="confirmDelete({{ $surat->id }})"
                                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md inline-flex items-center gap-1 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-gray-500 dark:text-gray-400">Belum ada
                                            data surat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $surats->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: View Surat --}}
    <div id="viewModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-start justify-center z-50 overflow-auto">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-11/12 max-w-4xl p-6 mt-10 mb-10">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Preview Surat</h3>
                <button type="button" onclick="closeViewModal()" class="text-red-600 font-bold text-xl">&times;</button>
            </div>

            <div id="viewContent" class="prose max-w-full text-black dark:text-gray-100"></div>

            <div class="flex justify-end mt-4">
                <button type="button" onclick="closeViewModal()"
                    class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md mr-2">Tutup</button>
                <a id="downloadLink" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md"
                    target="_blank">Download PDF</a>
            </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div id="deleteModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300">
        <div id="deleteModalContent"
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6 text-center transform scale-95 opacity-0 transition-all duration-300">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Konfirmasi Hapus</h2>
            <p class="mb-6 text-gray-600 dark:text-gray-300">Apakah kamu yakin ingin menghapus surat ini?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-center space-x-2">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script Modal --}}
    <script>
        const viewModal = document.getElementById('viewModal');
        const viewContent = document.getElementById('viewContent');
        const downloadLink = document.getElementById('downloadLink');
        const deleteModal = document.getElementById('deleteModal');
        const deleteModalContent = document.getElementById('deleteModalContent');
        const deleteForm = document.getElementById('deleteForm');

        function openViewModal(surat) {
            // surat.isi_html kemungkinan berisi HTML
            viewContent.innerHTML = surat.isi_html || '<p class="text-gray-500">Tidak ada konten.</p>';
            // jika mau download via route, sesuaikan URL ini
            downloadLink.href = `/user/surat/${surat.id}/download`;
            viewModal.classList.remove('hidden');
            window.scrollTo(0, 0);
        }

        function closeViewModal() {
            viewModal.classList.add('hidden');
            viewContent.innerHTML = '';
        }

        function confirmDelete(id) {
            deleteForm.action = `/user/surat/${id}`;
            deleteModal.classList.remove('hidden');
            setTimeout(() => {
                deleteModalContent.classList.remove('scale-95', 'opacity-0');
                deleteModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDeleteModal() {
            deleteModalContent.classList.remove('scale-100', 'opacity-100');
            deleteModalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => deleteModal.classList.add('hidden'), 200);
        }

        // klik backdrop untuk tutup
        viewModal.addEventListener('click', (e) => { if (e.target === viewModal) closeViewModal(); });
        deleteModal.addEventListener('click', (e) => { if (e.target === deleteModal) closeDeleteModal(); });
    </script>
</x-app-layout>
