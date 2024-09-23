<?php

namespace App\Http\Service;

use Intervention\Image\Laravel\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class UserProfileService
{
    public function saveImageProfile(UploadedFile $photo, $nama)
    {
        $fileName = str_slug($nama).'-'.date('YmdHis').'.'.$photo->guessClientExtension();
        $destinationPath = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'userprofile';
        Image::read($photo)->scale(400, 400)->save($destinationPath.DIRECTORY_SEPARATOR.$fileName);

        return $fileName;
    }

    public function deleteImageProfile($filename)
    {
        $path = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'userprofile'.DIRECTORY_SEPARATOR.$filename;

        return File::delete($path);
    }
}
