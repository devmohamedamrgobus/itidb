<?php
namespace Iti\Db;

class db{
    /**
     * @var false|mysqli
     */
    private $connection;
    /**
     * @var
     */
    private $table;
    /**
     * @var
     */
    private $sql;

    public function __construct($server,$user,$password,$database)
    {
        $this->connection = mysqli_connect($server,$user,$password,$database);
    }

    /**
     * @param string $table
     * @return object|$this
     */
    public function table(string $table):object
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param array $data
     * @return object|$this
     */
    public function insert(array $data):object
    {
        $columns = '';
        $values = '';
        foreach ($data as $key => $value){
            $columns .= "`$key`,";
            $values .= "'$value',";
        }
        $columns = rtrim($columns,',');
        $values = rtrim($values,',');
        $this->sql = "INSERT INTO `$this->table` ($columns) values ($values)";
        return $this;
    }

    /**
     * @param array $data
     * @return object|$this
     */
    public function update(array $data):object
    {
        $row = '';
        foreach ($data as $key => $value){
            $row .= "`$key` = '$value',";
        }
        $row = rtrim($row,',');
        $this->sql = "UPDATE `$this->table` SET $row";
        return $this;
    }

    /**
     * @return int
     */
    public function excute():int
    {
        mysqli_query($this->connection,$this->sql);
        return mysqli_affected_rows($this->connection);
    }

    /**
     * @param string $columns
     * @return object|$this
     */
    public function select(string $columns = "*"):object
    {
        $this->sql = "SELECT $columns FROM $this->table ";
        return  $this;
    }

    /**
     * @return array
     */
    public function all():array
    {
        $query = mysqli_query($this->connection,$this->sql);
        return mysqli_fetch_all($query,MYSQLI_ASSOC);
    }

    /**
     * @return array
     */
    public function first():array
    {
        $query = mysqli_query($this->connection,$this->sql);
        return mysqli_fetch_assoc($query);
    }

    /**
     * @param string $column
     * @param string $opreator
     * @param string $value
     * @return object|$this
     */
    public function where(string $column,string $opreator,string $value):object
    {
        $this->sql .= "WHERE `$column` $opreator  '$value'";
        return $this;
    }

    /**
     * @param string $column
     * @param string $opreator
     * @param string $value
     * @return object|$this
     */
    public function andWhere(string $column,string $opreator,string $value):object
    {
        $this->sql .= " AND `$column` $opreator  '$value'";
        return $this;
    }

    /**
     * @param string $column
     * @param string $opreator
     * @param string $value
     * @return object|$this
     */
    public function orWhere(string $column,string $opreator,string $value):object
    {
        $this->sql .= " OR `$column` $opreator '$value'";
        return $this;
    }

    /**
     * @return $this
     */
    public function delete()
    {
        $this->sql = "DELETE FROM `$this->table` ";
        return $this;
    }

    public function __destruct()
    {
        mysqli_close($this->connection);
    }
}


