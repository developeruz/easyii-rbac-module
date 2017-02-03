Role Base Access for EasyiiCMS
==============================

This module allows add [Rbac module](https://github.com/developeruz/yii2-db-rbac) to [Easy yii2 cms](http://github.com/noumo/easyii) 

## Installation guide

Please, install [User module for EasyiiCMS by following these instructions](https://github.com/developeruz/easyii-user-module) before going further

```bash
$ php composer.phar require developeruz/easyii-rbac-module "dev-master"
```

Replace last line in `app/config/web.php`
```php
$config = array_merge_recursive($config,
    require($webroot . '/vendor/developeruz/easyii-user-module/config/user_module_config.php'),
    require($webroot . '/vendor/noumo/easyii/config/easyii.php'));
$config['components']['user'] = [ 'identityClass' => 'developeruz\easyii_user\models\User' ];
return $config;
```
with 
```php
$config = array_merge_recursive($config,
    require($webroot . '/vendor/developeruz/easyii-user-module/config/user_module_config.php'),
    require($webroot . '/vendor/developeruz/easyii-rbac-module/config/rbac_module_config.php'),
    require($webroot . '/vendor/noumo/easyii/config/easyii.php'));
$config['components']['user'] = [ 'identityClass' => 'developeruz\easyii_rbac\models\User' ];
return $config;
```

Add authManager to components in `app/config/console.php` and `app/config/web.php`
```php
'components' => [
      ...
      'authManager' => [
        'class' => 'yii\rbac\DbManager',
      ],
]
```

Run authManager migrations
```bash 
php yii migrate --migrationPath=@yii/rbac/migrations/
```

Run migrations
```bash
php yii migrate --migrationPath=@vendor/developeruz/easyii-rbac-module/migrations
```

Open User CRUD page (url `admin/user`), you will see `change user role` button in action buttons column. Click on it and assign `Admin`role to admin user.

Add behaviour in `app/config/web.php`
```php
'components' => [
...
],
'modules' => [
... 
],
'as AccessBehavior' => [
        'class' => \developeruz\db_rbac\behaviors\AccessBehavior::className(),
        'login_url' => '/admin/sign/in',
        'rules' => [
            'user/security' => [['actions' => ['login'], 'allow' => true ],
                                ['actions' => ['logout'], 'roles' => ['@'], 'allow' => true ]],
            'user/settings' => [['roles' => ['@'], 'allow' => true ]],
            'admin/sign' => [['actions' => ['in'], 'allow' => true],
                             ['actions' => ['out'], 'roles' => ['@'], 'allow' => true ]],
                             
            'site' =>[[ 'allow' => true]],
            'articles' =>[[ 'allow' => true]],
            'gallery' =>[[ 'allow' => true]],
            'news' =>[[ 'allow' => true]],
        ],
]

```

Add all public controllers in `rules`.

If the user doesn't have access to admin panel, admin Toolbar will be hidden on front pages via adding css `display:none`. 
It is compelled workaround because [Easy yii2 cms](http://github.com/noumo/easyii) doesn't allow to overwrite this part. 
I will create PR and change the behavior in this module as soon as it would be possible.

License
=======

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
