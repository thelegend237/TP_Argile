<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/salarie.php';

class SalarieTest extends TestCase
{
    public function testSetMatriculeValide()
    {
        $s = new salarie();
        $s->setMatricule(123456);
        $this->assertEquals(123456, $s->getMatricule());
    }

    public function testSetMatriculeInvalide()
    {
        $this->expectException(Exception::class);
        $s = new salarie();
        $s->setMatricule(12);
    }

    public function testGetDateEmbauche()
    {
        $s = new salarie(123456, "Test", 1000, "01/01/2020");
        $this->assertEquals("2020", $s->getDateEmbauche()->format("Y"));
    }

    public function testExperience()
    {
        $s = new salarie(123456, "Test", 1000, "01/01/2020");
        $this->assertGreaterThanOrEqual(4, $s->experience());
    }

    public function testCalculerSalaireNet()
    {
        $s = new salarie(123456, "Test", 1000, "01/01/2020");
        $this->assertEquals(800, $s->calculerSalaireNet());
    }

    public function testPrimeAnnuelle()
    {
        $s = new salarie(123456, "Test", 1000, "01/01/2020");
        $this->assertGreaterThanOrEqual(800 + 400, $s->primeAnnuelle());
    }
}
