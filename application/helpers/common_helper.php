<?php defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('truncateTxt')){
    
    function truncateTxt($text, $chars = 25) {
        if(strlen($text) > $chars){
            $text = $text." ";
            $text = substr($text,0,$chars);
            //$text = substr($text,0,strrpos($text,' '));
            $text = $text."...";
            return $text;
            
        }else{
            return $text;
        }
    }
}


if( ! function_exists('getAllImages')){
    function getAllImages(){
        $directory = "./uploads/";
        $images = glob($directory . "*.*");
        
        $imagesArray = array();
        $i = 0;
        foreach($images as $image)
        {
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            if(!in_array(strtolower($ext), array('png','jpeg','jpg','gif','bmp'))){ 
                continue;
            }

            $imagesArray[$i]['imgid'] = $i + 1;  
            $title = str_replace("_", " ", (pathinfo($image, PATHINFO_FILENAME)));
            $imagesArray[$i]['title'] = $title;
            $imagesArray[$i]['title_trimmed'] = truncateTxt($title, 17);
            $imagesArray[$i]['path'] = $image;
            $i++;
        }
        return $imagesArray;
    }
}