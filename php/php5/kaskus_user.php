<?php
/**
* class instan untuk ngambil informasi user dari kaskus.us berdasar UID
* baca remote html pake fopen(), fgets() dan pencarian pake preg_match_all()
* semoga bisa sebagai masukan
*
* @copyright	Copyright (c) 2010 jahong (http://www.kaskus.us/member.php?u=121806)
* @license		http://www.gnu.org/licenses/gpl-3.0.txt GNU GENERAL PUBLIC LICENSE Version 3
* @example      http://www.kaskus.us/member.php?u=3
*/
class kusUser
{
    /**
    * link profil publik kaskus.us
    */
    const URL       = 'http://www.kaskus.us/member.php?u=';
    
    /**
    * error constant ?? :)
    */
    const ERRORUIDNOTVALID    = 'UID harus > 0 atau != 0';
    
    /**
    * tag title
    */
    const TITLESTART    = '<title>Kaskus - The Largest Indonesian Community - View Profile:';
    const TITLEEND      = '<\/title>';
    
    /**
    * tag join
    */
    const JOINSTART     = '<dt class=\"shade\">Join Date<\/dt><dd>';
    const JOINEND       = '<\/dd><dt class=\"shade\">Total Posts<\/dt>';
    
    /**
    * tag total post
    */
    const TOTALSTART    = '<dt class=\"shade\">Total Posts<\/dt><dd>';
    const TOTALEND      = '<\/dd><dt class=\"shade\">Blog Entries<\/dt>';
    
    /**
    * uid int
    */
    protected $_uid = 0;
    
    /**
    * string
    */ 
    protected $_userLink;
    
    /**
    * array hasil return fetchAction()
    */
    protected $_hasil;
    
    /**
    * saya butuh __construct() untuk set uid dan full link
    * @params integer
    */
    public function __construct($uid)
    {
        $this->_uid = (int)$uid;
        $this->_userLink = self::URL . $this->_uid;
    }
    
    /**
    * fetch data
    * @return array
    */
    public function fetchAction()
    {
        if($this->_uid != 0 && $this->_uid > 0)
        {
            /**
            * saya disini pake fopen();
            */
            $fetcher = fopen($this->_userLink, 'r');
            
            /**
            * @TODO error handling untuk masalah koneksi bisa ditaruh sini
            * butuh kan ?? :p
            */
            
            /**
            * sedooooooooooooooottttttttttttttttttttttttttttttttttttt :)
            */
            while (!feof($fetcher)) 
            {
                $buffer = trim(fgets($fetcher, 4096));
                $contents .= $buffer;
            }
            
            /**
            * Untuk ngambil username
            */
            preg_match_all('/'. self::TITLESTART . '(.*)' . self::TITLEEND . '/s'
                            , $contents
                            , $username
                           );
            
            /**
            * untuk ngambil Join Date
            */
            preg_match_all('/' . self::JOINSTART . '(.*)' . self::JOINEND . '/s'
                            , $contents
                            , $joindate
                           );
            
            /**
            * untuk ngambil Total Posts
            */
            preg_match_all('/' . self::TOTALSTART . '(.*)' . self::TOTALEND . '/s'
                            , $contents
                            , $total
                           );
            
            
            /**
            * @TODO terserah mau ambil apa aja dari halaman ini, 
            *       tapi disini saya cuma ngambil uname, joindate, totalposts
            */
            
            /**
            * kumpulkan dan simpan di array $this->_hasil;
            */
            $this->_hasil['username']     = $username[1];
            $this->_hasil['joindate']     = $joindate[1];
            $this->_hasil['totalposts']   = $total[1];
            
            return $this->_hasil;
            
        }
        else {
            /*
            * @TODO sepertinya error handling ini masih perlu diperbaiki x_X
            */
            return self::ERRORUIDNOTVALID;
        }
    }
    
}


$kas = new kusUser(3); // ini cuma random aja kok...
print_r($kas->fetchAction());
/**
* silahkan mainan dengan script singkat ini
* :beer:
*/
/*
Array
(
    [username] => Array
        (
            [0] =>  admin
        )

    [joindate] => Array
        (
            [0] => 20-12-2001
        )

    [totalposts] => Array
        (
            [0] => 24,114
        )

)
*/
?>