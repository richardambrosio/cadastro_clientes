<?php

namespace App;

use Rain\Tpl;

class Page {

    private $tpl;
    private $options = [];
    private $defaults = [
        "template" => true,
        "template_default" => 'template'. DS .'template',
        "data" => []
    ];

    public function __construct($opts = array(), $tpl_dir = DS . 'views' . DS) {
        $this->options = array_merge($this->defaults, $opts);

        $config = array(
            "tpl_dir" => $_SERVER['DOCUMENT_ROOT'] . $tpl_dir,
            "cache_dir" => $_SERVER['DOCUMENT_ROOT'] . DS . 'views-cache' . DS,
            "debug" => false
        );

        Tpl::configure($config);

        $this->tpl = new Tpl;
    }

    public function setTpl($name, $data = ['title' => 'Cadastro de Clientes'], $returnHTML = true) {
        $this->setData($data);

        if ($this->options['template']) {
            $html = $this->tpl->draw($name, $data, true);
            $this->tpl->assign('content', $html);

            return $this->tpl->draw($this->options['template_default'], $returnHTML);
        } else {
            return $this->tpl->draw($name, $returnHTML);
        }
    }

    private function setData($data = array()) {
        $v = [];
        foreach($data as $key => $value) $this->tpl->assign($key, $value);
    }
}