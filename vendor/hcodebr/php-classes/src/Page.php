<?php

namespace Hcode;

use Rain\Tpl;

class Page{
    private $tpl;
    private $options = [];
    private $defaults = [
        "header"=>true,
        "footer"=>true,
        "data"=>[]
    ];
    //Primeiro método a ser executado
    public function __construct($opts = array(),$tpl_dir = "/keven/ecommerce/views/"){

        $this->options = array_merge($this->defaults,$opts);

        $config = array(
            //$_SERVER["DOCUMENT_ROOT"] - Pasta do diretório root
            "tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
            "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."keven/ecommerce/views-cache/",
            "debug"         => false
           );
        Tpl::configure( $config );
    
        $this->tpl = new Tpl;
           
        $this->setData($this->options["data"]);

        if($this->options["header"]==true) $this->tpl->draw("header");

    }

    private function setData($data = array()){
        foreach($data as $key =>$value){
            //assign - atribuir o valor em uma váriavel
            $this->tpl->assign($key,$value);
        }
    }

    public function setTpl($name, $data = array(),$retunrHTML = false)
    {
        $this->setData($data);
        return $this->tpl->draw($name, $retunrHTML);
    }

    //último a ser executado
    public function __destruct(){
        if($this->options["footer"]==true) $this->tpl->draw("footer");
    }
}


?>