<?php date_default_timezone_set("Asia/Bangkok");?>
<html>
<head>
    <meta http-equiv="Content-Type" charset="UTF-8">
    <meta name="viewport" content="text/html, width=device-width, initial-scale=1.0">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bootstrap/dist/css/animate.min.css">
    <script src="jquery/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="jquery/sweetalert2.all.min.js"></script>
    <title>SmkcPortal</title>
    <style> 
			  @font-face {
			  font-family: 'Kanit-Regular';
			  src:url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.eot) format('embedded-opentype');
			  font-weight: normal;
			  font-style: normal;
						}

			  @font-face {
			  font-family: 'Kanit-Regular';
			  src:  url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.woff) format('woff'), 
				    url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.ttf)  format('truetype'), 
				    url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.svg#Kanit-Regular) format('svg');
			  font-weight: normal;
			  font-style: normal;
						}

			body {font-family: 'Kanit-Regular' !important;} 
         </style>
<script type="text/javascript">
            $(document).ready(function(){

                $.getJSON('court.json', function(msg) { 
                $("#courtN").html(msg.courtN); });

			$("#1Btn").click(function(){
				window.open("https://10.37.78.12/praxticol85-coj", "_blank"); });
			$("#2Btn").click(function(){
				window.open("http://10.37.76.250:9090/access2praxticol", "_blank"); });
            $("#3Btn").click(function(){
				window.open("http://10.37.76.250:9090/gdms/login", "_blank"); });
            $("#4Btn").click(function(){
				window.open("http://10.37.76.250:9090/webETC/case_post.php", "_blank"); });
            $("#5Btn").click(function(){
				window.open("http://10.37.76.250:9090/access2search", "_blank"); });
            $("#6Btn").click(function(){
				window.open("http://10.37.76.250:9090/webETC/EcourtC.php", "_blank"); });
            $("#7Btn").click(function(){
				window.open("http://10.37.76.250:9090/webETC/sendL.php", "_blank"); });
            $("#8Btn").click(function(){
				window.open("http://10.37.76.250:9090/webETC/remain_case.php", "_blank"); });
            $("#9Btn").click(function(){
				window.open("http://10.37.76.2:8089/coj/login", "_blank"); });
            $("#10Btn").click(function(){
				window.open("http://10.37.76.250:9090/webETC/smkc-probation", "_blank"); });
     
         

            
            $("#MTBtn").click(function(){
				window.open("http://smkc.coj.go.th/th/weblink/item/index/id/184", "_blank"); });
            $("#MBBtn").click(function(){
				window.open("http://smkc.coj.go.th/th/page/item/index/id/1", "_blank"); });
                
           

            });

</script>
<body>
    <div class="container-fluid animate__animated animate__zoomInDown">

    <div class="row justify-content-center bg-light">
    <div class="col-3 text-right"><img src="img/coj1.png" alt width="80"></div>
    <div class="col-7 text-left">
	<p class="h3 mt-4" name="courtN" id="courtN"></p><a>   รวมระบบงาน เฉพาะระบบภายในศาล</a>
    </div></div>

    <div class="row justify-content-center">
    <div class="col-12 text-center">
    <button class="btn btn-lg btn-primary btn-lg btn-block" name="MTBtn" id="MTBtn"><span><i class="fa-solid fa-scale-balanced fa-1x"></i></span>  ระบบงานส่วนกลาง</button>
    </div></div>
    <div class="row justify-content-center"><div class="col-3 text-center">
    <button class="btn btn-lg btn-Secondary btn-lg btn-block mt-3" name="1Btn" id="1Btn"><span><i class="fa-solid fa-file-contract fa-2x"></i></span><br>ระบบ E-CMS (แนบเอกสารแสกน)</button>
	<button class="btn btn-lg btn-Secondary btn-lg btn-block mt-3" name="2Btn" id="2Btn"><span><i class="fa-solid fa-file-contract fa-2x"></i></span><br>ระบบแสกน(ตั้งต้นคดี)</button>
   <button class="btn btn-lg btn-Secondary btn-lg btn-block mt-3" name="9Btn" id="9Btn"><span><i class="fa-solid fa-university fa-2x"></i></span><br>ระบบงาน (ระยะ 3)</button>
   
    </div><div class="col-3 text-center">
    <button class="btn btn-lg btn-Danger btn-lg btn-block mt-3" name="3Btn" id="3Btn"><span><i class="fa-solid fa-book fa-2x"></i></span><br>ระบบ GDMS (หนังสือเวียนภายใน)</button>
    <button class="btn btn-lg btn-Danger btn-lg btn-block mt-3" name="4Btn" id="4Btn"><span><i class="fa-solid fa-square-envelope fa-2x"></i></span><br>ติดตามผลไปรษณีย์ </button>
    
    </div><div class="col-3 text-center">
    <button class="btn btn-lg btn-Success btn-lg btn-block mt-3" name="5Btn" id="5Btn"><span><i class="fa-solid fa-magnifying-glass fa-2x"></i></span><br>ค้นหาข้อมูลคดี</button>
    <button class="btn btn-lg btn-Success btn-lg btn-block mt-3" name="6Btn" id="6Btn"><span><i class="fa-solid fa-chalkboard-user fa-2x"></i></span><br> บันทึกคดีออนไลน์</button>
    <button class="btn btn-lg btn-Success btn-lg btn-block mt-3" name="10Btn" id="10Btn"><span><i class="fa-solid fa-id-badge fa-2x"></i></span><br> บันทึก ค.ป. และ ค.ป.ย. </button>

    </div><div class="col-3 text-center">
    <button class="btn btn-lg btn-Warning btn-lg btn-block mt-3" name="8Btn" id="8Btn"><span><i class="fa-solid fa-file-excel fa-2x"></i></span><br>ข้อมูลคดีค้าง</button>
    <button class="btn btn-lg btn-Warning btn-lg btn-block mt-3" name="7Btn" id="7Btn"><span><i class="fa-regular fa-comment fa-2x"></i></span><br> แจ้งเตือน Line</button>
   
   </div></div>
    <div class="row justify-content-center">
    <div class="col-12 text-center">
    <button class="btn btn-lg btn-primary btn-lg btn-block mt-3" name="MBBtn" id="MBBtn"><span><i class="fa-solid fa-bank fa-1x"></i></span>  เว็บศาลจังหวัดสมุทรสงคราม</button>
    </div></div>

    </div>   
</body>
</html>