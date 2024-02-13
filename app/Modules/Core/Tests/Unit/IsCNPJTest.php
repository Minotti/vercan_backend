<?php

namespace App\Modules\Core\Tests\Unit;

use Tests\TestCase;
use App\Modules\Core\Rules\IsCNPJ;

class IsCNPJTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new IsCNPJ();
    }

    /** @test */
    public function should_fail_when_cnpj_is_incorrect(): void
    {
        $passes = true;
        $attribute = 'cnpj';
        $value = '0000';

        $this->rule->validate(
            $value,
            $attribute,
            function (string $message) use (&$passes): void {
                $passes = false;
                $this->assertSame('O campo :attribute deve conter um CNPJ válido.', $message);
            },
        );

        $this->assertFalse($passes);
    }

    /**
     * @test
     */
    public function should_be_valid_when_cnpj_is_correct()
    {
        $passes = true;
        $attribute = 'cnpj';
        $value = '39418056000104';

        $this->rule->validate(
            $value,
            $attribute,
            function (string $message) use (&$passes): void {
                $passes = true;
            },
        );

        $this->assertTrue($passes);
    }
}
