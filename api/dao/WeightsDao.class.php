<?php
require_once dirname(_FILE_) . "/BaseDao.class.php";

class WheightsDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct("weights");
    }

    public function add_weights($weights)
    {
        return $this->insert("weights", $weights);
    }

    public function update_weights($id, $weights)
    {
        $this->update("weights", $id, $weights);
    }

    public function get_weights_by_id($id)
    {
        return $this->query_unique("SELECT * FROM weights WHERE id =:id", ["id" => $id]);
    }


    public function get_all_weights()
    {
        return $this->query("SELECT * FROM weights", []);
    }



}
