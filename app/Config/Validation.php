<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public $signin = [
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email is required',
                'valid_email' => 'Email not valid'
            ]
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password is required',
            ]
        ],
    ];

    public $signup = [
        'name' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Name is required',
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email is required',
                'valid_email' => 'Email not valid'
            ]
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password is required',
            ]
        ],
        'conf_password' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Confirm Password is required',
                'matches' => 'Confirm password is not the same'
            ]
        ],
         'phone' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Phone is required',
            ]
        ],
         'address' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Address is required',
            ]
        ],
    ];

    public $production = [
        'date' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Date is required',
            ]
        ],
        'type_materials' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Type of materials is required',
            ]
        ],
        'amount' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Amount is required',
            ]
        ],
        'code' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Code/SKU is required',
            ]
        ],
        'unit' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Unit is required',
            ]
        ],
        'serial_number' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Serial number is required',
            ]
        ],
    ];

    public $inventory = [
        'type_materials' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Type of materials is required',
            ]
        ],
        'amount' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Amount is required',
            ]
        ],
        'code' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Code/SKU is required',
            ]
        ],
        'unit' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Unit is required',
            ]
        ],
    ];
}
