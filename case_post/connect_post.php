<?php 
           $db = 'D:/DATA2Agenct/dataAccess.mdb';
           $driverdb = 'odbc:Driver={Microsoft Access Driver (*.mdb)};';
           $conn = new PDO($driverdb."Dbq=$db", null, null);
           $TableN = 'case_post';
           $FiledN1 = 'datesend';
           $FiledN2 = 'case_id';
           $FiledN3 = 'sendto';

        //    $_GET["postText"] = 'ผบE787/63';

           if(isset($_GET["PostText"]) && $_GET["PostText"]!="" && isset($_GET["S_num"]) && $_GET["S_num"]!=""){

            $text_post = $_GET["PostText"];
            
            switch ($_GET["S_num"]){
                case 2 :
                    $query = ConvertTIS620("SELECT * FROM [$TableN] WHERE [$FiledN2] LIKE '%$text_post%' ORDER BY [$FiledN1] DESC");
                    break ;
                case 3 :
                    $query = ConvertTIS620("SELECT * FROM [$TableN] WHERE [$FiledN3] LIKE '%$text_post%' ORDER BY [$FiledN1] DESC");
                    break ;
                default : $query = ConvertTIS620("SELECT * FROM [$TableN] ORDER BY [$FiledN1] DESC");  break ;
            }       
           } else {
            $query = ConvertTIS620("SELECT * FROM [$TableN] ORDER BY [$FiledN1] DESC");
           }

           $result = $conn->prepare($query);
           $result->execute();
           $row = $result->fetchAll(PDO::FETCH_ASSOC);
           $resPost = ArrayEncodeTH2D($row);
        //    print_r ($resPost);
            // echo "<br> จำนวนทั้งหมด : " . count($row) . "<br>";
            // for ($i = 0; $i <= (count($row)-1); $i++) {
            //     $text = $res[$i]['case_id']." ".
            //         $res[$i]['sendno']." ".
            //         $res[$i]['datesend']." ".
            //         $res[$i]['book_no']." ".
            //         $res[$i]['sendto']." ".
            //         $res[$i]['address'] ;
            //     echo $text."<br>";
            //   }
            if(!empty($resPost)){
                echo json_encode($resPost);
                } else { $resPost = null; echo json_encode($resPost); }
 

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