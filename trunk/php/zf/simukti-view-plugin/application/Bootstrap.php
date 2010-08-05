<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
    * untuk ngambil semua kunci konfigurasi agar bisa dpanggil dari keseluruhan app
    */
    protected function _initConfig()
    {
        Zend_Registry::set('config', new Zend_Config($this->getOptions()));
    }
    
    /**
    * set doc type dari bootstrap
    */
    protected function _initDoctype()
    {
        $type = new Zend_View_Helper_Doctype();
        $type->doctype('HTML5');
    }
    
    /**
    * kita daftarkan plugin meta generator tadi
    */
    protected function _initMeta()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Neptunus_View_Helper_Metagenerator());
    }

}

