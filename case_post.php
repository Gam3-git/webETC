<?php date_default_timezone_set("Asia/Bangkok");?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="text/html, width=device-width, initial-scale=1.0">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="jquery/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <title>casePost</title>
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
<script type="text/javascript" src="case_post/post_obj.js"></script>
<script type="text/javascript">
            $(document).ready(function(){ 

            $("#PostText").keypress(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault(); 
                    $("#casePost").click();
                    } });

            $("#caseP").click(function(){
                $('#obt1').empty();
                search_post(1);  });

            $("#casePost").click(function(){
                $('#obt1').empty();
                search_post(2);  });

            $("#casePText").click(function(){
                $('#obt1').empty();
                search_post(3);  });

            $("#PostT").click(function(){
                window.open("https://track.thailandpost.co.th", "_blank") });
            });
</script></head>
<body>

    <div class="container-fluid">

    <div class="row justify-content-center">
    <div class="text-center">
	<img class="mt-2 mb-1" src="img/coj1.png" alt width="80" >
    <h1 class="h3 mb-3 font-weight-normal">
    <p name="courtN" id="courtN">ศาลจังหวัดสมุทรสงคราม</p></h1>
    <p class="text-muted"> ติดตามผลส่งไปรษณีย์ (เบื้องต้น)</p></div></div> 

    <div class="row no-gutters justify-content-center">
    <div class="col-9">
    <form name = "form1" id="form1" method="post">
    <p class="text-center" style="font-size:20px;">
    <input class="btn-warning" type="button" name="caseP" id="caseP" value=" แสดง 50 รายการล่าสุด ">
    <input class="btn-danger" type="button" name="PostT" id="PostT" value=" เว็บไปรษณีย์ไทย "></p>
    <p class="text-center" style="font-size:20px;">
    <input style="width:45%" type="text" name="PostText" id="PostText" autofocus>
    <input class="btn-success" type="button" name="casePost" id="casePost" value=" ค้นหาโดยเลขคดี ">
    <input class="btn-info" type="button" name="casePText" id="casePText" value=" ค้นหาส่งถึง "></p>
    <table class="table table-bordered table-sm" name="obt1" id="obt1"></table>
    </form></div>
    </div>

    </div> 
</body>
</html>