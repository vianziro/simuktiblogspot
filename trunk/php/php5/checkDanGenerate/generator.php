<?php
/**
 * @filesource generator.php
 *
 * @author __siMukti
 * @copyright __siMukti - http://simukti.blogspot.com/
 * @license GPL v3
  */

class generator {

    private $_pengacak;

    /**
    * @param Integer $panjang - panjang karakter yang diinginkan dari hasil hash SHA1
    */
    private function tesBuatPassword($panjang) {

        $test = sha1($this->pengacak());
        // pengacak diambil sebanyak $panjang karakter dari urutan ke 5
        $hasil = substr($test, 5, $panjang);
        return $hasil;
        
    }

    /**
     * buat password yang isinya huruf saja
     */
    private function _buatHuruf() {}

    /**
     * buat password yang isinya angka dan huruf
     */
    private function _buatAngkaHuruf() {}

    /**
     * buat password yang isinya angka huruf karakter
     */
    private function _buatAngkaHurufKarakter() {}

    /**
     * pengacak ini diambil dari tanggal + bulan + tahun + jam + menit + detik
     */
    private function pengacak() {

        $dyn = date('dmYGis');
        $this->_pengacak = $dyn;
        return $this->_pengacak;

    }

    /**
     * generate password berdasar pilihan panjang, tipe, dan gabungan hash sha1 remote address dan referrer
     *
     * @param Integer $panjang - default == 6
     * @param String $tipe - 'huruf' || 'angkahuruf' || 'angkahurufkarakter'
     */
    public function generate($panjang = 6, $tipe = 'angkahuruf') { }

    /**
     *
     * @param Integer $panjang - panjang password yang diinginkan
     * @return String
     */
    public function test($panjang) {

        return $this->tesBuatPassword($panjang);

    }

}

?>