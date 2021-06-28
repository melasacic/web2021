<?php
require_once dirname(_FILE_) . "/BaseDao.class.php";

class ShoppingCartDao extends BaseDao
{

    public function get_shoppingcarts_by_id($id)
    {
        return $this->query_unique("SELECT * FROM shopping_cart WHERE id=:id", ["id" => $id]);
    }

    public function get_all_shoppingcarts()
    {
        return $this->query("SELECT * FROM shopping_cart", []);
    }

}
