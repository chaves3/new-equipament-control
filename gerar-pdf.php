<?php


ob_start();

include("templateEmprestimo.php");

$conteudo = ob_get_contents();

ob_end_clean();

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($conteudo);
$mpdf->Output();



