<?php
function tanggal_indo($tanggal, $format = 'full')
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $tanggal);

    if ($format == 'short') {
        return $split[2] . ' ' . substr($bulan[(int)$split[1]], 0, 3) . ' ' . $split[0];
    } elseif ($format == 'full') {
        return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
    }
}
