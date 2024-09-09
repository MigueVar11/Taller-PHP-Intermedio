<?php

namespace App\Controllers;


use App\Models\ModeloConversion;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use setasign\Fpdi\Fpdi;

class ControladorPrincipal
{
    // Atributo para el modelo de conversión
    private $conversion;

    public function __construct()
    {
        $this->conversion = new ModeloConversion();
    }

    public function convertirMoneda($cantidad, $moneda)
    {
        try {
            return $this->conversion->conversionMoneda($cantidad, $moneda);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    // Método para calcular el área de un círculo
    public function calcularAreaCirculo($radio)
    {
        return $this->conversion->calcularAreaCirculo($radio);
    }

    // Método para generar el PDF
    public function generarPDF($contenido)
    {
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, 'Resultados Matematicos', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(190, 10, $contenido, 0, 1);

        $nombreArchivo = 'resultados_matematicos.pdf';
        $pdf->Output('F', $nombreArchivo);  // Guarda el archivo en el servidor

        return $nombreArchivo;
    }

    // Método para enviar correo con el PDF adjunto
    public function enviarCorreo($emailDestino, $contenido)
    {
        // (en este caso usando SMTP)
        $transport = Transport::fromDsn('smtp://miguelvamo11@gmail.com:brxhppfnmuwyfcof@smtp.gmail.com:587');
        $mailer = new Mailer($transport);

        // Generar el PDF con los resultados
        $nombreArchivo = $this->generarPDF($contenido);

        // Crear el correo electrónico
        $email = (new Email())
            ->from('miguelvamo11@gmail.com')
            ->to($emailDestino)
            ->subject('Resultados Matemáticos')
            ->text('Adjunto encontrarás el PDF con los resultados matematicos.')
            ->attachFromPath($nombreArchivo);

        // Enviar el correo
        $mailer->send($email);

        echo "Correo enviado a $emailDestino con el archivo PDF adjunto.";
    }
}
