<?php

namespace app\database\models;

use PDOException;
use app\database\Filters;

use app\database\Connection;
use app\database\Pagination;

abstract class Model
{
    private string $fields = "*";
    private string $filters = "";
    private string $pagination = '';

    public function setFields($fields)
    {
        $this->fields = $fields;
    }
    public function setFilters(Filters $filters)
    {
        $this->filters = $filters->dump();
        var_dump($this->filters);
    }

    public  function setPagination(Pagination $pagination){
        $this->pagination = $pagination->dump();
    }
    public function create(array $data)
    {
        try {
            $conn = Connection::connect();
            $sql = "INSERT INTO $this->table (";
            $sql .= implode(",", array_keys($data)) . ")";
            $sql .= "VALUES (:" . implode(", :", array_keys($data)) . ")";
            $stmt = $conn->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function update(string $field, string|int $value, array $data)
    {
        try {
            $conn = Connection::connect();
            $sql = "UPDATE $this->table SET ";
            foreach ($data as $index => $dataValue) {
                $sql .= $index . " = :" . $index . ", ";
            }
            $pos = strripos($sql, ",");
            if ($pos) {
                $sql = substr_replace($sql, "", $pos, 1);
            }
            $sql .= " WHERE $field = :$field";

            $data[$field] = $value;
            $stmt = $conn->prepare($sql);

            return $stmt->execute($data);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function fetchAll()
    {
        try {
            $conn = Connection::connect();
            $sql = "SELECT {$this->fields} FROM {$this->table} {$this->filters} {$this->pagination}";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return $stmt->rowCount() > 0 ? $stmt->fetchAll() : [];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function findBy(string $field, string $value)
    {
        try {
            $conn = Connection::connect();
            $sql = "SELECT $this->fields FROM $this->table where $field = :$field";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":$field", $value);
            $stmt->execute();
            return $stmt->rowCount() > 0 ? $stmt->fetch() : [];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteFrom(string $field, string $value)
    {
        try {
            $conn = Connection::connect();
            $sql = "DELETE FROM $this->table where $field = :$field";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":$field", $value);
            $stmt->execute();
            return $stmt->rowCount() > 0 ? true : false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function first(string $field, string $order = 'ASC')
    {
        try {
            $conn = Connection::connect();
            $sql = "SELECT $this->fields FROM $this->table ORDER BY $field $order";
            $stmt = $conn->query($sql);
            return $stmt->rowCount() > 0 ? $stmt->fetch() : [];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function count()
    {
        try {
            $conn = Connection::connect();
            $sql = "SELECT $this->fields FROM $this->table $this->filters";
            $stmt = $conn->query($sql);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
