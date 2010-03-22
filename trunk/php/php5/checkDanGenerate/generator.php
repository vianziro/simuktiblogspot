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

class generator {

    private $_pengacak;

    private $_karakterSpesial = '+=.-_#@%&(?),!';

    private $_password = '';

    /**
    * hasil dari pengacak trus di SHA1 sebanyak 10 karakter
    */
    private function _buatRandom() {

        $upper = strtoupper(sha1($this->_pengacak()));
        $this->_karakterSpesial .= substr($upper, 10, 5);

        $lower = strtolower(sha1($this->_pengacak()));
        $this->_karakterSpesial .= substr($lower, 20, 5);

        return $this->_karakterSpesial;
        
    }

    /**
     * pengacak ini diambil dari tanggal + bulan + tahun + jam + menit + detik
     */
    private function _pengacak() {

        $dyn = date('dmYGis');
        $this->_pengacak = $dyn;
        return $this->_pengacak;

    }

    /**
     * generate password berdasar pilihan panjang
     *
     * @param Integer $panjang
     */
    public function generate($panjang) {
        for ($i = 0; $i < $panjang; $i++) {
            $random = mt_rand(0, strlen($this->_buatRandom()) - 1);
            $this->_password .= $this->_karakterSpesial{$random};
        }
        
        return $this->_password;
    }

}

?>