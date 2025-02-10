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

    public $registration = [
        'username' => [
            'label' => 'Auth.username',
            'rules' => [
                'required',
                'max_length[30]',
                'min_length[3]',
                'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                'is_unique[users.username]',
            ],
        ],
        'telefono' => [
            'label' => 'Mobile Number',
            'rules' => [
                'max_length[20]',
                'min_length[10]',
                'regex_match[/\A[0-9]+\z/]',
                'is_unique[users.mobile_number]',
            ],
        ],
        'email' => [
            'label' => 'Auth.email',
            'rules' => [
                'required',
                'max_length[254]',
                'valid_email',
                'is_unique[auth_identities.secret]',
            ],
        ],
        'password' => [
            'label' => 'Auth.password',
            'rules' => [
                'required',
                'max_byte[72]',
                'strong_password[]',
            ],
            'errors' => [
                'max_byte' => 'Auth.errorPasswordTooLongBytes',
            ]
        ],
        'password_confirm' => [
            'label' => 'Auth.passwordConfirm',
            'rules' => 'required|matches[password]',
        ],
        'fotoProfilo' => [
            'label' => 'Profile Picture',
            'rules' => 'uploaded[fotoProfilo]|max_size[fotoProfilo,4096]|is_image[fotoProfilo]|mime_in[fotoProfilo,image/jpg,image/jpeg,image/gif,image/png,image/webp,image/avif]',
        ],
        'facebook' => [
            'label' => 'Facebook',
            'rules' => 'max_length[255]|valid_url',
        ],
        'twitter' => [
            'label' => 'Twitter',
            'rules' => 'max_length[255]|valid_url',
        ],
        'instagram' => [
            'label' => 'Instagram',
            'rules' => 'max_length[255]|valid_url',
        ],
        'linkedin' => [
            'label' => 'LinkedIn',
            'rules' => 'max_length[255]|valid_url',
        ],
        'youtube' => [
            'label' => 'YouTube',
            'rules' => 'max_length[255]|valid_url',
        ],
        'twitch' => [
            'label' => 'Twitch',
            'rules' => 'max_length[255]|valid_url',
        ],
        'tiktok' => [
            'label' => 'TikTok',
            'rules' => 'max_length[255]|valid_url',
        ],
        'thread' => [
            'label' => 'Thread',
            'rules' => 'max_length[255]|valid_url',
        ],
        'sitoWeb' => [
            'label' => 'Website',
            'rules' => 'max_length[255]|valid_url',
        ],
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
}
