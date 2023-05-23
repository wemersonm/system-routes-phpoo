<?php

namespace app\database;

class Filters
{
    private array $filters = [];

    public function where(string $field, string $operator, mixed $value, string $logic = '')
    {

        $formater = "";
        if (is_array($value)) {
            $formater .= "('" . implode("','", $value) . "')";
        } elseif (is_string($value)) {
            $formater = "'{$value}'";
        } elseif (is_bool($value)) {
            $formater = $value ? 1 : 0;
        } else {
            $formater = $value;
        }

        $value = strip_tags($formater);

        $this->filters['where'][] = "{$field} {$operator} {$value} {$logic}";
    }

    public function limit(int $limit)
    {
        $this->filters['limit'] = " LIMIT {$limit}";
    }
    public function orderBy(string $field, string $order = "ASC")
    {
        $this->filters['order'] = " ORDER BY " . $field . " " . $order;
    }

    public function join(string $foreginTable, string $joinTable1, string $operator, string $joinTable2, string $joinType = 'INNER JOIN')
    {

        $this->filters['join'][] = "$joinType $foreginTable ON $joinTable1 $operator $joinTable2";
    }

    public function dump()
    {
        $filter = !empty($this->filters['where']) ? ' where ' . implode(' ', $this->filters['where']) : '';
        $filter.= !empty($this->filters['join']) ? implode(' ', $this->filters['join']) : '';
        $filter .= $this->filters['order'] ?? '';
        $filter .= $this->filters['limit'] ?? '';
        return $filter;
    }
}
