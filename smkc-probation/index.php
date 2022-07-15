<?php date_default_timezone_set("Asia/Bangkok");


        // require_once '../vendor/autoload.php';

        // $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word-tmp/formkp1.docx');
        // $templateProcessor->setValue('numbook', 'E19999');
        // $templateProcessor->setValue([
        //     't1','t2','t3','t4','t5','t6','t7','t9','t10',
        //     't11','t12','t13','t14','t15','t16','t17','t18','t19','t20'
        // ],[
        //     date("d"),date("mm"),date("yyyy"),'ผู้อำนวยการสำนักงานคุมประพฤติจังหวัดสมุทรสงคราม','1','-','อ998/65','16','กรกฎาคม',
        //     '2565','นายจำเลยทดสอบ มาเบิกตัว','9-9999-99999-99-1','16','สิงหาคม','2565','10.00',
        //     'นายผู้อำนวยการ','ตำแหน่งผู้อำนวยการ','ตำแหน่งบรรทัดสอง'
        // ] );
        // $no = date("Y-m-d");
        // $templateProcessor->saveAs('word-result/formkp1-fill'.$no.'.docx');
        // $url = 'msword/formkp1-fill'.$no.'.docx';
        // $file_name = basename($url);
        // if (file_put_contents($file_name, file_get_contents($url)))
        //     {
        //         echo "File downloaded successfully";
        //     }
        //     else
        //     {
        //         echo "File downloading failed.";
        //     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" charset="UTF-8">
    <meta name="viewport" content="text/html, width=device-width, initial-scale=1.0">
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../jquery/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../jquery/sweetalert2.all.min.js"></script>
    <title>SmkcProbation</title>
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
                body {font-family: 'Sarabun-Regular' !important;} 
                thead { 
                    border-top: 5px solid #000;
                    border-bottom: 5px solid #000; 
                }
      
</style>
<script type="text/javascript">
    
        $(document).ready(function(){ 
            $.getJSON('court.json', function(msg) { 
                $("#courtN").html(msg.courtN); }); 
                let sameDay = new Date();
                $("#dN").html(sameDay.toLocaleDateString("th-TH"));
                $("#1Btn").click(function(){
                    window.location.href ="kp1.php"; });
                $("#2Btn").click(function(){
                     });
                $("#3Btn").click(function(){
                     });
                $("#4Btn").click(function(){
                     });
                $("#5Btn").click(function(){
                     });
                $("#6Btn").click(function(){
                     });
                $("#7Btn").click(function(){
                     });
                $("#8Btn").click(function(){
                     });
                $("#9Btn").click(function(){
                     });
                $("#10Btn").click(function(){
                     });
        
            // $('a#t1').attr({target: '_blank', 
            //         href  : 'word-result/formkp1-fill.docx'});
        });

</script>
</head>
<body>
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-3 text-right"><img src="img/coj1.png" alt width="80"></div>
            <div class="col-7 text-left">
                <p class="h3 mt-4" name="courtN" id="courtN"></p>
                <a>บันทึกข้อมูล ค.ป.1-6 และ  ค.ป.ย.1-5 </a>
                <a>ข้อมูล ณ วันที่ </a><a class="h5 text-danger" name="dN" id="dN"></a>
            </div>
    </div>


    <div class="row justify-content-center">

    <div class="col-4 text-center">
    <button class="btn btn-primary btn-block mt-3" name="1Btn" id="1Btn">ค.ป.1 <br> หนังสือให้สืบเสาะและพินิจ</button>
    <button class="btn btn-primary btn-block mt-3" name="4Btn" id="4Btn">ค.ป.5 <br> หนังสือแจ้งการเปลี่ยนแปลงคำพิพากษาหรือคำสั่ง </button>
    </div>

    <div class="col-4 text-center">
    <button class="btn btn-primary btn-block mt-3" name="2Btn" id="2Btn">ค.ป.2 <br> หนังสือให้สืบเสาะและพินิจ (เพิ่มเติม)</button>
    <button class="btn btn-primary btn-block mt-3" name="5Btn" id="5Btn">ค.ป.6 <br> หนังสือแจ้งงดการสืบเสาะและพินิจ</button>
    </div>

    <div class="col-4 text-center">
    <button class="btn btn-primary btn-block mt-3" name="3Btn" id="3Btn">ค.ป.4 <br> หนังสือแจ้งคำพิพากษา</button>
    </div>

    <div class="col-4 text-center">
    <button class="btn btn-warning btn-block mt-3" name="6Btn" id="6Btn">ค.ป.ย.1 <br> หนังสือให้แสวงหาข้อเท็จจริง</button>    
    <button class="btn btn-warning btn-block mt-3" name="9Btn" id="9Btn">ค.ป.ย.4 <br> หนังสือแจ้งการแก้ไขเปลี่ยนแปลงคำพิพากษาหรือคำสั่ง</button>
    </div>

    <div class="col-4 text-center">
    <button class="btn btn-warning btn-block mt-3" name="7Btn" id="7Btn">ค.ป.ย.2 <br> หนังสือให้แสวงหาข้อเท็จจริง (เพิ่มเติม)</button>
    <button class="btn btn-warning btn-block mt-3" name="10Btn" id="10Btn">ค.ป.ย.5 <br> หนังสือแจ้งงดการแสวงหาข้อเท็จจริง</button>
    </div>

    <div class="col-4 text-center">
    <button class="btn btn-warning btn-block mt-3" name="8Btn" id="8Btn">ค.ป.ย.3 <br> หนังสือแจ้งคำพิพากษา</button> 
    </div>

    </div>
    
</div> 
</body>
</html>