<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initView() 
    {
    
        $view = new Zend_View();
        $view->headTitle('test test');

        $view->docType('XHTML1_STRICT');

        Zend_Layout::startMvc(
            array(
                'layoutPath' => APPLICATION_PATH . '/layouts'
            )
            );

    }

}

