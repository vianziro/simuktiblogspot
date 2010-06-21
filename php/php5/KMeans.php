<?php
/**
* Class untuk implementasi k-Means Clustering di PHP
* @since 22-06-2010
* @author simukti <me@simukti.net>
* @license http://www.gnu.org/licenses/gpl-3.0.txt
*/
class Simukti_Model_Learning_KMeans
{
    /**
    * hasil kmeans clustering disimpan di variabel ini sebagai array
    * array $_hasil
    */
    private $_hasil;
    
    // gak usah pake __construct
    public function __construct(){}
    
    /**
    * Satu-satunya fungsi public dari class Simukti_Model_Learning_KMeans
    * @param array $data
    * @param integer $k <jumlah cluster yang diinginkan>
    */
    public function proses($data, $k)
    {
        // cek dulu tipe data dari inputan
        if(!is_array($data) || !is_int($k)) {
            return '$data harus array dan $k harus integer';
            die(); // matikan segera proses-nya :)
        }
        return self::_prosesKMeans($data, (int)$k);
    }
    
    /**
    * Proses utama untuk proses k-Means clustering
    * @param array $data
    * @param integer $k
    * @return array $this->_hasil dari fungsi self::_output()
    */
    private function _prosesKMeans($data, $k)
    {
        $centroid = self::_inisialisasi($data, $k);
        while(true) {
            $jarakBaru = self::_tandaiCentroid($data, $centroid);
            $berubah = false;
            foreach($jarakBaru as $kunci => $nilai) {
                if(!isset($arrayjarak[$kunci]) || $nilai != $arrayjarak[$kunci]) {
                    $arrayjarak = $jarakBaru;
                    $berubah = true;
                    break;
                }
            }
            if(!$berubah){
                // klo uda gak berubah, keluarkan hasilnya
                return self::_output($arrayjarak, $data, $centroid);
            }
            $centroid = self::_updateCentroid($arrayjarak, $data, $k);
        }
    }
    
    /**
    * Buat centroid berdasar parameter dimensi yang diinginkan, nilai random minimum, nilai random maximum
    * @param integer $dimensi
    * @param array $mini
    * @param array $maxi
    * @return array $centroid
    */
    private function _buatCentroid($dimensi, $mini, $maxi) 
    {
        $total = 0;
        for($i = 0; $i < $dimensi; $i++) {
            // pake mt_rand() karena lebih baik dari rand()
            // @link http://php.net/manual/en/function.mt-rand.php
            // dikalikan dengan 10 cuma untuk memudahkan pembagian di self::_normalisasi()
            $centroid[$i] = (mt_rand($mini[$i] * 10, $maxi[$i] * 10));
            $total += $centroid[$i] * $centroid[$i];
        }
        return self::_normalisasi($centroid, sqrt($total));
    }
    
    /**
    * Normalisasikan nilai centroid
    * @param array $centroid
    * @param integer $total
    * @return array centroid <yang sudah dinormalisasi>
    */
    private function _normalisasi($centroid, $total)
    {
        /** 
        * Rubah nilai centroid
        * @link http://php.net/manual/en/control-structures.foreach.php
        */
        foreach($centroid as &$val){
            $val = $val/$total;
        }
        return $centroid;
    }
    
    /**
    * Inisialisasi sebaran centroid berdasar nilai terendah dan tertinggi di tiap lajur data x,y,a,b,c
    * Contoh :
    * <code>
    * <?php
    * array(     //x  y  a  b  c
    *        array(4, 6, 7, 2, 1),
    *        array(3, 5, 5, 2, 1),
    *        array(6, 2, 4, 8, 2));
    * // tertinggi -> (6, 6, 7, 8, 2)
    * ?>
    * </code>
    * @param array $data
    * @param integer $k
    * @return array $centroid
    */
    private function _inisialisasi($data, $k)
    {
        $dimensi = count($data[0]);
        // ambil nilai tertinggi dan terendah dari input data lajur x, y, z
        foreach($data as $lajur) {
            foreach($lajur as $key => $val) {
                if(!isset($maxi[$key]) || $val > $maxi[$key]) {
                    $maxi[$key] = $val;
                }
                if(!isset($mini[$key]) || $val < $mini[$key]) {
                    $mini[$key] = $val;
                }
            }
        }
        for($i=0; $i < $k; $i++) {
            // buat random centroid awal sejumlah $_k;
            $centroid[$i] = self::_buatCentroid($dimensi, $mini, $maxi);
        }
        return $centroid;
    }
    
    /**
    * Hitung jarak data ke centroid
    * @param array $data
    * @param array $centroid
    * @return array $arrayjarak
    */
    private function _tandaiCentroid($data, $centroid)
    {
        foreach($data as $key => $val) {
            $jarakMinimum = 100;
            $centroidMinimum = null;
            foreach($centroid as $kunci => $nilai) {
                $jarak = 0;
                foreach($nilai as $vlib => $kids) {
                    $jarak += abs($kids - $val[$vlib]);
                }
                if($jarak < $jarakMinimum) {
                    $jarakMinimum = $jarak;
                    $centroidMinimum = $kunci;
                }
            }
            $arrayjarak[$key] = $centroidMinimum;
        }
        return $arrayjarak;
    }
    
    /**
    * Update centroid jika jarak-nya tidak sama dengan sebelumnya
    * @param array $arrayjarak
    * @param array $data
    * @param integer $k
    * @return array $jarak
    */
    private function _updateCentroid($arrayjarak, $data, $k) 
    {
        $jumlah = array_count_values($arrayjarak);
        foreach($arrayjarak as $key => $val) {
            foreach($data[$key] as $kunci => $nilai){
                $jarak[$val][$kunci] += ($nilai/$jumlah[$val]);
            }
        }
        if(count($jarak) < $k) {
            $jarak = array_merge($jarak, self::_inisialisasi($data, $k - count($jarak)));
        }
        
        return $jarak;
    }
    
    /**
    * Fungsi untuk memformat hasil clustering
    * @param array $arrayjarrak
    * @param array $data
    * @param array $centroid
    * @return array $this->_hasil
    */
    private function _output($arrayjarak, $data, $centroid) 
    {
        $this->_hasil['centroid'] = $centroid;
        foreach($arrayjarak as $kunci => $nilai) {
            $this->_hasil[$nilai][] = implode(', ', $data[$kunci]);
        }
        return $this->_hasil;
    }
}

// ------------------------------------------------------------------------------------------
// kita coba class Simukti_Model_Learning_KMeans
// Uncomment baris dibawah ini untuk mencoba class Simukti_Model_Learning_KMeans
//
//$datacontoh = array(
//                    array(0.05, 0.95, 1),
//                    array(0.1, 0.9, 2),
//                    array(0.2, 0.8, 1),
//                    array(0.25, 0.75, 3),
//                    array(0.45, 0.55, 3),
//                    array(0.5, 0.5, 2),
///                    array(0.55, 0.45, 1), 
//                    array(0.85, 0.15, 2),
//                    array(0.9, 0.1, 1),
//                    array(0.95, 0.05, 1)
//              );

//$simukti = new Simukti_Model_Learning_KMeans();
//$smiths = $simukti->proses($datacontoh, 4);

//var_dump($smiths);

?>