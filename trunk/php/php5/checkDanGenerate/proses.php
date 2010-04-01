<?php
/**
 * @filesource proses.php
 *
 * @author __siMukti
 * @copyright __siMukti - http://simukti.blogspot.com/
 * @license GPL v3
  */

require_once 'checker.php';
require_once 'generator.php';

$cek = $_GET['password'];

$cekPass = new checker();


if(empty($cek)){
    $abc = new generator();
    $bcd = $abc->generate(6);
    echo "<div style=\"background: #EEE;\">Password : {$bcd} <br />";
    echo "Skor : {$cekPass->cekPassword($bcd)}</div>";
} else {
    echo "<div style=\"background: #EEE;\">Password : {$cek} <br />";
    echo "Skor : {$cekPass->cekPassword($cek)}</div>";
}

?>
