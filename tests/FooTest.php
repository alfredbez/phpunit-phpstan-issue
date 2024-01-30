<?php

namespace AppTests;

use PHPUnit\Framework\TestCase;

class FooTest extends TestCase
{
    public function testSomething(): void
    {
        $foo = $this->createMock(\App\Foo::class);
        $matcher = $this->exactly(2);

        $foo->expects($matcher)
            ->method('bar')
            ->willReturnCallback(function (int $baz) use ($matcher): void {
            switch ($matcher->numberOfInvocations()) {
                case 1:
                    $this->assertEquals(5, $baz);

                    break;
                case 2:
                    $this->assertEquals(3, $baz);

                    break;
            }
        });

        $foo->bar(5);
        $foo->bar(3);
    }
}
