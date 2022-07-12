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
    <title>ECoutrC</title>
    <style> 
			  @font-face {
			  font-family: 'Kanit-Regular';
			  src:url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.eot) format('embedded-opentype');
			  font-weight: normal;
			  font-style: normal;
						}

			  @font-face {
			  font-family: 'Kanit-Regular';
			  src:  url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.woff) format('woff'), 
				    url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.ttf)  format('truetype'), 
				    url(bootstrap/dist/font/Kanit-Regular/Kanit-Regular.svg#Kanit-Regular) format('svg');
			  font-weight: normal;
			  font-style: normal;
						}
			body {font-family: 'Kanit-Regular' !important;} 
</style>
<script type="text/javascript" src="ECourtC/ECourtC_obj.js"></script>
<script type="text/javascript">
            $(document).ready(function(){
               
                $.getJSON('court.json', function(msg) { 
                $("#courtN").html(msg.courtN); });

                $("#view_b").click(function(){
                $('#objTable').empty();
                search_ECourtC();  });

                $("#report_b").click(function(){
                    window.open("http://10.37.76.250:9090/webETC/EcourtC/view_report.php", "_blank"); });

                $("#report_cancle").click(function(){
                    window.open("http://10.37.76.250:9090/webETC/EcourtC/view_case.php", "_blank"); });

                $("#update_data").click(function(){
                    update_ECourtC();
                    });


            $(function () {
		    $('#update_d').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); /*Button that triggered the modal*/
                var case_id = button.data('case_id');
                var type_case = button.data('type_case');

                dropdown_type(type_case);

                var modal = $(this);
                modal.find('#case_id').val(case_id);
                    });
                });

  
                $('#objTable').DataTable ({
                    bSort: false,
                    bFilter: false,
                    aoColumns: [ { bSearchable: false, bSortable: false } ],
                        "scrollCollapse": false,
                        "searchable": false,
                        "info":           false,
                        "paging":         false  });

         
            });

</script></head>
<body>
    <div class="container-fluid">

    <div class="row justify-content-center bg-light">
    <div class="col-3 text-right"><img src="img/coj1.png" alt width="80"></div>
    <div class="col-7 text-left">
	<p class="h3 mt-4" name="courtN" id="courtN"></p><a>   บันทึกข้อมูลพิจารณาออนไลน์ ประกอบการรายงาน</a>
    </div></div>

    
    <div class="row justify-content-center">
    <div class="col-10 text-center mt-3">
    <label for="date_text">ระบุวันที่นัดพิจารณา : </label>
    <input style="width: 20%" type="text" name="date_text" id="date_text" placeholder="01/11/2564" autofocus>
    <label for="room_text">ระบุบัลลังก์ : </label>
    <input style="width: 10%" type="text" name="room_text" id="room_text">
    <input class="btn-success" type="button" name="view_b" id="view_b" value=" ค้นหา ">
    <input class="btn-danger" type="button" name="report_cancle" id="report_cancle" value=" ยกเลิกคดี ">
    <input class="btn-primary" type="button" name="report_b" id="report_b" value=" รายงาน ">
    <table class="table table-bordered table-sm text-center" name="objTable" id="objTable"></table>
    </div></div>

    </div>   


<!-- Modal Update-->
<div class="modal fade" id="update_d" role="dialog">
		<div class="modal-dialog modal-md">
		  <div class="modal-content">
			<div class="modal-header bg-danger" style="padding:6px;">
			  <h5 class="modal-title"><i class="fa fa-edit"></i> บันทึกข้อมูลพิจารณาออนไลน์ </h5>
			</div>
			<div class="modal-body">

				<div class="row">
					<div class="col">
					    <label for="room_text">หมายเลขคดีดำ : </label><input type="text" name="case_id" id="case_id" required>
                        <form id="Form_EcourtC">
                        </form>
					</div>	
				</div>

			</div>
			<div class="modal-footer" style="padding-bottom:0px !important;text-align:center !important;">
			<p style="text-align:center;float:center;"><button type="submit" id="update_data" class="btn btn-danger">Save</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></p>
			
		  </div>
		  </div>
		</div>
	</div>
<!-- Modal End-->



</body>
</html>