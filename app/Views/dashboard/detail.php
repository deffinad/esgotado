<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<section>
    <div class="grid grid-cols-3 gap-4">
        <?php if ($type === 'stock-in-out-bar') { ?>
            <a href="" class="h-[400px] relative bg-white border rounded-lg col-span-3">
                <canvas id="barChart" class="absolute inset-0 m-4 w-full h-full"></canvas>
            </a>
        <?php } else if ($type === 'current-stock') { ?>
            <div class="h-[400px] relative bg-white border rounded-lg col-span-3">
                <canvas id="barHorizontalChart" class="absolute inset-0 m-4 w-full h-full"></canvas>
            </div>

            <div class="bg-white border rounded-lg p-4 flex flex-col gap-4 col-span-3">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type of Materials</th>
                            <th>Code/SKU</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Kain Z</td>
                            <td>KZ01</td>
                            <td>
                                <div class="flex items-center">
                                    <p class="bg-green-100 rounded-full text-green-500 font-bold p-2 text-xs w-24 text-center">Safety Stock</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Kain Z</td>
                            <td>KZ01</td>
                            <td>
                                <div class="flex items-center">
                                    <p class="bg-red-100 rounded-full text-red-500 font-bold p-2 text-xs w-24 text-center">Low Stock</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } else if ($type === 'stock-in-out-line') { ?>
            <div class="h-[400px] relative bg-white border rounded-lg col-span-3">
                <canvas id="lineChart" class="absolute inset-0 m-4 w-full h-full"></canvas>
            </div>
        <?php } ?>
    </div>
</section>

<script>
    const labels = <?= json_encode($labels ?? ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']) ?>;

    const data1 = <?= json_encode($data ?? [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]) ?>;
    const data2 = <?= json_encode($data2 ?? [12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1]) ?>;

    <?php if ($type === 'stock-in-out-bar') { ?>
        const ctxBarChart = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(ctxBarChart, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Dataset 1',
                        data: data1,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Dataset 2',
                        data: data2,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    <?php } else if ($type === 'current-stock') { ?>
        const ctxBarHorizontalChart = document.getElementById('barHorizontalChart').getContext('2d');
        const barHorizontalChart = new Chart(ctxBarHorizontalChart, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Dataset 1',
                        data: data1,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Dataset 2',
                        data: data2,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        $('#myTable').DataTable();
    <?php } else if ($type === 'stock-in-out-line') { ?>
        const ctxLineChart = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(ctxLineChart, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Dataset 1',
                        data: data1,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Dataset 2',
                        data: data2,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    <?php } ?>
</script>

<?= $this->endSection(); ?>