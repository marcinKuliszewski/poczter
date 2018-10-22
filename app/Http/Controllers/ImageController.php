<?php

namespace App\Http\Controllers;

use App\Logic\Image\ImageRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\Models\Image;
use App\User;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    protected $image;
    protected $user;

    public function __construct(ImageRepository $imageRepository)
    {
       $this->image = $imageRepository;
       $this->user= new User; 
    }

    public function getUpload(User $user)
    {
        dd($user);
        return view('pages.upload',compact('user'));
    }


    public function postUpload($klient)
    {
        $photo = Input::all();
        $response = $this->image->upload($photo, $klient);
        return $response;

    }

    public function deleteUpload()
    {

        $filename = Input::get('id');
        
       // dd($filename);
        if(!$filename)
        {
            return 0;
            
        }

        $response = $this->image->delete( $filename );
        return $response;
    }

      /**
     * Part 2 - Display already uploaded images in Dropzone
     */

  

    public function getServerImages()
    {
        $images = Image::get(['original_name', 'filename']);

        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'server' => $image->filename,
                'size' => File::size(public_path('images/full_size/' . $image->filename))
            ];
        }

        return response()->json([
            'images' => $imageAnswer
        ]);
    }
}
