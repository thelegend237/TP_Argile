<?php

namespace App;

class Compte
{
    private static int $nbComptes = 0;
    private int $code;
    private float $solde;
    private Client $proprietaire;

    public function __construct(Client $client)
    {
        self::$nbComptes++;
        $this->code = self::$nbComptes;
        $this->solde = 0;
        $this->proprietaire = $client;
    }

    public function getCode() { return $this->code; }

    public function getSolde() { return $this->solde; }
    public function setSolde($solde) { $this->solde = $solde; }

    public function getProprietaire() { return $this->proprietaire; }
    public function setProprietaire(Client $client) { $this->proprietaire = $client; }

    public function credite(float $montant, Compte $source = null)
    {
        if ($montant > 0) {
            $this->solde += $montant;
            if ($source !== null) {
                $source->debite($montant);
            }
        }
    }

    public function debite(float $montant, Compte $destination = null)
    {
        if ($montant > 0 && $montant <= $this->solde) {
            $this->solde -= $montant;
            if ($destination !== null) {
                $destination->credite($montant);
            }
        }
    }

    public function afficherResume()
    {
        return "Compte N°{$this->code}, Solde: {$this->solde}€, Propriétaire: " . $this->proprietaire->afficher();
    }

    public static function getNombreComptes()
    {
        return self::$nbComptes;
    }
}
