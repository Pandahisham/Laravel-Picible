<?php
namespace Kaom\Picible\Adapters;

use Kaom\Picible\Contracts\ShareableInterface;
use Kaom\Picible\Models\Picture;

class Sftp extends AbstractAdapter implements ShareableInterface
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
        //
    }
}
