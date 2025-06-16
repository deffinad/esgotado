<!DOCTYPE html>
<html lang="en">

<?= $this->include('templates/header') ?>

<?php
$sukses = session()->getFlashdata('sukses') ? true : false;
$gagal = session()->getFlashdata('gagal') ? true : false;
?>

<body
    x-data="{ 
    page: 'formLayout', 
    loaded: true, 
    darkMode: true, 
    stickyMenu: false, 
    sidebarToggle: false, 
    scrollTop: false, 
    showSukses: false, 
    showGagal: false 
  }"
    x-init="
    darkMode = JSON.parse(localStorage.getItem('darkMode')) ?? true;
    setTimeout(() => showSukses = <?= json_encode($sukses) ?>, 700);
    setTimeout(() => showGagal = <?= json_encode($gagal) ?>, 700);
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)));
  "
    :class="{
    'dark text-bodydark bg-boxdark-2': darkMode === true
  }"
    class="overflow-y-hidden">

    <!-- ===== Preloader Start ===== -->
    <?= $this->include('templates/preloader') ?>
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        <?= $this->include('templates/sidebar') ?>
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden bg-gray-50">

            <!-- ===== Header Start ===== -->
            <?= $this->include('templates/navbar') ?>
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">

                    <!-- ===== Flash Success Notification ===== -->
                    <div
                        x-show="showSukses"
                        x-transition:enter="transition-transform duration-700"
                        x-transition:enter-start="transform translate-x-full"
                        x-transition:enter-end="transform translate-x-0"
                        x-transition:leave="transition-transform duration-700"
                        x-transition:leave-start="transform translate-x-0"
                        x-transition:leave-end="transform translate-x-full"
                        class="px-8 py-4 z-999 bg-green-500 text-white flex justify-between gap-6 rounded fixed bottom-[30px] right-0">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-6" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                            </svg>
                            <p class="capitalize"><?= esc(session()->getFlashdata('sukses')) ?></p>
                        </div>
                        <button @click="showSukses = false" class="text-green-100 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- ===== Flash Error Notification ===== -->
                    <div
                        x-show="showGagal"
                        x-transition:enter="transition-transform duration-700"
                        x-transition:enter-start="transform translate-x-full"
                        x-transition:enter-end="transform translate-x-0"
                        x-transition:leave="transition-transform duration-700"
                        x-transition:leave-start="transform translate-x-0"
                        x-transition:leave-end="transform translate-x-full"
                        class="px-8 py-4 z-999 bg-red-400 text-white flex justify-between gap-6 rounded fixed bottom-[30px] right-0">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-6" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <p><?= esc(session()->getFlashdata('gagal')) ?></p>
                        </div>
                        <button @click="showGagal = false" class="text-red-100 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Your actual content here -->
                    <?= $this->renderSection('content') ?>
                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
</body>

</html>