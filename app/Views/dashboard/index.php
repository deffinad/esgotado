<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<?php
$input = session()->getFlashdata('input');
$errors = session()->getFlashdata('validationError');
?>

<section>
    <div class="grid grid-cols-12 gap-4">
        <div class="bg-white border rounded-lg p-4 md:col-span-4 col-span-12 open-rfid-modal-inbound cursor-pointer">
            <div class="flex h-16 w-16 text-2xl items-center justify-center rounded-full bg-meta-2">
                <i class="fas fa-truck-loading text-primary"></i>
            </div>

            <div class="mt-2 flex items-end justify-between">
                <div>
                    <p class="text-4xl font-bold text-black">
                        <?= $count_stock_inbound; ?>
                    </p>
                    <span class="text-lg font-normal">Total Stock In</span>
                </div>
            </div>
        </div>
        <div class="bg-white border rounded-lg p-4 md:col-span-4 col-span-12 open-rfid-modal-outbound cursor-pointer">
            <div class="flex h-16 w-16 text-2xl items-center justify-center rounded-full bg-meta-2">
                <i class="fas fa-truck-moving text-primary"></i>
            </div>

            <div class="mt-2 flex items-end justify-between">
                <div>
                    <p class="text-4xl font-bold text-black">
                        <?= $count_stock_outbound; ?>
                    </p>
                    <span class="text-lg font-normal">Total Stock Out</span>
                </div>
            </div>
        </div>
        <div class="bg-white border rounded-lg p-4 md:col-span-4 col-span-12">
            <div class="flex h-16 w-16 text-2xl items-center justify-center rounded-full bg-meta-2">
                <i class="fas fa-clipboard-list text-primary"></i>
            </div>

            <div class="mt-2 flex items-end justify-between">
                <div>
                    <p class="text-4xl font-bold text-black">
                        <?= $count_activity; ?>
                    </p>
                    <span class="text-lg font-normal">Total Activity</span>
                </div>
            </div>
        </div>

        <a href="<?= base_url('/dashboard/detail/stock-in-out-bar') ?>" class="h-[400px] relative bg-white border rounded-lg col-span-12">
            <div class="p-4">
                <span class="text-xl font-semibold">Stock In & Out</span>
            </div>
            <canvas id="barChart" class="absolute inset-0 !mx-4 !mb-4 !mt-8 w-full h-full"></canvas>
        </a>

        <div class="grid grid-cols-12 gap-4 col-span-12">
            <a href="<?= base_url('/dashboard/detail/current-stock') ?>" class="h-[400px] relative bg-white border rounded-lg md:col-span-6 col-span-12">
                <div class="p-4">
                    <span class="text-xl font-semibold">Current Stock</span>
                </div>
                <canvas id="barHorizontalChart" class="absolute inset-0 !mx-4 !mb-4 !mt-8 w-full h-full"></canvas>
            </a>
            <a href="<?= base_url('/dashboard/detail/stock-in-out-line') ?>" class="h-[400px] relative bg-white border rounded-lg md:col-span-6 col-span-12">
                <div class="p-4">
                    <span class="text-xl font-semibold">Stock In & Out</span>
                </div>
                <canvas id="lineChart" class="absolute inset-0 !mx-4 !mb-4 !mt-8 w-full h-full"></canvas>
            </a>
        </div>
    </div>

    <!-- Modal -->
    <div id="rfidModalOutbound" class="fixed inset-0 bg-black/70 z-99999 hidden items-center justify-center">
        <div class="bg-white p-5 rounded shadow-lg w-full max-w-lg flex flex-col gap-4">
            <p class="text-2xl font-semibold">Add Outbound</p>

            <form action="<?= base_url('production/outbound/add/process') ?>" method="post" enctype="multipart/form-data">
                <div>
                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black">
                            Date Time In <span class="text-meta-1">*</span>
                        </label>
                        <input type="datetime-local" name="date" value="<?= isset($input['date']) ? esc($input['date']) : '' ?>" placeholder="Select Date" class="w-full rounded border-[1.5px] <?= !isset($errors['date']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />
                        <span class="text-danger text-sm"><?= isset($errors['date']) ? $errors['date'] : '' ?></span>
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black">
                            Type of Raw Material <span class="text-meta-1">*</span>
                        </label>
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                            <select name="type_materials" id="type_materials" class="relative z-20 w-full rounded border <?= !isset($errors['type_materials']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary" :class="isOptionSelected && 'text-black'" @change="isOptionSelected = true">
                                <option value="" disabled selected>
                                    Select
                                </option>
                                <?php foreach ($dataInventory as $val) { ?>
                                    <option value="<?= $val->type_of_material ?>" <?= $input != null && isset($input['type_materials']) && $input['type_materials'] == $val->type_of_material ? 'selected' : '' ?> class="text-body"><?= $val->type_of_material ?></option>
                                <?php } ?>
                            </select>
                            <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.8">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z" fill=""></path>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <span class="text-danger text-sm"><?= isset($errors['type_materials']) ? $errors['type_materials'] : '' ?></span>
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black">
                            Code/SKU <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" name="code" id="code" value="<?= isset($input['code']) ? esc($input['code']) : '' ?>" placeholder="Input Code/SKU" class="w-full rounded border-[1.5px] <?= !isset($errors['code']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" readonly />
                        <span class="text-danger text-sm"><?= isset($errors['code']) ? $errors['code'] : '' ?></span>
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black">
                            Amount/Unit <span class="text-meta-1">*</span>
                        </label>

                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-10">
                                <input type="number" name="amount" value="<?= isset($input['amount']) ? esc($input['amount']) : '' ?>" placeholder="Input Amount" class="w-full rounded border-[1.5px] <?= !isset($errors['amount']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />
                                <span class="text-danger text-sm"><?= isset($errors['amount']) ? $errors['amount'] : '' ?></span>
                            </div>

                            <div class="col-span-2">
                                <input type="text" name="unit" id="unit" value="<?= isset($input['unit']) ? esc($input['unit']) : '' ?>" placeholder="Input Unit" class="w-full rounded border-[1.5px] <?= !isset($errors['unit']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" readonly />
                                <span class="text-danger text-sm"><?= isset($errors['unit']) ? $errors['unit'] : '' ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black">
                            Serial Number <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" name="serial_number" value="<?= isset($input['serial_number']) ? esc($input['serial_number']) : '' ?>" placeholder="Input Serial Number" class="w-full rounded border-[1.5px] <?= !isset($errors['serial_number']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />
                        <span class="text-danger text-sm"><?= isset($errors['serial_number']) ? $errors['serial_number'] : '' ?></span>
                    </div>

                    <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-white hover:bg-opacity-90">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="rfidModalInbound" class="fixed inset-0 bg-black/70 z-99999 hidden items-center justify-center">
        <div class="bg-white p-5 rounded shadow-lg w-full max-w-lg flex flex-col gap-4">
            <p class="text-2xl font-semibold">Add Inbound</p>

            <form action="<?= base_url('production/inbound/add/process') ?>" method="post" enctype="multipart/form-data">
                <div>
                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black">
                            Date Time In <span class="text-meta-1">*</span>
                        </label>
                        <input type="datetime-local" name="date" value="<?= isset($input['date']) ? esc($input['date']) : '' ?>" placeholder="Select Date" class="w-full rounded border-[1.5px] <?= !isset($errors['date']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />
                        <span class="text-danger text-sm"><?= isset($errors['date']) ? $errors['date'] : '' ?></span>
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black">
                            Type of Raw Material <span class="text-meta-1">*</span>
                        </label>
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                            <select name="type_materials" id="type_materials" class="relative z-20 w-full rounded border <?= !isset($errors['type_materials']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary" :class="isOptionSelected && 'text-black'" @change="isOptionSelected = true">
                                <option value="" disabled selected>
                                    Select
                                </option>
                                <?php foreach ($dataInventory as $val) { ?>
                                    <option value="<?= $val->type_of_material ?>" <?= $input != null && isset($input['type_materials']) && $input['type_materials'] == $val->type_of_material ? 'selected' : '' ?> class="text-body"><?= $val->type_of_material ?></option>
                                <?php } ?>
                            </select>
                            <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.8">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z" fill=""></path>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <span class="text-danger text-sm"><?= isset($errors['type_materials']) ? $errors['type_materials'] : '' ?></span>
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black">
                            Code/SKU <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" name="code" id="code" value="<?= isset($input['code']) ? esc($input['code']) : '' ?>" placeholder="Input Code/SKU" class="w-full rounded border-[1.5px] <?= !isset($errors['code']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" readonly />
                        <span class="text-danger text-sm"><?= isset($errors['code']) ? $errors['code'] : '' ?></span>
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black">
                            Amount/Unit <span class="text-meta-1">*</span>
                        </label>

                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-10">
                                <input type="number" name="amount" value="<?= isset($input['amount']) ? esc($input['amount']) : '' ?>" placeholder="Input Amount" class="w-full rounded border-[1.5px] <?= !isset($errors['amount']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />
                                <span class="text-danger text-sm"><?= isset($errors['amount']) ? $errors['amount'] : '' ?></span>
                            </div>

                            <div class="col-span-2">
                                <input type="text" name="unit" id="unit" value="<?= isset($input['unit']) ? esc($input['unit']) : '' ?>" placeholder="Input Unit" class="w-full rounded border-[1.5px] <?= !isset($errors['unit']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" readonly />
                                <span class="text-danger text-sm"><?= isset($errors['unit']) ? $errors['unit'] : '' ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4.5">
                        <label class="mb-3 block text-sm font-medium text-black">
                            Serial Number <span class="text-meta-1">*</span>
                        </label>
                        <input type="text" name="serial_number" value="<?= isset($input['serial_number']) ? esc($input['serial_number']) : '' ?>" placeholder="Input Serial Number" class="w-full rounded border-[1.5px] <?= !isset($errors['serial_number']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />
                        <span class="text-danger text-sm"><?= isset($errors['serial_number']) ? $errors['serial_number'] : '' ?></span>
                    </div>

                    <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-white hover:bg-opacity-90">
                        Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const labels = <?= json_encode($listMonth) ?>;

    const dataStockIn = <?= json_encode($dataStockInbound) ?>;
    const dataStockOutbound = <?= json_encode($dataStockOutbound) ?>;

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

    const ctxBarChart = document.getElementById('barChart').getContext('2d');
    const ctxBarHorizontalChart = document.getElementById('barHorizontalChart').getContext('2d');
    const ctxLineChart = document.getElementById('lineChart').getContext('2d');

    const barChart = new Chart(ctxBarChart, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Stock In',
                    data: dataStockIn,
                    backgroundColor: '#0095FF',
                    borderColor: '#0095FF',
                    borderWidth: 1
                },
                {
                    label: 'Stock Out',
                    data: dataStockOutbound,
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

    const lineChart = new Chart(ctxLineChart, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Stock In',
                    data: dataStockIn,
                    backgroundColor: '#0095FF',
                    borderColor: '#0095FF',
                    borderWidth: 1
                },
                {
                    label: 'Stock Out',
                    data: dataStockOutbound,
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

    // Open Modal
    $('.open-rfid-modal-outbound').on('click', function(e) {
        e.preventDefault();
        $('#confirmDeleteBtn').attr('href', '');
        $('#rfidModalOutbound').removeClass('hidden').addClass('flex');
    });

    // Close Modal
    $('#cancelModalOutbound').on('click', function() {
        $('#rfidModalOutbound').addClass('hidden').removeClass('flex');
    });

    $('#rfidModalOutbound').on('click', function(e) {
        if (e.target === this) {
            $('#rfidModalOutbound').addClass('hidden').removeClass('flex');
        }
    });

    $('.open-rfid-modal-inbound').on('click', function(e) {
        e.preventDefault();
        $('#confirmDeleteBtn').attr('href', '');
        $('#rfidModalInbound').removeClass('hidden').addClass('flex');
    });

    // Close Modal
    $('#cancelModalInbound').on('click', function() {
        $('#rfidModalInbound').addClass('hidden').removeClass('flex');
    });

    $('#rfidModalInbound').on('click', function(e) {
        if (e.target === this) {
            $('#rfidModalInbound').addClass('hidden').removeClass('flex');
        }
    });
</script>

<?= $this->endSection(); ?>