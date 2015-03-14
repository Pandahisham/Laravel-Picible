<?php
namespace Kaom\Picible\Adapters;

use Kaom\Picible\Contracts\ShareableInterface;
use Kaom\Picible\Models\Picture;

class Local extends AbstractAdapter implements ShareableInterface
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

        $path = str_replace([
            public_path(), storage_path(),
        ], null, $config['path']);

        $path = config('app.url').$path.'/'.$this->buildFileName($picture, $filters);

        return $path;
    }
}
