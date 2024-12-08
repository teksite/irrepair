<?php

namespace Modules\Main\Traits\Upload;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;

trait Uploader
{
    public function fileUploader($file, $directory = null, bool $overwrite = false ,bool $randomFileName=false): string
    {
        $folderNameByDate = Carbon::now()->format('Y-m');

        $directory = is_null($directory) ? 'uploads/' . $folderNameByDate : 'uploads/' . $directory;

        $url = $directory;

        $path = public_path($directory);
        if (!is_dir($path)) mkdir($path, 0755, true);

        $fileName = $this->checkAndChangeFileName($file, $path, $overwrite, $randomFileName);

        $file = $file->move($path, $fileName);

        return  '/'.stripslashes($url) . '/' . $fileName;
    }


    protected function checkAndChangeFileName($file, $path, $overwrite = true , $randomFileName=false): string
    {
        $originalFileName = str_replace(' ', '_', $file->getClientOriginalName());
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $filename = $randomFileName ? time(). '.' . $extension: $originalFileName;

        if (!$overwrite) {
            if (file_exists($path . $filename)) {


                $file_name = basename($filename, '.' . $extension);

                $i = 1;
                do {
                    $filename = $file_name . '-' . $i . '.' . $extension;
                    $i++;
                } while (file_exists($path . $filename));
            }
        }
        return $filename;
    }
}
