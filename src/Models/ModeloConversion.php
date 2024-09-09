<?php

namespace App\Models;

class ModeloConversion
{
    // Tasas de conversión predefinidas
    private $tasasMoneda = [
        'USD' => 4.167,
        'EUR' => 4.623,
        'GBP' => 5.313,
        'JPY' => 0.031
    ];
    public function conversionMoneda($cantidad, $moneda)
    {
        if (isset($this->tasasMoneda[$moneda])) {
            $tasa = $this->tasasMoneda[$moneda];
            return $cantidad * $tasa;
        } else {
            throw new \Exception("La moneda $moneda no está soportada.");
        }
    }
    

    // Método para calcular el área de un círculo
    public function calcularAreaCirculo($radio)
    {
        return pi() * pow($radio, 2);  // Fórmula: π * radio^2
    }
}
