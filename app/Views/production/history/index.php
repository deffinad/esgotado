<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<section>
    <div class="bg-white border rounded-lg p-4 flex flex-col gap-4">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="!text-left">Date</th>
                    <th>Type of Materials</th>
                    <th>Code/SKU</th>
                    <th>Type & Unit</th>
                    <th>Serial Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $index => $val) { ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td class="!text-left"><?= $val->date; ?></td>
                        <td><?= $val->type_of_material; ?></td>
                        <td><?= $val->code_sku; ?></td>
                        <td><?= $val->amount_unit . ' ' . $val->unit; ?></td>
                        <td><?= $val->serial_number; ?></td>
                        <td>
                            <div class="flex items-center">
                                <?php if ($val->type === 'in') { ?>
                                    <p class="bg-green-100 rounded-full text-green-500 font-bold p-2 text-xs w-14 text-center">IN</p>
                                <?php } else { ?>
                                    <p class="bg-red-100 rounded-full text-red-500 font-bold p-2 text-xs w-14 text-center">OUT</p>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

<?= $this->endSection(); ?>