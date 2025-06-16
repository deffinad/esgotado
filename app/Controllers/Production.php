<?php

namespace App\Controllers;

use PhpParser\Node\Stmt\Break_;

class Production extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function inboundView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'production',
                'url' => ''
            ],
            (object) [
                'name' => 'inbound',
                'url' => '/production/inbound'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('production/inbound/index');
    }

    public function addInboundView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'production',
                'url' => ''
            ],
            (object) [
                'name' => 'inbound',
                'url' => '/production/inbound'
            ],
            (object) [
                'name' => 'add inbound',
                'url' => '/production/inbound/add'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('production/inbound/add');
    }

    public function editInboundView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'production',
                'url' => ''
            ],
            (object) [
                'name' => 'inbound',
                'url' => '/production/inbound'
            ],
            (object) [
                'name' => 'edit inbound',
                'url' => '/production/inbound/add'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('production/inbound/edit');
    }

    public function outboundView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'production',
                'url' => ''
            ],
            (object) [
                'name' => 'outbound',
                'url' => '/production/outbound'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('production/outbound/index');
    }

    public function addOutboundView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'production',
                'url' => ''
            ],
            (object) [
                'name' => 'outbound',
                'url' => '/production/outbound'
            ],
            (object) [
                'name' => 'add outbound',
                'url' => '/production/outbound/add'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('production/outbound/add');
    }

    public function editOutboundView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'production',
                'url' => ''
            ],
            (object) [
                'name' => 'outbound',
                'url' => '/production/outbound'
            ],
            (object) [
                'name' => 'edit outbound',
                'url' => '/production/outbound/add'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('production/outbound/edit');
    }

    public function inventoryView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'production',
                'url' => ''
            ],
            (object) [
                'name' => 'inventory',
                'url' => '/production/inventory'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('production/inventory/index');
    }

    public function addInventoryView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'production',
                'url' => ''
            ],
            (object) [
                'name' => 'inventory',
                'url' => '/production/inventory'
            ],
            (object) [
                'name' => 'add inventory',
                'url' => '/production/inventory/add'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('production/inventory/add');
    }

    public function editInventoryView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'production',
                'url' => ''
            ],
            (object) [
                'name' => 'inventory',
                'url' => '/production/inventory'
            ],
            (object) [
                'name' => 'edit inventory',
                'url' => '/production/inventory/add'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('production/inventory/edit');
    }

    public function historyView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'production',
                'url' => ''
            ],
            (object) [
                'name' => 'history',
                'url' => '/production/history'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('production/history/index');
    }

    public function logActivityView()
    {
        $breadcrumb = [
            (object) [
                'name' => 'log activity',
                'url' => '/logActivity'
            ],
        ];

        $this->session->set('route', $breadcrumb);
        return view('/logActivity/index');
    }
}
