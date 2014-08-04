<?php

class Files extends Eloquent
{

    protected $table = 'files_managed';

    public function sanitizeFileName($name)
    {
        return $name;
    }

    public function getFileMimeType($filepath)
    {
        return mime_content_type($filepath);
    }

    public function getNextFileName($fileName, $fileExt)
    {
        // File::isFile('uploads/user_pic/' . "{$fileName}.{$fileExt}")
        $counter = 0;
        $finalFileName = '';
        do {
            $counter++;
            if (!File::isFile('uploads/user_pic/' . "{$fileName}{$counter}.{$fileExt}"))
            {
                $finalFileName = "{$fileName}{$counter}.{$fileExt}";
                break;
            }
        }
        while (File::isFile('uploads/user_pic/' . "{$fileName}{$counter}.{$fileExt}"));

        return $finalFileName;
    }
}