<?php
/**
* Contoh class untuk mencari nilai maximum dan minimum di dalam array
* @since 22-06-2010
* @author simukti <me@simukti.net>
* @license http://www.gnu.org/licenses/gpl-3.0.txt
*/
class reform
{
    public function cariVertical($data)
    {
        foreach($data as $vert) {
            foreach($vert as $key => $val) {
                if(!isset($maxi[$key]) || $val > $maxi[$key]) {
                    $maxi[$key] = $val;
                }
                if(!isset($mini[$key]) || $val < $mini[$key]) {
                    $mini[$key] = $val;
                }
            }
        }
        $output['maxv'] = $maxi;
        $output['minv'] = $mini;
        return json_encode($output);
    }
    
    public function cariHorizontal($data)
    {
        foreach($data as $hori => $zon) {
            $maxi[$hori] = max($zon);
            $mini[$hori] = min($zon);
        }
        $output['maxh'] = $maxi;
        $output['minh'] = $mini;
        return json_encode($output);
    }
    
    public function cariPerValue($data)
    {
        $explorer = new RecursiveArrayIterator($data);
        $iterator = new RecursiveIteratorIterator($explorer);
        foreach($iterator as $k => $v) {
            $gabungan[] = $v;
        }
        
        $output['maxval'] = max($gabungan);
        $output['minval'] = min($gabungan);
        
        return json_encode($output);
    }
}

// tes
$data = array(
            array(4, 6, 7, 2, 0),
            array(3, 5, 5, 2, 1),
            array(6, 2, 4, 8, 3),
            array(2, 4, 1, 3, 5),
            array(4, 5, 2, 8, 9),
            array(7, 3, 5, 9, 1)
);

$smiths = new reform();
$simukti = $smiths->cariVertical($data);
$blog = $smiths->cariHorizontal($data);
$spot = $smiths->cariPerValue($data);

print_r($simukti);
echo '<br />';
print_r($blog);
echo '<br />';
print_r($spot);
?>