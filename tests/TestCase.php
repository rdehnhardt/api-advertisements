<?php

namespace Tests;

use Faker\Generator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory as Faker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var Generator
     */
    private $faker;

    /**
     * @return Generator
     */
    public function faker()
    {
        if (!$this->faker) {
            $this->faker = Faker::create();
        }

        return $this->faker;
    }
}
