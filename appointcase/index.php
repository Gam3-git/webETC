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
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script> -->
<script type="text/javascript">
    
        $(document).ready(function(){ 
        
            app_point();
  
          $("#NT").html("OK");
        });

</script>
<script type="text/javascript">setTimeout("window.close();", 10000);</script>
</head>
<body>
    <div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-10 text-center mt-3">
    <p class="h1 mt-4">ส่งข้อมูล วันนัดพิจาณา ขึ้นหน้าเว็บ</p>
    <p class="h3 mt-4" name="NT" id="NT"></p>

    </div></div></div>   
</body>
</html>