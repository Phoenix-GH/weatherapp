<?php
namespace Chainside\Test;

require __DIR__ . '/../vendor/autoload.php';

class HasToString
{
    public function __toString() {
        return 'foo';
    }
}
