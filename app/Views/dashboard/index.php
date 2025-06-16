<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<section>
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white border rounded-lg p-4">
            <div class="flex h-16 w-16 text-2xl items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                <i class="fas fa-shopping-cart text-primary"></i>
            </div>

            <div class="mt-2 flex items-end justify-between">
                <div>
                    <p class="text-4xl font-bold text-black dark:text-white">
                        0
                    </p>
                    <span class="text-lg font-normal">Total Stock In</span>
                </div>
            </div>
        </div>
        <div class="bg-white border rounded-lg p-4">
            <div class="flex h-16 w-16 text-2xl items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                <i class="fas fa-shopping-cart text-primary"></i>
            </div>

            <div class="mt-2 flex items-end justify-between">
                <div>
                    <p class="text-4xl font-bold text-black dark:text-white">
                        0
                    </p>
                    <span class="text-lg font-normal">Total Stock Out</span>
                </div>
            </div>
        </div>
        <div class="bg-white border rounded-lg p-4">
            <div class="flex h-16 w-16 text-2xl items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                <i class="fas fa-shopping-cart text-primary"></i>
            </div>

            <div class="mt-2 flex items-end justify-between">
                <div>
                    <p class="text-4xl font-bold text-black dark:text-white">
                        0
                    </p>
                    <span class="text-lg font-normal">Total Activity</span>
                </div>
            </div>
        </div>

        <a href="<?= base_url('/dashboard/detail/stock-in-out-bar') ?>" class="h-[400px] relative bg-white border rounded-lg col-span-3">
            <canvas id="barChart" class="absolute inset-0 m-4 w-full h-full"></canvas>
        </a>
        <a href="<?= base_url('/dashboard/detail/current-stock') ?>" class="h-[400px] relative bg-white border rounded-lg col-span-3">
            <canvas id="barHorizontalChart" class="absolute inset-0 m-4 w-full h-full"></canvas>
        </a>
        <a href="<?= base_url('/dashboard/detail/stock-in-out-line') ?>" class="h-[400px] relative bg-white border rounded-lg col-span-3">
            <canvas id="lineChart" class="absolute inset-0 m-4 w-full h-full"></canvas>
        </a>
    </div>
</section>

<script>
    const labels = <?= json_encode($labels ?? ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']) ?>;

    const data1 = <?= json_encode($data ?? [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]) ?>;
    const data2 = <?= json_encode($data2 ?? [12, 11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1]) ?>;

    const ctxBarChart = document.getElementById('barChart').getContext('2d');
    const ctxBarHorizontalChart = document.getElementById('barHorizontalChart').getContext('2d');
    const ctxLineChart = document.getElementById('lineChart').getContext('2d');

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
</script>

<?= $this->endSection(); ?>