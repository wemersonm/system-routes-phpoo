<?php

namespace app\database\models;

use app\database\Connection;
use app\database\Filters;

use PDOException;

abstract class Model
{
    private string $fields = "*";
    private string $filters = "";

    public function setFields($fields)
    {
        $this->fields = $fields;
    }
    public function setFilters(Filters $filters)
    {
        $this->filters = $filters->dump();
    }

    public function fetchAll()
    {
        try {
            $conn = Connection::connect();
            $sql = "SELECT $this->fields FROM $this->table $this->filters";
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
            $stmt->bindValue(":$field",$value);
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
            $stmt->bindValue(":$field",$value);
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
