### Rationale

This package aims to implement the Open Geo Consortium proposed standard for geo-spatial objects.  

### Installation

##### Using Composer

Execute in the project root folder:

```bash
$ composer require elevenlab/php-ogc
```

##### Manually

TODO

### Quick Documentation

All objects could be created from and exported as:
- Well Known Text (WKT) format
- Well Known Binary (WKB) format

##### Point

```php
<?php

$p1 = new Point(1.234, 2.345);
$p2 = new Point("1.234", "2.345");
$p3 = Point::fromArray([1.234, 2.345]);
$p4 = Point::fromString("1.234, 2.345");
$p5 = Point::fromString("1.234 2.345", " ");
$p6 = Point::fromString("1.234#2.345", "#");
$p7 = Point::fromWKT("POINT(0 0)");
```

##### LineString

```php
<?php

$l1 = new LineString([new Point(1, 2), new Point(3, 4), new Point(5, 6)]); 
$l2 = new LineString([new Point(1, 2), new Point(3, 4), new Point(5, 6), new Point(1, 2)]); 
$l3 = LineString::fromArray([[1,2], [2,3], [3,4]]);
$l4 = LineString::fromString('1 2, 2 3, 3 4, 4 5');
$l5 = LineString::fromString('1 2@ 2 3@ 3 4@ 4 5', '@');
$l6 = LineString::fromString('1#2@2#3@3#4@4#5', '@', '#');
$l7 = LineString::fromWKT("LINESTRING(0 0,1 1,1 2)");
```

##### MultiPoint

Identical to LineString.

##### MultiLineString

```php
<?php

$ml1 = new MultiLineString([LineString::fromArray([[1,2], [2,3], [3,4]]), LineString::fromArray([[5,6], [7,8], [9,10]])]);
$ml2 = MultiLineString::fromArray([[[1,2], [2,3], [3,4]],[[5,6], [7,8], [9,10]]]);
$ml3 = MultiLineString::fromString("1 2, 2 3, 3 4; 5 6, 7 8, 9 10");
$ml4 = MultiLineString::fromString("1 2, 2 3, 3 4@ 5 6, 7 8, 9 10", "@");
$ml4 = MultiLineString::fromString("1 2, 2 3, 3 4@ 5 6, 7 8, 9 10", "@");
$ml5 = MultiLineString::fromString("1 2# 2 3# 3 4@ 5 6# 7 8# 9 10", "@", "#");
$ml6 = MultiLineString::fromString("1^2#2^3# 3^4@ 5^6# 7^8# 9^10", "@", "#", "^");
$ml7 = MultiLineString::fromWKT("MULTILINESTRING((0 0,4 0,4 4,0 4),(1 1, 2 1, 2 2, 1 2))");
```

##### Polygon

The only difference between Polygon and MultiLineString objects is that the former must be composed by all circular linestrings (first and last point equals).

##### MultiPolygon

```php
<?php

$mp1 = new MultiPolygon([
    new Polygon([LineString::fromArray([[1,2], [2,3], [3,4], [1,2]]), LineString::fromArray([[5,6], [7,8], [9,10], [5,6]])]),
    new Polygon([LineString::fromArray([[1,2], [2,3], [3,4], [1,2]]), LineString::fromArray([[5,6], [7,8], [9,10], [5,6]])]),
    new Polygon([LineString::fromArray([[1,2], [2,3], [3,4], [1,2]]), LineString::fromArray([[5,6], [7,8], [9,10], [5,6]])])
]);
$mp2 = MultiPolygon::fromArray([
    [[[1,2], [2,3], [3,4], [1,2]],[[5,6], [7,8], [9,10], [5,6]]],
    [[[1,2], [2,3], [3,4], [1,2]],[[5,6], [7,8], [9,10], [5,6]]],
    [[[1,2], [2,3], [3,4], [1,2]],[[5,6], [7,8], [9,10], [5,6]]]
]);
$mp3 = MultiPolygon::fromString("1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6|1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6|1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6");
$mp4 = MultiPolygon::fromString("1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6%1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6%1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6", "%");
$mp5 = MultiPolygon::fromString("1 2, 2 3, 3 4, 1 2# 5 6, 7 8, 9 10, 5 6%1 2, 2 3, 3 4, 1 2# 5 6, 7 8, 9 10, 5 6%1 2, 2 3, 3 4, 1 2# 5 6, 7 8, 9 10, 5 6", "%", "#");
$mp6 = MultiPolygon::fromString("1 2: 2 3: 3 4: 1 2# 5 6: 7 8: 9 10: 5 6%1 2: 2 3: 3 4: 1 2# 5 6: 7 8: 9 10: 5 6%1 2: 2 3: 3 4: 1 2# 5 6: 7 8: 9 10: 5 6", "%", "#", ":");
$mp7 = MultiPolygon::fromString("1?2: 2?3: 3?4: 1?2# 5?6: 7?8: 9?10: 5?6%1?2: 2?3: 3?4: 1?2# 5?6: 7?8: 9?10: 5?6%1?2: 2?3: 3?4: 1?2# 5?6: 7?8: 9?10: 5?6", "%", "#", ":", "?");
$mp8 = MultiPolygon::fromWKT("MULTIPOLYGON(((0 0,4 0,4 4,0 4,0 0),(1 1,2 1,2 2,1 2,1 1)),((-1 -1,-1 -2,-2 -2,-2 -1,-1 -1)))");

```

##### GeometryCollection

```php
<?php

$gc = new GeometryCollection([
    new Polygon([LineString::fromArray([[1,2], [2,3], [3,4], [1,2]]), LineString::fromArray([[5,6], [7,8], [9,10], [5,6]])]),
    MultiPolygon::fromString("1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6|1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6|1 2, 2 3, 3 4, 1 2; 5 6, 7 8, 9 10, 5 6"),
    MultiLineString::fromArray([[[1,2], [2,3], [3,4]],[[5,6], [7,8], [9,10]]]),
    LineString::fromWKT("LINESTRING(0 0,1 1,1 2)"),
    new Point(1.234, 2.345) 
]);

```

### ToDo

- add docs for manual installation
- add constructor
