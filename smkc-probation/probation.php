<?php
        // $_POST["caseB"] = "อ68/64"; 
        // $_POST["action"] = "3"; 


        if(isset($_POST['action'])) {
            switch( $_POST['action'] ) {
                case "1" : func1(); break;
                case "2" : func2(); break;
                case "3" : func3(); break;
                case "4" : func4(); break;
                case "5" : func5(); break;
                case "6" : func6(); break;
                case "7" : func7(); break;
                default: echo json_encode(null);
        }} else { echo json_encode(null); }

function func1(){
            $json = file_get_contents('court.json');
            $dataj = json_decode($json, true);
            $db = $dataj['dbA'];
            $driverdb = $dataj['driverA'];
            $conn = new PDO($driverdb."Dbq=$db", null, null);
            $TableN1 = 'จำเลย';
            // $caseB = array();
            $caseB = $_POST["caseB"];
            $FiledN1 = 'หมายเลขดำที่/พศ';
            $FiledN2 = 'สถานะ';
            $FiledN3 = 'ชื่อ และ นามสกุล';
            $FiledN4 = 'IDCard';
            $query = ConvertTIS620("SELECT [$FiledN1],[$FiledN3],[$FiledN4]  FROM [$TableN1] WHERE [$FiledN1] = '$caseB' AND [$FiledN2] = 1 ");
            $result = $conn->prepare($query);
            $result->execute();
            $row = $result->fetchAll(PDO::FETCH_ASSOC);
            $res = ArrayEncodeTH2D($row);
            if(!empty($res)){
                for($i=0; $i<sizeof($res); $i++){
                    if($res[$i]['IDCard'] == null) {
                        $res[$i]['IDCard'] = '-';
                    }
                }
                echo json_encode($res);
            }else{
                $res = null;
                echo json_encode($res);
            }

}

function func2(){
        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $servername = $dataj['dbMySql'];
        $username = $dataj['MySql_username'];
        $password = $dataj['MySql_password'];
        $dbname = $dataj['MySql_dbname'];
      try {
          $connsql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $connsql->exec("set names utf8");
          // set the PDO error mode to exception
          $connsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          // echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }

        $val_insert = array($_POST["obt1"], $_POST["obt2"], date("Y-m-d",strtotime($_POST["obt3"])), $_POST["obt4"],
        $_POST["obt5"], $_POST["obt6"], date("Y-m-d",strtotime($_POST["obt7"])),
        date("Y-m-d",strtotime($_POST["obt8"])), $_POST["obt9"], $_POST["obt10"],
        $_POST["obt11"], $_POST["obt12"], $_POST["obt13"], $_POST["obt14"]);

        $sql = "INSERT INTO kp_table1 (blacknum,book_num,date_book,name_per,idcard_per,book_to,date_order,
        date_probation,time_probation,num_book1,num_book2,name_app,position1,position2,file_n) 
          VALUES ('$val_insert[0]','$val_insert[1]','$val_insert[2]','$val_insert[3]','$val_insert[4]',
          '$val_insert[5]','$val_insert[6]','$val_insert[7]','$val_insert[8]','$val_insert[9]',
          '$val_insert[10]','$val_insert[11]','$val_insert[12]','$val_insert[13]','xxxxxxxx')";

        $connsql->prepare($sql)->execute();

        if ($connsql){ echo json_encode(1); } else { echo json_encode(null); }

}

