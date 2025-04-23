<?php

use PHPUnit\Framework\TestCase;
use App\Produit;

class ProduitTest extends TestCase
{
    public function testCalculerTTC()
    {
        $produit = new Produit("AB123", "Produit Test", 100, "vêtement", 10);
        $this->assertEquals(120, $produit->calculerTTC());
    }

    public function testValeurEnStock()
    {
        $produit = new Produit("AB123", "Produit Test", 50, "appareil", 4);
        $this->assertEquals(200, $produit->valeurEnStock());
    }

    public function testSolde()
    {
        $produit = new Produit("AB123", "Produit Test", 100, "vêtement", 1);
        $this->assertEquals(80, $produit->solde(20));
    }

    public function testReferenceIncorrecte()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Produit("123", "Produit", 50, "appareil", 1);
    }

    public function testPrixNegatif()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Produit("AB123", "Produit", -10, "nettoyage", 1);
    }

    public function testTypeInvalide()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Produit("AB123", "Produit", 50, "jouet", 1);
    }

    public function testStockNegatif()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Produit("AB123", "Produit", 50, "nettoyage", -1);
    }
}
