<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Route;

class ExampleTest extends TestCase
{
    protected $admin;

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $dynamicReg = '/{\\S*}/';
        $routeCollection = Route::getRoutes();

        $blacklist = [
            '_debugbar/open',
        ];

        foreach ($routeCollection as $route) {
            if (! preg_match($dynamicReg, $route->uri()) && in_array('GET', $route->methods()) && ! in_array($route->uri(), $blacklist)) {
                $response = $this->call('GET', $route->uri());
                fwrite(STDERR, print_r("[ ] Test => {$response->getStatusCode()} [ ".$route->uri()."\n", true));
                $this->assertNotEquals(500, $response->getStatusCode(), $route->uri().' => failed to load');
            }
        }
    }
}
