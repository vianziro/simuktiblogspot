<?php
/**
* Mencari nilai max/min didalam array, cari per value, bukan per key seperti max() atau min()
* menggunakan SPL RecursiveIteratorIterator dan ArrayRecursiveIterator
* @author simukti <me@simukti.net>
*/ 
$datasatu = array(
                array(4, 6, 7, 2, 0),
                array(3, 5, 5, 2, 1),
                array(6, 2, 4, 8, 3),
                array(2, 4, 1, 3, 5),
                array(4, 5, 2, 8, 9),
                array(7, 3, 5, 9, 1)
        );
        
$datadua = array(
                array(4, 6, 8, 2, 1),
                array(2, 5, 5, 2, 1),
                array(6, 2, 4, 8, 3),
                array(2, 4, 3, 3, 5),
                array(4, 5 ,2, 8, 9),
                array(7, 3, 4, 9, 10)
        );

$iteratorsatu = new RecursiveIteratorIterator(new RecursiveArrayIterator($datasatu));
$iteratordua = new RecursiveIteratorIterator(new RecursiveArrayIterator($datadua));

$arrmerge = array();
foreach($iteratorsatu as $key => $val) {
    $arrmerge[] = $val;
}

foreach($iteratordua as $key => $val) {
    $arrmerge[] += $val;
}

echo 'Minimum : ' . min($arrmerge) . '<br />';
echo 'Maximum : ' . max($arrmerge);

?>