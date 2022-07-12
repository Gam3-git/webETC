<?php 
  

           $db = "D:/DATA2Agenct/dataAccess.mdb";
           $driverdb = "odbc:Driver={Microsoft Access Driver (*.mdb)};";
           $conn = new PDO($driverdb."Dbq=$db", null, null);
           $M_text = date("m");  
           
                $FiledN2 = "appointment_date"; 
                $TextV = "case_id, appointment_detail, appointment_date";
                $query = ConvertTIS620(" SELECT $TextV FROM ECourtC WHERE month($FiledN2) =  $M_text ORDER BY $FiledN2 desc ");
                $result = $conn->prepare($query);
                $result->execute();
                $row = $result->fetchAll(PDO::FETCH_NUM);
                $res = ArrayEncodeTH2D($row); 
                
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