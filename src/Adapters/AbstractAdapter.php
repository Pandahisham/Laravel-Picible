<?php
namespace Kaom\Picible\Adapters;

use Kaom\Picible\Contracts\Adapter;
use Kaom\Picible\Models\Picture;
use GrahamCampbell\Flysystem\FlysystemManager;
use League\Flysystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

abstract class AbstractAdapter implements Adapter
{
    /**
     * @var \GrahamCampbell\Flysystem\FlysystemManager
     */
    protected $flysystem;

    /**
     * @var string
     */
    protected $connection;

    /**
     * @param \GrahamCampbell\Flysystem\FlysystemManager $flysystem
     */
    public function __construct(FlysystemManager $flysystem)
    {
        $this->flysystem = $flysystem;
    }

    /**
     * Write a new file.
     *
     * @param \Symfony\Component\HttpFoundation\File\File $file
     * @param array                                       $filters
     *
     * @return \Kaom\Picible\Models\Picture $picture
     * @return boolean
     */
    public function write(File $file, Picture $picture, array $filters = [])
    {
        return $this->getConnection()->write(
            $this->buildFileName($picture, $filters),
            \File::get($file)
        );
    }

    /**
     * Check if a file exists.
     *
     *
     * @param array $filters
     *
     * @return \Kaom\Picible\Models\Picture $picture
     * @return boolean
     */
    public function has(Picture $picture, array $filters = [])
    {
        return $this->getConnection()->has(
            $this->buildFileName($picture, $filters)
        );
    }

    /**
     * Delete a file.
     *
     *
     * @param array $filters
     *
     * @return \Kaom\Picible\Models\Picture $picture
     * @return boolean
     */
    public function delete(Picture $picture, array $filters = [])
    {
        if ($this->has($picture, $filters)) {
            return $this->getConnection()->delete(
                $this->buildFileName($picture, $filters)
            );
        }
    }

    /**
     * Build a unique filename.
     *
     *
     * @param array $filters
     *
     * @return string $picture
     * @return string
     */
    protected function buildFileName(Picture $picture, array $filters = [])
    {
        return sprintf('%s-%s.%s',
            $picture->getKey(),
            $this->buildHash($picture, $filters),
            $picture->extension
        );
    }

    /**
     * Build a unique hash based on the image id and filters.
     *
     *
     * @param array $filters
     *
     * @return string $picture
     * @return string
     */
    protected function buildHash(Picture $picture, array $filters = [])
    {
        $state = [
            'id'      => (string) $picture->getKey(),
            'filters' => $filters,
        ];

        $state = $this->recursiveKeySort($state);

        return md5(json_encode($state));
    }

    /**
     * Recursively sort an array by its keys.
     *
     * @param array $array
     *
     * @return array
     */
    protected function recursiveKeySort(array $array)
    {
        ksort($array);

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = $this->recursiveKeySort($value);
            }
        }

        return $array;
    }

    /**
     * Load the configuration from Laravel-Flysystem.
     *
     * @return array
     */
    public function loadFlysystemConfig()
    {
        $adapterKey = config('picible.default');
        $adapterKey = config('picible.adapters.'.$adapterKey.'.connection');

        return config('flysystem.connections.'.$adapterKey);
    }

    /**
     * Get an instance of the Filesystem.
     *
     * @return string
     */
    public function getConnection()
    {
        $connection = $this->connection;

        if (!$connection instanceof Filesystem) {
            $connection = get_class($connection);
            throw new InvalidArgumentException("Class [$connection] does not implement Filesystem.");
        }

        return $connection;
    }

    /**
     * Set the name of the connection.
     *
     * @param string $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $this->flysystem->connection($this->connection);
    }
}
