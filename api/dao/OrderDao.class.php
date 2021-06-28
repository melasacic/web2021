<?php
require_once dirname(_FILE_) . "/BaseDao.class.php";

class OrderDao extends BaseDao
{

    public function get_all_orders()
    {
        return $this->query("SELECT * FROM orders ", []);
    }

  

    public function get_orders_by_id($id)
    {
        return $this->query_unique("SELECT * FROM orders WHERE id =:id", ["id" => $id]);
    }

}
