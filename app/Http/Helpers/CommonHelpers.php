<?php
namespace App\Http\Helpers;

class CommonHelpers {
	/**
     * Convert price
     * @param string
     * @return int
     */
	static function convert_price($string)
	{
		return trim(str_replace(',','',$string));
	}
}