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
    <title>report</title>
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
<script type="text/javascript" src="remain_case_obj.js"></script>
<script type="text/javascript">
            $(document).ready(function(){
                let sameDay = new Date();
                $("#text_H").html(sameDay.toLocaleDateString("th-TH"));
                cal_detail();

            $("#report_pr").click(function(){
                window.print();
            });
               

            });

</script></head>
<body>
    <div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-10 text-center mt-3">
    <button class="btn btn-dark" name="report_pr" id="report_pr">พิมพ์ </button><br>
    <a>รายงานสรุปคดีค้าง ประจำวันที่ :</a><a name="text_H" id="text_H"></a><br>
    <table class="table table-bordered table-sm text-center" name="objReport" id="objReport"></table>
    </div></div></div>   
</body>
</html>