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
    <script type="text/javascript" src="jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    <link rel="stylesheet" href="jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <script type="text/javascript" src="jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
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

            set_vari(4);

            $("#caseB").keypress(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault(); 
                    $("#caseBtn").click();
                } });
    
            $("#caseBtn").click(function(){
                search_casered(4);  
            });

            $("#obt2").change(function(){ 
                $("#saveBtn").attr("disabled", false);
              });

            $("#obt8").change(function(){ 
                $("#obt9").val($("#obt8").val());
              });

            $("#saveBtn").click(function(){
                checkInp_kp($("#obt2").val(),4);
            });

            $("#showBtn").click(function(){
                load_kp(4);  
            });

            $("#editBtn").click(function(){
                update_kp( $(this).attr('data-id'),4);
            });

            $("#editcaseBtn").click(function(){
                update_case_kp(4);
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
        <p class="h5 text-warning">บันทึกหนังสือ ( ค.ป.4 ) --- ( ค.ป.ย.3 )</p>
                    <p class="h4">ค้นหาหมายเลขคดีดำ
                    <input type="text" name="caseB" id="caseB"  value="" autofocus> 
                    <button class="btn btn-light" name="caseBtn" id="caseBtn">ค้นหา</button>
                    <button class="btn btn-light" name="editcaseBtn" id="editcaseBtn">แก้ไข ค.ป.4 </button>
                    <button class="btn btn-light" name="menu_case" id="menu_case">กลับหน้าหลัก</button></p>
        </div>
        

        <div class="col-12 text-light">
            <form name = "form_per" id="form_per" method="post">
                <p class="h6">ข้อมูลจำเลยที่พบจากระบบงาน</p> 
                <div class="col-12 mt-3 data_form_per">
                <table class="table table-bordered table-sm text-light" name="objTable_per" id="objTable_per"></table>
                </div>
            </form>
            </div>
</div>

<form name ="form1" id="form1" method="post">
<div class="form-group row mt-2">

        <div class="col-12">
                    <div class="form-check form-check-inline">
                        <p>  เลือกประเภท 
                        <input class="form-check-input" type="radio" name="obt_kp" id="obt_kp" value=1>
                        <label class="form-check-label text-danger" for="obt_kp"> [ค.ป.] </label>
                        <input class="form-check-input" type="radio" name="obt_kp" id="obt_kp" value=2>
                        <label class="form-check-label text-danger" for="obt_kp"> [ค.ป.ย.] </label>
                        </p>
                    </div>
            </div>


        <div class="col-4">
            <label for="obt1">หมายเลขคดีแดง</label>
            <input class="form-control text-danger" type="text" id="obt1" name="obt1"  value=""> 
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

        <div class="col-2">
            <label for="obt7">จำนวนสำเนา<br>คำพิพากษา (แผ่น)</label> 
            <input class="form-control" type="number" id="obt7" name="obt7"  value="">

        </div>
        <div class="col-4">
            <label for="obt8"><br>วันที่ได้มีคำพิพากษา</label> 
            <input class="form-control" type="text" id="obt8" name="obt8"  value=""> 

        </div>
        <div class="col-4">
            <label for="obt9"><br>วันที่พบคุมประพฤติ</label> 
            <input class="form-control" type="text" id="obt9" name="obt9"  value=""> 
        </div>
        <div class="col-2">
            <label for="obt10"><br>เวลาพบคุมประพฤติ</label> 
            <input class="form-control" type="text" id="obt10" name="obt10" maxlength="5" value=""> 
         </div>

         <div class="col-12 mt-2 bg-secondary text-light"><p>ข้อมูลที่อยู่จำเลย</p> 
         <input type="hidden" id="case_bid" name="case_bid" value=""></div>

        <div class="col-2">
            <label for="obt11">บ้านเลขที่</label> 
            <input class="form-control" type="text" id="obt11" name="obt11"  value="">
        </div>
        <div class="col-1">
            <label for="obt12">หมู่</label> 
            <input class="form-control" type="number" id="obt12" name="obt12"  value="">
        </div>
        <div class="col-3"> 
            <label for="obt13">ถนน</label> 
            <input class="form-control" type="text" id="obt13" name="obt13"  value=""> 
        </div>
        <div class="col-3">
            <label for="obt14">ตรอก/ซอย</label> 
            <input class="form-control" type="text" id="obt14" name="obt14"  value=""> 
        </div>

        <div class="col-3">
            <label for="obt15">ตำบล/แขวง</label> 
            <input class="form-control" type="text" id="obt15" name="obt15"  value=""> 
        </div>
        <div class="col-3">
            <label for="obt16">อำเภอ/เขต</label> 
            <input class="form-control" type="text" id="obt16" name="obt16"  value=""> 
        </div>        
        <div class="col-3">
            <label for="obt17">จังหวัด</label> 
            <input class="form-control" type="text" id="obt17" name="obt17"  value=""> 
        </div>

        <div class="col-2">
            <label for="obt18">รหัสไปรษณีย์</label> 
            <input class="form-control" type="number" id="obt18" name="obt18" onKeyPress="if(this.value.length==5) return false;" value=""> 
        </div>
        <div class="col-2">    
            <label for="obt19">เบอร์โทรศัพท์</label> 
            <input class="form-control" type="number" id="obt19" name="obt19" onKeyPress="if(this.value.length==10) return false;" value=""> 
        </div>

        <div class="col-4">
            <label for="obt20">ลงชื่อหนังสือ</label>
            <input class="form-control" type="text" id="obt20" name="obt20"  value=""> 
        </div>
        <div class="col-4">
            <label for="obt21">ตำแหน่ง</label>
            <input class="form-control" type="text" id="obt21" name="obt21"  value=""> 
        </div>
        <div class="col-4">
            <label for="obt22">ตำแหน่ง(2)</label>
            <input class="form-control" type="text" id="obt22" name="obt22"  value=""> 
        </div>
        
</div>
</form>

<div class="row">

        <div class="col-12 text-center">
                    <button class="btn btn-danger" name="saveBtn" id="saveBtn" >บันทึกข้อมูล</button>
                    <button class="btn btn-warning" name="editBtn" id="editBtn" data-id="">แก้ไขข้อมูล</button>
                    <button class="btn btn-success" name="showBtn" id="showBtn" data-id="">แสดงเอกสาร</button>
        </div>

</div>              
</div>
</body>
</html>