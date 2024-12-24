@extends('layout.main')
@section('content')
    <main class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route(session()->get('role') . '.dashboard') }}"><i
                                    class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <span class="text-dark">Dashboard</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="row">
            <div class="col-12">
                <h5 class="text-info">Statistik Pengguna dan Aset</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card radius-10 bg-purple-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-dark">Jumlah Admin</p>
                                <h4 class="my-1 text-dark">{{ $totalAdmin }}</h4>
                            </div>
                            <div class="text-dark ms-auto font-35"><i class="bi bi-person-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card radius-10 bg-purple-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-dark">Jumlah Mesin</p>
                                <h4 class="my-1 text-dark">{{ $totalMesin }}</h4>
                            </div>
                            <div class="text-dark ms-auto font-35"><i class="bi bi-gear-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card radius-10 bg-purple-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-dark">Jumlah Produk</p>
                                <h4 class="my-1 text-dark">{{ $totalProduk }}</h4>
                            </div>
                            <div class="text-dark ms-auto font-35"><i class="bi bi-box-seam"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <h5 class="text-info">Statistik Pesanan</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card radius-10 bg-purple-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-dark">Jumlah Pesanan Selesai ({{ $currentMonthName }})</p>
                                <h4 class="my-1 text-dark">{{ $totalPesananSelesaiBulanIni }}</h4>
                            </div>
                            <div class="text-dark ms-auto font-35"><i class="bx bx-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card radius-10 bg-purple-gradient">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-dark">Jumlah Pesanan Proses ({{ $currentMonthName }})</p>
                                <h4 class="my-1 text-dark">{{ $totalPesananProsesBulanIni }}</h4>
                            </div>
                            <div class="text-dark ms-auto font-35"><i class="bx bx-time-five"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-6">
                <div class="card radius-10 bg-purple-gradient">
                    <div
                        class="card-header bg-gradient bg-info text-white d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 me-auto">Laporan Penjualan</h4>
                        <div class="d-flex align-items-center">
                            <a id="downloadPDF"
                                href="{{ route('owner.dashboard.keuangan.pdf-report', ['year' => request('year', now()->year)]) }}"
                                target="_blank" class="btn btn-success me-2 py-1">
                                <i class="lni lni-download"></i> Download PDF
                            </a>
                            <div style="width: 100px">
                                <select id="yearSelect" class="form-select py-1 w-100 d-inline-block">
                                    <!-- Tahun akan diisi secara dinamis -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="charts-row">
                            <div class="chart-wrapper">
                                <div class="chart-container">
                                    <canvas id="revenueChart"></canvas>
                                </div>
                            </div>
                            <div class="chart-wrapper">
                                <div id="productChartContainer" class="chart-container">
                                    <canvas id="productChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="summary">
                            <div>
                                <strong>Total Pendapatan:</strong>
                                <span id="totalRevenue">Rp 0</span>
                            </div>
                            <div>
                                <strong>Bulan Tertinggi:</strong>
                                <span id="highestMonth">-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Chart configuration
        let revenueChart = null;
        let productChart = null;

        const yearSelect = document.getElementById('yearSelect');
        const downloadBtn = document.getElementById('downloadPDF');

        // Update URL download berdasarkan tahun yang dipilih
        function updateDownloadUrl() {
            const year = yearSelect.value || new Date().getFullYear(); // Gunakan tahun saat ini sebagai fallback
            downloadBtn.href = `{{ route('owner.dashboard.keuangan.pdf-report', ['year' => ':year']) }}`.replace(':year',
                year);
        }

        // Event listener untuk update URL saat tahun dipilih
        yearSelect.addEventListener('change', updateDownloadUrl);

        // Update URL saat halaman dimuat
        updateDownloadUrl();

        // Initialize year select options
        function initYearSelect() {
            const currentYear = new Date().getFullYear();
            const yearSelect = document.getElementById('yearSelect');

            // Add last 5 years to select
            for (let i = 0; i < 5; i++) {
                const year = currentYear - i;
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;

                if (i === 0) {
                    option.selected = true;
                }

                yearSelect.appendChild(option);
            }

            yearSelect.addEventListener('change', (e) => {
                fetchChartData(e.target.value);
            });
        }

        // Fetch and update chart data
        async function fetchChartData(year) {
            try {
                const base_url = '{{ url('/') }}';
                const response = await fetch(`${base_url}/owner/dashboard/keuangan/chart-data?year=${year}`);
                const data = await response.json();
                console.log(data)
                updateCharts(data);
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Update charts with new data
        function updateCharts(data) {
            updateRevenueChart(data);
            updateProductChart(data);
            updateSummary(data);
        }

        // Update revenue bar chart
        function updateRevenueChart(data) {
            const ctx = document.getElementById('revenueChart').getContext('2d');

            if (revenueChart) {
                revenueChart.destroy();
            }

            const chartData = {
                labels: data.monthly_revenues.map(item => item.month_name),
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: data.monthly_revenues.map(item => item.total_revenue),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            };

            revenueChart = new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        }

        // Update product pie chart
        function updateProductChart(data) {
            const ctx = document.getElementById('productChart').getContext('2d');

            if (productChart) {
                productChart.destroy();
            }

            const colors = [
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(153, 102, 255, 0.6)'
            ];

            let chartData;
            if (data.top_products.length > 0) {
                const totalSold = data.top_products.reduce((total, item) => total + item.total_sold, 0);
                chartData = {
                    labels: data.top_products.map(item =>
                        `${item.name} (${((item.total_sold / totalSold) * 100).toFixed(0)}%)`),
                    datasets: [{
                        data: data.top_products.map(item => item.total_sold),
                        backgroundColor: colors,
                        borderColor: colors.map(color => color.replace('0.6', '1')),
                        borderWidth: 1
                    }]
                };
            } else {
                chartData = {
                    labels: ['No data'],
                    datasets: [{
                        data: [1],
                        backgroundColor: ['#ccc'],
                        borderColor: ['#999'],
                        borderWidth: 1
                    }]
                };
            }

            productChart = new Chart(ctx, {
                type: 'pie',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw;
                                    return `${label}: ${value} terjual`;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Update summary section
        function updateSummary(data) {
            document.getElementById('totalRevenue').textContent =
                'Rp ' + data.total_annual_revenue.toLocaleString();

            const highestRevenueMonth = data.monthly_revenues.reduce((max, month) =>
                month.total_revenue > max.total_revenue ? month : max
            );

            document.getElementById('highestMonth').textContent =
                `${highestRevenueMonth.month_name} (Rp ${highestRevenueMonth.total_revenue.toLocaleString()})`;
        }

        // Add basic styles
        const style = document.createElement('style');
        style.textContent = `
    .chart-container {
        padding: 15px;
        margin: 15px 0;
        height: 400px;
    }
    
    .charts-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .chart-wrapper {
        flex: 1;
        min-width: 0;
    }

    .summary {
        display: flex;
        justify-content: space-around;
        padding: 15px;
        margin-top: 15px;
    }

    .summary div {
        text-align: center;
    }

    .summary strong {
        display: block;
        margin-bottom: 5px;
    }
`;
        document.head.appendChild(style);

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', () => {
            initYearSelect();
            fetchChartData(new Date().getFullYear());
        });
    </script>
@endsection
