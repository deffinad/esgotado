<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<section>
    <div class="bg-white border rounded-lg p-4 flex flex-col gap-4">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th class="!text-left">Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $index => $val) { ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td>
                            <div class="flex flex-row gap-2 items-center">
                                <div class="w-6 h-6 text-xs rounded-full bg-gray-300 text-gray-400 flex items-center justify-center">
                                    <i class="fas fa-user"></i>
                                </div>

                                <span><?= $val->nama; ?></span>
                            </div>
                        </td>
                        <td class="!text-left"><?= $val->date; ?></td>
                        <td><?= $val->action; ?></td>
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