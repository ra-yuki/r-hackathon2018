<?php
namespace App\Libraries;

use App\Libraries\Config;

class CloudinaryHelper{
    // required to call first
    public static function init(){
        \Cloudinary::config(array( 
            "cloud_name" => env('CLOUDINARY_CLOUD_NAME'), 
            "api_key" => env('CLOUDINARY_API_KEY'),
            "api_secret" => env('CLOUDINARY_API_SECRET')
        ));
    }
    
    // return vals:
    //       0  -> too large file to upload, 
    //      -1  -> parsed data is invalid, 
    //      -2  -> something is wrong with the html file input system
    //      -3  -> upload failed
    //       1  -> upload successfully performed
    // return array example:
    /*
    array (size=16)
      'public_id' => string 'yl7dnekxhs3gyslw7air' (length=20)
      'version' => int 1531489563
      'signature' => string 'b7fe5b199d52b6ebbb662f397abaa9666d5f4d30' (length=40)
      'width' => int 48
      'height' => int 48
      'format' => string 'png' (length=3)
      'resource_type' => string 'image' (length=5)
      'created_at' => string '2018-07-13T13:46:03Z' (length=20)
      'tags' => 
        array (size=0)
          empty
      'bytes' => int 2071
      'type' => string 'upload' (length=6)
      'etag' => string 'c4dc9996fae168ad7d8e020260d0f6bc' (length=32)
      'placeholder' => boolean false
      'url' => string 'http://res.cloudinary.com/dkgsscz7j/image/upload/v1531489563/yl7dnekxhs3gyslw7air.png' (length=85)
      'secure_url' => string 'https://res.cloudinary.com/dkgsscz7j/image/upload/v1531489563/yl7dnekxhs3gyslw7air.png' (length=86)
      'original_filename' => string 'phpySRuyk' (length=9)
    */
    public static function upload($fileData, &$result){
        //*-- exception handling --*//
        $condInvalidData =
            !isset($fileData[Config::UPLOAD_TAG_NAME]) ||
            !isset($fileData[Config::UPLOAD_TAG_NAME]['size']) ||
            !isset($fileData[Config::UPLOAD_TAG_NAME]['tmp_name']) ||
            !isset($fileData[Config::UPLOAD_TAG_NAME]['type']);
        if($condInvalidData) return Config::UPLOAD_RETURN_CODES['InvalidData'];
        
        if($fileData[Config::UPLOAD_TAG_NAME]['size'] > Config::MAX_FILE_SIZE) return Config::UPLOAD_RETURN_CODES['TooLargeFileSize'];
        
        if($fileData[Config::UPLOAD_TAG_NAME]['error'] > 0) return Config::UPLOAD_RETURN_CODES['HtmlInputError'];
        
        $count = count(Config::UPLOADABLE_FILES);
        foreach(Config::UPLOADABLE_FILES as $key => $uploadable){
            if($fileData[Config::UPLOAD_TAG_NAME]['type'] == $uploadable) break;
            if($key == $count-1) return Config::UPLOAD_RETURN_CODES['InvalidFileType'];
        }
        
        //*-- perform upload --*//
        $result = (object)\Cloudinary\Uploader::upload($fileData[Config::UPLOAD_TAG_NAME]['tmp_name']); //parse as StdClass object
        if(!isset($result->public_id)) return Config::UPLOAD_RETURN_CODES['UploadFailed'];
        
        return Config::UPLOAD_RETURN_CODES['SuccessfullyPerformed'];
    }
    
    public static function getUrl($fileMetadataRaw){
        $data = json_decode($fileMetadataRaw);
        
        if(!isset($data->url)) return false; //exception handling
        
        return $data->url; // supposed to return the image url
    }
    public static function getSecureUrl($fileMetadataRaw){
        $data = json_decode($fileMetadataRaw);
        
        if(!isset($data->secure_url)) return false; //exception handling
        
        return $data->secure_url; // supposed to return the image url
    }
}