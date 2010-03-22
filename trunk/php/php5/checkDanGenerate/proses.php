<?php
/**
 *@filesource proses.php
 *
 * @author __siMukti
 * @copyright __siMukti - http://simukti.blogspot.com/
 * @license GPL v3
  */

include_once 'checker.php';
include_once 'generator.php';

$abc = new generator();
$bcd = $abc->generate(6);
echo $bcd;

echo '<br />';

$test = new checker();
echo $test->cekPassword($bcd);

?>
