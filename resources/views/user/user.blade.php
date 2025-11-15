<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data User') }}
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

            {{-- Tombol tambah --}}
            <div class="flex justify-end">
                <button onclick="openModal()"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md flex items-center gap-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah User
                </button>
            </div>

            {{-- Tabel daftar user --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Daftar User</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Nama</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Posisi</th>
                                    @superadmin
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Aksi</th>
                                    @endsuperadmin
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($users as $user)
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{ $users->firstItem() + $loop->index }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $user->email }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $user->role->nama_role ?? '-' }}</td>
                                    @superadmin
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <button onclick="openModal({{ $user }})"
                                            class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md inline-flex items-center gap-1 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M17.414 2.586a2 2 0 00-2.828 0L6 11.172V14h2.828l8.586-8.586a2 2 0 000-2.828z" />
                                            </svg>
                                            Edit
                                        </button>

                                        <button onclick="confirmDelete({{ $user->id }})"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md inline-flex items-center gap-1 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </td>
                                    @endsuperadmin
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">Belum ada
                                        data user.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create/Edit --}}
    <div id="userModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300">
        <div id="userModalContent"
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-lg p-6 transform scale-95 opacity-0 transition-all duration-300">
            <h2 id="modalTitle" class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Tambah User</h2>
            <form id="userForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                        <input type="text" id="modalName" name="name"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" id="modalEmail" name="email"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input type="password" id="modalPassword" name="password"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                        <small class="text-gray-500 dark:text-gray-400">Kosongkan jika tidak ingin mengubah
                            password.</small>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                        <select id="modalRole" name="role_id"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100">
                            <option value="">Pilih Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-end space-x-2 mt-6">
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
            <p class="mb-6 text-gray-600 dark:text-gray-300">Apakah kamu yakin ingin menghapus user ini?</p>
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
        const userModal = document.getElementById('userModal');
        const userModalContent = document.getElementById('userModalContent');
        const modalTitle = document.getElementById('modalTitle');
        const userForm = document.getElementById('userForm');
        const formMethod = document.getElementById('formMethod');
        const nameInput = document.getElementById('modalName');
        const emailInput = document.getElementById('modalEmail');
        const passInput = document.getElementById('modalPassword');
        const roleSelect = document.getElementById('modalRole');

        function openModal(user = null) {
            if (user) {
                modalTitle.textContent = 'Edit User';
                userForm.action = `/user/${user.id}`;
                formMethod.value = 'PUT';
                nameInput.value = user.name;
                emailInput.value = user.email;
                passInput.value = '';
                roleSelect.value = user.role_id ?? '';
            } else {
                modalTitle.textContent = 'Tambah User';
                userForm.action = `{{ route('admin.user.store') }}`;
                formMethod.value = 'POST';
                nameInput.value = '';
                emailInput.value = '';
                passInput.value = '';
                roleSelect.value = '';
            }

            userModal.classList.remove('hidden');
            setTimeout(() => {
                userModalContent.classList.remove('scale-95', 'opacity-0');
                userModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            userModalContent.classList.remove('scale-100', 'opacity-100');
            userModalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => userModal.classList.add('hidden'), 200);
        }

        userModal.addEventListener('click', e => {
            if (e.target === userModal) closeModal();
        });

        const deleteModal = document.getElementById('deleteModal');
        const deleteModalContent = document.getElementById('deleteModalContent');
        const deleteForm = document.getElementById('deleteForm');

        function confirmDelete(id) {
            deleteForm.action = `/user/${id}`;
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

        deleteModal.addEventListener('click', e => {
            if (e.target === deleteModal) closeDeleteModal();
        });
    </script>
</x-app-layout>
