<?php

namespace ElevenLab\PHPOGC;

use ElevenLab\PHPOGC\DataTypes\Point;

class PointsTest extends \PHPUnit_Framework_TestCase
{
    public function testPointDistance()
    {
        $p1 = new Point(41.934077,12.4525363); // olimpico
        $p2 = new Point(41.7480619,12.4637237); // trigoria

        $vDistance = Point::distance($p1, $p2, "vincenty");
        $this->assertEquals(0, bccomp("20704.687222767", $vDistance));

        $hDistance = Point::distance($p1, $p2);
        $this->assertEquals(0, bccomp("20704.687222768", $hDistance));
    }
}