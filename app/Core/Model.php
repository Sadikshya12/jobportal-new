<?php

namespace App\Core;
class Model
{
    public $db;
    public $table;
    protected $sql;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function insert($data)
    {
        // retrieve the keys of the array (column titles)
        $fields = array_keys($data);

        // build the query
        $this->sql = "INSERT INTO " . $this->table;
        $this->sql .= "(`" . implode('`,`', $fields) . "`)";
        $this->sql .= "VALUES('" . implode("','", $data) . "')";

        // run and return the query result resource
        return $this->db->query($this->sql);
    }

    public function all()
    {
        $this->sql = "SELECT * FROM `$this->table`";
        return $this->fetch_rows();
    }

    public function select($column)
    {
        $this->sql = "SELECT " . $column . " FROM $this->table";
        return $this;
    }

    public function where($data)
    {
        $this->select("$this->table.*");

        $conditions = [];
        foreach ($data as $key => $value) {
            $conditions[] = "`$key` = '$value'";
        }

        $this->sql .= " WHERE " . implode(" AND ", $conditions);
        return $this;
    }

    public function raw_query($sql){
        $this->sql = $sql;
        return $this;
    }

    public function fetch_rows()
    {

        $query = $this->db->query($this->sql);

        if(!$query){
            return null;
        }

        $rows = [];
        while ($row = mysqli_fetch_object($query)) {
            array_push($rows, $row);
        }

        return $rows;
    }

    public function fetch_row()
    {
        $query = $this->db->query($this->sql);
        if(!$query){
            return null;
        }

        $row = mysqli_fetch_object($query);
        return $row;
    }

}