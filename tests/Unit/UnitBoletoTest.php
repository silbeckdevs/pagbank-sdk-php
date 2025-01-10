<?php

namespace Tests\Unit;

use PagBankApi\Entity\Boleto;
use PHPUnit\Framework\TestCase;

class UnitBoletoTest extends TestCase
{
    public function testSetDueDateWithValidDate(): void
    {
        $boleto = new Boleto();
        $date = '2024-12-31';

        $boleto->setDueDate($date);

        $this->assertEquals($date, $boleto->getDueDate());
    }

    public function testSetDueDateWithInvalidDateThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The due date must be in the format YYYY-MM-DD.');

        $boleto = new Boleto();
        $boleto->setDueDate('31-12-2024');
    }
}
