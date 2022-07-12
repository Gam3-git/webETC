<?php date_default_timezone_set("Asia/Bangkok");?>
<html>
<head>
    <meta http-equiv="Content-Type" charset="UTF-8">
    <meta name="viewport" content="text/html, width=device-width, initial-scale=1.0">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bootstrap/dist/css/jquery.dataTables.min.css">
    <script src="jquery/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="bootstrap/dist/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="jquery/sweetalert2.all.min.js"></script>
    <script src="pdfmake/build/pdfmake.min.js"></script>
    <script src="pdfmake/build/vfs_fonts.js"></script>
    <title>Case-Remain</title>
    <style> 
			  @font-face {
			  font-family: 'Kanit-Regular';
			  src:  url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.woff) format('woff'), 
				    url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.ttf)  format('truetype'), 
				    url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.svg#Kanit-Regular) format('svg'),
                    url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.eot) format('embedded-opentype');
			  font-weight: normal;
			  font-style: normal;
						}
              body {font-family: 'Kanit-Regular' !important;} 
              @media print {
                    @page { size: A4 landscape; }
                /* body { transform: scale(1); } */
                /* table {page-break-inside: avoid;} */
                button { visibility: hidden; }
                }
              
</style>
<script type="text/javascript" src="remain_case/remain_case_obj.js"></script>
<script type="text/javascript">
            $(document).ready(function(){
               
                $.getJSON('court.json', function(msg) { 
                $("#courtN").html(msg.courtN); }); 
                let sameDay = new Date();
                $("#dN").html(sameDay.toLocaleDateString("th-TH"));

                search_remain_C();

                $("#1Btn").click(function(){
				window.open("/webETC/case_re_detail.php?num=1", "_blank"); });
                $("#2Btn").click(function(){
				window.open("/webETC/case_re_detail.php?num=2", "_blank"); });
                $("#3Btn").click(function(){
				window.open("/webETC/case_re_detail.php?num=3", "_blank"); });
                $("#4Btn").click(function(){
				window.open("/webETC/case_re_detail.php?num=4", "_blank"); });
                $("#5Btn").click(function(){
				window.open("/webETC/case_re_detail.php?num=5", "_blank"); });
                $("#6Btn").click(function(){
				window.open("/webETC/case_re_detail.php?num=6", "_blank"); });
                $("#7Btn").click(function(){
				window.open("/webETC/case_re_detail.php?num=7", "_blank"); });
                $("#8Btn").click(function(){
				window.open("/webETC/case_re_detail.php?num=8", "_blank"); });
                $("#9Btn").click(function(){
				window.open("/webETC/case_re_detail.php?num=9", "_blank"); });

                $("#10Btn").click(function(){
                    // var textrec ="test ทดสอบ PDF"
                    var textrec = "รายงานสรุป\n \n - จำนวนคดีค้างทั้งหมด : \n"+$("#Rn1").html()+
                    "\n \n - ค้างไม่เกิน 3 เดือน : \n"+$("#Rn2").html()+
                    "\n \n - ค้างไม่เกิน 6 เดือน : \n"+$("#Rn3").html()+
                    "\n \n - ค้างไม่เกิน 1 ปี : \n"+$("#Rn4").html()+
                    "\n \n - ค้างไม่เกิน 2 ปี : \n"+$("#Rn5").html()+
                    "\n \n - ค้างไม่เกิน 3 ปี : \n"+$("#Rn6").html()+
                    "\n \n - ค้างไม่เกิน 4 ปี : \n"+$("#Rn7").html()+
                    "\n \n - ค้างไม่เกิน 5 ปี : \n"+$("#Rn8").html()+
                    "\n \n - ค้างเกิน 5 ปี : \n"+$("#Rn9").html();
                    pdf_make(textrec);
                    window.print();
                });
                $("#11Btn").click(function(){
                    search_remain_C2();
                    location.reload();
                });
                $("#12Btn").click(function(){
                    window.open("/webETC/remain_case/report_detail.php", "_blank");
                });
       
            });


