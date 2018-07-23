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
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_340,w_340,x_200,y_370/v1531500699/crzfliii8uojmt6qznio.jpg', //penguin
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_340,w_340,x_655,y_370/v1531500699/crzfliii8uojmt6qznio.jpg', //seal
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_340,w_340,x_1095,y_370/v1531500699/crzfliii8uojmt6qznio.jpg', //walrus
        
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_340,w_340,x_210,y_770/v1531500699/crzfliii8uojmt6qznio.jpg', //squid
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_340,w_340,x_660,y_770/v1531500699/crzfliii8uojmt6qznio.jpg', //octopus
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_340,w_340,x_1095,y_770/v1531500699/crzfliii8uojmt6qznio.jpg', //sea lion
        
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_340,w_340,x_210,y_1160/v1531500699/crzfliii8uojmt6qznio.jpg', //hermit crab
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_340,w_340,x_660,y_1160/v1531500699/crzfliii8uojmt6qznio.jpg', //turtle
        'http://res.cloudinary.com/dkgsscz7j/image/upload/c_crop,h_340,w_340,x_1095,y_1160/v1531500699/crzfliii8uojmt6qznio.jpg', //starfish
    ];
    
    //*-- group avatar --*//
    const AVATAR_DEFAULT_URLS_GROUP = [
        'http://res.cloudinary.com/dkgsscz7j/image/upload/v1532288146/trees.png', //trees
        'http://res.cloudinary.com/dkgsscz7j/image/upload/v1532288145/sea.png', //sea
        'http://res.cloudinary.com/dkgsscz7j/image/upload/v1532288145/ruins.png', //ruins
        
        'http://res.cloudinary.com/dkgsscz7j/image/upload/v1532288145/mountains.png', //mountains
        'http://res.cloudinary.com/dkgsscz7j/image/upload/v1532288143/fields.png', //fields
        'http://res.cloudinary.com/dkgsscz7j/image/upload/v1532288144/iceberg.png', //iceberg
        
        'https://res.cloudinary.com/dkgsscz7j/image/upload/v1532288144/island.png', //island
        'https://res.cloudinary.com/dkgsscz7j/image/upload/v1532288143/desert.png', //desert
        'https://res.cloudinary.com/dkgsscz7j/image/upload/v1532288143/castle.png', //castle
        
        'https://res.cloudinary.com/dkgsscz7j/image/upload/v1532288143/cape.png', //cape
        'https://res.cloudinary.com/dkgsscz7j/image/upload/v1532288143/bridge.png', //bridge
        'https://res.cloudinary.com/dkgsscz7j/image/upload/v1532288143/beach.png', //beach
        
        'https://res.cloudinary.com/dkgsscz7j/image/upload/v1532288142/village.png', //village
        'https://res.cloudinary.com/dkgsscz7j/image/upload/v1532288143/windmills.png', //windmills
        'https://res.cloudinary.com/dkgsscz7j/image/upload/v1532288143/windmills.png', //river
        
        'https://res.cloudinary.com/dkgsscz7j/image/upload/v1532288143/cityscape.png', //cityscape
    ];
    
    //*-- date --*//
    const DATETIME_FORMAT_FULL = 'Y-m-d H:i:s';
    const DATETIME_FORMAT_DATE = 'Y-m-d';
    const DATETIME_FORMAT_TIME = 'H:i:s';
    
    //*-- images --*//
    const IMAGE_PLUS = 'https://res.cloudinary.com/dkgsscz7j/image/upload/v1532320235/plus.png';
}