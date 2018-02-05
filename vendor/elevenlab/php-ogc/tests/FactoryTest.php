<?php

namespace ElevenLab\PHPOGC;

use ElevenLab\PHPOGC\DataTypes\MultiLineString;
use ElevenLab\PHPOGC\DataTypes\MultiPoint;
use ElevenLab\PHPOGC\DataTypes\MultiPolygon;
use ElevenLab\PHPOGC\Exceptions\GeoSpatialException;
use ElevenLab\PHPOGC\DataTypes\LineString;
use ElevenLab\PHPOGC\DataTypes\Point;
use ElevenLab\PHPOGC\DataTypes\Polygon;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testPointSuccess()
    {
        $points = [];
        $points[] = new Point(1.234, 2.345);
        $points[] = new Point("1.234", "2.345");
        $points[] = Point::fromArray([1.234, 2.345]);
        $points[] = Point::fromString("1.234, 2.345");
        $points[] = Point::fromString("1.234 2.345", " ");
        $points[] = Point::fromString("1.234#2.345", "#");
        $points[] = Point::fromWKT("POINT(1.234 2.345)");

        foreach($points as $point){
            if( get_class($point) != 'ElevenLab\PHPOGC\DataTypes\Point' || $point->lat != 1.234 || $point->lon != 2.345)
                throw new GeoSpatialException('Error instantiating Points');
        }
    }

    public function testLinestringSuccess()
    {
        $linestrings = [];

        $p1 = new Point(1, 2);
        $p2 = new Point(3, 4);
        $p3 = new Point(5, 6);

        $linestrings[] = new LineString([$p1, $p2, $p3]);
        $linestrings[] = LineString::fromString("1 2, 3 4, 5 6");
        $linestrings[] = LineString::fromString("1 2: 3 4: 5 6", ":");
        $linestrings[] = LineString::fromString("1_2: 3_4: 5_6", ":", "_");
        $linestrings[] = LineString::fromArray([ [1, 2], [2, 3], [3, 4] ]);

        $linestrings[] = new LineString([new Point(1, 2), new Point(3, 4), new Point(5, 6)]);
        $linestrings[] = new LineString([new Point(1, 2), new Point(3, 4), new Point(5, 6), new Point(1, 2)]);
        $linestrings[] = LineString::fromArray([[1,2], [2,3], [3,4]]);
        $linestrings[] = LineString::fromString('1 2, 2 3, 3 4, 4 5');
        $linestrings[] = LineString::fromString('1 2@ 2 3@ 3 4@ 4 5', '@');
        $linestrings[] = LineString::fromString('1#2@2#3@3#4@4#5', '@', '#');
        $linestrings[] = LineString::fromWKT("LINESTRING(0 0,1 1,1 2)");

        foreach($linestrings as $ls){
            if( get_class($ls) != 'ElevenLab\PHPOGC\DataTypes\LineString' )
                throw new GeoSpatialException("Error instantianting Linestring");
            foreach($ls->points as $point){
                if( get_class($point) != 'ElevenLab\PHPOGC\DataTypes\Point' )
                    throw new GeoSpatialException("LineString does not contains Points");
            }
        }
    }

    public function testMultiPointSuccess()
    {
        $multipoints = [];

        $p1 = new Point(1, 2);
        $p2 = new Point(3, 4);
        $p3 = new Point(5, 6);

        $multipoints[] = new MultiPoint([$p1, $p2, $p3]);
        $multipoints[] = MultiPoint::fromString("1 2, 3 4, 5 6");
        $multipoints[] = MultiPoint::fromString("1 2: 3 4: 5 6", ":");
        $multipoints[] = MultiPoint::fromString("1_2: 3_4: 5_6", ":", "_");
        $multipoints[] = MultiPoint::fromArray([ [1, 2], [2, 3], [3, 4] ]);
    }

    public function testLineStringCircular()
    {
        $linestring1 = new LineString([new Point(1, 2), new Point(3, 4), new Point(5, 6)]);
        $linestring2 = new LineString([new Point(1, 2), new Point(3, 4), new Point(5, 6), new Point(1, 2)]);

        $this->assertFalse($linestring1->isCircular());
        $this->assertTrue($linestring2->isCircular());
    }

    public function testLineStringSplit()
    {
        $p1 = new Point(1,1);
        $p2 = new Point(2,2);
        $p3 = new Point(3,3);
        $p4 = new Point(4,4);
        $p5 = new Point(5,5);

        $linestring1 = new LineString([$p1, $p2, $p3, $p4, $p5]);
        $linestring2 = new LineString([$p1, $p2]);


        $splitted = $linestring1->split($p2);
        $this->assertEquals($splitted[0], $linestring2);
        $this->assertEquals($splitted[1], new LineString([ $p2, $p3, $p4, $p5] ));

        $splitted = $linestring1->split($p1);
        $this->assertEquals($splitted[0], $p1 );
        $this->assertEquals($splitted[1], $linestring1);

        $splitted = $linestring1->split($p5);
        $this->assertEquals($splitted[0], $linestring1);
        $this->assertEquals($splitted[1], $p5 );

        $splitted = $linestring2->split($p1);
        $this->assertEquals($splitted[0], $p1 );
        $this->assertEquals($splitted[1], $linestring2 );

        $splitted = $linestring2->split($p2);
        $this->assertEquals($splitted[0], $linestring2 );
        $this->assertEquals($splitted[1], $p2 );

        $splitted = $linestring2->split($p3);
        $this->assertEquals($splitted[0], $linestring2 );
        $this->assertEquals($splitted[1], null );

    }

    public function testMultiLineString()
    {
        $ml[] = new MultiLineString([LineString::fromArray([[1,2], [2,3], [3,4]]), LineString::fromArray([[5,6], [7,8], [9,10]])]);
        $ml[] = MultiLineString::fromArray([[[1,2], [2,3], [3,4]],[[5,6], [7,8], [9,10]]]);
        $ml[] = MultiLineString::fromString("1 2, 2 3, 3 4; 5 6, 7 8, 9 10");
        $ml[] = MultiLineString::fromString("1 2, 2 3, 3 4@ 5 6, 7 8, 9 10", "@");
        $ml[] = MultiLineString::fromString("1 2, 2 3, 3 4@ 5 6, 7 8, 9 10", "@");
        $ml[] = MultiLineString::fromString("1 2# 2 3# 3 4@ 5 6# 7 8# 9 10", "@", "#");
        $ml[] = MultiLineString::fromString("1^2#2^3# 3^4@ 5^6# 7^8# 9^10", "@", "#", "^");
        $ml[] = MultiLineString::fromWKT("MULTILINESTRING((0 0,4 0,4 4,0 4),(1 1, 2 1, 2 2, 1 2))");

        foreach ($ml as $multilinestring) {
            $this->assertTrue($multilinestring instanceof MultiLineString);
        }
    }

    public function testPolygonSuccess()
    {
        $polygons = [];
        $p1 = new Point(1,1);
        $p2 = new Point(2,2);
        $p3 = new Point(3,3);
        $p4 = new Point(4,4);
        $p5 = new Point(5,5);

        $linestring1 = new LineString([$p1, $p2, $p3, $p4, $p5, $p1]);
        $linestring2 = new LineString([$p1, $p2, $p3, $p1]);
        $linestring3 = "1 2, 3 4, 5 6, 1 2";
        $linestring4 = "1 2: 3 4: 5 6: 1 2";
        $linestring5 = "1_2: 3_4: 5_6: 1_2";

        $polygons[] = new Polygon([$linestring1]);
        $polygons[] = new Polygon([$linestring1, $linestring2]);
        $polygons[] = Polygon::fromString($linestring3);
        $polygons[] = Polygon::fromString($linestring3 .";". $linestring3);
        $polygons[] = Polygon::fromString($linestring4 ."#". $linestring4, "#", ":");
        $polygons[] = Polygon::fromString($linestring5 ."@". $linestring5, "@", ":", "_");


        foreach($polygons as $poly){
            if( get_class($poly) != 'ElevenLab\PHPOGC\DataTypes\Polygon' )
                throw new GeoSpatialException("Error instantianting Polygon");
            foreach($poly->linestrings as $ls){
                if( get_class($ls) != 'ElevenLab\PHPOGC\DataTypes\LineString' )
                    throw new GeoSpatialException("Error instantianting Linestring");
                foreach($ls->points as $point){
                    if( get_class($point) != 'ElevenLab\PHPOGC\DataTypes\Point' )
                        throw new GeoSpatialException("LineString does not contains Points");
                }
            }
        }
    }

    public function testMultiPolygonSuccess()
    {
        $polygons = [];
        $p1 = new Point(1,1);
        $p2 = new Point(2,2);
        $p3 = new Point(3,3);
        $p4 = new Point(4,4);
        $p5 = new Point(5,5);

        $linestring1 = new LineString([$p1, $p2, $p3, $p4, $p5, $p1]);
        $linestring2 = new LineString([$p1, $p2, $p3, $p1]);
        $linestring3 = "1 2, 3 4, 5 6, 1 2";
        $linestring4 = "1 2: 3 4: 5 6: 1 2";
        $linestring5 = "1_2: 3_4: 5_6: 1_2";

        $polygons[] = new Polygon([$linestring1]);
        $polygons[] = new Polygon([$linestring1, $linestring2]);
        $polygons[] = Polygon::fromString($linestring3);
        $polygons[] = Polygon::fromString($linestring3 .";". $linestring3);
        $polygons[] = Polygon::fromString($linestring4 ."#". $linestring4, "#", ":");
        $polygons[] = Polygon::fromString($linestring5 ."@". $linestring5, "@", ":", "_");

        $multi = new MultiPolygon($polygons);
        if( ! $multi instanceof MultiPolygon )
            throw new \Exception();

        $mp[] = new MultiPolygon([
            new Polygon([LineString::fromArray([[1,2], [2,3], [3,4], [1,2]]), LineString::fromArray([[5,6], [7,8], [9,10], [5,6]])]),
            new Polygon([LineString::fromArray([[1,2], [2,3], [3,4], [1,2]]), LineString::fromArray([[5,6], [7,8], [9,10], [5,6]])]),
            new Polygon([LineString::fromArray([[1,2], [2,3], [3,4], [1,2]]), LineString::fromArray([[5,6], [7,8], [9,10], [5,6]])])
        ]);
        $mp[] = MultiPolygon::fromArray([
            [[[1,2], [2,3], [3,4], [1,2]],[[5,6], [7,8], [9,10], [5,6]]],
            [[[1,2], [2,3], [3,4], [1,2]],[[5,6], [7,8], [9,10], [5,6]]],
            [[[1,2], [2,3], [3,4], [1,2]],[[5,6], [7,8], [9,10], [5,6]]]
        ]);
        $mp[] = MultiPolygon::fromString("1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6|1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6|1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6");
        $mp[] = MultiPolygon::fromString("1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6%1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6%1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6", "%");
        $mp[] = MultiPolygon::fromString("1 2, 2 3, 3 4, 1 2# 5 6, 7 8, 9 10, 5 6%1 2, 2 3, 3 4, 1 2# 5 6, 7 8, 9 10, 5 6%1 2, 2 3, 3 4, 1 2# 5 6, 7 8, 9 10, 5 6", "%", "#");
        $mp[] = MultiPolygon::fromString("1 2: 2 3: 3 4: 1 2# 5 6: 7 8: 9 10: 5 6%1 2: 2 3: 3 4: 1 2# 5 6: 7 8: 9 10: 5 6%1 2: 2 3: 3 4: 1 2# 5 6: 7 8: 9 10: 5 6", "%", "#", ":");
        $mp[] = MultiPolygon::fromString("1?2: 2?3: 3?4: 1?2# 5?6: 7?8: 9?10: 5?6%1?2: 2?3: 3?4: 1?2# 5?6: 7?8: 9?10: 5?6%1?2: 2?3: 3?4: 1?2# 5?6: 7?8: 9?10: 5?6", "%", "#", ":", "?");
        $mp[] = MultiPolygon::fromWKT("MULTIPOLYGON(((0 0,4 0,4 4,0 4,0 0),(1 1,2 1,2 2,1 2,1 1)),((-1 -1,-1 -2,-2 -2,-2 -1,-1 -1)))");

        foreach ($mp as $multipolygon) {
            $this->assertTrue($multipolygon instanceof MultiPolygon);
        }
    }

    /**
     * @expectedException \ElevenLab\PHPOGC\Exceptions\GeoSpatialException
     * @expectedExceptionMessage A LineString instance that compose a Polygon must be circular (min 4 points, first and last equals).
     */
    public function testPolygonFails1()
    {
        $p1 = new Point(1,1);
        $p2 = new Point(2,2);
        $p3 = new Point(3,3);
        $p4 = new Point(4,4);
        $p5 = new Point(5,5);

        $linestring1 = new LineString([$p1, $p2, $p3, $p4, $p5]);
        $poly = new Polygon([$linestring1]);
    }


    public function testFromWKTSuccess()
    {
        $point = Point::fromWKT("POINT(0 0)");
        assert($point instanceof Point);
        $this->assertEquals("POINT(0 0)", $point->toWKT());

        $linestring = LineString::fromWKT("LINESTRING(0 0,1 1,1 2)");
        assert($linestring instanceof LineString);
        $this->assertEquals("LINESTRING(0 0,1 1,1 2)", $linestring->toWKT());

        $multilinestring = MultiLineString::fromWKT("MULTILINESTRING((0 0,4 0,4 4,0 4,0 0),(1 1, 2 1, 2 2, 1 2,1 1))");
        assert($multilinestring instanceof MultiLineString);
        $this->assertEquals("MULTILINESTRING((0 0,4 0,4 4,0 4,0 0),(1 1,2 1,2 2,1 2,1 1))", $multilinestring->toWKT());

        $multipoint = MultiPoint::fromWKT("MULTIPOINT(0 0,1 2)");
        assert($multipoint instanceof MultiPoint);
        $this->assertEquals("MULTIPOINT(0 0,1 2)", $multipoint->toWKT());

        $polygon = Polygon::fromWKT("POLYGON((0 0,4 0,4 4,0 4,0 0),(1 1,2 1,2 2,1 2,1 1))");
        assert($polygon instanceof Polygon);
        $this->assertEquals("POLYGON((0 0,4 0,4 4,0 4,0 0),(1 1,2 1,2 2,1 2,1 1))", $polygon->toWKT());

        $multipolygon = MultiPolygon::fromWKT("MULTIPOLYGON(((0 0,4 0,4 4,0 4,0 0),(1 1,2 1,2 2,1 2,1 1)),((-1 -1,-1 -2,-2 -2,-2 -1,-1 -1)))");
        assert($multipolygon instanceof MultiPolygon);
        $this->assertEquals("MULTIPOLYGON(((0 0,4 0,4 4,0 4,0 0),(1 1,2 1,2 2,1 2,1 1)),((-1 -1,-1 -2,-2 -2,-2 -1,-1 -1)))", $multipolygon->toWKT());
    }



}