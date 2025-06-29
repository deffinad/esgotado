<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<?php
$input = session()->getFlashdata('input');
$errors = session()->getFlashdata('validationError');
?>

<section>
    <div class="bg-white border rounded-lg p-4 flex flex-col gap-4">
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
                            <?php foreach ($inventory as $val) { ?>
                                <option value="<?= $val->type_of_material ?>" class="text-body"><?= $val->type_of_material ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <span class="text-danger text-sm"><?= isset($errors['type_materials']) ? $errors['type_materials'] : '' ?></span>
                </div>

                <div class="mb-4.5 hidden" id="wrapper-category">
                    <label class="mb-3 block text-sm font-medium text-black">
                        Category <span class="text-meta-1">*</span>
                    </label>
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                        <select name="category" id="category" class="relative z-20 w-full rounded border <?= !isset($errors['category']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary" :class="isOptionSelected && 'text-black'" @change="isOptionSelected = true">
                            <option value="" disabled selected>
                                Select
                            </option>
                        </select>
                    </div>
                    <span class="text-danger text-sm"><?= isset($errors['category']) ? $errors['category'] : '' ?></span>
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black">
                        Code/SKU <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" name="code" id="code" placeholder="Input Code/SKU" class="w-full rounded border-[1.5px] <?= !isset($errors['code']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" readonly />
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
</section>

<script>
    $(document).ready(function() {
        let dataInventory = []
        <?php foreach ($inventory as $val) { ?>
            dataInventory.push({
                code_sku: '<?= $val->code_sku ?>',
                type_of_material: '<?= $val->type_of_material ?>',
                stock: '<?= $val->stock ?>',
                unit: '<?= $val->unit ?>'
            })
        <?php } ?>

        $('#type_materials').change(function() {
            let find = dataInventory.find(x => x.type_of_material === $(this).val())
            $('#code').val(find.code_sku)
            $('#unit').val(find.unit)

            $.ajax({
                url: '<?= base_url('/production/category/') ?>' + find.code_sku,
                type: 'GET',
                success: function(response) {
                    if (response.category.length > 0) {
                        $('#wrapper-category').attr('class', 'mb-4.5 block')
                        const select = $('select[name="category"]')

                        $('select[name="category"] option').not('[value=""]').remove();

                        response.category.map(item => {
                            const newItem = `<option value="${item.nama}" class="text-body">${item.nama}</option>`;
                            select.append(newItem);
                        })
                    } else {
                        $('#wrapper-category').attr('class', 'mb-4.5 hidden')
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>