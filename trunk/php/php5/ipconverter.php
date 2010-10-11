<?php
/**
 * Class untuk mengkonversi ipaddress
 * tiap form dari user mengambil ip address mereka
 * dan di encrypt, masukkan hidden form value, lalu dimasukkkan DB
 * jika ingin ditampilkan di admin area, di decrypt dulu
 * NOTE : bukan untuk client yang melewati proxy
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */

class IpConverter
{
    
    /**
    * class instance
    */
    private static $_instance;
    
    /**
    * Array $_realvalue
    */
    protected $_realvalue = array('.', '1' ,'2' ,'3' ,'4' ,'5' ,'6' ,'7' ,'8' ,'9' ,'0');
    
    /**
    * Array $_replacer
    */
    protected $_replacer = array('sy', 'ao' ,'bp' ,'cq' ,'dr' ,'es' ,'ft' ,'gu' ,'hv' ,'iw' ,'jx');

    /**
    * avoid object instantiation via constructor
    */
    final private function __construct() {}
    
    /**
    * avoid __clone()
    */
    final private function __clone() {}
    
    /**
    * class instantiation (singleton)
    */
    public static function makeip()
    {
        if(!isset(self::$_instance)) {
            $ipconverter = __CLASS__;
            self::$_instance = new $ipconverter;
        }
        
        return self::$_instance;
    }
    
    /**
    * encrypt notation of ip address with replacer
    * @return String
    */
    public function encrip()
    {
        //'HTTP_CLIENT_IP', 
        //'HTTP_X_FORWARDED_FOR', 
        //'HTTP_X_FORWARDED', 
        //'HTTP_X_CLUSTER_CLIENT_IP', 
        //'HTTP_FORWARDED_FOR', 
        //'HTTP_FORWARDED', 
        //'REMOTE_ADDR'
        
        $clientIP = $_SERVER['REMOTE_ADDR'];
        return str_replace($this->_realvalue, $this->_replacer, $clientIP);
        
    }
    
    /**
    * decrypt ip address from encypted notation
    * @return String
    */
    public function decrip($value)
    {
        return str_replace($this->_replacer, $this->_realvalue, $value);
    }

}

// ini yang tertampil di halaman admin
// $ip = '127.0.0.1';

// ini yang tersimpan di database, contoh : 127.0.0.1
$ipvaluedaridatabase = 'aobpgusyjxsyjxsyao';

echo 'Ini IP client yang di hidden form value : ' . IpConverter::makeip()->encrip();
echo '<br />';
echo 'Ini IP client yang di admin page : ' . IpConverter::makeip()->decrip($ipvaluedaridatabase);
echo '<br />';
