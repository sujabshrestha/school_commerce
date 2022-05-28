<?php

use Illuminate\Support\Facades\Storage;

function getImageUrl($path = null)
{
    if($path){
        return Storage::url($path);
    }
}



?>
