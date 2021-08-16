<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait UploadTrait
{

    public function uploadFile(UploadedFile $uploadedFile, $folder = null,$mainPath = 'public' ,$fileName = null) 
    {
        $name = !is_null($fileName) ? $fileName : time();

        $filePath = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->extension(), $mainPath);

        return $name.'.'.$uploadedFile->extension();
    }
}