</script></head>
<body>
    <div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-3 text-right"><img src="img/coj1.png" alt width="80"></div>
            <div class="col-7 text-left">
	            <p class="h3 mt-4" name="courtN" id="courtN"></p>
                <a>ข้อมูลคดีค้าง ณ วันที่ </a><a class="h5 text-danger" name="dN" id="dN"></a><a> (นับแต่วันรับฟ้อง)</a>
            </div>
    </div>

    <div class="row justify-content-center">

        <div class="col-7 text-center mt-3">
            <div class="card bg-danger text-white">
                <div class="card-header h5">
                    จำนวนคดีค้างทั้งหมด 
                </div>
                <div class="card-body">
                    <p class="h1" name="Rn1" id="Rn1"></p>
                    <button class="btn btn-danger" name="1Btn" id="1Btn">
                    รายละเอียด <span><i class="fa-solid fa-chevron-down"></i></span></button>
                    </div>
            </div> 
        </div> 

    </div>

    <div class="row justify-content-center text-center" id="bodytext">
       

            <div class="card bg-info" style="width:12%;">
                <div class="card-header h5">
                    ค้างไม่เกิน <br> 3 เดือน
                </div>
                <div class="card-body">
                    <p class="h2" name="Rn2" id="Rn2"></p>
                    <button class="btn btn-info text-dark" name="2Btn" id="2Btn">
                    รายละเอียด <span><i class="fa-solid fa-chevron-down"></i></span></button>
                </div>
            </div> 
        
        
            <div class="card bg-info" style="width:12%;">
                <div class="card-header h5">
                ค้างไม่เกิน <br> 6 เดือน
                </div>
                <div class="card-body">
                    <p class="h2" name="Rn3" id="Rn3"></p>
                    <button class="btn btn-info text-dark" name="3Btn" id="3Btn">
                    รายละเอียด <span><i class="fa-solid fa-chevron-down"></i></span></button>
                </div>
            </div>
        
            <div class="card bg-info" style="width:12%;">
                <div class="card-header h5">
                ค้างไม่เกิน <br> 1 ปี
                </div>
                <div class="card-body">
                    <p class="h2" name="Rn4" id="Rn4"></p>
                    <button class="btn btn-info text-dark" name="4Btn" id="4Btn">
                    รายละเอียด <span><i class="fa-solid fa-chevron-down"></i></span></button>
                </div>
            </div>
      
            <div class="card bg-info" style="width:12%;">
                <div class="card-header h5">
                ค้างไม่เกิน <br> 2 ปี
                </div>
                <div class="card-body">
                    <p class="h2" name="Rn5" id="Rn5"></p>
                    <button class="btn btn-info text-dark" name="5Btn" id="5Btn">
                    รายละเอียด <span><i class="fa-solid fa-chevron-down"></i></span></button>
                </div>
            </div>
            <div class="card bg-dark text-white" style="width:12%;">
                <div class="card-header h5">
                ค้างไม่เกิน <br> 3 ปี
                </div>
                <div class="card-body">
                    <p class="h2" name="Rn6" id="Rn6"></p>
                    <button class="btn btn-dark" name="6Btn" id="6Btn">
                    รายละเอียด <span><i class="fa-solid fa-chevron-down"></i></span></button>
                </div>
            </div> 
        
        
            <div class="card bg-dark text-white" style="width:12%;">
                <div class="card-header h5">
                ค้างไม่เกิน <br> 4 ปี
                </div>
                <div class="card-body">
                    <p class="h2" name="Rn7" id="Rn7"></p>
                    <button class="btn btn-dark" name="7Btn" id="7Btn">
                    รายละเอียด <span><i class="fa-solid fa-chevron-down"></i></span></button>
                </div>
            </div>
        
            <div class="card bg-dark text-white" style="width:12%;">
                <div class="card-header h5">
                ค้างไม่เกิน <br> 5 ปี
                </div>
                <div class="card-body">
                    <p class="h2" name="Rn8" id="Rn8"></p>
                    <button class="btn btn-dark" name="8Btn" id="8Btn">
                    รายละเอียด <span><i class="fa-solid fa-chevron-down"></i></span></button>
                </div>
            </div>
      
            <div class="card bg-dark text-white" style="width:12%;">
                <div class="card-header h5">
                    ค้างเกิน <br> 5 ปี
                </div>
                <div class="card-body">
                    <p class="h2" name="Rn9" id="Rn9"></p>
                    <button class="btn btn-dark" name="9Btn" id="9Btn">
                    รายละเอียด <span><i class="fa-solid fa-chevron-down"></i></span></button>
                </div>
            </div>

        </div>
        <div class="row justify-content-center text-center">
        <div class="col-2 text-center mt-3">
        <button class="btn btn-dark" name="12Btn" id="12Btn">พิมพ์สรุป</button>
        </div>
        <div class="col-2 text-center mt-3">
        <button class="btn btn-warning" name="11Btn" id="11Btn">คำนวนข้อมูลอีกครั้ง</button>
        </div>

        </div>



    </div>   

</body>
</html>