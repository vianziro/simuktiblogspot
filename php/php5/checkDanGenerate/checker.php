<?php
/**
 * @filesource checker.php
 *
 * @author __siMukti
 * @copyright __siMukti - http://simukti.blogspot.com/
 * @license GPL v3
  */

class checker {

    private $_skor = 0;

    private $_patterns = array('#[a-z]#','#[A-Z]#','#[0-9]#','/[¬!"£$%^&*()`{}\[\]:@~;\'#<>?,.\/\\-=_+\|]/');

    /**
     * konstruktor dikosongkan
     */
    public function  __construct() {}

    /**
     * nilai output = 1 / 2 / 3 / 4
     * 1 = huruf saja atau angka saja
     * 2 = huruf dan angka (lowercase)
     * 3 = huruf + angka + uppercase saja / lowercase saja
     * 4 = huruf + angka + karakter spesial + uppercase + lowercase
     * @param String $password - password yang akan dicheck
     */
    public function cekPassword($password) {

        foreach($this->_patterns as $pattern) {
            if (preg_match($pattern, $password, $matches)) {
                $this->_skor++;
            }
        }
        return $this->_skor;

    }

}
?>
