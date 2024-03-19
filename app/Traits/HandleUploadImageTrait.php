<?php

namespace App\Traits;

use Intervention\Image\Laravel\Facades\Image;

trait HandleUploadImageTrait
{

    protected $path = 'upload/users/';
    public function veryfy($request)
    {
        return $request->has('image');
    }

    public function saveImage($request)
    {
        $image = $request->file('image');
        $name = $image->getClientOriginalName();
        Image::read($image)->resize(300, 300)->save($this->path . $name);
        return $name;
    }

    public function updateImage($request, $currentImage)
    {
        if ($this->veryfy($request)) {
            // $this->deleteImage($currentImage);
            return $this->saveImage($request);
        }
        return $currentImage;
    }

    public function deleteImage($imageName)
    {
        if (file_exists($this->path . $imageName)) {
            unlink($this->path . $imageName);
        }
        return true;
    }

}