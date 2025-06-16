<?php
function createPagination($totalItems, $perPage, $currentPage)
{
    $totalPages = ceil($totalItems / $perPage);

    $pager = [
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'hasPreviousPage' => $currentPage > 1,
        'hasNextPage' => $currentPage < $totalPages,
        'previousPage' => $currentPage - 1,
        'nextPage' => $currentPage + 1,
    ];

    return $pager;
}
