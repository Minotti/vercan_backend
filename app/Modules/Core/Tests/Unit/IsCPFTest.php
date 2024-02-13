<?php

namespace App\Modules\Core\Tests\Unit;

use Tests\TestCase;
use App\Modules\Core\Rules\IsCPF;

class IsCPFTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new IsCPF();
    }

    /** @test */
    public function should_fail_when_cpf_is_incorrect(): void
    {
        $passes = true;
        $attribute = 'cpf';
        $value = '0000';

        $this->rule->validate(
            $value,
            $attribute,
            function (string $message) use (&$passes): void {
                $passes = false;
                $this->assertSame('O campo :attribute deve conter um CPF válido.', $message);
            },
        );

        $this->assertFalse($passes);
    }

    /**
     * @test
     */
    public function should_be_valid_when_cpf_is_correct()
    {
        $passes = true;
        $attribute = 'cpf';
        $value = '01234567890';

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
