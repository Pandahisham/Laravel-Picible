<?php
namespace Kaom\Picible\Contracts;

use Kaom\Picible\Models\Picture;
use Symfony\Component\HttpFoundation\File\File;

interface Adapter
{
    /**
     * Write a new file.
     *
     * @param \Symfony\Component\HttpFoundation\File\File $file
     * @param \Kaom\Picible\Models\Picture                $picture
     * @param array                                       $filters
     *
     * @return boolean
     */
    public function write(File $file, Picture $picture, array $filters = []);

    /**
     * Check if a file exists.
     *
     * @param \Kaom\Picible\Models\Picture $picture
     * @param array                        $filters
     *
     * @return boolean
     */
    public function has(Picture $picture, array $filters = []);

    /**
     * Delete a file.
     *
     * @param \Kaom\Picible\Models\Picture $picture
     * @param array                        $filters
     *
     * @return boolean
     */
    public function delete(Picture $picture, array $filters = []);
}
