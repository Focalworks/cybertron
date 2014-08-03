<?php

class FileApi
{
    public static function uploadFromURL($url, $destination)
    {
        $Files = new Files;
        
        $arrFileInfo = pathinfo($url);
        $fileName = $Files->sanitizeFileName($arrFileInfo['filename']);
        $fileExt = $arrFileInfo['extension'];
        $fileMimeType = $Files->getFileMimeType('uploads/user_pic/' . "{$fileName}.{$fileExt}");
        
        File::isFile('uploads/user_pic/' . "{$fileName}.{$fileExt}");
        
        
        GlobalHelper::dsm($fileMimeType);
        GlobalHelper::dsm($arrFileInfo);
    }
}