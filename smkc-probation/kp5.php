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

            set_vari(5);

            $("#caseB").keypress(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault(); 
                    $("#caseBtn").click();
                } });
    
            $("#caseBtn").click(function(){
                search_casekp(5);  
            });

            $("#obt2").change(function(){ 
                $("#saveBtn").attr("disabled", false);
              });

            $("#saveBtn").click(function(){
                checkInp_kp($("#obt2").val(),5);
            });

            $("#showBtn").click(function(){
                load_kp(5);  
            });
            $("#editBtn").click(function(){
                update_kp( $(this).attr('data-id'),5); 
            });
            
            $("#editcaseBtn").click(function(){
                update_case_kp(5);
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
        <p class="h5 text-warning">บันทึกหนังสือ ( ค.ป.5 ) --- ( ค.ป.ย.4 )</p>
                    <p class="h4">ค้นหาหมายเลขคดีดำ
                    <input type="text" name="caseB" id="caseB"  value="" autofocus> 
                    <button class="btn btn-light" name="caseBtn" id="caseBtn">ค้นหา</button>
                    <button class="btn btn-light" name="editcaseBtn" id="editcaseBtn">แก้ไข ค.ป.5 </button>
                    <button class="btn btn-light" name="menu_case" id="menu_case">กลับหน้าหลัก</button></p>
        </div>
        

        <div class="col-12 text-light">
            <form name = "form_per" id="form_per" method="post">
                <p class="h6">ข้อมูลที่พบจากระบบงาน</p> 
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

        <div class="col-4"> <input type="hidden" id="case_bid" name="case_bid" value="">
            <label for="obt1">หมายเลขคดีแดง</label>
            <input class="form-control text-danger" type="text" id="obt1" name="obt1"  value=""> 
            <label for="obt2">เลขหนังสือ</label> 
            <input class="form-control" type="number" id="obt2" name="obt2"  value="" required>  
        </div>

        <div class="col-8">
            <label for="obt3">ชื่อจำเลย</label>
            <input class="form-control" type="text" id="obt3" name="obt3"  value=""> 
            <label for="obt4">เรียน</label> 
            <input class="form-control" type="text" id="obt4" name="obt4"  value="">  
        </div>

        <div class="col-4">
            <label for="obt5">วันที่หนังสือ</label> 
            <input class="form-control" type="text" id="obt5" name="obt5"  value="">
        </div>
        <div class="col-4">
            <label for="obt6">วันที่คำสั่งศาล(แจ้งการเปลี่ยนแปลง)</label> 
            <input class="form-control" type="text" id="obt6" name="obt6"  value=""> 
        </div>
        <div class="col-4">            
            <label for="obt7">จำนวนสำเนาคำพิพากษา (แผ่น)</label> 
            <input class="form-control" type="number" id="obt7" name="obt7"  value=""> 
        </div>

        <div class="col-4">
            <label for="obt8">ลงชื่อหนังสือ</label>
            <input class="form-control" type="text" id="obt8" name="obt8"  value=""> 
        </div>
        <div class="col-4">
            <label for="obt9">ตำแหน่ง</label>
            <input class="form-control" type="text" id="obt9" name="obt9"  value=""> 
        </div>
        <div class="col-4">
            <label for="obt10">ตำแหน่ง(2)</label>
            <input class="form-control" type="text" id="obt10" name="obt10"  value=""> 
        </div>
</div>
</form>

<div class="row">

        <div class="col-12 text-center">
                    <button class="btn btn-danger" name="saveBtn" id="saveBtn">บันทึกข้อมูล</button>
                    <button class="btn btn-warning" name="editBtn" id="editBtn" data-id="">แก้ไขข้อมูล</button>
                    <button class="btn btn-success" name="showBtn" id="showBtn" data-id="">แสดงเอกสาร</button>
        </div>

</div>              
</div>
</body>
</html>