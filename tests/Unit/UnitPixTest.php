<?php

namespace PagBankApi\Tests\Unit;

use PagBankApi\Entity\Holder;
use PagBankApi\Entity\Pix;
use PagBankApi\Tests\BaseTestCase;

class UnitPixTest extends BaseTestCase
{
    public function testSetAndGetExpirationDate(): void
    {
        $pix = new Pix();
        $date = '2026-08-06T20:14:00Z';

        $result = $pix->setExpirationDate($date);

        $this->assertSame($pix, $result);
        $this->assertSame($date, $pix->getExpirationDate());
    }

    public function testSetAndGetHolder(): void
    {
        $pix = new Pix();
        $holder = new Holder();
        $holder->setName('Jose da Silva')
            ->setTaxId('12345678909');

        $result = $pix->setHolder($holder);

        $this->assertSame($pix, $result);
        $this->assertSame($holder, $pix->getHolder());
        $this->assertSame('Jose da Silva', $pix->getHolder()->getName());
    }

    public function testNullDefaults(): void
    {
        $pix = new Pix();

        $this->assertNull($pix->getExpirationDate());
        $this->assertNull($pix->getEndToEndId());
        $this->assertNull($pix->getHolder());
    }

    public function testSerializeOnlyExpirationDate(): void
    {
        $pix = new Pix();
        $pix->setExpirationDate('2026-08-06T20:14:00Z');

        $json = $pix->toJSON();

        $this->assertIsString($json);
        $this->assertJsonStringEqualsJsonString(
            '{"expiration_date":"2026-08-06T20:14:00Z"}',
            (string) $json
        );
    }

    public function testPopulateByArrayWithResponseFields(): void
    {
        $pix = new Pix();
        $pix->populateByArray([
            'expiration_date' => '2026-08-05T17:27:00.000-03:00',
            'end_to_end_id' => 'b3f3a9f643d94bc699076f547fdec740',
            'holder' => [
                'name' => 'API-PIX Payer Mock',
                'tax_id' => '***931180**',
            ],
        ]);

        $this->assertSame('2026-08-05T17:27:00.000-03:00', $pix->getExpirationDate());
        $this->assertSame('b3f3a9f643d94bc699076f547fdec740', $pix->getEndToEndId());
        $this->assertInstanceOf(Holder::class, $pix->getHolder());
        $this->assertSame('API-PIX Payer Mock', $pix->getHolder()->getName());
        $this->assertSame('***931180**', $pix->getHolder()->getTaxId());
    }
}
