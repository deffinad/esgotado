<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<?php
$input = session()->getFlashdata('input');
$errors = session()->getFlashdata('validationError');
?>

<section>
    <div class="bg-white border rounded-lg p-4 flex flex-col gap-4">
        <form action="<?= base_url('production/inbound/add/process') ?>" method="post" enctype="multipart/form-data">
            <div>
                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Date Time In <span class="text-meta-1">*</span>
                    </label>
                    <input type="date" name="date" value="<?= isset($input['date']) ? esc($input['date']) : '' ?>" placeholder="Select Date" class="w-full rounded border-[1.5px] <?= !isset($errors['date']) ? 'border-stroke dark:border-form-strokedark' : 'border-danger dark:border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:bg-form-input dark:text-white dark:focus:border-primary" />
                    <span class="text-danger text-sm"><?= isset($errors['date']) ? $errors['date'] : '' ?></span>
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Type of Raw Material <span class="text-meta-1">*</span>
                    </label>
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent dark:bg-form-input">
                        <select name="type_materials" class="relative z-20 w-full appearance-none rounded border <?= !isset($errors['type_materials']) ? 'border-stroke dark:border-form-strokedark' : 'border-danger dark:border-danger' ?> bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:bg-form-input dark:focus:border-primary" :class="isOptionSelected && 'text-black dark:text-white'" @change="isOptionSelected = true">
                            <option value="" class="text-gray-100" disabled selected>
                                Select
                            </option>
                            <option value="Kain Y" <?= $input != null && isset($input['type_materials']) && $input['type_materials'] == 'Kain Y' ? 'selected' : '' ?> class="text-body">Kain Y</option>
                            <option value="Kain X" <?= $input != null && isset($input['type_materials']) && $input['type_materials'] == 'Kain X' ? 'selected' : '' ?> class="text-body">Kain X</option>
                            <option value="Zipper" <?= $input != null && isset($input['type_materials']) && $input['type_materials'] == 'Zipper' ? 'selected' : '' ?> class="text-body">Zipper</option>
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
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Code/SKU <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" name="code" value="<?= isset($input['code']) ? esc($input['code']) : '' ?>" placeholder="Input Code/SKU" class="w-full rounded border-[1.5px] <?= !isset($errors['code']) ? 'border-stroke dark:border-form-strokedark' : 'border-danger dark:border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:bg-form-input dark:text-white dark:focus:border-primary" disabled/>
                    <span class="text-danger text-sm"><?= isset($errors['code']) ? $errors['code'] : '' ?></span>
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Amount/Unit <span class="text-meta-1">*</span>
                    </label>
                    <input type="number" name="amount" value="<?= isset($input['amount']) ? esc($input['amount']) : '' ?>" placeholder="Input Amount/Unit" class="w-full rounded border-[1.5px] <?= !isset($errors['amount']) ? 'border-stroke dark:border-form-strokedark' : 'border-danger dark:border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:bg-form-input dark:text-white dark:focus:border-primary" />
                    <span class="text-danger text-sm"><?= isset($errors['amount']) ? $errors['amount'] : '' ?></span>
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Serial Number <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" name="serial_number" value="<?= isset($input['serial_number']) ? esc($input['serial_number']) : '' ?>" placeholder="Input Serial Number" class="w-full rounded border-[1.5px] <?= !isset($errors['serial_number']) ? 'border-stroke dark:border-form-strokedark' : 'border-danger dark:border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:bg-form-input dark:text-white dark:focus:border-primary" />
                    <span class="text-danger text-sm"><?= isset($errors['serial_number']) ? $errors['serial_number'] : '' ?></span>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-white hover:bg-opacity-90">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

<?= $this->endSection(); ?>