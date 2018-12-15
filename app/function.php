<?php

function get_request_file($str)
{
    $c = iconv_strlen($str);
    
    
    $f = new File_req();
    
    return $f;
}

class File_req {
    
    public $chars;
    public $words;
    public $lines;
    public $time;
    public $path;


}

