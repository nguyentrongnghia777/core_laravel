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
	* Remove tag <p>
	* @param $description
	* @return object
	*/
	static function strip_tags($description)
	{
		return strip_tags($description,'p');
	}
}