<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-gray-500 dark:text-gray-400">
            Statistik pembuatan surat bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
        </p>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Chart --}}
            <div class="
    bg-white dark:bg-gray-900
    border border-gray-200 dark:border-white/10
    shadow-sm dark:shadow-lg dark:shadow-black/40
    rounded-2xl p-6
">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">
                    Grafik Pembuatan Surat per Hari
                </h2>

                <div class="relative h-[320px]">
                    <canvas id="suratChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('suratChart').getContext('2d');

        const labels = @json($labels);
        const rawLabels = @json($rawLabels);
        const datasets = @json($chartData).map((set, index) => {
            const colors = ['#3b82f6'];

            return {
                label: set.label,
                data: set.data,
                borderColor: colors[index],
                backgroundColor: colors[index] + '33',
                fill: true,
                tension: 0.35,
                pointRadius: 4,
                pointHoverRadius: 6
            };
        });

        const isDark = document.documentElement.classList.contains('dark');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        min: 0,
                        max: 10, // 🔥 BIAR NGGAK MEMBESAR
                        ticks: {
                            stepSize: 1,
                            color: isDark ? '#9ca3af' : '#4b5563'
                        },
                        grid: {
                            color: isDark ? '#374151' : '#e5e7eb'
                        }
                    },
                    x: {
                        ticks: {
                            color: isDark ? '#9ca3af' : '#4b5563'
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: isDark ? '#e5e7eb' : '#374151'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            title: (items) => rawLabels[items[0].dataIndex],
                            label: (item) =>
                                `${item.formattedValue} surat`
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
