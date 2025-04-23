<?php

use PHPUnit\Framework\TestCase;
use App\Client;
use App\Compte;

class CompteTest extends TestCase
{
    public function testCrediter()
    {
        $client = new Client("AB123", "Dupont", "Jean", "0600000000");
        $compte = new Compte($client);
        $compte->credite(100);
        $this->assertEquals(100, $compte->getSolde());
    }

    public function testDebiter()
    {
        $client = new Client("CD456", "Martin", "Luc", "0611111111");
        $compte = new Compte($client);
        $compte->credite(200);
        $compte->debite(50);
        $this->assertEquals(150, $compte->getSolde());
    }

    public function testVirement()
    {
        $c1 = new Compte(new Client("EF789", "Durand", "Marie", "0622222222"));
        $c2 = new Compte(new Client("GH012", "Moreau", "Paul", "0633333333"));
        $c1->credite(300);
        $c2->credite(100, $c1);
        $this->assertEquals(200, $c1->getSolde());
        $this->assertEquals(100, $c2->getSolde());
    }

    public function testNombreComptes()
    {
        $total = Compte::getNombreComptes();
        $this->assertGreaterThanOrEqual(3, $total);
    }
}
