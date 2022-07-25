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
                    window.location.href ="kp2.php"; });
                $("#3Btn").click(function(){
                    window.location.href ="kp4.php"; });
                $("#4Btn").click(function(){
                    window.location.href ="kp5.php"; });
                $("#5Btn").click(function(){
                    window.location.href ="kp6.php"; });
                    Swal.fire({ title: "วิธีใช้",
                html: 'ค้นหาเลขคดีดำ เพื่อดึงชื่อจำเลย <br>หรือ บันทึกข้อมูลเองโดยไม่ค้นหาก็ได้ <br><br> กรณีเคยบันทึก คป ผ่านระบบนี้แล้วต้องการแก้ไข ให้ค้นหาจากเลขดำ แล้วกดปุ่มแก้ไข <br><br> ต้องออกเลขหนังสือก่อน บันทึก เพื่อป้องกันเลขหนังสือกับเอกสารไม่ตรงกัน ' ,
                });
               
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

    <div class="col-6 text-center">
    <button class="btn btn-primary btn-block mt-3" name="1Btn" id="1Btn"><h4>หนังสือให้สืบเสาะและพินิจ (ค.ป.1) <br><br> หนังสือให้แสวงหาข้อเท็จจริง (ค.ป.ย.1)</h4></button>
    <button class="btn btn-info btn-block mt-3" name="2Btn" id="2Btn"><h4>หนังสือให้สืบเสาะและพินิจ(เพิ่มเติม) (ค.ป.2) <br><br>  หนังสือให้แสวงหาข้อเท็จจริง(เพิ่มเติม) (ค.ป.ย.2)</h4></button>
    <button class="btn btn-primary btn-block mt-3" name="3Btn" id="3Btn"><h4>หนังสือแจ้งคำพิพากษา (ค.ป.4) <br><br> หนังสือแจ้งคำพิพากษา (ค.ป.ย.3)</h4></button>
    <button class="btn btn-info btn-block mt-3" name="4Btn" id="4Btn"><h4>หนังสือแจ้งการเปลี่ยนแปลงคำพิพากษาหรือคำสั่ง (ค.ป.5) <br><br> หนังสือแจ้งการแก้ไขเปลี่ยนแปลงคำพิพากษาหรือคำสั่ง (ค.ป.ย.4)</h4></button>
    <button class="btn btn-primary btn-block mt-3" name="5Btn" id="5Btn"><h4>หนังสือแจ้งงดการสืบเสาะและพินิจ (ค.ป.6) <br><br> หนังสือแจ้งงดการแสวงหาข้อเท็จจริง (ค.ป.ย.5)</h4></button>
    </div>
    </div>
    
</div> 
</body>
</html>