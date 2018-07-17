<?php 
namespace App\Libraries;

class Config{
    //*-- group --*//
    public static function getPrivateGroupName() {
        return '@'. \Auth::user()->id;
    }
    
    //*-- image upload --*//
    const MAX_FILE_SIZE = 1500000;
    const UPLOAD_TAG_NAME = 'fileToUpload';
    const UPLOADABLE_FILES = [
        'image/jpeg',
        'image/png',
    ];
    const UPLOAD_RETURN_CODES = [
        'SuccessfullyPerformed' => 1,
        'InvalidData' => 0,
        'TooLargeFileSize' => -1,
        'HtmlInputError' => -2,
        'InvalidFileType' => -3,
        'UploadFailed' => -4,
    ];
    
    //*-- user avatar --*//
    const AVATAR_DEFAULT_URLS = [
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_400,w_340,x_200,y_350/v1531500699/crzfliii8uojmt6qznio.jpg', //penguin
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_400,w_340,x_655,y_350/v1531500699/crzfliii8uojmt6qznio.jpg', //seal
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_400,w_340,x_1095,y_350/v1531500699/crzfliii8uojmt6qznio.jpg', //walrus
        
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_400,w_340,x_210,y_750/v1531500699/crzfliii8uojmt6qznio.jpg', //squid
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_400,w_340,x_660,y_750/v1531500699/crzfliii8uojmt6qznio.jpg', //octopus
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_400,w_340,x_1095,y_750/v1531500699/crzfliii8uojmt6qznio.jpg', //sea lion
        
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_400,w_340,x_210,y_1140/v1531500699/crzfliii8uojmt6qznio.jpg', //hermit crab
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_400,w_340,x_660,y_1140/v1531500699/crzfliii8uojmt6qznio.jpg', //turtle
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_400,w_340,x_1095,y_1140/v1531500699/crzfliii8uojmt6qznio.jpg', //starfish
    ];
    
    //*-- date --*//
    const DATETIME_FORMAT_FULL = 'Y-m-d H:i:s';
    const DATETIME_FORMAT_DATE = 'Y-m-d';
    const DATETIME_FORMAT_TIME = 'H:i:s';
}