<?php
namespace Kaom\Picible\Adapters;

use Kaom\Picible\Contracts\ShareableInterface;
use Kaom\Picible\Models\Picture;
use Dropbox\Client;
use League\Flysystem\Dropbox\DropboxAdapter;
use League\Flysystem\Filesystem;

class Dropbox extends AbstractAdapter implements ShareableInterface
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
        $config     = $this->loadFlysystemConfig();
        $client     = new Client($config['token'], $config['app']);
        $adapter    = new DropboxAdapter($client);
        $filesystem = new Filesystem($adapter);

        $path = $this->buildFileName($picture, $filters);

        return $filesystem->getAdapter()
                            ->getClient()
                            ->createShareableLink($path);
    }
}
