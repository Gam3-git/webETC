<?php date_default_timezone_set("Asia/Bangkok");?>
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
<script type="text/javascript" src="/webETC/appointcase/apppoint_obj.js"></script>
<script type="text/javascript" src="/webETC/appointcase/1.js"></script>
<script type="text/javascript">
    
        $(document).ready(function(){ 

            // app_alert();

            
        for (var j =1; j < 4; j++){

            switch (j) {
                case 1 : 
                    var url ="https://script.google.com/macros/s/AKfycbwfxHQXMlMfgHgzmaBE96w_K3a1557mhdm1QS-p6ibBfTfWKnN1MSgMsdTxgNOxcY4D/exec";
                    var table_obj ="#objReport1";
                    break;
                case 2 :
                    var url ="https://script.google.com/macros/s/AKfycbwyB7Jze6fmGPT0HiQ32IINvwyDhGIC9mM3CVGL2HvMFDFM-7pJop8SrBTa1XcO6suS/exec";
                    var table_obj ="#objReport2";
                    break;
                case 3 :
                    var url ="https://script.google.com/macros/s/AKfycbx07LZYDs-DMgcHxEJ_W6oqbcE2mI31NZFt4InUp6vtxSHafj2V9frnHq4d-4pJV-DJ/exec";
                    var table_obj ="#objReport3";
                    break;
                default : var url ="https://script.google.com/macros/s/AKfycbyOO0ctwZclugR1yamRNKmeHhLDIWqPPbdqJ2THqOXCiYUHaQiTXmUyFOISoPmYxgxl/exec";
                var table_obj ="#objReport1"; break;
            }

            // var url ="https://script.google.com/macros/s/AKfycbwTpTPPt6xxWJ6mL9aY1VXX-qY2wwV8Fi1DJqLh_z2LYZgq1qXE9GneXLb5qFYTnLtj/exec";
            // var table_obj ="#objReport1"; 
            $.ajax({
            crossDomain: true,
            url: url,
            type : "GET",
            async : false,
            cache: false,
           success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
            // console.log(result);
            // console.log(result.length);
            var temp1 = '<thead class=text-center><tr><th>ลำดับ</th><th>เลขดำ</th><th>เวลา</th><th>นัด</th><th>ห้อง</th><th>ข้อหา</th><th>ความ</th></tr></thead><tbody>';
            $(table_obj).empty().append(temp1);
            for(var i = 0; i < result.length; i++) {
                var temp = '<tr><td>'+(i+1)+'</td><td>'+result[i].black+'</td>';
                temp += '<td>'+result[i].timeapp+'</td><td>'+result[i].appdo+'</td><td>'+result[i].room+'</td>';
                temp += '<td style="width: 20%">'+result[i].case_d+'</td><td style="width: 20%">'+result[i].type_c+'</td><tr></tr>';
                $(table_obj).append(temp);
            }$(table_obj).append('</tbody>');
               					
        }, 
                    error:function(msg){
                        console.log( "error:", msg );
                    }
                });

        }



        });

</script>
</head>
<body>
    <div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-10 text-center mt-3">
    <p class="h1 mt-4">ส่งข้อมูล วันนัดพิจาณา ขึ้นหน้าเว็บ</p>
    <table class="table table-bordered table-sm text-center" name="objReport1" id="objReport1"></table>
    <table class="table table-bordered table-sm text-center" name="objReport2" id="objReport2"></table>
    <table class="table table-bordered table-sm text-center" name="objReport3" id="objReport3"></table>
    </div></div></div>   
</body>

    </div></div></div>   
</body>
</html>