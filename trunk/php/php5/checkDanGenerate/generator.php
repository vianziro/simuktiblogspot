<?php
/**
 * Generator password simpel ini mengambil sha1 dari date('dmYGis')
 *
 * @filesource generator.php
 *
 * @author __siMukti
 * @copyright __siMukti - http://simukti.blogspot.com/
 * @license GPL v3
  */

require_once 'checker.php';

class generator {

    private $_pengacak;

    private $_karakter = '+=.-_#@%&(?),!^';

    private $_password = '';

    /**
    * hasil dari pengacak trus di SHA1 sebanyak 5 karakter
    * @return String
    */
    private function _buatRandom() {

        $upper = strtoupper(sha1($this->_pengacak()));
        $this->_karakter .= substr($upper, 10, 5);

        $lower = strtolower(sha1($this->_pengacak()));
        $this->_karakter .= substr($lower, 20, 5);

        return $this->_karakter;
        
    }

    /**
     * pengacak ini diambil dari tanggal + bulan + tahun + jam + menit + detik
     * @return String
     */
    private function _pengacak() {

        $dyn = date('dmYGis');
        $this->_pengacak = $dyn;
        return $this->_pengacak;

    }

    /**
     *
     * @param Integer $panjang
     * @return String
     */
    private function _password($panjang) {
        for ($i = 0; $i < $panjang; $i++) {
            $random = mt_rand(0, strlen($this->_buatRandom()) - 1);
            $this->_password .= $this->_karakter{$random};
        }
        return $this->_password;
    }

    /**
     * generate password berdasar pilihan panjang
     *
     * @param Integer $panjang
     * @return String
     */
    public function generate($panjang) {
        
        $newpass = $this->_password($panjang);
        return $newpass;
     
    }

}

?>