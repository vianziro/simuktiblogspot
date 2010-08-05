<?php
class Neptunus_View_Helper_Metagenerator extends Zend_Controller_Plugin_Abstract
{
    /**
    * kenapa saya pake preDispatch ???
    * @link http://framework.zend.com/manual/en/zend.controller.plugins.html
    */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        // default view helper
        $viewRender = Zend_Controller_Action_HelperBroker::getExistingHelper('ViewRenderer');
        
        $viewRender->initView();
        
        $view = $viewRender->view;
        
        $view->headTitle(Zend_Registry::get('config')->site->meta->title);
                        
        $view->headMeta()->appendName('author',
                                        Zend_Registry::get('config')->site->meta->author
                                      );
        $view->headMeta()->appendName('google-site-verification',
                                        Zend_Registry::get('config')->site->meta->googleid
                                      );
        $view->headMeta()->appendName('y_key',
                                        Zend_Registry::get('config')->site->meta->yahookey
                                      );
        $view->headMeta()->appendName('alexaVerifyID',
                                        Zend_Registry::get('config')->site->meta->alexaid
                                      );
        $view->headMeta()->appendName('generator',
                                        Zend_Registry::get('config')->site->meta->generator
                                      );
    }

}

?>