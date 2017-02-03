<?php

use yii\db\Migration;

class m170202_122233_insert_base_permissions_for_easyii_rbac_module extends Migration
{
    public function up()
    {
        $this->insert('auth_item', [
            'name' => 'admin',
            'type' => 2,
            'description' => 'Access to Admin Panel',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('auth_item', [
            'name' => 'permit',
            'type' => 2,
            'description' => 'CRUD Permissions and Roles',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('auth_item', [
            'name' => 'user',
            'type' => 2,
            'description' => 'CRUD Users',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('auth_item', [
            'name' => 'administrator',
            'type' => 1,
            'description' => 'Admin',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $permissions = ['admin', 'permit', 'user'];
        $role = Yii::$app->authManager->getRole('administrator');
        foreach ($permissions as $permit) {
            $new_permit = Yii::$app->authManager->getPermission($permit);
            Yii::$app->authManager->addChild($role, $new_permit);
        }
    }

    public function down()
    {
        $this->delete('auth_item', ['name' => 'admin']);
        $this->delete('auth_item', ['name' => 'permit']);
        $this->delete('auth_item', ['name' => 'user']);
        return true;
    }
}
