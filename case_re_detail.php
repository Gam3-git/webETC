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
    <script src="html-to-pdfmake/browser.js"></script>
    
    <title>Case-Remain</title>
    <style> 

			  @font-face {
			  font-family: 'Sarabun-Regular';
			  src:  url(bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.woff) format('woff'), 
				    url(bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.ttf)  format('truetype'), 
				    url(bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.svg#Sarabun-Regular) format('svg'),
                    url(bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.eot) format('embedded-opentype');
			  font-weight: normal;
			  font-style: normal;
						}
                
                @media print {
                    @page { size: A4 portrait; }
                /* body { transform: scale(1); } */
                /* table {page-break-inside: avoid;} */
                button { visibility: hidden; }
                }

                body {font-family: 'Sarabun-Regular' !important;} 
                thead { 
                    border-bottom: 5px solid #000; 
                }
</style>
<script type="text/javascript" src="remain_case/remain_case_obj.js"></script>
<script type="text/javascript">
            $(document).ready(function(){
                var url_num =decodeURIComponent(window.location.href).replace("http://10.37.76.250:9090/webETC/case_re_detail.php?num=","");
                search_remain_D(url_num);
            $("#10Btn").click(function(){
                // var textrec =htmlToPdfmake($("#objReport").html());
                // var textrec =$("#objReport").html();
                // pdf_make(textrec);
                // pdf_make1(textrec);
                document.getElementById('10Btn').style.display = 'block'; 
                  this.style.display = 'none'
                  window.print();
                });
            });


</script></head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 text-center mt-3">
        <button class="btn btn-dark" name="10Btn" id="10Btn">พิมพ์ </button>
        <p style="font-size:18px;" name="text_R" id="text_R"></p>
        <table class="table table-bordered table-sm" name="objReport" id="objReport"></table>
        </div>
    </div>
</div>   
 

</body>
</html>