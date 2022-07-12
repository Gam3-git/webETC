<?php date_default_timezone_set("Asia/Bangkok"); include('connect_gdms.php');include('sendL2.php');?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="text/html, width=device-width, initial-scale=1.0">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="jquery/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <title>SendL</title>
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

<body>

    <div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-5 text-center">
    <form method="post" action="sendL2.php">
	<img class="mt-5 mb-3" src="img/coj1.png" alt width="80" >
	<h1 class="h3 mb-3 font-weight-normal">
    <p name="courtN" id="courtN">ศาลจังหวัดสมุทรสงคราม</p></h1>
	<p class="mt-4 mb-3 text-muted"> ใช้ส่งข้อมูลแจ้งเตือน Line กลุ่ม</p>
	<p style="font-size:14px;"> ข้อความที่ส่ง (ห้ามกดเล่น เพราะส่งจริง) (ปุ่มปิด) </p>  
        <textarea id="TextSend" name="TextSend" rows="5" cols="75%"> <?php echo $message.$message2; ?>
        </textarea> 

        <input class="btn-success" type="submit" name="caseBBtn" id="caseBBtn" value="แจ้งเตือน" disabled>
        
    
    </form></div></div></div>       
</body>
            <?php 
            // LineMsg($message,1); 
            // LineMsg($message2,2);
            ?>
</html>