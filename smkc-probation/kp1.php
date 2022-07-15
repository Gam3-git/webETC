<?php date_default_timezone_set("Asia/Bangkok");
?>
<html>
<head>
    <meta http-equiv="Content-Type" charset="UTF-8">
    <meta name="viewport" content="text/html, width=device-width, initial-scale=1.0">
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap-datepicker-thai/css/datepicker.css" rel="stylesheet">
    <script src="../jquery/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../jquery/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="../bootstrap-datepicker-thai/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js"></script>
    <script type="text/javascript" src="../bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js"></script>
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
<script type="text/javascript" src="probation_obj.js"></script>
<script type="text/javascript">

            $(document).ready(function(){

            set_vari(1);

            $("#caseB").keypress(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault(); 
                    $("#caseBtn").click();
                } });
    
            $("#caseBtn").click(function(){
                search_case(1);  
            });

            $("#obt2").change(function(){ 
                $("#saveBtn").attr("disabled", false);
              });

            $("#saveBtn").click(function(){
                checkInp_kp1($("#obt2").val(),1);
            });

            $("#showBtn").click(function(){
                load_kp1();  
            });

            $("#menu_case").click(function(){
                window.location.href ="index.php"; });


            });

</script>
</head>
<body>
<div class="container">
<div class="row pt-4 bg-dark">

        <div class="col-12 text-light text-center">
            <p class="h5 text-warning">บันทึกหนังสือให้สืบเสาะและพินิจ [ ค.ป.1 ]</p>
                    <p class="h4">ค้นหาหมายเลขคดีดำ
                    <input type="text" name="caseB" id="caseB"  value="" autofocus> 
                    <button class="btn btn-light" name="caseBtn" id="caseBtn">ค้นหา</button>
                    <button class="btn btn-light" name="menu_case" id="menu_case">กลับหน้าหลัก</button></p>
        </div>
        

        <div class="col-12 text-light">
            <form name = "form_per" id="form_per" method="post">
                <p sclass="h3">ข้อมูลจำเลยที่พบจากระบบงาน</p> 
                <div class="col-12 mt-3 data_form_per">
                <table class="table table-bordered table-sm text-light" name="objTable_per" id="objTable_per"></table>
                </div>
            </form>
            </div>
</div>

<form name ="form1" id="form1" method="post">
<div class="form-group row mt-2">

        <div class="col-4">
            <label for="obt1">หมายเลขคดีดำ</label>
            <input class="form-control" type="text" id="obt1" name="obt1"  value=""> 
            <label for="obt2">เลขหนังสือ</label> 
            <input class="form-control" type="number" id="obt2" name="obt2"  value="" required> 
            <label for="obt3">วันที่หนังสือ</label> 
            <input class="form-control" type="text" id="obt3" name="obt3"  value=""> 
        </div>

        <div class="col-8">
            <label for="obt4">ชื่อจำเลย</label>
            <input class="form-control" type="text" id="obt4" name="obt4"  value="">  
            <label for="obt5">เลขบัตรประชาชน (ใส่เฉพาะตัวเลข)</label> 
            <input class="form-control" type="number" id="obt5" name="obt5" onKeyPress="if(this.value.length==13) return false;" value=""> 
            <label for="obt6">เรียน</label> 
            <input class="form-control" type="text" id="obt6" name="obt6"  value="">             
        </div>

        <div class="col-3">
            <label for="obt7"><br>วันที่คำสั่งศาล</label> 
            <input class="form-control" type="text" id="obt7" name="obt7"  value=""> 
        </div>
        <div class="col-3">
            <label for="obt8"><br>วันที่พบคุมประพฤติ</label> 
            <input class="form-control" type="text" id="obt8" name="obt8"  value=""> 
        </div>
        <div class="col-2">
            <label for="obt9">เวลาพบคุมประพฤติ<br>(09.00)</label> 
            <input class="form-control" type="text" id="obt9" name="obt9" maxlength="5" value=""> 
        </div>
        <div class="col-2">
            <label for="obt10">จำนวนสำเนา<br>คำฟ้อง (แผ่น)</label> 
            <input class="form-control" type="number" id="obt10" name="obt10"  value="">
        </div>
        <div class="col-2">
            <label for="obt11">จำนวนสำเนารายงาน<br>กระบวนพิจารณา (แผ่น)</label> 
            <input class="form-control" type="number" id="obt11" name="obt11"  value="">
        </div>

        <div class="col-4">
            <label for="obt12">ลงชื่อหนังสือ</label>
            <input class="form-control" type="text" id="obt12" name="obt12"  value=""> 
        </div>
        <div class="col-4">
            <label for="obt13">ตำแหน่ง</label>
            <input class="form-control" type="text" id="obt13" name="obt13"  value=""> 
        </div>
        <div class="col-4">
            <label for="obt14">ตำแหน่ง(2)</label>
            <input class="form-control" type="text" id="obt14" name="obt14"  value=""> 
        </div>
  
</div>
</form>

<div class="row">

        <div class="col-12 text-center">
                    <button class="btn btn-danger" name="saveBtn" id="saveBtn">บันทึกข้อมูล</button>
                    <button class="btn btn-success" name="showBtn" id="showBtn">แสดงเอกสาร</button>
        </div>

</div>              
</div>
</body>
</html>