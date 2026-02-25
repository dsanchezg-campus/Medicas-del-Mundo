<?php

class Videojuego {
    private $nombre;
    private $plataforma;
    private $presupuesto;
    function __construct($nombre, $plataforma, $presupuesto) {
        $this->nombre = $nombre;
        $this->plataforma = $plataforma;
        if ($presupuesto == "A" || $presupuesto == "AA" || $presupuesto == "AAA") {
            $this->presupuesto = $presupuesto;
        }
    }

}