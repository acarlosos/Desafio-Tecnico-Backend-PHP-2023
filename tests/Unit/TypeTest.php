<?php

namespace Tests\Unit;

use App\Models\Type;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_name()
    {
        $type = new Type(['name' => 'Danger']);
        $this->assertIsString($type->name);
        $this->assertStringContainsStringIgnoringCase('Danger', $type->name);
    }
}
