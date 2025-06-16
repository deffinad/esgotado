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
                        Type of Raw Material <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" name="type_materials" value="<?= isset($input['type_materials']) ? esc($input['type_materials']) : '' ?>" placeholder="Input Type of Raw Material" class="w-full rounded border-[1.5px] <?= !isset($errors['type_materials']) ? 'border-stroke dark:border-form-strokedark' : 'border-danger dark:border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:bg-form-input dark:text-white dark:focus:border-primary" />
                    <span class="text-danger text-sm"><?= isset($errors['type_materials']) ? $errors['type_materials'] : '' ?></span>
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Code/SKU <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" name="code" value="<?= isset($input['code']) ? esc($input['code']) : '' ?>" placeholder="Input Code/SKU" class="w-full rounded border-[1.5px] <?= !isset($errors['code']) ? 'border-stroke dark:border-form-strokedark' : 'border-danger dark:border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:bg-form-input dark:text-white dark:focus:border-primary" />
                    <span class="text-danger text-sm"><?= isset($errors['code']) ? $errors['code'] : '' ?></span>
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Unit <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" name="unit" value="<?= isset($input['unit']) ? esc($input['unit']) : '' ?>" placeholder="Input Unit" class="w-full rounded border-[1.5px] <?= !isset($errors['unit']) ? 'border-stroke dark:border-form-strokedark' : 'border-danger dark:border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:bg-form-input dark:text-white dark:focus:border-primary" />
                    <span class="text-danger text-sm"><?= isset($errors['unit']) ? $errors['unit'] : '' ?></span>
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