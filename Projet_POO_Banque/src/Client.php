<?php

namespace App;

class Client
{
    private string $cin;
    private string $nom;
    private string $prenom;
    private string $tel;

    public function __construct($cin, $nom, $prenom, $tel)
    {
        $this->cin = $cin;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->tel = $tel;
    }

    public function getCin() { return $this->cin; }
    public function setCin($cin) { $this->cin = $cin; }

    public function getNom() { return $this->nom; }
    public function setNom($nom) { $this->nom = $nom; }

    public function getPrenom() { return $this->prenom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }

    public function getTel() { return $this->tel; }
    public function setTel($tel) { $this->tel = $tel; }

    public function afficher()
    {
        return "CIN: {$this->cin}, Nom: {$this->nom}, Prénom: {$this->prenom}, Tél: {$this->tel}";
    }
}
