<?php

use yii\db\Migration;

class m170202_120556_insert_rbac_module_to_easy_cms extends Migration
{
    public function up()
    {
        $this->insert('easyii_modules', [
            'name' => 'role',
            'class' => 'developeruz\easyii_rbac\RoleModule',
            'title' => 'Roles',
            'icon' => 'warning-sign',
            'status' => 1,
            'settings' => '[]',
            'notice' => 0,
            'order_num' => 120
        ]);

        $this->insert('easyii_modules', [
            'name' => 'permission',
            'class' => 'developeruz\easyii_rbac\PermissionModule',
            'title' => 'Permissions',
            'icon' => 'warning-sign',
            'status' => 1,
            'settings' => '[]',
            'notice' => 0,
            'order_num' => 120
        ]);
    }

    public function down()
    {
        $this->delete('easyii_modules', ['name' => 'permission']);
        $this->delete('easyii_modules', ['name' => 'role']);
        return true;

    }
}
