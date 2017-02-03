<?php

return [
    'bootstrap' => ['developeruz\easyii_rbac\Bootstrap'],
    'components' => [
        'urlManager' => [
            'rules' => [
                'admin/role' => '/permit/access/role',
                'admin/permission' => '/permit/access/permission',
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views/' => '@vendor/developeruz/easyii-rbac-module/views/user'
                ],
            ],
        ],
    ],
    'modules' => [
        'permit' => [
            'class' => 'developeruz\db_rbac\Yii2DbRbac',
            'layout' => '@vendor/noumo/easyii/views/layouts/main',
            'params' => [
                'userClass' => 'developeruz\easyii_rbac\models\User'
            ]
        ]
    ]
];
