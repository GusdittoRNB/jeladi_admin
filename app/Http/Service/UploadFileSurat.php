<?php

namespace App\Http\Service;

use Intervention\Image\Laravel\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use File;

class UploadFileSurat
{
    public function uploadFileSurat(UploadedFile $file, $surat)
    {
        $fileName = date('Ymd', strtotime($surat->tanggal_permohonan)).'-'.$surat->jenis_surat_id.'-'.$surat->user_id.'-'.$surat->id.'-'.str_slug($surat->atas_nama_surat).'.'.$file->guessClientExtension();
        $destinationPath = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'permohonan-surat';
        $file->move($destinationPath, $fileName);

        return $fileName;
    }

    public function deleteFileSurat($filename)
    {
        $path = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'permohonan-surat'.DIRECTORY_SEPARATOR.$filename;

        return File::delete($path);
    }
}
