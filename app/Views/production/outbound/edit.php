<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<?php
$input = session()->getFlashdata('input');
$errors = session()->getFlashdata('validationError');
?>

<section>
    <div class="bg-white border rounded-lg p-4 flex flex-col gap-4">
        <form action="<?= base_url('production/outbound/edit/process/' . $outbound['id_outbound']) ?>" method="post" enctype="multipart/form-data">
            <div>
                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black">
                        Date Time In <span class="text-meta-1">*</span>
                    </label>
                    <input type="datetime-local" name="date" value="<?= isset($input['date']) ? esc($input['date']) : $outbound['date'] ?>" placeholder="Select Date" class="w-full rounded border-[1.5px] <?= !isset($errors['date']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />
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
                            <?php
                            $inv = $outbound['type_of_material'];
                            foreach ($inventory as $val) {
                                $selected = '';
                                if ($inv == $val->type_of_material) {
                                    $selected = 'selected';
                                }
                            ?>
                                <option value="<?= $val->type_of_material ?>" <?= $selected ?> class="text-body"><?= $val->type_of_material ?></option>
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

                <div class="mb-4.5 <?= $outbound['category'] != '' ? 'block' : 'hidden' ?>" id="wrapper-category">
                    <label class="mb-3 block text-sm font-medium text-black">
                        Category <span class="text-meta-1">*</span>
                    </label>
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                        <select name="category" id="category" class="relative z-20 w-full rounded border <?= !isset($errors['category']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary" :class="isOptionSelected && 'text-black'" @change="isOptionSelected = true">
                            <option value="" disabled selected>
                                Select
                            </option>
                            <?php
                            $cat = $outbound['category'];
                            foreach ($category as $val) {
                                $selected = '';
                                if ($cat == $val->nama) {
                                    $selected = 'selected';
                                }
                            ?>
                                <option value="<?= $val->nama ?>" <?= $selected; ?>><?= $val->nama ?></option>
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
                    <span class="text-danger text-sm"><?= isset($errors['category']) ? $errors['category'] : '' ?></span>
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black">
                        Code/SKU <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" name="code" id="code" value="<?= $outbound['code_sku'] ?>" placeholder="Input Code/SKU" class="w-full rounded border-[1.5px] <?= !isset($errors['code']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" readonly />
                    <span class="text-danger text-sm"><?= isset($errors['code']) ? $errors['code'] : '' ?></span>
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black">
                        Amount/Unit <span class="text-meta-1">*</span>
                    </label>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-10">
                            <input type="number" name="amount" value="<?= isset($input['amount']) ? esc($input['amount']) : $outbound['amount_unit'] ?>" placeholder="Input Amount" class="w-full rounded border-[1.5px] <?= !isset($errors['amount']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />
                            <span class="text-danger text-sm"><?= isset($errors['amount']) ? $errors['amount'] : '' ?></span>
                        </div>

                        <div class="col-span-2">
                            <input type="text" name="unit" id="unit" value="<?= isset($input['unit']) ? esc($input['unit']) : $outbound['unit'] ?>" placeholder="Input Unit" class="w-full rounded border-[1.5px] <?= !isset($errors['unit']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" readonly />
                            <span class="text-danger text-sm"><?= isset($errors['unit']) ? $errors['unit'] : '' ?></span>
                        </div>
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="mb-3 block text-sm font-medium text-black">
                        Serial Number <span class="text-meta-1">*</span>
                    </label>
                    <input type="text" name="serial_number" value="<?= isset($input['serial_number']) ? esc($input['serial_number']) : $outbound['serial_number'] ?>" placeholder="Input Serial Number" class="w-full rounded border-[1.5px] <?= !isset($errors['serial_number']) ? 'border-stroke' : 'border-danger' ?> bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter" />
                    <span class="text-danger text-sm"><?= isset($errors['serial_number']) ? $errors['serial_number'] : '' ?></span>
                </div>

                <button class="flex w-full justify-center rounded bg-primary p-3 font-medium text-white hover:bg-opacity-90">
                    Ubah
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