<?php

return [
    /*
     * You can specify a prefix for that is used for storing all media.
     * If you set this to `/my-subdir`, all your media will be stored in a `/my-subdir` directory.
     */
    'prefix' => env('MEDIA_PREFIX', '/media'),

    /*
     * The fully qualified class name of the media model.
     */
    'media_model' => App\Models\Media::class,
];
