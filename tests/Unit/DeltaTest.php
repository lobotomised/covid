<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DeltaTest extends TestCase
{
    /** @test **/
    public function it_can_get_a_negative_delta(): void
    {
        $output = delta(10, 15);

        $this->assertEquals('-5',  $output);
    }

    /** @test **/
    public function it_can_get_a_null_delta(): void
    {
        $output = delta(10, 10);

        $this->assertEquals('-5',  $output);
    }

    /** @test **/
    public function it_can_get_a_positive_delta(): void
    {
        $output = delta(15, 10);

        $this->assertEquals('+5',  $output);
    }
}
