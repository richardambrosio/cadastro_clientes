<?php

namespace App;

use App\DB\Sql;
use App\Helper\Component;

class Pagination {
    const SESSION = 'SessionPagination';

    private $pages = [];

    public static function beginPaginationSession() {
        $_SESSION[Pagination::SESSION] = true;

        return new Pagination();
    }

    public static function endPaginationSession() {
        unset($_SESSION[Pagination::SESSION]);
    }

    public static function verifySessionPagination() {
        return (isset($_SESSION[Pagination::SESSION]) && $_SESSION[Pagination::SESSION] === true) ? true : false;
    }

    public function createPagination($rawQuery, $args = array(), $route = '/', $itemsPerPage = 5) {
        $page = (isset($_GET['page']) && !empty($_GET['page'])) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $itemsPerPage;

        $rawQuery = $this->setFoundRowsInSql($rawQuery);
        $rawQuery = $this->setLimitOffsetInSql($rawQuery, $start, $itemsPerPage);

        $sql = new Sql();

        $results = $sql->select($rawQuery, $args); //registros
        $resultsTotal = $sql->select('SELECT FOUND_ROWS() AS total_rows'); // quantidade total de registros
        $resultsTotal = $resultsTotal[0]['total_rows'];
        $totalPages = ceil($resultsTotal / $itemsPerPage); //quantidade total de páginas
        $previous = ($page == 1) ? 1 : $page - 1; //página anterior
        $next = ($page >= $totalPages) ? $totalPages : $page + 1; //próx página
        $currentRecords = ($start + 1) . " - " . (($itemsPerPage * $page > $resultsTotal) ? $resultsTotal : $itemsPerPage * $page); //registros na página
        
        $maxLinks = 3;
        $sideLink = ceil($maxLinks / 2);
        $init = $page - $sideLink;
        $end = $page + $sideLink;

        for ($i = $init; $i <= $end; $i++) {
            if ($i >= 1 && $i <= $totalPages) {
                array_push($this->pages, [
                    'href' => "{$route}?" . http_build_query([
                        'page' => $i
                    ]),
                    'text' => $i
                ]);
            }
        }
        
        if ($resultsTotal == 0) {
            return [
                'data' => null,
                'pagination' => ''
            ];
        }
        
        $component = new Component();
        return [
            'data' => $results,
            'pagination' => $component->pagination(
                $resultsTotal,
                $currentRecords,
                $totalPages,
                $previous,
                $next,
                $this->pages,
                $route,
                $page
            )
        ];
    }

    private function setFoundRowsInSql($sql) {
        return preg_replace('/SELECT/', 'SELECT SQL_CALC_FOUND_ROWS ', trim($sql), 1);
    }

    private function setLimitOffsetInSql($sql, $start = 0, $offset = 10) {
        return "
            {$sql}
            LIMIT {$start}, {$offset}
        ";
    }

    public function __destruct(){
        Pagination::endPaginationSession();
    }
}