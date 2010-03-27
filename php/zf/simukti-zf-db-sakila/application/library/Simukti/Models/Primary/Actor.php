<?php
/**
 * Actor.php merupakan kode contoh dari http://simukti.blogspot.com/
 *
 * @author __siMukti
 * @copyright __siMukti - http://simukti.blogspot.com/
 * @license GPL v3
  */

class Simukti_Models_Primary_Actor extends Zend_Db_Table_Abstract {

    /**
     * nama variabel adalah nama table, secara default
     * @var String
     */
    protected $_name = 'actor';

    public function getActor($actorId) {
        
        $actorId = (int) $actorId;
        $baris = $this->fetchRow('actor_id = ' . $actorId);

        if(!$baris) {
            throw new Exception("$actorId tidak dapat ditemukan");
        }

        return $baris->toArray();

    }

}
?>
