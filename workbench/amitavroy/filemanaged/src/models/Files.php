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

    public function getNextFileName($fileName)
    {
        $counter = 0;
        $flag = false;
        
        do {
            
        }
    }
}