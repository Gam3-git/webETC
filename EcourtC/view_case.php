<html>
<head>

    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../bootstrap/dist/css/jquery.dataTables.min.css">
    <script src="../jquery/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="../bootstrap/dist/js/jquery.dataTables.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../jquery/sweetalert2.all.min.js"></script>
    <script src="../pdfmake/build/pdfmake.min.js"></script>
    
    <title>report</title>
    <style> 
			  @font-face {
			  font-family: 'Sarabun-Regular';
			  src:url(../bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.eot) format('embedded-opentype');
			  font-weight: normal;
			  font-style: normal;
						}

			  @font-face {
			  font-family: 'Sarabun-Regular';
			  src:  url(../bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.woff) format('woff'), 
				    url(../bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.ttf)  format('truetype'), 
				    url(../bootstrap/dist/font/Sarabun-Regular/Sarabun-Regular.svg#Sarabun-Regular) format('svg');
			  font-weight: normal;
			  font-style: normal;
						}
			body {font-family: 'Sarabun-Regular' !important;} 
      
</style>
<script type="text/javascript" src="ECourtC_obj.js"></script>
<script type="text/javascript">
            $(document).ready(function(){
              del_ECourt();
            });

</script></head>
<body>
    <div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-10 text-center mt-3">
    <p style="font-size:18px;" name="text_cancle" id="text_cancle">คดีพิจารณาออนไลน์ เดือนปัจจุบัน ( ค้นหาโดยการกดปุ่ม ctrl+F )</p>
    <table class="table table-bordered table-sm text-center" name="objReport" id="objReport"></table>
    </div></div></div>   

    

</body>
</html>
