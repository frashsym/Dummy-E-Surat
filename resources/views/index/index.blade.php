<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- 🔹 Image Slider --}}
            <div class="relative overflow-hidden rounded-2xl shadow-lg max-w-5xl mx-auto">
                <div id="slider" class="flex transition-transform duration-1000 ease-in-out">
                    <img src="{{ asset('assets/img/home.jpg') }}" class="w-full h-[400px] object-cover flex-shrink-0"
                        alt="Slide 1">
                    <img src="{{ asset('assets/img/home.jpg') }}" class="w-full h-[400px] object-cover flex-shrink-0"
                        alt="Slide 2">
                    <img src="{{ asset('assets/img/home.jpg') }}" class="w-full h-[400px] object-cover flex-shrink-0"
                        alt="Slide 3">
                </div>

                {{-- Tombol navigasi slider --}}
                <button onclick="prevSlide()"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white px-3 py-2 rounded-full hover:bg-opacity-80">
                    ‹
                </button>
                <button onclick="nextSlide()"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white px-3 py-2 rounded-full hover:bg-opacity-80">
                    ›
                </button>
            </div>

            {{-- 🔹 Section Layanan --}}
            <section id="layanan" class="py-12">
                <h3 class="text-center text-2xl font-bold text-gray-800 dark:text-gray-200">Layanan</h3>
                {{-- isi konten layanan lo di sini --}}
            </section>

            {{-- 🔹 3 Kartu Layanan --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- E-Surat --}}
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 flex flex-col items-center text-center hover:shadow-lg transition">
                    <img src="https://cdn-icons-png.flaticon.com/512/3176/3176363.png" alt="E-Surat"
                        class="h-16 w-16 mb-3">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">E-Surat</h4>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Layanan untuk pengelolaan surat masuk dan
                        keluar secara elektronik.</p>
                    <a href="{{ route('surat.index') }}"
                        class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold">Buka</a>
                </div>

                {{-- Penilaian Kinerja --}}
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 flex flex-col items-center text-center hover:shadow-lg transition">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" alt="Penilaian Kinerja"
                        class="h-16 w-16 mb-3">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Penilaian Kinerja</h4>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Layanan untuk melakukan penilaian terhadap
                        kinerja pegawai.</p>
                    {{-- <a href="{{ route('kinerja.index') }}"
                        class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold">Buka</a>
                    --}}
                </div>

                {{-- Layanan Karir --}}
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 flex flex-col items-center text-center hover:shadow-lg transition">
                    <img src="https://cdn-icons-png.flaticon.com/512/9128/9128955.png" alt="Layanan Karir"
                        class="h-16 w-16 mb-3">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Layanan Karir</h4>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Layanan untuk informasi dan pengembangan
                        karir karyawan.</p>
                    {{-- <a href="{{ route('karir.karir') }}"
                        class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold">Buka</a>
                    --}}
                </div>
            </div>
        </div>
    </div>

    {{-- 🔹 Script Slider --}}
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('#slider img');

        function showSlide(index) {
            const total = slides.length;
            if (index >= total) currentSlide = 0;
            else if (index < 0) currentSlide = total - 1;
            else currentSlide = index;
            document.getElementById('slider').style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function nextSlide() { showSlide(currentSlide + 1); }
        function prevSlide() { showSlide(currentSlide - 1); }

        // Auto-slide setiap 5 detik
        setInterval(() => nextSlide(), 5000);
    </script>
</x-app-layout>
