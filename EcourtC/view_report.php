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

                $("#report_ecc").modal();

                $("#report_data").click(function(){
                    report_ECourtC();
                    
                    });
                $("#report_px").click(function(){

                  document.getElementById('report_px').style.display = 'block'; 
                  this.style.display = 'none'
                  window.print();

                    });





            });

</script></head>
<body>
    <div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-10 text-center mt-3">
    <input class="btn-success" type="button" name="report_px" id="report_px" value=" ??????????????? ">
    <p style="font-size:18px;" name="text_NR" id="text_NR"></p>
    <table class="table table-bordered table-sm text-center" name="objReport" id="objReport"></table>
    </div></div></div>   

    <div class="modal fade" id="report_ecc" role="report_ecc">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header bg-danger" style="padding:6px;">
			  <h5 class="modal-title"> ????????????????????????????????? </h5>
			</div>
			<div class="modal-body">

            <div class="row justify-content-center">
            <div class="col-10 text-center mt-3">
            <form id="Form_report">
            <label for="browser">?????????????????????????????????????????? : </label>
                <input type="text" list="m_list" name="m_list12" id="m_list12" placeholder="-??????????????????????????????-" >
                <datalist id="m_list">
                    <option value="??????????????????">
                    <option value="??????????????????????????????">
                    <option value="??????????????????">
                    <option value="??????????????????">
                    <option value="?????????????????????">
                    <option value="????????????????????????">
                    <option value="?????????????????????">
                    <option value="?????????????????????">
                    <option value="?????????????????????">
                    <option value="??????????????????">
                    <option value="???????????????????????????">
                    <option value="?????????????????????">
                </datalist>
                <label for="browser">????????????????????????????????? : </label>
                <input type="text" list="y_list" name="y_list65" id="y_list65" placeholder="-?????????????????????-" >
                <datalist id="y_list">
                    <option value="2564">
                    <option value="2565">
                </datalist>
                <br><input type="radio" name="optR" value="????????????" checked>  ???????????? 
            <input type="radio" name="optR" value="????????????">  ???????????? 
            </form></div></div>

			</div>
			<div class="modal-footer" style="padding-bottom:0px !important;text-align:center !important;">
			<p style="text-align:center;float:center;"><button type="submit" id="report_data" class="btn btn-danger">??????????????????</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">?????????</button></p>
			
		  </div>
		  </div>
		</div>
	</div>
<!-- Modal End-->


</body>
</html>
