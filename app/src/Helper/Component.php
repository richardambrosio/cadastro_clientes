<?php

namespace App\Helper;

use App\Page;

class Component extends Page {
    public function __construct($opts = array('template' => false), $tpl_dir = DS . 'views'. DS .'component'. DS) {
        parent::__construct($opts, $tpl_dir);
    }

    public function alert($text, $color = 'primary') {
        $data = [
            'text' => $text,
            'color' => $color
        ];
        
        return $this->setTpl('alert', $data);
    }

    public function pagination($totalRecords, $currentRecords, $totalPages, $previous, $next, $links, $route, $currentPage) {
        return $this->setTpl('pagination', [
            'totalRecords' => $totalRecords,
            'currentRecords' => $currentRecords,
            'totalPages' => $totalPages,
            'previous' => $previous,
            'next' => $next,
            'links' => $links,
            'route' => $route,
            'currentPage' => $currentPage
        ], true);
    }
}