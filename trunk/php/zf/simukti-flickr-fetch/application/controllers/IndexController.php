<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }
    
    /**
    * tampilkan form di index
    */
    public function indexAction()
    {
        $fetchForm = new Pluto_Form_Flickr_Userfetch();
        $this->view->fetchForm = $fetchForm;
        
        $request = $this->getRequest();
        if($this->getRequest()->isPost())
        {
            if($fetchForm->isValid($request->getPost()))
            {
                $email = $fetchForm->getValue('email');
                
                $apikey = Zend_Registry::get('config')->flickr->apikey;
                
                $flickr = new Zend_Service_Flickr($apikey);
                
                /**
                * @TODO nyari cara klo ada error : username not found
                */
                $hasil = $flickr->userSearch($email);
                
                $this->view->hasilFetch = $hasil;
            }
        }
    }
    
}

