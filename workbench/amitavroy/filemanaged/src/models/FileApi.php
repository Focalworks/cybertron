<?php

class FileApi
{
    public static function uploadFromURL($url, $destination)
    {
        $Files = new Files;

        $arrFileInfo = pathinfo($url);

        // getting the file extension
        $fileExt = $arrFileInfo['extension'];

        // the correct file name
        $fileNameNew = $Files->getNextFileName($arrFileInfo['filename'], $destination, $fileExt);

        $content = file_get_contents($url);
        if (file_put_contents($destination . $fileNameNew , $content))
        {
            // get the mime type of the file
            $fileMimeType = $Files->getFileMimeType($destination . $fileNameNew);

            $fileManagedData = array(
                'file_name' => $fileNameNew,
                'file_url' => $destination . $fileNameNew,
                'file_mime' => $fileMimeType,
                'file_size' => filesize($destination . $fileNameNew),
                'file_status' => filesize($destination . $fileNameNew),
                'file_type' => $fileExt,
                'entity_type' => 'user',
            );

            $fileId = $Files->saveFileEntry($fileManagedData);
            if ($fileId)
                return $fileId;
            else
                GlobalHelper::setMessage('Not able to save the file');
        }
        else
        {
            GlobalHelper::setMessage('Not able to save the file');
        }
    }
}