<?= $this->extend('templates/layout'); ?>

<?= $this->section('content'); ?>

<?= $this->include('templates/breadcrumb') ?>

<section>
    <div class="bg-white border rounded-lg p-4 flex flex-col gap-4">
        <div class="py-2">
            <a href="<?= base_url('production/inbound/add') ?>" class="cursor-pointer rounded-lg border border-primary bg-primary px-4 py-2 font-medium text-white transition hover:bg-opacity-90">+ Tambah</a>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Type of Materials</th>
                    <th>Code/SKU</th>
                    <th>Type & Unit</th>
                    <th>Serial Number</th>
                    <th>Action</th>
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
                        <div class="flex flex-row items-center gap-2">
                            <a href="/production/inbound/edit/1" class="transition-all duration-200 hover:text-yellow-500 dark:hover:text-white text-gray-500">
                                <i class="far fa-edit text-lg"></i>
                            </a>

                            <div x-data="{modalOpen: false}" class="hover:text-red-500 dark:hover:text-white text-gray-500 cursor-pointer">
                                <i @click="modalOpen = true" class="far fa-trash-alt text-lg"></i>

                                <!-- Modal Dialog -->
                                <div x-show="modalOpen" x-transition class="fixed left-0 top-0 z-999999 flex h-full min-h-screen w-full items-center justify-center bg-black/90 px-4 py-5" style="display: none;">
                                    <div @click.outside="modalOpen = false" class="w-full max-w-142.5 rounded-lg bg-white px-8 py-12 text-center dark:bg-boxdark md:px-17.5 md:py-15">
                                        <!-- Icon Modal -->
                                        <span class="mx-auto inline-block">
                                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.1" width="60" height="60" rx="30" fill="#DC2626"></rect>
                                                <path d="M30 27.2498V29.9998V27.2498ZM30 35.4999H30.0134H30ZM20.6914 41H39.3086C41.3778 41 42.6704 38.7078 41.6358 36.8749L32.3272 20.3747C31.2926 18.5418 28.7074 18.5418 27.6728 20.3747L18.3642 36.8749C17.3296 38.7078 18.6222 41 20.6914 41Z" stroke="#DC2626" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>

                                        <h3 class="mt-5.5 pb-2 text-xl font-bold text-black dark:text-white sm:text-2xl">
                                            Hapus Data
                                        </h3>
                                        <p class="mb-10 font-normal text-black dark:text-whiter">
                                            Apakah anda yakin akan menghapus data dengan nama promo <span class="font-semibold"></span>
                                        </p>

                                        <div class="-mx-3 flex flex-wrap gap-y-4">
                                            <div class="w-full px-3 2xsm:w-1/2">
                                                <button @click="modalOpen = false" class="block w-full rounded border border-stroke bg-gray p-3 text-center font-medium text-black transition hover:border-meta-1 hover:bg-meta-1 hover:text-white dark:border-strokedark dark:bg-meta-4 dark:text-white dark:hover:border-meta-1 dark:hover:bg-meta-1">
                                                    Batal
                                                </button>
                                            </div>
                                            <div class="w-full px-3 2xsm:w-1/2">
                                                <a @click="modalOpen = false" href="<?= base_url('production/inbound/delete/1') ?>" class="block w-full rounded border border-meta-1 bg-meta-1 p-3 text-center font-medium text-white transition hover:bg-opacity-90 no-underline">
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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