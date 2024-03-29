<?php

namespace Reporter\Helper;

/**
 * Class ColorHelper
 */
class ColorHelper
{
    public static $rgxHexColor = '/#([a-f]|[A-F]|[0-9]){6}\b/';
    /**
     * @param $hex
     * @return array
     */
    public static function hex2rgb($hex) {

        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        return ['r' => $r, 'g' => $g, 'b' => $b];
    }
}