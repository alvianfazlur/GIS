<!DOCTYPE html>
<html lang="en">

<head>
    <base target="_top">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pengangguransky</title>

    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <style>
        html,
        body {
            height: 100%;
            margin: 50px;
        }

    </style>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/lib/remixicon/fonts/remixicon.css" />
    <link rel="stylesheet" href="/lib/jqvmap/jqvmap.min.css" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style.min.css" />

</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="/" class="sidebar-logo">Idle Tracker</a>
        </div>
        <!-- sidebar-header -->
        <div id="sidebarMenu" class="sidebar-body">
            <div class="nav-group show">
                <a href="#" class="nav-label">Dashboard</a>
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="/lp" class="nav-link"><i class="ri-map-pin-line"></i> <span>Map</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/data" class="nav-link"><i class="ri-database-line"></i> <span>Database</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="../dashboard/sales.html" class="nav-link"><i class="ri-contacts-line"></i>
                            <span>Contact Us</span></a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- sidebar-body -->
        <!-- sidebar-footer -->
    </div>
    <!-- sidebar -->

    <div class="header-main px-3 px-lg-4">
        <a id="menuSidebar" href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>

        <div class="form-search me-auto">
            <input type="text" class="form-control" placeholder="Search" />
            <i class="ri-search-line"></i>
        </div>
        <!-- form-search -->

    </div>
    <!-- header-main -->

    <div class="main main-app p-3 p-lg-4">
        <h2>Persentase Tingkat Pengangguran Jawa Timur</h2>
        <canvas id="chart"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil data dari tabel
        var dataTahun2020 = [];
        var dataTahun2021 = [];
        var dataTahun2022 = [];
        var labels = [];

        var tableRows = document.querySelectorAll('#example2 tbody tr');
        tableRows.forEach(function (row) {
            var columns = row.querySelectorAll('td');
            labels.push(columns[1].innerText);
            dataTahun2020.push(parseFloat(columns[2].innerText));
            dataTahun2021.push(parseFloat(columns[3].innerText));
            dataTahun2022.push(parseFloat(columns[4].innerText));
        });

        // Buat grafik menggunakan Chart.js
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Tahun 2020',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        data: dataTahun2020
                    },
                    {
                        label: 'Tahun 2021',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        data: dataTahun2021
                    },
                    {
                        label: 'Tahun 2022',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        data: dataTahun2022
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

        <h2><br><br>Data persentase pengangguran di Jawa Timur</h2>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kota</th>
                                <th>2020</th>
                                <th>2021</th>
                                <th>2022</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->nama_kota }}</td>
                                    <td>{{ $user->tahun_2020 }}</td>
                                    <td>{{ $user->tahun_2021 }}</td>
                                    <td>{{ $user->tahun_2022 }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="/lib/jquery/jquery.min.js"></script>
    <script src="/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/lib/jquery.flot/jquery.flot.js"></script>
    <script src="../lib/jquery.flot/jquery.flot.stack.js"></script>
    <script src="../lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="../lib/jquery.flot/jquery.flot.threshold.js"></script>
    <script src="../lib/chart.js/chart.min.js"></script>
    <script src="../lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="../lib/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/db.data.js"></script>
    <script src="/assets/js/db.sales.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</body>
