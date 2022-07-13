<?php date_default_timezone_set("Asia/Bangkok");


        require_once '../vendor/autoload.php';
        // $phpWord = new \PhpOffice\PhpWord\PhpWord();

        // /* Note: any element you append to a document must reside inside of a Section. */
        
        // // Adding an empty Section to the document...
        // $section = $phpWord->addSection();
        // // Adding Text element to the Section having font styled by default...
        // $section->addText(
        //     '"ทดสอบ พิมพ์ภาษาไทย เลย '
        //         . 'ว่าได้แค่ไหน" '
        //         . 'ทำได้ไง'
        // );
        
        // /*
        //  * Note: it's possible to customize font style of the Text element you add in three ways:
        //  * - inline;
        //  * - using named font style (new font style object will be implicitly created);
        //  * - using explicitly created font style object.
        //  */
        
        // // Adding Text element with font customized inline...
        // $section->addText(
        //     '"ทดสอบ ครั้งที่ 2 ว่าทำได้ '
        //         . 'แบบตั้ง font " '
        //         . '(ได้สิ)',
        //     array('name' => 'TH SarabunIT๙', 'size' => 17)
        // );
        
        // // Adding Text element with font customized using named font style...
        // $fontStyleName = 'oneUserDefinedStyle';
        // $phpWord->addFontStyle(
        //     $fontStyleName,
        //     array('name' => 'TH SarabunPSK', 'size' => 20, 'color' => '1B2232', 'bold' => true)
        // );
        // $section->addText(
        //     '"ทดสอบ ครั้งที่ 3 ว่าทำได้ '
        //         . 'แบบไทย." '
        //         . '(6598)',
        //     $fontStyleName
        // );
        
        // // Adding Text element with font customized using explicitly created font style object...
        // $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        // $fontStyle->setBold(true);
        // $fontStyle->setName('Tahoma');
        // $fontStyle->setSize(13);
        // $myTextElement = $section->addText('"เชื่อสิทำได้\'มาขนาดนี้." (เมว)');
        // $myTextElement->setFontStyle($fontStyle);
        
        // // Saving the document as OOXML file...
        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        // $objWriter->save('helloWorld.docx');
        
        // // Saving the document as ODF file...
        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
        // $objWriter->save('helloWorld.odt');
        
        // // Saving the document as HTML file...
        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        // $objWriter->save('helloWorld.html');

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('msword/tem1.docx');
        $templateProcessor->setValue('name', 'นายพรรนพ นาคศิริ');
        $templateProcessor->setValue('t1', 'ทดสอบข้อความว่า 123');
        $templateProcessor->setValue('t2', 'ทดสอบข้อความว่า 654');
        $templateProcessor->setValue('t3', 'ทดสอบข้อความว่า 789');
        $templateProcessor->saveAs('msword/tem2.docx');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../jquery/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../jquery/sweetalert2.all.min.js"></script>
    <script src="../axios/dist/axios.min.js"></script>
    <style> 
			  @font-face {
			  font-family: 'Sarabun-Regular';
			  src:  url(../bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.woff) format('woff'), 
				    url(../bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.ttf)  format('truetype'), 
				    url(../bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.svg#Sarabun-Regular) format('svg'),
                    url(../bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.eot) format('embedded-opentype');
			  font-weight: normal;
			  font-style: normal;
						}
                
                @media print {
                    @page { size: A4 landscape; }
                button { visibility: hidden; }
                }

                body {font-family: 'Sarabun-Regular' !important;} 
                thead { 
                    border-top: 5px solid #000;
                    border-bottom: 5px solid #000; 
                }
      
</style>
<script type="text/javascript">
    
        $(document).ready(function(){ 
       

        });

</script>
</head>
<body>
    <div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-10 text-center mt-3">
    <p class="h1 mt-4">ส่งข้อมูล วันนัดพิจาณา ขึ้นหน้าเว็บ</p>
    <p class="h3 mt-4" name="NT" id="NT"></p>

    </div></div></div>   
</body>
</html>