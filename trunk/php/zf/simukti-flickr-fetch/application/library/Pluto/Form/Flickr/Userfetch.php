<?php

class Pluto_Form_Flickr_Userfetch extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        
        // seperti di manual zf
        $this->addElement('text', 'email', array(
            'label'      => 'Alamat Email:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
            )
        ));
        
        $this->addElement('submit', 'submit', array(
            'ignore'    => true,
            'label'     => 'Tampilkan',
        ));
        
        $this->addElement('hash', 'crsh', array(
            'ignore'    => true,
        ));
    }
}

?>