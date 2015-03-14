<?php
namespace Kaom\Picible\Adapters;

use Aws\S3\S3Client;
use Kaom\Picible\Contracts\ShareableInterface;
use Kaom\Picible\Models\Picture;
use League\Flysystem\AwsS3v2\AwsS3Adapter;
use League\Flysystem\Filesystem;

class AwsS3 extends AbstractAdapter implements ShareableInterface
{
    /**
     * Creates and returns a public link to a file.
     *
     * @param \Kaom\Picible\Models\Picture $picture
     * @param array                                $filters
     *
     * @return string
     */
    public function getShareableLink(Picture $picture, array $filters = [])
    {
        $config = $this->loadFlysystemConfig();
        $client = S3Client::factory([
            'key'    => $config['key'],
            'secret' => $config['secret'],
            'region' => isset($config['region']) ? $config['region'] : null,
        ]);

        $adapter    = new AwsS3Adapter($client, $config['bucket']);
        $filesystem = new Filesystem($adapter);

        $key = $this->buildFileName($picture, $filters);

        return $filesystem->getAdapter()
                            ->getClient()
                            ->getObjectUrl($config['bucket'], $key);
    }
}
