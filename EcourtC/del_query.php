<?php 
  

           $db = "D:/DATA2Agenct/dataAccess.mdb";
           $driverdb = "odbc:Driver={Microsoft Access Driver (*.mdb)};";
           $conn = new PDO($driverdb."Dbq=$db", null, null);
           $casetext = $_POST['casetext']; $casedate = $_POST['casedate']; 

           $query = ConvertTIS620("DELETE FROM ECourtC WHERE case_id ='$casetext' AND appointment_date =#$casedate#");
           $result = $conn->prepare($query);
           $result->execute();
           $count = $result->rowCount();
           if ($count > 0){
           echo json_encode($count);
           } else { echo json_encode(null); }
   
 

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