<?php

namespace App\Models;
use StarterPhp\Core\BaseModel;

class UserModel extends BaseModel
{

    public function getUsers()
    {

        $sql = "select * from $this->table";

        $users = $this->db->getAll($sql);

        return $users;
    }

}
