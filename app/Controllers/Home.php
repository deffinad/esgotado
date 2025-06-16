<?php

namespace App\Controllers;

use PhpParser\Node\Stmt\Break_;

class Home extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index()
    {
        $breadcrumb = [
            (object) [
                'name' => 'dashboard',
                'url' => '/'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('dashboard/index');
    }

    public function detailDashboardView($type = '')
    {
        $breadcrumb = [
            (object) [
                'name' => 'dashboard',
                'url' => '/'
            ],
            (object) [
                'name' => 'detail',
                'url' => '/dashboard/detail/' . $type
            ],
        ];

        $this->session->set('route', $breadcrumb);
        $data['type'] = $type;
        return view('dashboard/detail', $data);
    }
}