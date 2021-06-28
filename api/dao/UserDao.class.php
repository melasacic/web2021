<?php
require_once dirname(_FILE_) . "/BaseDao.class.php";

class UserDao extends BaseDao
{
    private $table = "user";

    public function add_user($entity)
    {
        return $this->insert($this->table, $entity);

    }

    public function get_user_by_email($email)
    {
        return $this->query_unique("SELECT * FROM user WHERE email =:email", ["email" => $email]);
    }

    public function get_user_by_id($id)
    {
        return $this->query_unique("SELECT * FROM user WHERE id=:id", ["id" => $id]);
    }

    public function update_user($id, $user)
    {
        $this->update("user", $id, $user, 'id');
    }

    public function get_all_users()
    {
        return $this->query("SELECT * FROM user", []);
    }




}
