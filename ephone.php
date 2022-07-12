<?php
include('connect_Tstop.php');
if($work == 0){
    $message1 = "ลงเวลาปฏิบัติราชการ \n\n https://phonebook.coj.go.th";
    // $message1 = "Zoom Meeting \n วันที่ 11 พฤศจิกายน 2564 \n ระยะเวลา 10.00 – 12.00 น. (จำนวน 2 ชั่วโมง) \n ช่องทางการลงชื่อเข้าอบรม \n https://forms.gle/6t8hXM33DPvNipTTA \n (เปิดให้ลงชื่อในวันที่ 11 พฤศจิกายน 2564 เวลา 08.00 – 10.00 น.) ";
    // $message2 = "ช่องทางการเข้ารับการอบรม \n https://zoom.us/j/2840412767?pwd=ZlZxTVkzRkJjR0JxN0c4c1VUeXhYQT09";
    // $message3 = "*เนื่องจากห้องประชุมรองรับผู้เข้ารับการอบรมได้สูงสุด 1,000 user หากผู้เข้ารับการอบรมไม่สามารถเข้าห้องประชุมในวันเวลาดังกล่าวได้ สามารถรับชมวิดีโอการฝึกอบรมย้อนหลังได้ โดยทางสำนักเทคโนโลยีสารสนเทศจัดดำเนินการอัปโหลดวิดีโอการฝึกอบรมหลังจากสิ้นสุดการอบรม";
    // $message4 = "เอกสารประกอบการอบรม \n https://drive.google.com/drive/folders/1y4MKMrQk6dKwCSJTyRvnGjmapMmWn-Yu?usp=sharing";
    $message_t = array($message1);
    for($i = 0; $i < count($message_t); $i++) { 
        LineMsg($message_t[$i]);
    }
}else {echo "วันหยุด";} 


function LineMsg($message_t) {


    // $token = "SDps4IIL4mInrQpS9MDAi9XLX6GS8ehjHxT8SqXl5YX"; //test
    $token = "aFGnxoDhRG0FBkI063shOeHac136JPyG7Fekyc9XMrB"; //แก้เมื่อต้องการแจ้งไปไลน์อื่น
    $chOne = curl_init();
    curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    // curl_setopt( $chOne, CURLOPT_URL, "http://203.104.138.174/api/notify");
    
    // SSL USE
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
    //POST
    curl_setopt( $chOne, CURLOPT_POST, 1);
    // Message
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, $message_t);
    //��ҵ�ͧ�������ػ ������ 2 parameter imageThumbnail ���imageFullsize
    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$message_t");
    // follow redirects
    curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
    //ADD header array
    
    
    
    $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $token . '', );  // ��ѧ����� Bearer ��� line authen code �
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
    //RETURN
    curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec( $chOne );
    //Check error
    if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); }
    else { $result_ = json_decode($result, true);
    // echo "status : ".$result_['status']; echo "message : ". $result_['message']; 
    }
    //Close connect
    curl_close( $chOne );
}

?>

<script type="text/javascript">setTimeout("window.close();", 10000);</script>