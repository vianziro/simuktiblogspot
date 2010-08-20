<?php
/**
 * class to create slug from title
 *
 * This source file is subject to the General Public License v3 license
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to me@simukti.net so I can send you a copy immediately.
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 * @license General Public License v3 (http://www.gnu.org/licenses/gpl-3.0.txt)
 * @filesource Titleslug.php
 * @copyright (c) 2010 - Sarjono Mukti Aji (http://simukti.net)
 */

class Titleslug
{

    /**
     * preg_replace pattern to replace
     * @var array
     */
    protected $_pattern = array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/');

    /**
     * preg_replace replacer
     * @var array
     */
    protected $_replacer = array('', '-', '');

    /**
     * filtered characters
     * @var array
     */
    protected $_filtered = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È',
                                'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ',
                                'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û',
                                'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å',
                                'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î',
                                'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù',
                                'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă',
                                'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č',
                                'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ',
                                'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ',
                                'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ',
                                'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ',
                                'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ',
                                'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń',
                                'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ',
                                'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ',
                                'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š',
                                'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ',
                                'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų',
                                'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż',
                                'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư',
                                'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ',
                                'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ',
                                'Ǽ', 'ǽ', 'Ǿ', 'ǿ');

    /**
     * filter dictionary
     * @var array
     */
    protected $_filterer = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E',
                                'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N',
                                'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U',
                                'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a',
                                'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i',
                                'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u',
                                'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a',
                                'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C',
                                'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e',
                                'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G',
                                'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h',
                                'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I',
                                'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l',
                                'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N',
                                'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O',
                                'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r',
                                'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S',
                                's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u',
                                'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U',
                                'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z',
                                'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u',
                                'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U',
                                'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a',
                                'AE', 'ae', 'O', 'o');

    /**
     * create slug from cleaned title
     * @link http://www.php.net/manual/en/function.preg-replace.php#96586
     * @param string $title
     */
    public function createSlug($title)
    {
        return strtolower(preg_replace(
                            $this->_pattern,
                            $this->_replacer,
                            $this->_cleanString($title)
                          )
                );
    }

    /**
     * replace non-standard title characters
     * @link http://www.php.net/manual/en/function.preg-replace.php#96586
     * @param string $title
     */
    protected function _cleanString($title)
    {
        return str_replace($this->_filtered, $this->_filterer, $title);
    }
}