<?php date_default_timezone_set("Asia/Bangkok");?>
<?php

use setasign\Fpdi\Fpdi;
require('fpdf/fpdf.php');
require('fpdi/src/autoload.php');
// initiate FPDI
$pdf = new Fpdi();
// get the page count
$pageCount = $pdf->setSourceFile('temp/ss1.pdf');
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
   $templateId = $pdf->importPage($pageNo);
   // add a page
   $pdf->AddPage('P' ,'A4');
   $pdf->useTemplate($templateId, ['adjustPageSize' => true]);
   $pdf->AddFont('THSarabunNew','','THSarabunNew.php');
   $pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
   $pdf->SetFont('THSarabunNew','',16);
   $pdf->SetTextColor(255, 0, 0);
   $pdf->SetXY(148, 24);
   $pdf->Write(0, iconv('UTF-8', 'cp874', 'ทดสอบการพิมพ์'));
   $pdf->SetXY(148, 32);
   $pdf->Write(0, iconv('UTF-8', 'cp874', 'ทดสอบการพิมพ์2'));
   $pdf->SetFont('zapfdingbats', '', 16);
   $pdf->SetXY(148, 42);
   $pdf->Write(0, '3');
}

$pdf->Output();

?>