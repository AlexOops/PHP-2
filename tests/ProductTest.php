<?php

use PHPUnit\Framework\TestCase;
use app\models\entities\Products;

class ProductTest extends TestCase
{
    protected $fixture;

    protected function setUp(): void
    {
        $this->fixture = new Products('хлеб', 111, 'вкусный', 'img.jpg');
    }

    public function testProps()
    {
        $this->assertIsArray($this->fixture->props);
        $this->assertNotFalse($this->fixture->props);
    }

    /**
     * @dataProvider providerProduct
     */

    public function testConstructor($name, $value)
    {
        $this->assertEquals($value, $this->fixture->$name);
    }

    public function providerProduct(): array
    {
        return [
            ['name', 'хлеб'],
            ['price', 111],
            ['description', 'вкусный'],
            ['img', 'img.jpg'],
        ];
    }

    protected function tearDown(): void
    {
        $this->fixture = NULL;
    }
}

