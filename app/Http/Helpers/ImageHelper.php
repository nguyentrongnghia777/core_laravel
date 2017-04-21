<?php

namespace App\Http\Helpers;

use File;
use App\Http\Helpers\ConvertStringHelper;

Class ImageHelper {
    /**
     * upload image
     * @param file
     * @param image name
     * @param destination
     * @return boolean
     */
    public static function upload_image($file, $image_name, $destination) {
        //Move file to server
        $file->move($destination, $image_name);
    }

    /**
     * update image
     * @param file
     * @param old image name
     * @param new image name
     * @param destination
     * @return boolean
     */
    public static function update_image($file, $old_image_url, $new_image_name, $destination) {
        //Move file to server
        $file->move($destination, $new_image_name);
        //Find old image file and delete it.
        self::delete_image($old_image_url);
    }

    /**
     * delete image
     * @param old image name
     * @param destination
     * @return boolean
     */
    public static function delete_image($image_url) {
        $image_url = public_path().str_replace(url('/'), "", $image_url);
        //Find old image file and delete it.
        File::delete($image_url);
    }

    /**
     * Convert Image name to store to db
     * @param string
     * @return string
     */
    public static function convert_image_name($image, $destination) {
        $filename = pathinfo($image, PATHINFO_FILENAME);
        $extension = ".".pathinfo($image, PATHINFO_EXTENSION);
        $image_url = ConvertStringHelper::convert_vn_to_str($filename)."_".time();
        $image_url = url('/').$destination.$image_url.$extension;
        return $image_url;
    }
}