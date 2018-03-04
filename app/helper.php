<?php

namespace App;
/*
 * This model for all user define functions that we used in this project
 *
 * */
use Illuminate\Database\Eloquent\Model;
use Image;

class helper extends Model
{
    /* To resoze image and store it , return image name after operations.
     * args : image->input image file
     *        dest->upload image with original size and setting
     *        thumbnail-> store image after resize
     */
    public static function storeImage($image , $dest,$thumbnail ){
        $input['imageName'] =rand(10, 100000) . time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path($thumbnail);
        $thumb_img = Image::make($image->getRealPath())->resize(300,200);
        $thumb_img->save($destinationPath . '/' . $input['imageName']);
        $destinationPath = public_path($dest);
        $image->move($destinationPath, $input['imageName']);
        return $input['imageName'];

    }

    public static function storeTrailers($trailer , $dest )
    {
        $input['trialName'] = rand(10, 100000) . time() . '.' . $trailer->getClientOriginalExtension();
        $destinationPath = public_path($dest);
        $trailer->move($destinationPath, $input['trialName']);
        return $input['trialName'];
    }
}
