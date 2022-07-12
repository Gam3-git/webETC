<?php 

// $_POST['action'] = "3";
    if(isset($_POST['action'])){
      if ($_POST['action'] == "1") { func1(); }
      if ($_POST['action'] == "2") { func2(); }
      if ($_POST['action'] == "3") { func3(); }
    }

    function func3(){
 
      // $servername = "localhost";
      // $username = "root";
      // $password = "";
      $servername = "10.37.76.4";
      // $servername = "SMKCnas0740ea.myqnapcloud.com";
      $username = "smkc";
      $password = "SmKc307.014";
      $dbname = "accessdata";
      
      try {
          $connsql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          // set the PDO error mode to exception
          $connsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          // echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }

        
        $today =  date('y-m-d');
        $query = "SELECT id FROM remain_detailcount WHERE dateremain_detail = '$today'";
        $check = $connsql->query($query)->fetch();

        if(empty($check)) {

          $db = 'D:/DATA2Agenct/dataAccess.mdb';
          $driverdb = 'odbc:Driver={Microsoft Access Driver (*.mdb)};';
          $conn = new PDO($driverdb."Dbq=$db", null, null);

          $FiledN1 = 'แผนกรับฟ้อง';
          $FiledN2 = 'หมายเลขดำที่/พศ';  //แผนกรับฟ้อง
          $TextV = "[แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน' AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 
          OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null 
          AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %'
          AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' ";
          $TextVB ="[แผนกรับฟ้อง].[ความ] = 'แพ่ง' AND [แผนกรับฟ้อง].[ความa] Like '%ผู้บริโภค%'";
          $TextVP ="[แผนกรับฟ้อง].[ความ] = 'แพ่ง' AND [แผนกรับฟ้อง].[ความa] Not Like '%ผู้บริโภค%'";
          $TextVR ="[แผนกรับฟ้อง].[ความ] = 'อาญา'";

          $query = ConvertTIS620("SELECT sub1.Count_1, sub2.Count_2, sub3.Count_3, sub4.Count_4, sub5.Count_5, sub6.Count_6, 
          sub7.Count_7, sub8.Count_8, sub9.Count_9, sub10.Count_10, sub11.Count_11, sub12.Count_12,
          sub13.Count_13, sub14.Count_14, sub15.Count_15, sub16.Count_16, sub17.Count_17, sub18.Count_18,
          sub19.Count_19, sub20.Count_20, sub21.Count_21, sub22.Count_22, sub23.Count_23, sub24.Count_24 
          FROM (SELECT Count([$FiledN2]) AS Count_1 
          FROM [$FiledN1] WHERE $TextV AND $TextVB AND ((Date()-[วันเดือนปีรับฟ้อง]) < 91)) AS sub1,
          (SELECT Count([$FiledN2]) AS Count_2 
          FROM [$FiledN1] WHERE $TextV AND $TextVP AND ((Date()-[วันเดือนปีรับฟ้อง]) < 91)) AS sub2,
          (SELECT Count([$FiledN2]) AS Count_3 
          FROM [$FiledN1] WHERE $TextV AND $TextVR AND ((Date()-[วันเดือนปีรับฟ้อง]) < 91)) AS sub3,
          (SELECT Count([$FiledN2]) AS Count_4 
          FROM [$FiledN1] WHERE $TextV AND $TextVB AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 91 AND 180)) AS sub4,
          (SELECT Count([$FiledN2]) AS Count_5 
          FROM [$FiledN1] WHERE $TextV AND $TextVP AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 91 AND 180)) AS sub5,
          (SELECT Count([$FiledN2]) AS Count_6 
          FROM [$FiledN1] WHERE $TextV AND $TextVR AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 91 AND 180)) AS sub6,
          (SELECT Count([$FiledN2]) AS Count_7 
          FROM [$FiledN1] WHERE $TextV AND $TextVB AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 181 AND 365)) AS sub7,
          (SELECT Count([$FiledN2]) AS Count_8 
          FROM [$FiledN1] WHERE $TextV AND $TextVP AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 181 AND 365)) AS sub8,
          (SELECT Count([$FiledN2]) AS Count_9 
          FROM [$FiledN1] WHERE $TextV AND $TextVR AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 181 AND 365)) AS sub9,
          (SELECT Count([$FiledN2]) AS Count_10 
          FROM [$FiledN1] WHERE $TextV AND $TextVB AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 366 AND 730)) AS sub10,
          (SELECT Count([$FiledN2]) AS Count_11 
          FROM [$FiledN1] WHERE $TextV AND $TextVP AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 366 AND 730)) AS sub11,
          (SELECT Count([$FiledN2]) AS Count_12 
          FROM [$FiledN1] WHERE $TextV AND $TextVR AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 366 AND 730)) AS sub12,
          (SELECT Count([$FiledN2]) AS Count_13 
          FROM [$FiledN1] WHERE $TextV AND $TextVB AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 731 AND 1095)) AS sub13,
          (SELECT Count([$FiledN2]) AS Count_14 
          FROM [$FiledN1] WHERE $TextV AND $TextVP AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 731 AND 1095)) AS sub14,
          (SELECT Count([$FiledN2]) AS Count_15 
          FROM [$FiledN1] WHERE $TextV AND $TextVR AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 731 AND 1095)) AS sub15,
          (SELECT Count([$FiledN2]) AS Count_16 
          FROM [$FiledN1] WHERE $TextV AND $TextVB AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 1096 AND 1460)) AS sub16,
          (SELECT Count([$FiledN2]) AS Count_17 
          FROM [$FiledN1] WHERE $TextV AND $TextVP AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 1096 AND 1460)) AS sub17,
          (SELECT Count([$FiledN2]) AS Count_18 
          FROM [$FiledN1] WHERE $TextV AND $TextVR AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 1096 AND 1460)) AS sub18,
          (SELECT Count([$FiledN2]) AS Count_19 
          FROM [$FiledN1] WHERE $TextV AND $TextVB AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 1461 AND 1825)) AS sub19,
          (SELECT Count([$FiledN2]) AS Count_20 
          FROM [$FiledN1] WHERE $TextV AND $TextVP AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 1461 AND 1825)) AS sub20,
          (SELECT Count([$FiledN2]) AS Count_21 
          FROM [$FiledN1] WHERE $TextV AND $TextVR AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 1461 AND 1825)) AS sub21,
          (SELECT Count([$FiledN2]) AS Count_22 
          FROM [$FiledN1] WHERE $TextV AND $TextVB AND ((Date()-[วันเดือนปีรับฟ้อง]) > 1826)) AS sub22,
          (SELECT Count([$FiledN2]) AS Count_23 
          FROM [$FiledN1] WHERE $TextV AND $TextVP AND ((Date()-[วันเดือนปีรับฟ้อง]) > 1826)) AS sub23,
          (SELECT Count([$FiledN2]) AS Count_24 
          FROM [$FiledN1] WHERE $TextV AND $TextVR AND ((Date()-[วันเดือนปีรับฟ้อง]) > 1826)) AS sub24;
          ");
     
          $remain_ca = $conn->query($query)->fetch(PDO::FETCH_NUM);  
          
          

          $sql = "INSERT INTO remain_detailcount (dateremain_detail,3mB,3mP,3mR,6mB,6mP,6mR,
          1yB,1yP,1yR,2yB,2yP,2yR,3yB,3yP,3yR,4yB,4yP,4yR,5yB,5yP,5yR,6yB,6yP,6yR) 
          VALUES ('$today','$remain_ca[0]','$remain_ca[1]','$remain_ca[2]','$remain_ca[3]','$remain_ca[4]','$remain_ca[5]',
          '$remain_ca[6]','$remain_ca[7]','$remain_ca[8]','$remain_ca[9]','$remain_ca[10]','$remain_ca[11]',
          '$remain_ca[12]','$remain_ca[13]','$remain_ca[14]','$remain_ca[15]','$remain_ca[16]','$remain_ca[17]',
          '$remain_ca[18]','$remain_ca[19]','$remain_ca[20]','$remain_ca[21]','$remain_ca[22]','$remain_ca[23]')";

          $connsql->prepare($sql)->execute();

      } 
      $query = "SELECT * FROM remain_detailcount WHERE dateremain_detail = '$today'";
      $res = $connsql->query($query)->fetch(PDO::FETCH_NUM);

     if(!empty($res)){
        echo json_encode($res);
        } else { $res = null; echo json_encode($res); }

    }

    function func2(){
      // $servername = "localhost";
      // $username = "root";
      // $password = "";
      $servername = "10.37.76.4";
      $username = "smkc";
      $password = "SmKc307.014";
      $dbname = "accessdata";
        
        try {
            $connsql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $connsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }

          $today =  date('y-m-d');
          $sql = "DELETE FROM remaincount WHERE dateremain = '$today'";
          $connsql->prepare($sql)->execute();
          $sql = "DELETE FROM remain_detailcount WHERE dateremain_detail = '$today'";
          $connsql->prepare($sql)->execute();

    }

    function func1(){
  
      // $servername = "localhost";
      // $username = "root";
      // $password = "";
      $servername = "10.37.76.4";
      $username = "smkc";
      $password = "SmKc307.014";
      $dbname = "accessdata";
        
        try {
            $connsql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $connsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }

          $today =  date('y-m-d');
          $query = "SELECT id FROM remaincount WHERE dateremain = '$today'";
          $check = $connsql->query($query)->fetch();

          if(empty($check)) {

            $db = 'D:/DATA2Agenct/dataAccess.mdb';
            $driverdb = 'odbc:Driver={Microsoft Access Driver (*.mdb)};';
            $conn = new PDO($driverdb."Dbq=$db", null, null);
                    
            $query = ConvertTIS620("SELECT Count([แผนกรับฟ้อง].[หมายเลขดำที่/พศ]) FROM [แผนกรับฟ้อง] 
            WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
            AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' 
            AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' AND ((Date()-[วันเดือนปีรับฟ้อง]) IS NOT NULL)");
            $all_remain_count = $conn->query($query)->fetchColumn();

            $query = ConvertTIS620("SELECT Count([แผนกรับฟ้อง].[หมายเลขดำที่/พศ]) FROM [แผนกรับฟ้อง] 
            WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
            AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' 
            AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' 
            AND ((Date()-[วันเดือนปีรับฟ้อง]) < 91)");
            $threeM_remain = $conn->query($query)->fetchColumn();

            $query = ConvertTIS620("SELECT Count([แผนกรับฟ้อง].[หมายเลขดำที่/พศ]) FROM [แผนกรับฟ้อง] 
            WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
            AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' 
            AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' 
            AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 91 AND 180)");
            $sixM_remain = $conn->query($query)->fetchColumn();

            $query = ConvertTIS620("SELECT Count([แผนกรับฟ้อง].[หมายเลขดำที่/พศ]) FROM [แผนกรับฟ้อง] 
            WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
            AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' 
            AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' 
            AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 181 AND 365)");
            $OneY_remain = $conn->query($query)->fetchColumn();

            $query = ConvertTIS620("SELECT Count([แผนกรับฟ้อง].[หมายเลขดำที่/พศ]) FROM [แผนกรับฟ้อง] 
            WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
            AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' 
            AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' 
            AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 366 AND 730)");
            $TwoY_remain = $conn->query($query)->fetchColumn();

            $query = ConvertTIS620("SELECT Count([แผนกรับฟ้อง].[หมายเลขดำที่/พศ]) FROM [แผนกรับฟ้อง] 
            WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
            AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' 
            AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' 
            AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 731 AND 1095)");
            $ThreeY_remain = $conn->query($query)->fetchColumn();

            $query = ConvertTIS620("SELECT Count([แผนกรับฟ้อง].[หมายเลขดำที่/พศ]) FROM [แผนกรับฟ้อง] 
            WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
            AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' 
            AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' 
            AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 1096 AND 1460)");
            $FourY_remain = $conn->query($query)->fetchColumn();

            $query = ConvertTIS620("SELECT Count([แผนกรับฟ้อง].[หมายเลขดำที่/พศ]) FROM [แผนกรับฟ้อง] 
            WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
            AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' 
            AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' 
            AND ((Date()-[วันเดือนปีรับฟ้อง]) Between 1461 AND 1825)");
            $FiveY_remain = $conn->query($query)->fetchColumn();

            $query = ConvertTIS620("SELECT Count([แผนกรับฟ้อง].[หมายเลขดำที่/พศ]) FROM [แผนกรับฟ้อง] 
            WHERE [แผนกรับฟ้อง].[ความa] NOT LIKE 'คดีแรงงาน'AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) 
            AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '%.%' 
            AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like '% %' AND [แผนกรับฟ้อง].[ผ/ฝ] Not Like 'กฟย' 
            AND ((Date()-[วันเดือนปีรับฟ้อง]) > 1825)");
            $SixY_remain = $conn->query($query)->fetchColumn();

            $sql = "INSERT INTO remaincount (dateremain, allcount, 3m, 6m, 1y, 2y, 3y, 4y, 5y, 6y) 
            VALUES ('$today', $all_remain_count, $threeM_remain, 
            $sixM_remain, $OneY_remain, $TwoY_remain, $ThreeY_remain, 
            $FourY_remain, $FiveY_remain, $SixY_remain)";

            $connsql->prepare($sql)->execute();

        } 

        $query = "SELECT * FROM remaincount WHERE dateremain = '$today'";
        $check = $connsql->query($query)->fetch(PDO::FETCH_NUM);

            echo json_encode(array("all_remain_count" => $check[2], 
                "threeM_remain" => $check[3], "sixM_remain" => $check[4],
                "OneY_remain" => $check[5], "TwoY_remain" => $check[6],
                "ThreeY_remain" => $check[7], "FourY_remain" => $check[8],
                "FiveY_remain" => $check[9], "SixY_remain" => $check[10]));

    }

    function ConvertUTF8($value){
      return iconv('TIS-620', 'UTF-8',$value);
    }
    function ConvertTIS620($value){
        return iconv('UTF-8','TIS-620',$value);
    }
?>

