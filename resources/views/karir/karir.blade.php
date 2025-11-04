<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Karir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Alert sukses --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Tombol tambah --}}
            <div class="flex justify-end">
                <button onclick="openModal()"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md flex items-center gap-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Karir
                </button>
            </div>

            {{-- Tabel daftar karir --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Daftar Karir</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nama Karir</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Deskripsi</th>
                                    @admin
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Aksi</th>
                                    @endadmin
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($karirs as $karir)
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $karir->nama_karir }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">
                                        {{ $karir->deskripsi }}
                                    </td>
                                    @admin
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <button onclick="openModal({{ $karir }})"
                                            class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md inline-flex items-center gap-1 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L6 11.172V14h2.828l8.586-8.586a2 2 0 000-2.828z" />
                                            </svg>
                                            Edit
                                        </button>

                                        <button onclick="confirmDelete({{ $karir->id }})"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md inline-flex items-center gap-1 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </td>
                                    @endadmin
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-500 dark:text-gray-400">Belum ada
                                        data.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $karirs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create/Edit --}}
    <div id="karirModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300">
        <div id="karirModalContent"
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-lg p-6 transform scale-95 opacity-0 transition-all duration-300">
            <h2 id="modalTitle" class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Tambah Karir</h2>
            <form id="karirForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="mb-4">
                    <label for="nama_karir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                        Karir</label>
                    <input type="text" id="modalNamaKarir" name="nama_karir"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                    <textarea id="modalDeskripsi" name="deskripsi" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div id="deleteModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300">
        <div id="deleteModalContent"
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6 text-center transform scale-95 opacity-0 transition-all duration-300">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Konfirmasi Hapus</h2>
            <p class="mb-6 text-gray-600 dark:text-gray-300">Apakah kamu yakin ingin menghapus data ini?</p>
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

    {{-- Script Modal Animation --}}
    <script>
        const karirModal = document.getElementById('karirModal');
        const karirModalContent = document.getElementById('karirModalContent');
        const modalTitle = document.getElementById('modalTitle');
        const karirForm = document.getElementById('karirForm');
        const formMethod = document.getElementById('formMethod');
        const namaInput = document.getElementById('modalNamaKarir');
        const deskripsiInput = document.getElementById('modalDeskripsi');

        function openModal(karir = null) {
            if (karir) {
                modalTitle.textContent = 'Edit Karir';
                karirForm.action = `/karir/${karir.id}`;
                formMethod.value = 'PUT';
                namaInput.value = karir.nama_karir;
                deskripsiInput.value = karir.deskripsi || '';
            } else {
                modalTitle.textContent = 'Tambah Karir';
                karirForm.action = `{{ route('karir.store') }}`;
                formMethod.value = 'POST';
                namaInput.value = '';
                deskripsiInput.value = '';
            }

            karirModal.classList.remove('hidden');
            setTimeout(() => {
                karirModalContent.classList.remove('scale-95', 'opacity-0');
                karirModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            karirModalContent.classList.remove('scale-100', 'opacity-100');
            karirModalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                karirModal.classList.add('hidden');
            }, 200);
        }

        // ✅ Tutup modal jika klik di luar konten
        karirModal.addEventListener('click', (e) => {
            if (e.target === karirModal) {
                closeModal();
            }
        });


        const deleteModal = document.getElementById('deleteModal');
        const deleteModalContent = document.getElementById('deleteModalContent');
        const deleteForm = document.getElementById('deleteForm');

        function confirmDelete(id) {
            deleteForm.action = `/karir/${id}`;
            deleteModal.classList.remove('hidden');
            setTimeout(() => {
                deleteModalContent.classList.remove('scale-95', 'opacity-0');
                deleteModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDeleteModal() {
            deleteModalContent.classList.remove('scale-100', 'opacity-100');
            deleteModalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                deleteModal.classList.add('hidden');
            }, 200);
        }

        // ✅ Tutup modal delete jika klik di luar konten
        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) {
                closeDeleteModal();
            }
        });
    </script>

</x-app-layout>
