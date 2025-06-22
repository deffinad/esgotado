<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<section>
    <div class="grid grid-cols-12 gap-4">
        <?php if ($type === 'stock-in-out-bar') { ?>
            <div class="h-[500px] relative bg-white border rounded-lg col-span-12">
                <div class="flex justify-end">
                    <div x-data="{ isOptionSelected: false }" class="relative m-4 z-20 bg-transparent dark:bg-form-input w-max">
                        <select
                            name="year"
                            id="year"
                            class="relative z-20 appearance-none rounded border border-stroke dark:border-form-strokedark bg-transparent px-5 py-2 outline-none transition focus:border-primary active:border-primary dark:bg-form-input dark:focus:border-primary w-40"
                            :class="isOptionSelected && 'text-black dark:text-white'"
                            @change="isOptionSelected = true">
                            <option value="" disabled selected>Select Year</option>
                            <?php for ($i = 2018; $i <= 2030; $i++) { ?>
                                <option value="<?= $i ?>" <?= $currentYear == $i ? 'selected' : '' ?>><?= $i ?></option>
                            <?php } ?>
                        </select>

                        <span class="pointer-events-none absolute right-4 top-1/2 z-30 -translate-y-1/2">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24">
                                <g opacity="0.8">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z" fill=""></path>
                                </g>
                            </svg>
                        </span>
                    </div>
                </div>

                <canvas id="barChart" class="absolute inset-0 !mx-4 !mb-4 !mt-16 w-full h-full"></canvas>
            </div>

            <div class="bg-white border rounded-lg p-4 flex flex-col gap-4 col-span-6">
                <p class="text-xl font-semibold">Dozen</p>
                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-6 text-lg">
                        <p>Stock In</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="dozen-stockin">0</p>
                    </div>
                    <div class="col-span-6 text-lg">
                        <p>Stock Out</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="dozen-stockout">0</p>
                    </div>
                    <div class="col-span-6 text-lg">
                        <p>Total</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="dozen-total">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border rounded-lg p-4 flex flex-col gap-4 col-span-6">
                <p class="text-xl font-semibold">Meter</p>
                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-6 text-lg">
                        <p>Stock In</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="meter-stockin">0</p>
                    </div>
                    <div class="col-span-6 text-lg">
                        <p>Stock Out</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="meter-stockout">0</p>
                    </div>
                    <div class="col-span-6 text-lg">
                        <p>Total</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="meter-total">0</p>
                    </div>
                </div>
            </div>
        <?php } else if ($type === 'current-stock') { ?>
            <div class="h-[400px] relative bg-white border rounded-lg col-span-12">
                <canvas id="barHorizontalChart" class="absolute inset-0 m-4 w-full h-full"></canvas>
            </div>

            <div class="bg-white border rounded-lg p-4 flex flex-col gap-4 col-span-12">
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
                        <?php foreach ($dataInventory as $index => $val) { ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= $val->type_of_material; ?></td>
                                <td><?= $val->code_sku; ?></td>
                                <td>
                                    <?php if (($val->unit === 'Meter' && $val->stock > 20) || $val->unit === 'Dozen' && $val->stock > 5) { ?>
                                        <div class="flex items-center">
                                            <p class="bg-green-100 rounded-full text-green-500 font-bold p-2 text-xs w-24 text-center">Safety Stock</p>
                                        </div>
                                    <?php } else { ?>
                                        <div class="flex items-center">
                                            <p class="bg-red-100 rounded-full text-red-500 font-bold p-2 text-xs w-24 text-center">Low Stock</p>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else if ($type === 'stock-in-out-line') { ?>
            <div class="h-[500px] relative bg-white border rounded-lg col-span-12">
                <div class="flex justify-end">
                    <div x-data="{ isOptionSelected: false }" class="relative m-4 z-20 bg-transparent dark:bg-form-input w-max">
                        <select
                            name="year"
                            id="year"
                            class="relative z-20 appearance-none rounded border border-stroke dark:border-form-strokedark bg-transparent px-5 py-2 outline-none transition focus:border-primary active:border-primary dark:bg-form-input dark:focus:border-primary w-40"
                            :class="isOptionSelected && 'text-black dark:text-white'"
                            @change="isOptionSelected = true">
                            <option value="" disabled selected>Select Year</option>
                            <?php for ($i = 2018; $i <= 2030; $i++) { ?>
                                <option value="<?= $i ?>" <?= $currentYear == $i ? 'selected' : '' ?>><?= $i ?></option>
                            <?php } ?>
                        </select>

                        <span class="pointer-events-none absolute right-4 top-1/2 z-30 -translate-y-1/2">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24">
                                <g opacity="0.8">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z" fill=""></path>
                                </g>
                            </svg>
                        </span>
                    </div>
                </div>

                <canvas id="lineChart" class="absolute inset-0 !mx-4 !mb-4 !mt-16 w-full h-full"></canvas>
            </div>

            <div class="bg-white border rounded-lg p-4 flex flex-col gap-4 col-span-6">
                <p class="text-xl font-semibold">Dozen</p>
                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-6 text-lg">
                        <p>Stock In</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="dozen-stockin">0</p>
                    </div>
                    <div class="col-span-6 text-lg">
                        <p>Stock Out</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="dozen-stockout">0</p>
                    </div>
                    <div class="col-span-6 text-lg">
                        <p>Total</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="dozen-total">0</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border rounded-lg p-4 flex flex-col gap-4 col-span-6">
                <p class="text-xl font-semibold">Meter</p>
                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-6 text-lg">
                        <p>Stock In</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="meter-stockin">0</p>
                    </div>
                    <div class="col-span-6 text-lg">
                        <p>Stock Out</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="meter-stockout">0</p>
                    </div>
                    <div class="col-span-6 text-lg">
                        <p>Total</p>
                    </div>
                    <div class="col-span-6 text-lg text-right">
                        <p id="meter-total">0</p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<script>
    let type = '<?= $type ?>'
    const labels = <?= json_encode($listMonth) ?>;

    const getDataStock = (dataInbound, dataOutbound) => {
        let stockInbound = []
        let stockOutbound = []

        let stockDozen = {
            inbound: 0,
            outbound: 0
        }

        let stockMeter = {
            inbound: 0,
            outbound: 0
        }

        labels.map(month => {
            let countInbound = 0
            let countOutbound = 0

            dataInbound.map(val => {
                let date = new Date(val.date)
                let tempMonth = labels[date.getMonth()]

                if (tempMonth === month) {
                    countInbound = countInbound + parseInt(val.amount_unit)
                    if (val.unit === 'Dozen') {
                        stockDozen.inbound = stockDozen.inbound + parseInt(val.amount_unit)
                    } else if (val.unit === 'Meter') {
                        stockMeter.inbound = stockMeter.inbound + parseInt(val.amount_unit)
                    }
                }
            })
            stockInbound.push(countInbound)

            dataOutbound.map(val => {
                let date = new Date(val.date)
                let tempMonth = labels[date.getMonth()]

                if (tempMonth === month) {
                    countOutbound = countOutbound + parseInt(val.amount_unit)
                    if (val.unit === 'Dozen') {
                        stockDozen.outbound = stockDozen.outbound + parseInt(val.amount_unit)
                    } else if (val.unit === 'Meter') {
                        stockMeter.outbound = stockMeter.outbound + parseInt(val.amount_unit)
                    }
                }
            })
            stockOutbound.push(countOutbound)
        })

        return {
            stockInbound: stockInbound,
            stockOutbound: stockOutbound,
            stockDozen: stockDozen,
            stockMeter: stockMeter,
        }
    }

    if (type === 'stock-in-out-bar' || type === 'stock-in-out-line') {
        const dataInbound = <?= json_encode($dataInbound) ?>;
        const dataOutbound = <?= json_encode($dataOutbound) ?>;

        const {
            stockInbound,
            stockOutbound,
            stockDozen,
            stockMeter
        } = getDataStock(dataInbound, dataOutbound)

        $('#dozen-stockin').text(stockDozen.inbound)
        $('#dozen-stockout').text(stockDozen.outbound)
        $('#dozen-total').text(stockDozen.inbound - stockDozen.outbound)

        $('#meter-stockin').text(stockMeter.inbound)
        $('#meter-stockout').text(stockMeter.outbound)
        $('#meter-total').text(stockMeter.inbound - stockMeter.outbound)

        let barChart = null;
        let lineChart = null;
        if (type === 'stock-in-out-bar') {
            const ctxBarChart = document.getElementById('barChart').getContext('2d');
            barChart = new Chart(ctxBarChart, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Stock In',
                            data: stockInbound,
                            backgroundColor: '#0095FF',
                            borderColor: '#0095FF',
                            borderWidth: 1
                        },
                        {
                            label: 'Stock Out',
                            data: stockOutbound,
                            backgroundColor: '#00E096',
                            borderColor: '#00E096',
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
                    },
                }
            });
        } else {
            const ctxLineChart = document.getElementById('lineChart').getContext('2d');
            lineChart = new Chart(ctxLineChart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Stock In',
                            data: stockInbound,
                            backgroundColor: '#0095FF',
                            borderColor: '#0095FF',
                            borderWidth: 1
                        },
                        {
                            label: 'Stock Out',
                            data: stockOutbound,
                            backgroundColor: '#00E096',
                            borderColor: '#00E096',
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
        }

        $('#year').on('change', function() {
            let yearSelected = $(this).val()

            $.ajax({
                url: '<?= base_url('dashboard/grafik/') ?>' + yearSelected,
                type: 'GET',
                success: function(response) {
                    const {
                        inbound,
                        outbound
                    } = response

                    const {
                        stockInbound,
                        stockOutbound,
                        stockDozen,
                        stockMeter
                    } = getDataStock(inbound, outbound)

                    $('#dozen-stockin').text(stockDozen.inbound)
                    $('#dozen-stockout').text(stockDozen.outbound)
                    $('#dozen-total').text(stockDozen.inbound - stockDozen.outbound)

                    $('#meter-stockin').text(stockMeter.inbound)
                    $('#meter-stockout').text(stockMeter.outbound)
                    $('#meter-total').text(stockMeter.inbound - stockMeter.outbound)

                    if (type === 'stock-in-out-bar') {
                        barChart.data.datasets[0].data = stockInbound
                        barChart.data.datasets[1].data = stockOutbound
                        barChart.update()
                    } else {
                        lineChart.data.datasets[0].data = stockInbound
                        lineChart.data.datasets[1].data = stockOutbound
                        lineChart.update()
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        })
    } else {
        const inventory = <?= json_encode($dataInventory) ?>;
        let labelsInventory = [];
        let dataInventory = [];
        let unitInventory = [];

        const unitColors = {
            Meter: '#0095FF',
            Dozen: '#00E096'
        };

        inventory.map(item => {
            labelsInventory.push(item.type_of_material)
            dataInventory.push(parseInt(item.stock))
            unitInventory.push(item.unit)
        })

        const uniqueUnits = [...new Set(unitInventory)];
        const barColors = unitInventory.map(unit => unitColors[unit] || '#999999');

        const ctxBarHorizontalChart = document.getElementById('barHorizontalChart').getContext('2d');
        const barHorizontalChart = new Chart(ctxBarHorizontalChart, {
            type: 'bar',
            data: {
                labels: labelsInventory,
                datasets: [{
                    label: 'Current Stock',
                    data: dataInventory,
                    backgroundColor: barColors,
                    borderColor: barColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                indexAxis: 'y',
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            generateLabels: function(chart) {
                                console.log('Generating labels...');
                                console.log(uniqueUnits);
                                return uniqueUnits.map(unit => {
                                    return {
                                        text: unit.charAt(0).toUpperCase() + unit.slice(1),
                                        fillStyle: unitColors[unit],
                                        strokeStyle: unitColors[unit],
                                        lineWidth: 1,
                                        hidden: false,
                                        index: 0
                                    };
                                });
                            }
                        }
                    }
                }
            }
        });
        $('#myTable').DataTable();
    }
</script>

<?= $this->endSection(); ?>