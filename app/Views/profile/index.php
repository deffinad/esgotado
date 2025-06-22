<?= $this->extend('templates/layout'); ?>
<?= $this->section('content'); ?>
<?= $this->include('templates/breadcrumb') ?>

<section>
    <div class="bg-white border rounded-lg p-4 flex flex-col gap-4">
        <div class="bg-white border rounded-lg p-4 flex flex-row items-center gap-4 ">
            <span class="!h-16 !w-16 text-2xl rounded-full bg-gray-300 text-gray-400 flex items-center justify-center">
                <i class="fas fa-user"></i>
            </span>

            <div>
                <p class="text-xl"><?= $user['nama']; ?></p>
                <p><?= $user['level']; ?></p>
            </div>
        </div>

        <div class="bg-white border rounded-lg p-4 flex flex-col gap-4">
            <p class="text-xl font-semibold">Personal Information</p>

            <div class="flex flex-col gap-3">
                <div>
                    <p class="text-gray-500">Name</p>
                    <p><?= $user['nama']; ?></p>
                </div>

                <div>
                    <p class="text-gray-500">Email</p>
                    <p><?= $user['email']; ?></p>
                </div>

                <div>
                    <p class="text-gray-500">Phone</p>
                    <p><?= $user['phone']; ?></p>
                </div>

                <div>
                    <p class="text-gray-500">Address</p>
                    <p><?= $user['address']; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>