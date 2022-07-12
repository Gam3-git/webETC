<?php 
           $db = 'D:/DATA2Agenct/dataAccess.mdb';
           $driverdb = 'odbc:Driver={Microsoft Access Driver (*.mdb)};';
           $conn = new PDO($driverdb."Dbq=$db", null, null);

        //    $case_id = $_POST['room_text'];
        //    $text_date = $_POST["text_date"];
           
           $TableN1 = 'แผนกรับฟ้อง';
           $TableN2 = 'สมุดนัดพิจารณา';
           $TableN3 = 'ECourtC';
           $FiledN1 = 'หมายเลขดำที่/พศ';  //แผนกรับฟ้อง
           $FiledN2 = 'หมายเลขคดีดำที่/พศ'; //สมุดนัด 
           $FiledN3 = 'case_id'; 
           $FiledN4 = 'วันปัจจุบัน'; 
           $FiledN5 = 'ห้องพิจารณาคดีที่';
           $TextV = '[แผนกรับฟ้อง].[หมายเลขดำที่/พศ], [แผนกรับฟ้อง].[ความ], [แผนกรับฟ้อง].[ข้อหา], [แผนกรับฟ้อง].[tot], [สมุดนัดพิจารณา].[เสร็จ/ไม่เสร็จ], [สมุดนัดพิจารณา].[ห้องพิจารณาคดีที่], [สมุดนัดพิจารณา].[ผู้ขอเลื่อนคดี]';

           if(isset($_POST["text_date"]) && $_POST["text_date"]!=""){
            $text_date = $_POST["text_date"];
            if(isset($_POST['room_text']) && $_POST['room_text']!="") { 
                $text_room = $_POST['room_text']; 
                $query = ConvertTIS620("SELECT $TextV FROM ([$TableN1] LEFT JOIN [$TableN2] ON [$TableN1].[$FiledN1] = [$TableN2].[$FiledN2]) LEFT JOIN $TableN3 ON [$TableN2].[$FiledN2] = $TableN3.$FiledN3 WHERE $TableN3.$FiledN3 IS NULL AND [$TableN2].[$FiledN5] = '$text_room' AND [$TableN2].[$FiledN4] = #$text_date#");
            } else { 
            $query = ConvertTIS620("SELECT $TextV FROM ([$TableN1] LEFT JOIN [$TableN2] ON [$TableN1].[$FiledN1] = [$TableN2].[$FiledN2]) LEFT JOIN $TableN3 ON [$TableN2].[$FiledN2] = $TableN3.$FiledN3 WHERE $TableN3.$FiledN3 IS NULL AND [$TableN2].[$FiledN4] = #$text_date#");
           }} 

           $result = $conn->prepare($query);
           $result->execute();
           $row = $result->fetchAll(PDO::FETCH_ASSOC);
           $res = ArrayEncodeTH2D($row);
        //    print_r ($res);
        //    echo "<br> จำนวนทั้งหมด : " . count($row) . "<br>";

        for($i=0; $i<sizeof($res); $i++){
            switch ($res[$i]['tot']){
            case "1" : $res[$i]['tot'] = "คดีสามัญ (ต่อเนื่อง)"; break;
            case "2" : $res[$i]['tot'] = "คดีจัดการพิเศษ"; break;
            case "3" : $res[$i]['tot'] = "ทุกวัน"; break;
            default : $res[$i]['tot'] = "-";
            }
            switch ($res[$i]['เสร็จ/ไม่เสร็จ']){
                case "1" : $res[$i]['เสร็จ/ไม่เสร็จ'] = "พิจารณาต่อนัดหน้า"; break;
                case "2" : $res[$i]['เสร็จ/ไม่เสร็จ'] = "เสร็จการพิจารณา"; break;
                default : $res[$i]['เสร็จ/ไม่เสร็จ'] = "-";
                }
        }

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