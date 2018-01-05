<?php

namespace App\Core;

/**
 * Class Database
 * @package App\Core
 */
class Database
{

    /**
     * @var \mysqli
     */
    protected $db;
    protected $table;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->connect();
    }

    public function connect()
    {

        if (!isset($this->db)) {
            $this->db = new \mysqli (
                config('database.hostname'),
                config('database.username'),
                config('database.password'),
                config('database.database')
            );
        }

        if ($this->db === false) {
            return false;
        }
    }

    /**
     * @param $data
     * @return \mysqli_result
     */
    public function insert($data)
    {
        $data['created_at'] = isset($data['created_at']) ? $data['created_at'] : date('Y-m-d H:i:s');

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

            list($column, $operator) = explode(' ', $key);

            if(isset($operator)){
                $conditions[] = "`$column` $operator '$value'";
            } else {
                $conditions[] = "`$column` = '$value'";
            }

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

    public function table($table){
        $this->table = $table;
        return $this;
    }

    public function delete($jobId)
    {
        $this->sql = "DELETE FROM $this->table WHERE id = $jobId";
        return $this->db->query($this->sql);
    }

    public function last_query(){
        return $this->sql;
    }

}