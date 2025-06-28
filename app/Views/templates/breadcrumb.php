<?php
$data = $_SESSION['route'];
$active = $data[count($data) - 1];
?>

<div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <h2 class="text-title-md font-bold text-black capitalize">
        <?= $active->name ?>
    </h2>

    <nav>
        <ol class="flex items-center gap-2">
            <?php
            foreach ($data as $val) {
            ?>
                <li>
                    <a class="capitalize <?= $val->name == $active->name ? 'font-medium' : 'font-light' ?>" href="<?= $val->url ?>">
                        <?= $val->name ?> <?= $val->name != $active->name ? '>' : '' ?>
                    </a>
                </li>
            <?php } ?>
        </ol>
    </nav>
</div>