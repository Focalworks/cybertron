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
                Files::setMessage('Not able to save the file');
        }
        else
        {
            Files::setMessage('Not able to save the file');
        }
    }

    public static function dataToCSV($dbData, $headers = null, $keys = null)
    {
        // the data needs to be an object
        if (!is_array($dbData))
        {
            Files::setMessage('Cannot convert this data into a CSV file');
        }

        // fetching the keys from the first element
        $dataCols = array();
        if ($keys == null)
        {
            foreach ($dbData[0] as $key => $value)
            {
                $dataCols[] = $key;
            }
        }
        else
        {
            $dataCols = $keys;
        }

        $finalDataArr = array();
        foreach ($dbData as $key => $row)
        {
            foreach ($dataCols as $col)
            {
                $finalDataArr[$key][] = $row->$col;
            }
        }

        $output = '';

        /**
         * checking if the CSV columns are defined
         * then it will add then as the first row.
         */
        if ($headers != null && is_array($headers))
        {
            $output .= implode(",",$headers);
            $output .= "\n";
        }

        foreach ($finalDataArr as $row) {
            $output.=  implode(",",$row);
            $output .= "\n";
        }

        return $output;
    }
}