<?php
require_once dirname(_FILE_) . "/../config.php";

/**
 * The main class for interaction with database.
 *
 * All other DAO classes should inherit this class.
 *
 * @author Mela Sacic
 */

class BaseDao
{
    protected $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=" . Config::DB_HOST . ";dbname=" . Config::DB_SCHEME, Config::DB_USERNAME, Config::DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 1);
        } catch (PDOException $e) {
            throw $e;
        }
    }


    protected function insert($table, $entity)
    {
        $query = "INSERT INTO ${table} (";
        foreach ($entity as $column => $value) {
            $query .= $column . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($entity as $column => $value) {
            $query .= ":" . $column . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";

        $stmt = $this->connection->prepare($query);
        $stmt->execute($entity); // sql injection prevention
        $entity['id'] = $this->connection->lastInsertId();
        return $entity;
    }

    protected function update($table, $id, $entity, $id_column = "id")
    {
        $query = "UPDATE ${table} SET ";
        foreach ($entity as $name => $value) {
            $query .= $name . "= :" . $name . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE {$id_column} = :id";
        $entity['id'] = $id;
        $stmt = $this->connection->prepare($query);
        $stmt->execute($entity);
    }

    protected function query($query, $params)
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function query_unique($query, $params)
    {
        $results = $this->query($query, $params);
        return reset($results);
    }

    public static function parse_order($order)
   {
       switch (substr($order, 0, 1)) {
           case '-':$order_direction = "ASC";
               break;
           case '+':$order_direction = "DESC";
               break;
           default;throw new Exception("Invalid order format. First character should be either + or -");
               break;
               // $this->connection->quote
       }
       $order_column = substr($order, 1);
       return [$order_column, $order_direction];
   }


}

 ?>
