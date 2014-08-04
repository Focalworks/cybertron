<?php

class FileApi
{
    public static function uploadFromURL($url, $destination)
    {
        $Files = new Files;
        
        $arrFileInfo = pathinfo($url);

        // sanitize the file name
        $fileName = $Files->sanitizeFileName($arrFileInfo['filename']);

        $fileExt = $arrFileInfo['extension'];

        $fileNameNew = $Files->getNextFileName($fileName, $fileExt);
        GlobalHelper::dsm($fileNameNew);

        // get the mime type of the file
        $fileMimeType = $Files->getFileMimeType('uploads/user_pic/' . "{$fileName}.{$fileExt}");
        
        File::isFile('uploads/user_pic/' . "{$fileName}.{$fileExt}");
        
        GlobalHelper::dsm($fileMimeType);
        GlobalHelper::dsm($arrFileInfo);
    }
}