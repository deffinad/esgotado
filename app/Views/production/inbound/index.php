<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>
<?= $this->include('templates/breadcrumb') ?>

<?php
$user = $_SESSION['isLogged'];
?>

<section>
    <div class="bg-white border rounded-lg p-4 flex flex-col gap-4">
        <?php if ($user['level'] == 'Staff') { ?>
            <div class="py-2">
                <a href="<?= base_url('production/inbound/add') ?>" class="cursor-pointer rounded-lg border border-primary bg-primary px-4 py-2 font-medium text-white transition hover:bg-opacity-90">+ Tambah</a>
            </div>
        <?php } ?>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="!text-left">Date</th>
                    <th>Type of Materials</th>
                    <th>Code/SKU</th>
                    <th>Type & Unit</th>
                    <th>Serial Number</th>
                    <?php if ($user['level'] == 'Staff') { ?>
                        <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $index => $val) { ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td class="!text-left"><?= $val->date ?></td>
                        <td><?= $val->type_of_material ?></td>
                        <td><?= $val->code_sku ?></td>
                        <td><?= $val->amount_unit . ' ' . $val->unit ?></td>
                        <td><?= $val->serial_number ?></td>
                        <?php if ($user['level'] == 'Staff') { ?>
                            <td>
                                <div class="flex flex-row items-center gap-2">
                                    <a href="<?= base_url('/production/inbound/edit/' . $val->id_inbound) ?>" class="transition-all duration-200 hover:text-yellow-500 text-gray-500">
                                        <i class="far fa-edit text-lg"></i>
                                    </a>
                                    <a href="#" class="open-delete-modal transition-all duration-200 hover:text-red-500 text-gray-500 cursor-pointer" data-id="<?= $val->id_inbound ?>">
                                        <i class="far fa-trash-alt text-lg"></i>
                                    </a>
                                </div>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black/70 z-99999 hidden items-center justify-center">
        <div class="bg-white p-5 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Hapus Data</h2>
            <p class="mb-4">Yakin ingin menghapus data ini?</p>
            <div class="flex justify-end gap-3">
                <button id="cancelModal" class="px-4 py-2 border rounded">Batal</button>
                <a id="confirmDeleteBtn" href="#" class="px-4 py-2 bg-red-600 text-white rounded">Hapus</a>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();

        // Open Modal
        $('.open-delete-modal').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            $('#confirmDeleteBtn').attr('href', '<?= base_url('production/inbound/delete/') ?>' + id);
            $('#deleteModal').removeClass('hidden').addClass('flex');
        });

        // Close Modal
        $('#cancelModal').on('click', function() {
            $('#deleteModal').addClass('hidden').removeClass('flex');
        });

        // Optional: close modal when clicking outside the modal box
        $('#deleteModal').on('click', function(e) {
            if (e.target === this) {
                $('#deleteModal').addClass('hidden').removeClass('flex');
            }
        });
    });
</script>

<?= $this->endSection(); ?>