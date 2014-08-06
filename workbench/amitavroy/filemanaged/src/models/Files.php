<?php

class Files extends Eloquent
{

    protected $table = 'files_managed';

    /**
     * This function will take the file name and remove any unwanted characters
     * present in the file name which can cause problem in urls.
     * @param $name
     *
     * @return mixed
     */
    public function sanitizeFileName($name)
    {
        return $name;
    }

    /**
     * This function will take the path of a file and return the mime type of the file.
     * @param $filepath
     *
     * @return string
     */
    public function getFileMimeType($filepath)
    {
        return mime_content_type($filepath);
    }

    /**
     * Get the next file name if the file exist.
     *
     * @param $fileName
     * @param $destination
     * @param $fileExt
     *
     * @return string
     */
    public function getNextFileName($fileName, $destination, $fileExt)
    {
        // create the folder if it doesn't exist
        if (!File::isDirectory($destination))
        {
            File::makeDirectory($destination,  $mode = 0777, $recursive = true);
        }

        $counter = 0;
        $finalFileName = '';
        do {
            $counter++;
            if (!File::isFile($destination . "{$fileName}{$counter}.{$fileExt}"))
            {
                $finalFileName = "{$fileName}{$counter}.{$fileExt}";
                break;
            }
        }
        while (File::isFile($destination . "{$fileName}{$counter}.{$fileExt}"));

        $finalFileName = $this->sanitizeFileName($finalFileName);

        return $finalFileName;
    }

    public function saveFileEntry($data)
    {
        date_default_timezone_set("Asia/Kolkata");
        $user = Session::get('userObj');
        $date = new DateTime();
        $created = $date->format('Y-m-d H:i:s');
        $data['added_on'] = $created;
        $data['user_id'] = $user->id;

        $fid = DB::table($this->table)->insertGetId($data);
        return $fid;
    }
}