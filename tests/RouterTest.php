<?php

use PHPUnit\Framework\TestCase;

final class RouterTest extends TestCase
{

    public function testFirst()
    {
        app()->make('App\\System\\Request' , ['/', 'GET']);
        $this->assertEquals(
            'home.index',
            Router::getActiveRoute()->name
        );
    }

    public function testSecond()
    {
        $this->assertEquals(
            '/vacancies/13',
            Router::getCompiled('vacancies.show', 13)->url
        );
    }

}
