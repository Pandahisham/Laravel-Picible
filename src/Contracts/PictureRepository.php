<?php
namespace Kaom\Picible\Contracts;

interface PictureRepository
{
    /**
     * Creates a new Image object in the database.
     *
     * @param $attributes
     *
     * @return \Kaom\Picible\Model\Picture
     */
    public function create($attributes);

    /**
     * Gets an image object by it's id.
     *
     * @param int $id
     *
     * @return \Kaom\Picible\Model\Picture
     */
    public function getById($id);

    /**
     * @param string $slot
     *
     * @return \Kaom\Picible\Contracts\Picible $picible
     * @return \Kaom\Picible\Model\Picture
     */
    public function getBySlot($slot, Picible $picible = null);
}