function func3(){

        require_once '../vendor/autoload.php';
        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $servername = $dataj['dbMySql'];
        $username = $dataj['MySql_username'];
        $password = $dataj['MySql_password'];
        $dbname = $dataj['MySql_dbname'];
      try {
          $connsql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $connsql->exec("set names utf8");
          // set the PDO error mode to exception
          $connsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //   echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }

        $query = "SELECT * FROM kp_table1 ORDER BY id_kp1 DESC LIMIT 1";

        $res = $connsql->query($query)->fetch(PDO::FETCH_NUM);
        if(!empty($res)){

            $daybook = array(); $dayorder = array(); $dayprobation = array();
            $daybook = convertdate($res[3]);
            $dayorder = convertdate($res[7]);
            $dayprobation = convertdate($res[8]);
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word-tmp/formkp1.docx');
           
            $templateProcessor->setValue([
                'numbook','t1','t2','t3','t4','t5','t6','t7','t9','t10',
                't11','t12','t13','t14','t15','t16','t17','t18','t19','t20'
            ],[
                $res[2],$daybook[0],$daybook[1],$daybook[2],$res[6],$res[10],$res[11],$res[1],
                $dayorder[0],$dayorder[1],$dayorder[2],$res[4],convert_idcard($res[5]),
                $dayprobation[0],$dayprobation[1],$dayprobation[2],$res[9],
                $res[12],$res[13],$res[14]
            ] );

            $f_kp1='formkp1_fill_'.$res[0].'_'.$res[2].'_'.$daybook[2].'.docx';
            $d_kp1 = checkFolderY('formkp1-fill',$daybook[2]);
            $templateProcessor->saveAs( $d_kp1.$f_kp1 );
            $query = "UPDATE kp_table1 SET file_n = '$f_kp1' WHERE id_kp1 = $res[0]";
            $result = $connsql->prepare($query);
            $result->execute();
            $count = $result->rowCount();

        echo json_encode($d_kp1.$f_kp1);
        } else { echo json_encode(null); }

}

function func4(){
    $json = file_get_contents('court.json');
    $dataj = json_decode($json, true);
    $servername = $dataj['dbMySql'];
    $username = $dataj['MySql_username'];
    $password = $dataj['MySql_password'];
    $dbname = $dataj['MySql_dbname'];
  try {
      $connsql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $connsql->exec("set names utf8");
      // set the PDO error mode to exception
      $connsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //   echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    $book_c = $_POST["obt2"]; 
    $date_c = $_POST["obt3"];
    $query = "SELECT book_num, date_book FROM kp_table1 WHERE book_num = $book_c AND date_book = '$date_c' ";

    $res = $connsql->query($query)->fetch(PDO::FETCH_NUM);
    if(!empty($res)){
    echo json_encode($res);
    } else { echo json_encode(null); }

}

function func5(){
    $json = file_get_contents('court.json');
    $dataj = json_decode($json, true);
    $servername = $dataj['dbMySql'];
    $username = $dataj['MySql_username'];
    $password = $dataj['MySql_password'];
    $dbname = $dataj['MySql_dbname'];
  try {
      $connsql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $connsql->exec("set names utf8");
      // set the PDO error mode to exception
      $connsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //   echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    $book_c = $_POST["obt2"]; 
    $date_c = $_POST["obt3"];
    $query = "SELECT book_num, date_book FROM kp_table2 WHERE book_num = $book_c AND date_book = '$date_c' ";

    $res = $connsql->query($query)->fetch(PDO::FETCH_NUM);
    if(!empty($res)){
    echo json_encode($res);
    } else { echo json_encode(null); }

}

function func6(){
    $json = file_get_contents('court.json');
    $dataj = json_decode($json, true);
    $servername = $dataj['dbMySql'];
    $username = $dataj['MySql_username'];
    $password = $dataj['MySql_password'];
    $dbname = $dataj['MySql_dbname'];
  try {
      $connsql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $connsql->exec("set names utf8");
      // set the PDO error mode to exception
      $connsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    $val_insert = array($_POST["obt1"], $_POST["obt2"], $_POST["obt3"], $_POST["obt4"],
    date("Y-m-d",strtotime($_POST["obt5"])), date("Y-m-d",strtotime($_POST["obt6"])), $_POST["obt7"],
    $_POST["obt8"],$_POST["obt9"], $_POST["obt10"]);

    $sql = "INSERT INTO kp_table2 (blacknum, book_num, name_per, book_to, date_book, date_order,
    num_book1, name_app, position1, position2, file_n) 
      VALUES ('$val_insert[0]','$val_insert[1]','$val_insert[2]','$val_insert[3]','$val_insert[4]',
      '$val_insert[5]','$val_insert[6]','$val_insert[7]','$val_insert[8]','$val_insert[9]','xxxxxxxx')";

    $connsql->prepare($sql)->execute();

    if ($connsql){ echo json_encode(1); } else { echo json_encode(null); }

}

function func7(){

    require_once '../vendor/autoload.php';
    $json = file_get_contents('court.json');
    $dataj = json_decode($json, true);
    $servername = $dataj['dbMySql'];
    $username = $dataj['MySql_username'];
    $password = $dataj['MySql_password'];
    $dbname = $dataj['MySql_dbname'];
  try {
      $connsql = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $connsql->exec("set names utf8");
      // set the PDO error mode to exception
      $connsql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //   echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    $query = "SELECT * FROM kp_table2 ORDER BY id_kp2 DESC LIMIT 1";

    $res = $connsql->query($query)->fetch(PDO::FETCH_NUM);
    if(!empty($res)){

        $daybook = array(); $dayorder = array(); 
        $daybook = convertdate($res[5]);
        $dayorder = convertdate($res[6]);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('word-tmp/formkp2.docx');
       
        $templateProcessor->setValue([
            'numbook','t1','t2','t3','t4','t5','t6',
            't7','t8','t9','t10','t11','t12','t13'
        ],[
            $res[2],$daybook[0],$daybook[1],$daybook[2],$res[4],$res[7],$res[1],
            $dayorder[0],$dayorder[1],$dayorder[2],$res[3],
            $res[8],$res[9],$res[10]
        ] );

        $f_kp='formkp2_fill_'.$res[0].'_'.$res[2].'_'.$daybook[2].'.docx';
        $d_kp = checkFolderY('formkp2-fill',$daybook[2]);
        $templateProcessor->saveAs( $d_kp.$f_kp );
        $query = "UPDATE kp_table2 SET file_n = '$f_kp' WHERE id_kp2 = $res[0]";
        $result = $connsql->prepare($query);
        $result->execute();
        $count = $result->rowCount();

    echo json_encode($d_kp.$f_kp);
    } else { echo json_encode(null); }

}


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

        function checkFolderY($typeF, $yearF) {
            $dir_cr = "word-result/".$typeF."/".$yearF."/";
            if(!is_dir($dir_cr)) {
                mkdir($dir_cr);
                } 
            return $dir_cr;
        }
        
        function convertdate($date) {
            //แยกตัวเลขออกจากเครื่องหมาย -
                $day = substr($date, 8, 2);
                $year = substr($date, 0, 4);
                $month = substr($date, 5, 2);
            //ทำการสร้าง Array ที่เก็บเดือนต่างๆ
                $thai_month_arr=array(
                "0"=>"",
                "01"=>"มกราคม",
                "02"=>"กุมภาพันธ์",
                "03"=>"มีนาคม",
                "04"=>"เมษายน",
                "05"=>"พฤษภาคม",
                "06"=>"มิถุนายน",	
                "07"=>"กรกฎาคม",
                "08"=>"สิงหาคม",
                "09"=>"กันยายน",
                "10"=>"ตุลาคม",
                "11"=>"พฤศจิกายน",
                "12"=>"ธันวาคม"					
            );
            //ทำการเลือกเดือนตามตัวเลขที่ระบุ
                $month_final = $thai_month_arr[($month)];
                $year_final = intval( $year ) + 543 ;
            //ทำการรวม วัน เดือน ปี เข้าเป็นตัวแปรเดียวกัน เพื่อเตรียมส่งค่าออกนอกฟังก์ชัน
                $date_arr = array($day,$month_final,$year_final); 
            //ส่งค่าออกนอกฟังก์ชัน เพื่อนำไปใช้งานต่อ
                return $date_arr;
        }
            
        function convert_idcard($idcard) {
            if(!empty($idcard)){
                $idcard_fill = substr($idcard, 0, 1)."-".substr($idcard, 1, 4)."-".
                substr($idcard, 5, 5)."-".substr($idcard, 10, 2)."-".substr($idcard, 12, 1);
                return $idcard_fill;
            } else {  return '-' ; }
                
        }


?>