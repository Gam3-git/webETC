<?php 

// $_POST['action']= 1;
// $_POST['action_date'] = '03/22/2022';
if(isset($_POST['action_date']) && $_POST['action_date']!=""){

          $db = 'D:/DATA2Agenct/dataAccess.mdb';
          $driverdb = 'odbc:Driver={Microsoft Access Driver (*.mdb)};';
          $conn = new PDO($driverdb."Dbq=$db", null, null);

          $date_check = $_POST['action_date'];
        //   switch ($_POST['action_date']){
        //       case 1 : $date_check = date('m-d-Y',strtotime('+1 Day')); break;
        //       case 2 : $date_check = date('m-d-Y',strtotime('+2 Day')); break;
        //       case 3 : $date_check = date('m-d-Y',strtotime('+3 Day')); break;
        //       case 4 : $date_check = date('m-d-Y',strtotime('+4 Day')); break;
        //       case 5 : $date_check = date('m-d-Y',strtotime('+7 Day')); break;
        //       case 6 : $date_check = date('m-d-Y',strtotime('+8 Day')); break;
        //       case 7 : $date_check = date('m-d-Y',strtotime('+9 Day')); break;
        //       case 8 : $date_check = date('m-d-Y',strtotime('+10 Day')); break;
        //       default :  $date_check = date('m-d-Y',strtotime('+1 Day')); break;
        //   }

        //   $TableN1 = 'แผนกรับฟ้อง'; $TableN2 = 'สมุดนัดพิจารณา'; 
        //   $FiledN1 = 'หมายเลขดำที่/พศ'; $FiledN2 = 'หมายเลขคดีดำที่/พศ';

          $TextV = '[สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ] AS black,[สมุดนัดพิจารณา].[เวลา] AS timeapp,
          [สมุดนัดพิจารณา].[นัดมาทำไม] AS appdo,[สมุดนัดพิจารณา].[ห้องพิจารณาคดีที่] AS room,
          [แผนกรับฟ้อง].[ข้อหา] AS case_d,[สมุดนัดพิจารณา].[หมายเหตุ] AS type_c';

          $query = ConvertTIS620(" SELECT $TextV FROM [สมุดนัดพิจารณา] 
          LEFT JOIN [แผนกรับฟ้อง] ON [สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ] = [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] 
          WHERE [สมุดนัดพิจารณา].[วันปัจจุบัน] = #$date_check# ORDER BY [สมุดนัดพิจารณา].[เวลา] ASC ");


          $result = $conn->prepare($query);
          $result->execute();
          $row = $result->fetchAll(PDO::FETCH_ASSOC);
          $res = ArrayEncodeTH2D($row);
        //   print_r($res);

        for($i=0; $i<sizeof($res); $i++){
            switch ($res[$i]['timeapp']){
            case "8.3" : $res[$i]['timeapp'] = "08.30 น."; break;
            case "9" : $res[$i]['timeapp'] = "09.00 น."; break;
            case "9.3" : $res[$i]['timeapp'] = "09.30 น."; break;
            case "10" : $res[$i]['timeapp'] = "10.00 น."; break;
            case "10.3" : $res[$i]['timeapp'] = "10.30 น."; break;
            case "13" : $res[$i]['timeapp'] = "13.00 น."; break;
            case "13.3" : $res[$i]['timeapp'] = "13.30 น."; break;
            case "14" : $res[$i]['timeapp'] = "14.00 น."; break;
            case "16.3" : $res[$i]['timeapp'] = "16.30 น."; break;
            default : $res[$i]['timeapp'] = $res[$i]['timeapp']." น.";
            }}
        for($i=0; $i<sizeof($res); $i++){
            switch ($res[$i]['room']){
            case "ก" : $res[$i]['room'] = "ไกล่เกลี่ย"; break;
            case "น" : $res[$i]['room'] = "พิจารณานอกเวลาฯ"; break;
            case "น1" : $res[$i]['room'] = "บัลลังก์ 1"; break;
            case "น2" : $res[$i]['room'] = "บัลลังก์ 2"; break;
            case "น3" : $res[$i]['room'] = "บัลลังก์ 3"; break;
            case "น4" : $res[$i]['room'] = "บัลลังก์ 4"; break;
            case "1" : $res[$i]['room'] = "บัลลังก์ 1"; break;
            case "2" : $res[$i]['room'] = "บัลลังก์ 2"; break;
            case "3" : $res[$i]['room'] = "บัลลังก์ 3"; break;
            case "4" : $res[$i]['room'] = "บัลลังก์ 4"; break;
            default : $res[$i]['room'] = "---".$res[$i]['room'];
            }}

    }  
    
     if(!empty($res)){
        echo json_encode($res);
        } else {  echo json_encode(null); }



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

