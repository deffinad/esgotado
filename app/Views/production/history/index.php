<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<section>
    <div class="bg-white border rounded-lg p-4 flex flex-col gap-4">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Type of Materials</th>
                    <th>Code/SKU</th>
                    <th>Type & Unit</th>
                    <th>Serial Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>24 Feb 2025</td>
                    <td>Kain Z</td>
                    <td>KZ01</td>
                    <td>12 Lusin</td>
                    <td>E2F3AB</td>
                    <td>
                        <div class="flex items-center">
                            <p class="bg-green-100 rounded-full text-green-500 font-bold p-2 text-xs w-14 text-center">IN</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>24 Feb 2025</td>
                    <td>Kain Z</td>
                    <td>KZ01</td>
                    <td>12 Lusin</td>
                    <td>E2F3AB</td>
                    <td>
                        <div class="flex items-center">
                            <p class="bg-red-100 rounded-full text-red-500 font-bold p-2 text-xs w-14 text-center">OUT</p>
                        </div>
                    </td>
                </tr>
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