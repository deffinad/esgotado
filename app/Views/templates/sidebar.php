<?php
$route = $_SESSION['route'][count($_SESSION['route']) - 1];
?>

<aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'" class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden border bg-white duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0" @click.outside="sidebarToggle = false">
    <!-- SIDEBAR HEADER -->
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
        <div class="flex flex-1 items-center justify-center">
            <a href="index.html">
                <img src="<?= base_url('images/logo.webp') ?>" alt="Logo" class="w-28" />
            </a>
        </div>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <!-- Sidebar Menu -->
        <nav class="mt-5 px-4 py-4 lg:mt-9 lg:px-6" x-data="{selected: $persist('Dashboard')}">
            <!-- Menu Group -->
            <div>
                <ul class="mb-6 flex flex-col gap-1.5">
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-lg px-4 py-2 duration-300 ease-in-out <?= $route->name === 'dashboard' || str_contains($route->url, 'dashboard') ? 'bg-orange-100 text-primary dark:bg-meta-4 font-semibold' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-meta-4 font-medium' ?>" href="<?= base_url('/') ?>">
                            <i class="fas fa-th-large"></i>
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-lg px-4 py-2  duration-300 ease-in-out <?= str_contains($route->url, 'production') ? 'bg-orange-100 text-primary dark:bg-meta-4 font-semibold' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-meta-4 font-medium' ?> "
                            href="#" @click.prevent="selected = (selected === 'Production' ? '':'Production')"
                            :class="{ 'bg-gray-100 dark:bg-meta-4': (selected === 'Production') && ( <?= !str_contains($route->url, 'production') ?>) }">
                            <i class="fas fa-boxes"></i>
                            Production

                            <svg class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                :class="{ 'rotate-180': (selected === 'Production') }" width="20" height="20"
                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill="" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="translate transform overflow-hidden"
                            :class="(selected === 'Production') ? 'block' :'hidden'">
                            <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium duration-300 ease-in-out <?= str_contains($route->url, 'inbound') ? 'text-primary font-semibold' : 'text-gray-500 font-medium' ?>"
                                        href=" <?= base_url('/production/inbound') ?>">Inbound
                                    </a>
                                </li>
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium duration-300 ease-in-out <?= str_contains($route->url, 'outbound') ? 'text-primary font-semibold' : 'text-gray-500 font-medium' ?>"
                                        href=" <?= base_url('/production/outbound') ?>">Outbound
                                    </a>
                                </li>
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium duration-300 ease-in-out <?= str_contains($route->url, 'inventory') ? 'text-primary font-semibold' : 'text-gray-500 font-medium' ?>"
                                        href=" <?= base_url('/production/inventory') ?>">Inventory
                                    </a>
                                </li>
                                <li>
                                    <a class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium duration-300 ease-in-out <?= str_contains($route->url, 'history') ? 'text-primary font-semibold' : 'text-gray-500 font-medium' ?>"
                                        href=" <?= base_url('/production/history') ?>">History
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Dropdown Menu End -->
                    </li>

                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-lg px-4 py-2 duration-300 ease-in-out <?= $route->name === 'log activity' ? 'bg-orange-100 text-primary dark:bg-meta-4 font-semibold' : 'text-gray-500 hover:bg-gray-100 dark:hover:bg-meta-4 font-medium' ?>" href="<?= base_url('log-activity') ?>">
                            <i class="fas fa-truck-loading"></i>
                            Log Activity
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>