<?php

namespace App;

use InvalidArgumentException;

class Produit
{
    private string $reference;
    private string $libelle;
    private float $prix;
    private string $type;
    private int $stock;

    public const TVA = [
        '0.05' => ['alimentation', 'nettoyage'],
        '0.2' => ['vêtement', 'appareil']
    ];

    public function __construct($reference, $libelle, $prix, $type, $stock)
    {
        $this->setReference($reference);
        $this->libelle = $libelle;
        $this->setPrix($prix);
        $this->setType($type);
        $this->setStock($stock);
    }

    public function setReference($reference)
    {
        if (!preg_match('/^[A-Z]{2,}/', $reference)) {
            throw new InvalidArgumentException("La référence doit commencer par au moins deux lettres majuscules.");
        }
        $this->reference = $reference;
    }

    public function getReference() { return $this->reference; }

    public function setPrix($prix)
    {
        if ($prix < 0) {
            throw new InvalidArgumentException("Le prix ne peut pas être négatif.");
        }
        $this->prix = $prix;
    }

    public function getPrix() { return $this->prix; }

    public function setType($type)
    {
        $types = array_merge(...array_values(self::TVA));
        if (!in_array($type, $types)) {
            throw new InvalidArgumentException("Type invalide.");
        }
        $this->type = $type;
    }

    public function getType() { return strtoupper($this->type); }

    public function setStock($stock)
    {
        if ($stock < 0) {
            throw new InvalidArgumentException("Le stock ne peut pas être négatif.");
        }
        $this->stock = $stock;
    }

    public function getStock() { return $this->stock; }

    public function getLibelle() { return $this->libelle; }

    public function valeurEnStock() {
        return $this->prix * $this->stock;
    }

    public function calculerTTC()
    {
        foreach (self::TVA as $taux => $types) {
            if (in_array($this->type, $types)) {
                return $this->prix * (1 + (float)$taux);
            }
        }
        throw new InvalidArgumentException("TVA non trouvée pour ce type.");
    }

    public function solde($pourcentage)
    {
        return $this->prix * (1 - $pourcentage / 100);
    }
}
