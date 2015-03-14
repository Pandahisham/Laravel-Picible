<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Adapter Name
    |--------------------------------------------------------------------------
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Picible Adapters
    |--------------------------------------------------------------------------
    */

    'adapters' => [

        'awss3' => [
            'driver'     => 'Kaom\Picible\Adapters\AwsS3',
            'connection' => 'awss3',
        ],

        'azure' => [
            'driver'     => 'Kaom\Picible\Adapters\Azure',
            'connection' => 'azure',
        ],

        'copy' => [
            'driver'     => 'Kaom\Picible\Adapters\Copy',
            'connection' => 'copy',
        ],

        'dropbox' => [
            'driver'     => 'Kaom\Picible\Adapters\Dropbox',
            'connection' => 'dropbox',
        ],

        'ftp' => [
            'driver'     => 'Kaom\Picible\Adapters\Ftp',
            'connection' => 'ftp',
        ],

        'gridfs' => [
            'driver'     => 'Kaom\Picible\Adapters\GridFs',
            'connection' => 'gridfs',
        ],

        'local' => [
            'driver'     => 'Kaom\Picible\Adapters\Local',
            'connection' => 'local',
        ],

        'rackspace' => [
            'driver'     => 'Kaom\Picible\Adapters\Rackspace',
            'connection' => 'rackspace',
        ],

        'sftp' => [
            'driver'     => 'Kaom\Picible\Adapters\Sftp',
            'connection' => 'sftp',
        ],

        'webdav' => [
            'driver'     => 'Kaom\Picible\Adapters\WebDav',
            'connection' => 'webdav',
        ],

        'zip' => [
            'driver'     => 'Kaom\Picible\Adapters\ZipArchive',
            'connection' => 'zip',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Image Processor
    |--------------------------------------------------------------------------
    */

    'driver' => 'gd',

    /*
    |--------------------------------------------------------------------------
    | Picible Filters
    |--------------------------------------------------------------------------
    */

    'filters' => [

        'colorize' => [
            'driver' => 'Kaom\Picible\Filters\Colorize',
            'config' => [
                'red'   => 50,
                'green' => 64,
                'blue'  => 32,
            ],
        ],

        'greyscale' => [
            'driver' => 'Kaom\Picible\Filters\Greyscale',
        ],

        'pixelate' => [
            'driver' => 'Kaom\Picible\Filters\Pixelate',
            'config' => [
                'size' => 15,
            ],
        ],

        'resize' => [
            'driver' => 'Kaom\Picible\Filters\Resize',
            'config' => [
                'width'          => 300,
                'height'         => 300,
                'preserve_ratio' => true,
            ],
        ],

        'watermark' => [
            'driver' => 'Kaom\Picible\Filters\Watermark',
            'config' => [
                'sourcePath'  => storage_path('files/watermark.png'),
                'offsetLeft'  => 'bottom-right',
                'offsetRight' => 10,
                'anchor'      => 0,
            ],
        ],

        /*
         * Example of a filter collection
         */
        'avatarize' => [
            [
                'driver' => 'Kaom\Picible\Filters\Pixelate',
                'config' => [
                    'size' => 15,
                ],
            ], [
                'driver' => 'Kaom\Picible\Filters\Resize',
                'config' => [
                    'width'          => 300,
                    'height'         => 300,
                    'preserve_ratio' => true,
                ],
            ], [
                'driver' => 'Kaom\Picible\Filters\Colorize',
                'config' => [
                    'red'   => 50,
                    'green' => 64,
                    'blue'  => 32,
                ],
            ], [
                'driver' => 'Kaom\Picible\Filters\Greyscale',
            ], [
                'driver' => 'Kaom\Picible\Filters\Watermark',
                'config' => [
                    'sourcePath'  => storage_path('files/watermark.png'),
                    'offsetLeft'  => 'bottom-right',
                    'offsetRight' => 10,
                    'anchor'      => 10,
                ],
            ],
        ],
    ],
];
