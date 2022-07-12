<?php  

if (!empty($_POST["TextSend"])) {
  $message = $_POST["TextSend"];
  LineMsg($message,1);
  header( "location: http://10.37.76.250:9090/webetc/sendL.php" );
} else {  
  echo "No, text send";
}

function LineMsg($message,$option) {


 
                    // echo $message;
                    if($option==1){
                      // $token = "SDps4IIL4mInrQpS9MDAi9XLX6GS8ehjHxT8SqXl5YX"; //test
                      $token = "aFGnxoDhRG0FBkI063shOeHac136JPyG7Fekyc9XMrB";
                     } else { 
                    $token = "SDps4IIL4mInrQpS9MDAi9XLX6GS8ehjHxT8SqXl5YX"; //test
                     $token = "j0J1A3r6I56OmY6arhUnB6BwGv0EPcLHjBrRgCEl5fm";
                     }

                    $chOne = curl_init();
                    curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
                    // curl_setopt( $chOne, CURLOPT_URL, "http://203.104.138.174/api/notify");
                    
                    // SSL USE
                    curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
                    //POST
                    curl_setopt( $chOne, CURLOPT_POST, 1);
                    // Message
                    curl_setopt( $chOne, CURLOPT_POSTFIELDS, $message);
                    //��ҵ�ͧ�������ػ ������ 2 parameter imageThumbnail ���imageFullsize
                    curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$message");
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
                    // echo "$text_head status : ".$result_['status']; echo "message : ". $result_['message']; 
                    }
                    //Close connect
                    curl_close( $chOne );

                   }
?>