<?php
namespace developeruz\easyii_rbac\models;

use developeruz\db_rbac\interfaces\UserRbacInterface;
use developeruz\easyii_user\models\User as BaseUser;

class User extends BaseUser implements UserRbacInterface
{

    public function getUserName()
    {
        return $this->username;
    }
}
