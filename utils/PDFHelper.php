<?php
namespace utils;

use Dompdf\Dompdf;

class PDFHelper
{
    public static function generatePDF($htmlContent, $fileName = 'document.pdf')
    {
        // Instancia o Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($htmlContent);

        // (Opcional) Configura o tamanho do papel e a orientação
        $dompdf->setPaper('A4', 'landscape');

        // Renderiza o HTML como PDF
        $dompdf->render();

        // Envia o PDF gerado para o navegador
        $dompdf->stream($fileName, ["Attachment" => false]);
    }
}
