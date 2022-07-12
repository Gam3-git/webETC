<?php 
           $db = 'D:/DATA2Agenct/dataAccess.mdb';
           $driverdb = 'odbc:Driver={Microsoft Access Driver (*.mdb)};';
           $conn = new PDO($driverdb."Dbq=$db", null, null);
        //    $_GET["num"] = 4;

           $TextV2 = '[แผนกรับฟ้อง].[หมายเลขดำที่/พศ], [แผนกรับฟ้อง].[โจทก์], [แผนกรับฟ้อง].[จำเลย], [แผนกรับฟ้อง].[ชื่อผู้พิพากษา], Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง]';
           $TextV = '[แผนกรับฟ้อง].[หมายเลขดำที่/พศ], [แผนกรับฟ้อง].[โจทก์], [แผนกรับฟ้อง].[จำเลย], [แผนกรับฟ้อง].[ชื่อผู้พิพากษา], Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง] AS M3, MAX([สมุดนัดพิจารณา].[วันปัจจุบัน]) AS M1, MAX([สมุดนัดพิจารณา].[นัดมาทำไม]) AS M2';
          
           if(isset($_GET["num"]) && $_GET["num"]!=""){
            switch ($_GET["num"]){
                case 1 :
                    $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง]
                    LEFT JOIN [สมุดนัดพิจารณา] ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = [สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ]
                    WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
                    AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' 
                    AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' 
                    AND ((Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง]) IS NOT NULL) GROUP BY $TextV2");
                    break ;
                case 2 :
                    $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง]
                    LEFT JOIN [สมุดนัดพิจารณา] ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = [สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ]
                    WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
                    AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' 
                    AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย'
                    AND ((Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง]) < 91) GROUP BY $TextV2 ");
                    break ;
                case 3 :
                    $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง]
                    LEFT JOIN [สมุดนัดพิจารณา] ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = [สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ]
                    WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
                    AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' 
                    AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' 
                    AND ((Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง]) Between 91 AND 180) GROUP BY $TextV2 ");
                    break ;
                case 4 :
                    $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง]
                    LEFT JOIN [สมุดนัดพิจารณา] ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = [สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ]
                    WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
                    AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' 
                    AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' 
                    AND ((Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง]) Between 181 AND 365) GROUP BY $TextV2 ");
                    break ;
                case 5 :
                    $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง]
                    LEFT JOIN [สมุดนัดพิจารณา] ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = [สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ]
                    WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
                    AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' 
                    AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' AND [สมุดนัดพิจารณา].[วันปัจจุบัน] >= DATE() 
                    AND ((Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง]) Between 366 AND 730) GROUP BY $TextV2 ");
                    break ;
                case 6 :
                    $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง]
                    LEFT JOIN [สมุดนัดพิจารณา] ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = [สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ]
                    WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
                    AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' 
                    AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' AND [สมุดนัดพิจารณา].[วันปัจจุบัน] >= DATE() 
                    AND ((Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง]) Between 731 AND 1095) GROUP BY $TextV2 ");
                    break ;
                case 7 :
                    $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง]
                    LEFT JOIN [สมุดนัดพิจารณา] ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = [สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ]
                    WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
                    AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' 
                    AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' AND [สมุดนัดพิจารณา].[วันปัจจุบัน] >= DATE() 
                    AND ((Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง]) Between 1096 AND 1460) GROUP BY $TextV2 ");
                    break ;
                case 8 :
                    $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง]
                    LEFT JOIN [สมุดนัดพิจารณา] ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = [สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ]
                    WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
                    AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' 
                    AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' AND [สมุดนัดพิจารณา].[วันปัจจุบัน] >= DATE() 
                    AND ((Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง]) Between 1461 AND 1825) GROUP BY $TextV2 ");
                    break ;
                case 9 :
                    $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง]
                    LEFT JOIN [สมุดนัดพิจารณา] ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = [สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ]
                    WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
                    AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' 
                    AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' AND [สมุดนัดพิจารณา].[วันปัจจุบัน] >= DATE() 
                    AND ((Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง]) > 1825) GROUP BY $TextV2 ");
                    break ;
                default :
                    $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง]
                    LEFT JOIN [สมุดนัดพิจารณา] ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = [สมุดนัดพิจารณา].[หมายเลขคดีดำที่/พศ]
                    WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
                    AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' 
                    AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' AND [สมุดนัดพิจารณา].[วันปัจจุบัน] >= DATE() 
                    AND ((Date()-[แผนกรับฟ้อง].[วันเดือนปีรับฟ้อง]) >=0) GROUP BY $TextV2 ");
                break;
            }
           }

 
     

          $result = $conn->prepare($query);
           $result->execute();
           $row = $result->fetchAll(PDO::FETCH_ASSOC);
           $res = ArrayEncodeTH2D($row);
        //    print_r ($res);
        //    echo "<br> จำนวนทั้งหมด : " . count($row) . "<br>";  
            

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