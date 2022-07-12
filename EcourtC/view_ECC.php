<?php 
  

           $db = "D:/DATA2Agenct/dataAccess.mdb";
           $driverdb = "odbc:Driver={Microsoft Access Driver (*.mdb)};";
           $conn = new PDO($driverdb."Dbq=$db", null, null);

           if(isset($_POST["text_m"]) && $_POST["text_m"]!=""){ 
            //    $M_text = 11;  
            //    $Type_case = 'อาญา';
            switch ( $_POST["text_m"] ){
                case "มกราคม" : $M_text = 1; break;
                case "กุมภาพันธ์" : $M_text = 2; break;
                case "มีนาคม" : $M_text = 3; break;
                case "เมษายน" : $M_text = 4; break;
                case "พฤษภาคม" : $M_text = 5; break;
                case "มิถุนายน" : $M_text = 6; break;
                case "กรกฎาคม" : $M_text = 7; break;
                case "สิงหาคม" : $M_text = 8; break;
                case "กันยายน" : $M_text = 9; break;
                case "ตุลาคม" : $M_text = 10; break;
                case "พฤศจิกายน" : $M_text = 11; break;
                case "ธันวาคม" : $M_text = 12; break;
            } }

            if(isset($_POST["text_detail"]) && $_POST["text_detail"]!=""){ 

                 $Type_case = $_POST['text_detail'];
                 $Y_text = intval($_POST['text_y'])-543; 

               if ($Type_case == "แพ่ง") { 

                $FiledN1 = "type_case"; 
                $FiledN2 = "appointment_date"; 
                $TextV = "case_id, detail_case, type_appiont, Ecase_detail";
                $query = ConvertTIS620(" SELECT $TextV FROM ECourtC WHERE $FiledN1 = '$Type_case' AND month($FiledN2) =  $M_text AND year($FiledN2) =  $Y_text ");
                $result = $conn->prepare($query);
                $result->execute();
                $row = $result->fetchAll(PDO::FETCH_NUM);
                $res = ArrayEncodeTH2D($row); 
                
               } else { 
   
                $FiledN1 = "type_case"; 
                $FiledN2 = "appointment_date"; 
                $TextV = "case_id, Ecase_detail";
                $query = ConvertTIS620(" SELECT $TextV FROM ECourtC WHERE $FiledN1 = '$Type_case' AND month($FiledN2) =  $M_text ");
                $result = $conn->prepare($query);
                $result->execute();
                $row = $result->fetchAll(PDO::FETCH_NUM);
                $res = ArrayEncodeTH2D($row); 
               }

            }
                
        // print_r ($res);

            if(!empty($res)){
                echo json_encode($res);
                } else { $res = null; echo json_encode($res); }
 



       function ConvertUTF8($value){
           return iconv('TIS-620', 'UTF-8',$value);
       }
       function ConvertTIS620($value){
           return iconv('UTF-8','TIS-620',$value);
       }
       function ArrayEncodeTH($ar){ 
           $rows = array();
           foreach ($ar as $key => $value) {
                   $key = ConvertUTF8($key);
                   $value = ConvertUTF8($value); 
                   $rows[$key] = $value;    
           }
           return $rows;
       }
       function ArrayEncodeTH2D($arr){  
           $rows = array();
           if($arr)
               foreach($arr as $row ) {
                   $rows[] = ArrayEncodeTH($row);
               }
           return $rows;
       }  

    ?>