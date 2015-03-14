<?php
namespace Kaom\Picible\Contracts;

interface Picible
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function pictures();
}
