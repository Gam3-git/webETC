<?php date_default_timezone_set("Asia/Bangkok");

?>
<html>
<head>
    <meta http-equiv="Content-Type" charset="UTF-8">
    <meta name="viewport" content="text/html, width=device-width, initial-scale=1.0">
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome/css/all.css" rel="stylesheet">

    <link href="../bootstrap/datepicker-thai/css/datepicker.css" rel="stylesheet" media="screen">
    
    <script src="../jquery/jquery-3.5.1.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../jquery/sweetalert2.all.min.js"></script>
     <script src="../bootstrap/datepicker-thai/js/bootstrap-datepicker.js"></script>
     <script src="../bootstrap/datepicker-thai/js/bootstrap-datepicker-thai.js"></script>
     <script src="../bootstrap/datepicker-thai/js/locales/bootstrap-datepicker.th.js"></script>

    <link href="../css/custome.css" rel="stylesheet">

    <title>Soc_ser</title>
   
<script type="text/javascript" src="social_ser.js"></script>
<script type="text/javascript">

    $(document).ready(function(){

        $("#section_1").hide();
        $("#caseB2").attr("disabled", true);
        
           $("#caseT").keypress(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault(); 
                $("#caseBtn").click();
                } });   

            $("#caseBtn").click(function(){ 
                $("#caseT").blur();
                search_case();
              });

            $("#hide_1").click(function(){ 
                $("#section_1").hide();
              });

            $("#hide_2").click(function(){ 
                $("#section_1").hide();
              });

              $("#obt30").change(function(){ 
                $("#obt31").val($("#obt30").val()*500);
              });

              $("#obt32").change(function(){ 
                $("#obt34").val( ($("#obt32").val() - $("#obt33").val())-$("#obt31").val() );
                $("#obt35").val( $("#obt34").val() / 500 );
              });

              $("#obt33").change(function(){ 
                $("#obt34").val( ($("#obt32").val() - $("#obt33").val())-$("#obt31").val() );
                $("#obt35").val( $("#obt34").val() / 500 );
              });

              $("#obt9").click(function(){ 
                $("#obt9").datepicker(); });

            $("#caseB1").click(function(){ 
                $("#caseB2").removeAttr("disabled");
            });

           
    });

