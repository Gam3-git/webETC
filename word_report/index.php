<?php date_default_timezone_set("Asia/Bangkok");


        require_once '../vendor/autoload.php';

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('msword/formkp1.docx');
        $templateProcessor->setValue('numbook', 'E19999');
        $templateProcessor->setValue([
            't1','t2','t3','t4','t5','t6','t7','t9','t10',
            't11','t12','t13','t14','t15','t16','t17','t18','t19','t20'
        ],[
            date("d"),date("mm"),date("yyyy"),'ผู้อำนวยการสำนักงานคุมประพฤติจังหวัดสมุทรสงคราม','1','-','อ998/65','16','กรกฎาคม',
            '2565','นายจำเลยทดสอบ มาเบิกตัว','9-9999-99999-99-1','16','สิงหาคม','2565','10.00',
            'นายผู้อำนวยการ','ตำแหน่งผู้อำนวยการ','ตำแหน่งบรรทัดสอง'
        ] );
        $no = date("Y-m-d");
        $templateProcessor->saveAs('msword/formkp1-fill'.$no.'.docx');
        $url = 'msword/formkp1-fill'.$no.'.docx';
        $file_name = basename($url);
        if (file_put_contents($file_name, file_get_contents($url)))
            {
                echo "File downloaded successfully";
            }
            else
            {
                echo "File downloading failed.";
            }
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
            $('a#t1').attr({target: '_blank', 
                    href  : 'msword/formkp1-fill.docx'});
        });

</script>
</head>
<body>
    <div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-10 text-center mt-3">
    <a id="t1" class="h1 mt-4">ส่งข้อมูล วันนัดพิจาณา ขึ้นหน้าเว็บ</a>
    <p class="h3 mt-4" name="NT" id="NT"></p>

    </div></div></div>   
</body>
</html>