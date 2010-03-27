<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $actor = new Simukti_Models_Primary_Actor();
        $this->view->actor = $actor->fetchAll();
    }

    public function countryAction()
    {
        $country = new Simukti_Models_Primary_Country();

        $rowset = $country->fetchAll();

        $jumlahRowset = count($rowset);

        if ( $jumlahRowset > 0 ) {
            $this->view->jumlahRowset = $jumlahRowset;
        } else {
            $this->view->jumlahRowset = 'tidak ada';
        }

    }


}

