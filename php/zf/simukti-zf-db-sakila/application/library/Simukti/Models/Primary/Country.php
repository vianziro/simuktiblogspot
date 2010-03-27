<?php
/**
 * Country.php merupakan kode contoh dari http://simukti.blogspot.com/
 *
 * @author __siMukti
 * @copyright __siMukti - http://simukti.blogspot.com/
 * @license GPL v3
  */

class Simukti_Models_Primary_Country extends Zend_Db_Table_Abstract {

    protected $_name = 'country';

    public function getCountry($countryId) {

        $countryId = (int) $countryId;
        
    }

}
?>
