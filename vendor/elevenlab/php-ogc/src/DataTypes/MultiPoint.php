<?php

namespace ElevenLab\PHPOGC\DataTypes;

class MultiPoint extends LineString
{
    protected $type = "MULTIPOINT";

    public function __construct(array $points)
    {
        parent::__construct($points);
    }
}
