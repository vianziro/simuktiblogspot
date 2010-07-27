<?php

class IndexController extends Zend_Controller_Action
{
    // ini cuma user scara random (videonya gak sampe 20)
    private static $_uname = 'freakstery';
    
    public function init() {}
    
    /**
    * action index untuk awalan nampilin video $_uname dengan thumbnail gambar
    */
    public function indexAction()
    {
        $youtube = new Zend_Gdata_YouTube();
        
        try {
            $lists = $youtube->getUserUploads(self::$_uname);
        }
        catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
        
        $this->view->lists = $lists;
    }
    
    /**
    * action swf untuk nampilin video $_uname swf player
    */
    public function swfAction()
    {
        $youtube = new Zend_Gdata_YouTube();
        
        try {
            $lists = $youtube->getUserUploads(self::$_uname);
        }
        catch (Exception $ex) {
            echo $ex->getMessage();
            exit;
        }
        
        
        // masih ngawur, masih belum selesai, klo dibikin gini cuma keluar 1 video :p
        // ntar aja dilanjut, ngantukkkkkkkkkkkkkkkkk
        foreach($lists as $vids) {
            $pub = new Zend_Date(
                        $vids->getPublished()->getText(),
                        Zend_Date::ISO_8601
                   );
            
            // lempar ke view script
            $this->view->videoTitle = $this->view->escape($vids->getVideoTitle());
            $this->view->published = $pub;
            $this->view->videoTags = join(', ', $vids->getVideoTags());
            $this->view->desc = $this->view->escape($vids->getVideoDescription());
            
            if($vids->isVideoEmbeddable()) {
                $this->view->url    = 'http://www.youtube.com/v/' . $vids->getVideoId(). '&fs=1';
                $this->view->width  = 320;
                $height->view->height = 240;
            }
        }
    }

}

