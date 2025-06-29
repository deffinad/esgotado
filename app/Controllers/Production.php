<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\InboundModel;
use App\Models\InventoryModel;
use App\Models\LogActivityModel;
use App\Models\OutboundModel;
use PhpParser\Node\Stmt\Break_;

class Production extends BaseController
{
    protected $session;
    protected $mInventory;
    protected $mCategory;
    protected $mInbound;
    protected $mOutbound;
    protected $mLog;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();

        $this->mInventory = new InventoryModel();
        $this->mInbound = new InboundModel();
        $this->mOutbound = new OutboundModel();
        $this->mLog = new LogActivityModel();
        $this->mCategory = new CategoryModel();
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
        $data['list'] = $this->mInbound->getInbound();
        return view('production/inbound/index', $data);
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
        $data['inventory'] = $this->mInventory->getInventory();
        return view('production/inbound/add', $data);
    }

    public function editInboundView($id)
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
        $data['inventory'] = $this->mInventory->getInventory();
        $data['inbound'] = $this->mInbound->getInboundById($id);

        $data['category'] = $this->mCategory->getCategoryByInventory($data['inbound']['code_sku']);
        return view('production/inbound/edit', $data);
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
        $data['list'] = $this->mOutbound->getOutbound();
        return view('production/outbound/index', $data);
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
        $data['inventory'] = $this->mInventory->getInventory();
        return view('production/outbound/add', $data);
    }

    public function editOutboundView($id)
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
        $data['inventory'] = $this->mInventory->getInventory();
        $data['outbound'] = $this->mOutbound->getOutboundById($id);

        $data['category'] = $this->mCategory->getCategoryByInventory($data['outbound']['code_sku']);
        return view('production/outbound/edit', $data);
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
        $data['list'] = $this->mInventory->getInventory();
        return view('production/inventory/index', $data);
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

    public function editInventoryView($id)
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
        $data['inventory'] = $this->mInventory->getInventoryById($id);
        $data['category'] = $this->mCategory->getCategoryByInventory($id);
        return view('production/inventory/edit', $data);
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
        $inbound = $this->mInbound->getInbound();
        $outbound = $this->mOutbound->getOutbound();
        
        $data['list'] = [];

        foreach($inbound as $val){
            $val->type = 'in';
            array_push($data['list'], $val);
        }

        foreach($outbound as $val){
            $val->type = 'out';
            array_push($data['list'], $val);
        }

        return view('production/history/index', $data);
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
        $data['list'] = $this->mLog->getLog();;

        return view('/logActivity/index', $data);
    }
}
