<?php
namespace tests;

use Germania\NamespacedFileFinder\NamespacedFileFinder;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Argument;

class NamespacedFileFinderTest extends \PHPUnit\Framework\TestCase
{
    use ProphecyTrait;


    public function testInstantiation()
    {
        $sut = new NamespacedFileFinder(__DIR__);
        $this->assertIsCallable($sut);

        return $sut;
    }



}

