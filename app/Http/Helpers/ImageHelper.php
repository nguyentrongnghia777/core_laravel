<?php

namespace App\Http\Helpers;

use File;
use App\Http\Helpers\ConvertStringHelper;

Class ImageHelper {
    /**
     * upload image
     * @param file
     * @param image_name
     * @param string destination (ex: /uploads/blog/)
     * @return boolean
     */
    public static function upload_image($file, $image_name, $destination) {
        //Move file to server
        $file->move(public_path() . $destination, $image_name);

    }

    /**
     * delete image
     * @param string image_url
     * @return boolean
     */
    public static function delete_image($image_url) {
        //Find old image file and delete it.
        File::delete(public_path() . $image_url);
    }

    /**
     * Convert Image name to store to db
     * @param string image_name
     * @return string
     */
    public static function convert_image_name($image_name) {
        $filename = pathinfo($image_name, PATHINFO_FILENAME);
        $extension = "." . pathinfo($image_name, PATHINFO_EXTENSION);
        $image_name = ConvertStringHelper::convert_vn_to_str($filename) . "_" . time() . $extension;
        return $image_name;
    }
}