</script>
</head>
<body>
<div class="container">

        <div class="row">
        <div class="col-12">
                    <table style="height: 100%; width: 100%"><tbody><tr>
                    <td class="text-warning bg-dark text-center">
                    <p style="font-size:20px;" name="courtN" id="courtN">ศาลจังหวัดสมุทรสงคราม</p>
                  </td></tr></tbody></table>
        </div></div>


        <div class="row">
        <div class="col-12">
                <table style="height: 100%; width: 100%"><tbody><tr>
                    <td class="text-light bg-dark text-center">
                    <p style="font-size:30px;">ค้นหาเลขคดีดำ
                    <input type="text" name="caseT" id="caseT"  value="" autofocus> 
                    <input type="button" name="caseBtn" id="caseBtn" value="ค้นหา">
                    <input class="btn-light" type="button" name="menu_case" id="menu_case" value="กลับ"></p> 
                    </td></tr></tbody></table>
        </div></div>

        <div class="row" id="section_1">
        <div class="col-12 mt-2" >
                <form name = "form1" id="form1" method="post">
                <table class="table table-bordered table-sm text-left">
                <tbody>
                    <tr><td style="width: 12%">หมายเลขคดีดำ : </td><td style="width: 18%"><a style="font-size:20px;" id="obt1" name="obt1"> </a></td>
                    <td style="width: 10%">ประเภทคดี : </td><td style="width: 20%"><a style="font-size:20px;" id="obt2" name="obt2"> </a></td>
                    <td style="width: 8%">ข้อหา : </td><td style="width: 32%"><a style="font-size:20px;" id="obt3" name="obt3"> </a></td></tr>
                    <tr><td style="width: 12%">หมายเลขคดีแดง : </td><td style="width: 18%"><a style="font-size:20px;" id="obt4" name="obt4"> </a></td>
                    <td style="width: 10%">โจทก์/ผู้ร้อง </td><td style="width: 20%"><a style="font-size:20px;" id="obt5" name="obt5"> </a></td>
                    <td style="width: 8%">จำเลย</td><td style="width: 32%"><a style="font-size:20px;" id="obt6" name="obt6"> </a></td></tr>
                </tbody>
                </table></form></div>

        <div class="col-6">
                <form name = "form_p" id="form_p" method="post">
                    <p style="font-size:20px;">ข้อมูลคู่ความ (ที่อยู่)
                    <input type="button" name="hide_1" id="hide_1" value="-"></p>
                    <table class="table table-bordered table-sm" name="objTable_p" id="objTable_p"></table>
                    </form>
        </div>
        <div class="col-6">
                <form name = "form_k" id="form_k" method="post">
                    <p style="font-size:20px;">ข้อมูลคู่ความ (คำพิพากษา)
                    <input type="button" name="hide_2" id="hide_2" value="-"></p> 
                    <table class="table table-bordered table-sm" name="objTable_k" id="objTable_k"></table>
                    </form>
        </div>
    </div> 

        <div class="row">
        <div class="col-12 text-light bg-dark">
        <p style="font-size:20px;">กรอกรายละเอียดข้อมูลคดี บส.1</p>
        </div></div>

        <form name = "form2" id="form2" method="post"> 
        <div class="row">
            <div class="col-2">
            <p>หมายเลขคดีดำ : </p> 
                <p><input type="text" style="font-size:16px; width:100%;" id="obt7" name="obt7"  value=""> </p> 
                <p>หมายเลขคดีแดง : </p> 
                <p> <input class="text-danger" type="text" style="font-size:16px; width:100%;" id="obt8" name="obt8"  value=""> </p> 
                <p>วันที่คำขอ : </p> 
                <p><input type="text" style="font-size:16px; width:100%;"
                data-provide="datepicker" data-date-language="th-th" id="obt9" name="obt9" value=""></p> 
                </div>
            <div class="col-4">
            <p> โจทก์ : </p> 
                <p> <input type="text" style="font-size:16px; width:100%;" id="obt10" name="obt10"  value=""> </p> 
                <p>จำเลย : </p> 
                <p> <input type="text" style="font-size:16px; width:100%;" id="obt11" name="obt11"  value=""> </p> 
                <p>ในความผิดฐาน : </p> 
                <p> <input type="text" style="font-size:16px; width:100%;" id="obt12" name="obt12"  value=""></p>     
            </div>
    
             <div class="col-6">
                <p>คดีนี้ศาลพิพากษา_1 : </p>
                <p>   <input type="text" style="font-size:16px; width:100%;" id="obt13" name="obt13"  value="">  </p>
                <p> คดีนี้ศาลพิพากษา_2 : </p>
                <p>  <input type="text" style="font-size:16px; width:100%;" id="obt14" name="obt14"  value="">  </p>
                <p> เหตุที่เลือก : </p>
                <p>   <input type="text" style="font-size:16px; width:100%;" id="obt15" name="obt15"  value=""> </p>     
                </div>

                <div class="col-12 h4">
                <p><u>ประสงค์ทำงานบริการสังคมด้าน : </u></p> </div>
                
                <div class="form-check col-3 h5">
                <input class="form-check-input" type="checkbox" value="" id="chk_1">
                 <label class="form-check-label" for="chk_1"> งานช่วยเหลือดูแลฯ </label>   
                 </div><div class="form-check col-3 h5">
                 <input class="form-check-input" type="checkbox" value="" id="chk_2">
                 <label class="form-check-label" for="chk_2"> งานวิชาการ การศึกษาฯ </label>  
                 </div><div class="form-check col-3 h5">  
                 <input class="form-check-input" type="checkbox" value="" id="chk_3">
                 <label class="form-check-label" for="chk_3"> งานวิชาชีพ งานฝืมือฯ </label>  
                 </div> <div class="form-check col-3 h5">   
                 <input class="form-check-input" type="checkbox" value="" id="chk_4" checked>
                 <label class="form-check-label" for="chk_4"> งานบริการสังคมฯ </label>     
                </div>


            </div>

        <div class="row">
        <div class="col-12 text-light bg-dark">
        <p style="font-size:20px;">กรอกรายละเอียดผู้ร้อง บส.1</p>
        </div></div>
        <div class="row">
            <div class="col-4">
                <p>ชื่อผู้ร้อง :  </p>
                <p> <input type="text" style="font-size:16px; width:100%;" id="obt16" name="obt16"  value=""> </p>
            </div>
            <div class="col-3">
                 <p> อาชีพ :  </p>
                <p> <input type="text" style="font-size:16px; width:100%;" id="obt17" name="obt17"  value=""> </p>
            </div>
            <div class="col-1">
                <p>วันเกิด </p>
                <p><input type="text" style="font-size:16px; width:100%;" id="obt18" name="obt18"  value=""></p>
                </div>
            <div class="col-2">
                <p>เดือน </p>
                <p><input type="text" style="font-size:16px; width:100%;" id="obt19" name="obt19"  value=""></p>
                 </div>
            <div class="col-1">
               <p>ปี </p>
                <p><input type="text" style="font-size:16px; width:100%;" id="obt20" name="obt20"  value=""></p>
            </div>
            <div class="col-1">
                <p>อายุ </p>
                <p><input  type="text" style="font-size:16px; width:100%;" id="obt21" name="obt21"  value=""></p>
                </div>

            <div class="col-2">
                <p>บ้านเลขที่ </p>
                <p><input type="text" style="font-size:16px; width:100%;" id="obt22" name="obt22"  value=""></p>
                </div>
            <div class="col-1">
                <p>หมู่ </p>
                <p><input type="text" style="font-size:16px; width:100%;" id="obt23" name="obt23"  value=""></p>
                 </div>
            <div class="col-3">
               <p>ถนน </p>
                <p><input type="text" style="font-size:16px; width:100%;" id="obt24" name="obt24"  value=""></p>
            </div>
            <div class="col-3">
                <p>ตรอก/ซอย </p>
                <p><input  type="text" style="font-size:16px; width:100%;" id="obt25" name="obt25"  value=""></p>
                </div>
            <div class="col-3">
                <p>ตำบล/แขวง </p>
                <p><input  type="text" style="font-size:16px; width:100%;" id="obt26" name="obt26"  value=""></p>
                </div>
            <div class="col-4">
                <p>อำเภอ/เขต </p>
                <p><input  type="text" style="font-size:16px; width:100%;" id="obt27" name="obt27"  value=""></p>
            </div><div class="col-4">
                <p>จังหวัด </p>
                <p><input  type="text" style="font-size:16px; width:100%;" id="obt28" name="obt28"  value=""></p>
            </div><div class="col-4">
                <p>โทรศัพท์ </p>
                <p><input  type="text" style="font-size:16px; width:100%;" id="obt29" name="obt29"  value=""></p>
                </div>
        
        </div>
    </form>

    <form name = "form3" id="form3" method="post"> 
    <div class="row">
        <div class="col-12 text-light bg-dark">
        <p style="font-size:20px;">หมายเหตุ  : ศาลพิพากษาปรับ</p>
        </div></div>

        <div class="row">
            <div class="col-2">
                <p>หักวันต้องขัง : </p> 
                <p><input type="text" style="font-size:16px; width:80%;" id="obt30" name="obt30"  value=0> วัน</p> 
                 </div>
            <div class="col-5">
                <p>เป็นเงิน : </p> 
                <p> <input type="text" style="font-size:16px; width:80%;" id="obt31" name="obt31"  value=0> บาท</p> 
                </div>
            <div class="col-5">
                <p>จำเลยต้องชำระค่าปรับทั้งสิ้น : </p> 
                <p> <input type="text" style="font-size:16px; width:80%;" id="obt32" name="obt32"  value=0> บาท</p> 
                </div>
            
            <div class="col-4">
            <p> หักจำเลยชำระค่าปรับบางส่วน : </p> 
                <p> <input type="text" style="font-size:16px; width:80%;" id="obt33" name="obt33"  value=0> บาท</p> 
             </div>
            <div class="col-5">
                <p>จำนวนเงินค่าปรับที่ต้องชำระ : </p> 
                <p> <input type="text" style="font-size:16px; width:80%;" id="obt34" name="obt34"  value=0> บาท</p> 
               
            </div>
            <div class="col-3">
                <p>มีระยะเวลาทำงานทั้งสิ้น : </p> 
                <p> <input type="text" style="font-size:16px; width:50%;" id="obt35" name="obt35"  value=0> วัน</p>     
            </div>

            </div>
            </form>

        <div class="row justify-content-center">
        <div class="col-6 text-center">
        <button class="btn btn-lg btn-primary btn-lg btn-block" name="caseB1" id="caseB1"> บันทึก บส.1</button>
        </div>
        <div class="col-6 text-center">
        <button class="btn btn-lg btn-primary btn-lg btn-block" name="caseB2" id="caseB2"> กรอก บส.2</button>
        </div>
        <div class="col-12 text-center">
        <p></p> </div>
        
        </div>
        
        
</div>
</body>
</html>