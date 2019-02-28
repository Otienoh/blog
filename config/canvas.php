<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | You may assign any custom middleware that you choose to the Canvas
    | routes in your application. They will be protected by basic
    | user authentication by default.
    |
    */

    'middleware' => [
        'web',
        'auth',
    ],

    /*
    |--------------------------------------------------------------------------
    | Uploads Disk
    |--------------------------------------------------------------------------
    |
    | This is the storage disk Canvas will use to put file uploads, you can use
    | any of the disks defined in your config/filesystems.php file. You may
    | also configure the path where the files should be stored.
    |
    */

    'storage_disk' => env('CANVAS_STORAGE_DISK', 'local'),

    'storage_path' => env('CANVAS_STORAGE_PATH', 'public/canvas/images'),

    /*
    |--------------------------------------------------------------------------
    | Unsplash Integration
    |--------------------------------------------------------------------------
    |
    | Visit https://unsplash.com/oauth/applications to create a new unsplash
    | app. Use the Access Key to integrate with the Unsplash API
    |
    */

    'unsplash' => [
        'access_key' => env('CANVAS_UNSPLASH_ACCESS_KEY'),
    ],

];
