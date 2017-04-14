<?php

namespace App\Http\Helpers;

use File;

Class ImageHelper {
    public static function upload_image($file, $image, $destination) {
        //Move file to server
        $file->move($destination, $image);
    }

    public static function update_image($file, $old_image, $new_image, $destination) {
        //Move file to server
        $file->move($destination, $new_image);

        //Find old image file and delete it.
        File::delete($destination.$old_image);
    }

    public static function delete_image($old_image, $destination) {
        //Find old avatar file and delete it.
        File::delete($destination.$old_image);
    }
}