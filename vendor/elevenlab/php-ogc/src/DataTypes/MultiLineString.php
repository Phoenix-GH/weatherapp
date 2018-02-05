<?php

namespace ElevenLab\PHPOGC\DataTypes;

class MultiLineString extends Polygon
{
    protected $type = "MULTILINESTRING";

    public function __construct(array $linestrings)
    {
        parent::__construct($linestrings, false);
    }
}