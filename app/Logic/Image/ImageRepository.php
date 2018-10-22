<?php

namespace App\Logic\Image;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Models\Image;
use Illuminate\Http\Request;
use App\UserData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ImageRepository
{
    public function upload($form_data, $klient )
    {
        $klient_patch_row=UserData::where('user_id',$klient)->first();
        $klient_patch='docum/'.$klient_patch_row['direct_patch'];
        $validator = Validator::make($form_data, Image::$rules, Image::$messages);
        if ($validator->fails()) 
        {
            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);
        }

        $photo = $form_data['file'];
        $originalName = $photo->getClientOriginalName();
        $extension = $photo->getClientOriginalExtension();
        $originalNameWithoutExt = substr($originalName, 0, strlen($originalName) - strlen($extension) - 1);
        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename( $filename, $extension, $klient_patch );
        $uploadSuccess1 = $this->original( $photo, $allowed_filename,$klient_patch);

        if( !$uploadSuccess1 ) 
        {
            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);
        }
        $sessionImage = new Image;
        $sessionImage->filename      = $allowed_filename;
        $sessionImage->original_name = $originalName;
        $sessionImage->klient_id = $klient;
        $sessionImage->operator = Auth::user()->name;
        $sessionImage->docum_stan = 'dodany';
        $sessionImage->save();

        return Response::json([
            'error' => false,
            'code'  => 200,
            'filename' => $allowed_filename
        ], 200);

    }

    public function createUniqueFilename( $filename, $extension)
    {
        $datefil=date('Ymd');
        $imageToken = substr(sha1(mt_rand()), 0, 5);
        return $filename.'-'. $datefil. '-' . $imageToken . '.' . $extension;
      
    }

    /**
     * Optimize Original Image
     */
    public function original( $photo, $filename, $klient_patch )
    {
        $image =  Storage::putFileAs($klient_patch, $photo, $filename);
        return $image;
    }

  
    public function delete( $filename, $klient )
    {
        $full_size_dir = 'docume/'.$klient.'/';
        $sessionImage = Image::where('filename', 'like', $filename)->first();
        if(empty($sessionImage))
        {
            return Response::json([
                'error' => true,
                'code'  => 400
            ], 400);

        }

        $full_path1 = $full_size_dir . $sessionImage->filename;

        if ( File::exists( $full_path1 ) )
        {
            File::delete( $full_path1 );
        }

        if( !empty($sessionImage))
        {
            $sessionImage->delete();
        }

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);
    }

    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}