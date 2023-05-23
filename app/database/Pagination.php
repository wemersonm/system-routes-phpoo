<?php

namespace app\database;

class Pagination
{
    private int $currentPage = 1;
    private int $itensPerPage = 10;
    private int $totalPages;
    private int $totalItens;

    public function setTotalItens(int $totalItens)
    {
        $this->totalItens = $totalItens;
    }
    public function setItensPerPage(int $itensPerPage)
    {
        $this->itensPerPage = $itensPerPage;
    }
   
    public function getTotalPages()
    {
        return $this->totalPages;
    }
    public function calculation()
    {

        $this->currentPage = $_GET['page'] ?? 1;

        $offset = ($this->currentPage - 1) * $this->itensPerPage;
        $this->totalPages = ceil($this->totalItens / $this->itensPerPage);

        return " LIMIT " . $offset . "," . $this->itensPerPage;
    }
    public function dump()
    {
        return $this->calculation();
    }
}
