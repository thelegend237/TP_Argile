<?php
use DateTime;

class salarie
{
    private int $matricule;
    private string $nomComplet;
    private float $salaire;
    public static float $tauxCS = 20;
    private DateTime $dateEmbauche;

    public function __construct(int $matricule = 0, string $nomComplet = "", float $salaire = 0, $dateEmbauche = "")
    {
        $this->matricule = $matricule;
        $this->nomComplet = $nomComplet;
        $this->salaire = $salaire;
        $this->dateEmbauche = $dateEmbauche != "" ? new DateTime($dateEmbauche) : new DateTime("now");
    }

    public function setMatricule(int $matricule): void
    {
        if (!preg_match("/^\d{3,7}$/", $matricule)) {
            throw new Exception("Matricule invalide!");
        }
        $this->matricule = $matricule;
    }

    public function getMatricule(): int { return $this->matricule; }

    public function getDateEmbauche() { return $this->dateEmbauche; }

    public function experience()
    {
        $today = new DateTime("now");
        $difference = $this->dateEmbauche->diff($today);
        return $difference->format("%y");
    }

    public function calculerSalaireNet(): float
    {
        return $this->salaire - ($this->salaire * self::$tauxCS / 100);
    }

    public function primeAnnuelle(): float
    {
        return $this->salaire * 0.8 + 100 * $this->experience();
    }
}
