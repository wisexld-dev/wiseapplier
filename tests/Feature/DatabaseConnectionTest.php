<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseConnectionTest extends TestCase
{
    /**
     * Test database connection.
     *
     * @return void
     */
    public function testDatabaseConnection()
    {
        $this->assertTrue(DB::connection()->getPdo() != null);
    }
}
