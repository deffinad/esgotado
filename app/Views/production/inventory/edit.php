<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<?php
$input = session()->getFlashdata('input');
$errors = session()->getFlashdata('validationError');
?>

<section>
    <div class="bg-white border rounded-lg p-4 flex flex-col gap-4">
        <form action="<?= base_url('production/inventory/edit/process/' . $inventory['code_sku']) ?>" method="post" enctype="multipart/form-data">
            <div>
                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black">
                        Type of Raw Material <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" name="type_materials" value="<?= isset($input['type_materials']) ? esc($input['type_materials']) : $inventory['type_of_material'] ?>" placeholder="Input Type of Raw Material" class="w-full rounded border-[1.5px] <?= !isset($errors['type_materials']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />
                    <span class="text-danger text-sm"><?= isset($errors['type_materials']) ? $errors['type_materials'] : '' ?></span>
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black">
                        Code/SKU <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" name="code" value="<?= isset($input['code']) ? esc($input['code']) : $inventory['code_sku'] ?>" placeholder="Input Code/SKU" class="w-full rounded border-[1.5px] <?= !isset($errors['code']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" readonly />
                    <span class="text-danger text-sm"><?= isset($errors['code']) ? $errors['code'] : '' ?></span>
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black">
                        Unit <span class="text-meta-1">*</span>
                    </label>

                    <div class="grid grid-cols-12 gap-4">
                        <!-- <div class="col-span-10">
                            <input type="number" name="amount" value="<?= isset($input['amount']) ? esc($input['amount']) : $inventory['stock'] ?>" placeholder="Input Amount" class="w-full rounded border-[1.5px] <?= !isset($errors['amount']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" readonly />
                            <span class="text-danger text-sm"><?= isset($errors['amount']) ? $errors['amount'] : '' ?></span>
                        </div> -->

                        <div class="col-span-12">
                            <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                <select name="unit" id="unit" class="relative z-20 w-full rounded border <?= !isset($errors['unit']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary" :class="isOptionSelected && 'text-black'" @change="isOptionSelected = true">
                                    <option value="" disabled selected>
                                        Select Unit
                                    </option>
                                    <?php $inv = $input != null && isset($input['unit']) ? $input['unit'] : $inventory['unit']; ?>
                                    <option value="Meter" <?= $inv == 'Meter' ? 'selected' : '' ?> class="text-body">Meter</option>
                                    <option value="Dozen" <?= $inv == 'Dozen' ? 'selected' : '' ?> class="text-body">Dozen</option>
                                </select>
                            </div>
                            <span class="text-danger text-sm"><?= isset($errors['unit']) ? $errors['unit'] : '' ?></span>
                        </div>
                    </div>
                </div>

                <div class="mb-4.5 flex flex-col gap-4" id="wrapper-category">
                    <div>
                        <button type="button" id="btn-category" class="flex justify-center rounded bg-primary py-1 px-3 font-medium text-white hover:bg-opacity-90">
                            + Add Category
                        </button>
                    </div>

                    <?php if (isset($input['category']) || $category) {
                        $data = isset($input['category']) ? $input['category'] : $category;
                        foreach ($data as $val) {
                    ?>
                            <div class="flex flex-row gap-4" id="item-category">
                                <input type="text" name="category[]" value="<?= isset($input['category']) ? $val : $val->nama ?>" placeholder="Kategori" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />

                                <button type="button" class="rounded-full w-10 h-10 flex items-center justify-center bg-gray-100 p-3 font-medium text-gray-500 text-lg hover:bg-opacity-90" id="remove-item">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                    <?php }
                    } ?>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-white hover:bg-opacity-90">
                    Edit
                </button>
            </div>
        </form>
    </div>
</section>

<script>
    $('#btn-category').click(() => {
        const lastGroup = $('#wrapper-category #item-category').last(); // last input group
        const lastInput = lastGroup.find('input[name="category[]"]');
        const errorSpan = lastGroup.find('#error-category');

        // Clear any previous error
        errorSpan.text('');

        if (lastInput.length > 0 && !lastInput.val()) {
            lastInput.focus();
            errorSpan.text('Kategori tidak boleh kosong.');
            return;
        }

        const newItemCategory = `
        <div class="flex flex-row gap-4" id="item-category">
            <div class="flex flex-col w-full">
                <input type="text" name="category[]" placeholder="Kategori" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />
                <span class="text-danger text-sm" id="error-category"></span>
            </div>

            <button type="button" class="rounded-full w-10 h-10 flex items-center justify-center bg-gray-100 p-3 font-medium text-gray-500 text-lg hover:bg-opacity-90" id="remove-item">
                <i class="fas fa-times"></i>
            </button>
        </div>
        `;
        $('#wrapper-category').append(newItemCategory);
    });


    $(document).on('click', '#remove-item', function() {
        $(this).closest('#item-category').remove();
    });
</script>

<?= $this->endSection(); ?>