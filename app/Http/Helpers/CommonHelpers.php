<?php
namespace App\Http\Helpers;

class CommonHelpers {
	/*
	* Cover string to slug
	* @param $slug
	* @return object
	*/
	static function str_slug($slug)
	{
		return str_slug($slug);
	}

	/*
	* Remove ',' in string
	* @param $space
	* @return object
	*/
	static function str_replace($space)
	{
		return trim(str_replace(',','',$space));
	}
}