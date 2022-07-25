<?php
        // $_POST["caseB"] = "อ68/64"; 
        $_POST["action"] = "3"; 
        $_POST["num_type"] = "1";
        $_POST["kp_id"] = 2;

        if(isset($_POST['action'])) {
            switch( $_POST['action'] ) {
                case "1" : search_access(); break;
                case "2" : kp_in(); break;
                case "3" : kp_word(); break;
                case "4" : check_numbook(); break;
                case "5" : update_kp(); break;
                case "6" : update_case_kp(); break;
                case "7" : search_kp(); break;
                case "8" : search_redaccess(); break;
                default: echo json_encode(null);
        }} else { echo json_encode(null); }

function search_access(){
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
function search_redaccess(){
    $json = file_get_contents('court.json');
    $dataj = json_decode($json, true);
    $db = $dataj['dbA'];
    $driverdb = $dataj['driverA'];
    $conn = new PDO($driverdb."Dbq=$db", null, null);

    // SELECT [แผนกรับฟ้อง].[หมายเลขดำที่/พศ], [แผนกรับฟ้อง].[ผ/ฝ], [แผนกรับฟ้อง].[หมายเลขแดงที่], [แผนกรับฟ้อง].พศa, [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน], [จำเลย].[จำเลยที่], [จำเลย].[ชื่อ และ นามสกุล], [จำเลย].IDCard, [จำเลยหมาย].[ชื่อ และ นามสกุล], [จำเลยหมาย].[ที่อยู่]
    // FROM (แผนกรับฟ้อง LEFT JOIN จำเลย ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = [จำเลย].[หมายเลขดำที่/พศ]) LEFT JOIN จำเลยหมาย ON ([จำเลย].[ชื่อ และ นามสกุล] = [จำเลยหมาย].[ชื่อ และ นามสกุล]) AND ([จำเลย].[หมายเลขดำที่/พศ] = [จำเลยหมาย].[หมายเลขดำที่/พศ])
    // WHERE ((([แผนกรับฟ้อง].[หมายเลขดำที่/พศ])="อ68/64") AND (([จำเลย].สถานะ)=1));

    $TableN1 = 'แผนกรับฟ้อง';
    $TableN2 = 'จำเลย';
    $TableN3 = 'จำเลยหมาย';
    $caseB = $_POST["caseB"];
    $FiledN1 = 'หมายเลขดำที่/พศ';
    $FiledN2 = 'สถานะ';
    $FiledN3 = 'ชื่อ และ นามสกุล';
    $select_q = '[แผนกรับฟ้อง].[หมายเลขดำที่/พศ], [แผนกรับฟ้อง].[ผ/ฝ], [แผนกรับฟ้อง].[หมายเลขแดงที่], [แผนกรับฟ้อง].พศa, [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน], [จำเลย].[ชื่อ และ นามสกุล], [จำเลย].IDCard, [จำเลยหมาย].[ชื่อ และ นามสกุล], [จำเลยหมาย].[ที่อยู่]';
    $query = ConvertTIS620("SELECT $select_q FROM ([$TableN1] LEFT JOIN [$TableN2] ON [$TableN1].[$FiledN1] = [$TableN2].[$FiledN1])
    LEFT JOIN [$TableN3] ON [$TableN2].[$FiledN1] = ([$TableN3].[$FiledN1]) AND ([$TableN2].[$FiledN3] = [$TableN3].[$FiledN3])
    WHERE [$TableN1].[$FiledN1] = '$caseB' AND [$TableN2].[$FiledN2] = 1 ");
    $result = $conn->prepare($query);
    $result->execute();
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $res = ArrayEncodeTH2D($row);
    if(!empty($res)){
        for($i=0; $i<sizeof($res); $i++){
            if($res[$i]['หมายเลขแดงที่'] != null) {
                $res[$i]['หมายเลขแดงที่'] = intval( $res[$i]['หมายเลขแดงที่'] );
                $res[$i]['พศa'] = intval( $res[$i]['พศa'] );
            } 
        }
        echo json_encode($res);
    }else{
        echo json_encode(null);
    }

}

function kp_in(){
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

        $type_num = $_POST["num_type"];

        if(isset( $type_num )) {
            switch( $type_num ) {
                case "1" : 
                    $val_insert = array($_POST["obt1"], $_POST["obt2"], date("Y-m-d",strtotime($_POST["obt3"])), $_POST["obt4"],
                    $_POST["obt5"], $_POST["obt6"], date("Y-m-d",strtotime($_POST["obt7"])),
                    date("Y-m-d",strtotime($_POST["obt8"])), $_POST["obt9"], $_POST["obt10"],
                    $_POST["obt11"], $_POST["obt12"], $_POST["obt13"], $_POST["obt14"], $_POST["obt_kp"]);
            
                    $sql = "INSERT INTO kp_table1 (blacknum,book_num,date_book,name_per,idcard_per,book_to,date_order,
                    date_probation,time_probation,num_book1,num_book2,name_app,position1,position2,kp_type,file_n) 
                      VALUES ('$val_insert[0]','$val_insert[1]','$val_insert[2]','$val_insert[3]','$val_insert[4]',
                      '$val_insert[5]','$val_insert[6]','$val_insert[7]','$val_insert[8]','$val_insert[9]',
                      '$val_insert[10]','$val_insert[11]','$val_insert[12]','$val_insert[13]'
                      ,'$val_insert[14]','xxxxxxxx')";
                    $connsql->prepare($sql)->execute();
                    $kp_id = $connsql->lastInsertId();
                break;
                case "2" : 
                    $val_insert = array($_POST["obt1"], $_POST["obt2"], $_POST["obt3"], $_POST["obt4"],
                    date("Y-m-d",strtotime($_POST["obt5"])), date("Y-m-d",strtotime($_POST["obt6"])), $_POST["obt7"],
                    $_POST["obt8"],$_POST["obt9"], $_POST["obt10"], $_POST["obt_kp"]);
                
                    $sql = "INSERT INTO kp_table2 (blacknum, book_num, name_per, book_to, date_book, date_order,
                    num_book1, name_app, position1, position2, kp_type, file_n) 
                      VALUES ('$val_insert[0]','$val_insert[1]','$val_insert[2]','$val_insert[3]','$val_insert[4]',
                      '$val_insert[5]','$val_insert[6]','$val_insert[7]','$val_insert[8]',
                      '$val_insert[9]','$val_insert[10]','xxxxxxxx')";
                    $connsql->prepare($sql)->execute();
                    $kp_id = $connsql->lastInsertId();
                break;
                case "4" : 
                    $val_insert = array($_POST["case_bid"],$_POST["obt1"], $_POST["obt2"], date("Y-m-d",strtotime($_POST["obt3"])), 
                    $_POST["obt4"], $_POST["obt5"], $_POST["obt6"], $_POST["obt7"],
                    date("Y-m-d",strtotime($_POST["obt8"])), date("Y-m-d",strtotime($_POST["obt9"])), $_POST["obt10"],
                    $_POST["obt11"], $_POST["obt12"], $_POST["obt13"], $_POST["obt14"], $_POST["obt15"], $_POST["obt16"], 
                    $_POST["obt17"], $_POST["obt18"], $_POST["obt19"], $_POST["obt20"], $_POST["obt21"],
                    $_POST["obt22"], $_POST["obt_kp"] );
                    $sql = "INSERT INTO kp_table4 (blacknum, rednum, book_num, date_book, name_per,
                    idcard_per, book_to, num_book1, date_order, date_probation, time_probation,
                    address_1, address_2, address_3, address_4, address_5, address_6,
                    address_7, address_8, address_9, name_app, position1, position2, kp_type, file_n) 
                      VALUES ('$val_insert[0]','$val_insert[1]','$val_insert[2]','$val_insert[3]','$val_insert[4]',
                      '$val_insert[5]','$val_insert[6]','$val_insert[7]','$val_insert[8]','$val_insert[9]',
                      '$val_insert[10]','$val_insert[11]','$val_insert[12]','$val_insert[13]','$val_insert[14]',
                      '$val_insert[15]','$val_insert[16]','$val_insert[17]','$val_insert[18]','$val_insert[19]',
                      '$val_insert[20]','$val_insert[21]','$val_insert[22]','$val_insert[23]','xxxxxxxx')";
                    $connsql->prepare($sql)->execute();
                    $kp_id = $connsql->lastInsertId();
                break;
                case "5" : 
                    $val_insert = array($_POST["case_bid"],$_POST["obt1"], $_POST["obt2"], $_POST["obt3"], $_POST["obt4"],
                    date("Y-m-d",strtotime($_POST["obt5"])), date("Y-m-d",strtotime($_POST["obt6"])), $_POST["obt7"],
                    $_POST["obt8"],$_POST["obt9"], $_POST["obt10"], $_POST["obt_kp"]);
                
                    $sql = "INSERT INTO kp_table5 (blacknum, rednum, book_num, name_per, book_to, date_book, date_order,
                    num_book1, name_app, position1, position2, kp_type, file_n) 
                      VALUES ('$val_insert[0]','$val_insert[1]','$val_insert[2]','$val_insert[3]','$val_insert[4]',
                      '$val_insert[5]','$val_insert[6]','$val_insert[7]','$val_insert[8]',
                      '$val_insert[9]','$val_insert[10]','$val_insert[11]','xxxxxxxx')";
                    $connsql->prepare($sql)->execute();
                    $kp_id = $connsql->lastInsertId();
                break;
                case "6" : 
                    $val_insert = array($_POST["obt1"], $_POST["obt2"], $_POST["obt3"], $_POST["obt4"],
                    date("Y-m-d",strtotime($_POST["obt5"])), date("Y-m-d",strtotime($_POST["obt6"])), $_POST["obt7"],
                    $_POST["obt8"],$_POST["obt9"], $_POST["obt10"], $_POST["obt11"], 
                    date("Y-m-d",strtotime($_POST["obt12"])), $_POST["obt_kp"]);
                
                    $sql = "INSERT INTO kp_table6 (blacknum, book_num, name_per, book_to, date_book, date_order,
                    num_book1, name_app, position1, position2, book_numkp, date_bookkp, kp_type, file_n) 
                      VALUES ('$val_insert[0]','$val_insert[1]','$val_insert[2]','$val_insert[3]','$val_insert[4]',
                      '$val_insert[5]','$val_insert[6]','$val_insert[7]','$val_insert[8]','$val_insert[9]',
                      '$val_insert[10]','$val_insert[11]','$val_insert[12]','xxxxxxxx')";
                    $connsql->prepare($sql)->execute();
                    $kp_id = $connsql->lastInsertId();
                break;
                default: $kp_id = null ;
        } }

        if (isset($kp_id)){ echo json_encode($kp_id); } else { echo json_encode(null); }

}

function kp_word(){

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

        // Gears\Pdf::convert('word-tmp/tem1.docx', 'word-tmp/temp99.pdf');

        // $document = new Gears\Pdf('word-tmp/temp88.docx');
        // $document->converter = function()
        // {
        //     return new Gears\Pdf\Docx\Converter\Unoconv();
        // };
        // $document->save('word-tmp/temp99.pdf');

        $type_num = $_POST["num_type"];
        $id_kp = $_POST["kp_id"];
        if(isset( $type_num )) {
            switch( $type_num ) {
            case "1" :
                $query = "SELECT * FROM kp_table1 WHERE id_kp1 =$id_kp";
                $res = $connsql->query($query)->fetch(PDO::FETCH_NUM);
                if(!empty($res)){
                $daybook = array(); $dayorder = array(); $dayprobation = array();
                $daybook = convertdate($res[3]);
                $dayorder = convertdate($res[7]);
                $dayprobation = convertdate($res[8]);
                if ($res[16] == 1) { 
                    $word_kp = 'word-tmp/formkp1.docx' ;
                    $f_kp='formkp1_fill_'.$res[0].'_'.$res[2].'_'.$daybook[2].'.docx';
                    $d_kp = checkFolderY('formkp1-fill',$daybook[2]); 
                } else { 
                    $word_kp = 'word-tmp/formkpy1.docx' ;
                    $f_kp='formkpy1_fill_'.$res[0].'_'.$res[2].'_'.$daybook[2].'.docx';
                    $d_kp = checkFolderY('formkpy1-fill',$daybook[2]);  
                }
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($word_kp);
            
                $templateProcessor->setValue([
                    'numbook','t1','t2','t3','t4','t5','t6','t7','t9','t10',
                    't11','t12','t13','t14','t15','t16','t17','t18','t19','t20'
                ],[
                    $res[2],$daybook[0],$daybook[1],$daybook[2],$res[6],$res[10],$res[11],$res[1],
                    $dayorder[0],$dayorder[1],$dayorder[2],$res[4],convert_idcard($res[5]),
                    $dayprobation[0],$dayprobation[1],$dayprobation[2],$res[9],
                    $res[12],$res[13],$res[14]
                ] );
                
                $templateProcessor->saveAs( $d_kp.$f_kp );
                $query = "UPDATE kp_table1 SET file_n = '$f_kp' WHERE id_kp1 = $res[0]";
                $result = $connsql->prepare($query);
                $result->execute();
                    echo json_encode($d_kp.$f_kp);
                } else { echo json_encode(null); }
            break;

            case "2" :
                $query = "SELECT * FROM kp_table2 WHERE id_kp2 =$id_kp";
                $res = $connsql->query($query)->fetch(PDO::FETCH_NUM);
                if(!empty($res)){
                $daybook = array(); $dayorder = array(); 
                $daybook = convertdate($res[5]);
                $dayorder = convertdate($res[6]);

                if ($res[12] == 1) { 
                    $word_kp = 'word-tmp/formkp2.docx' ;
                    $f_kp='formkp2_fill_'.$res[0].'_'.$res[2].'_'.$daybook[2].'.docx';
                    $d_kp = checkFolderY('formkp2-fill',$daybook[2]); 
                } else { 
                    $word_kp = 'word-tmp/formkpy2.docx' ;
                    $f_kp='formkpy2_fill_'.$res[0].'_'.$res[2].'_'.$daybook[2].'.docx';
                    $d_kp = checkFolderY('formkpy2-fill',$daybook[2]);  
                }
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($word_kp);
            
                $templateProcessor->setValue([
                    'numbook','t1','t2','t3','t4','t5','t6',
                    't7','t8','t9','t10','t11','t12','t13'
                ],[
                    $res[2],$daybook[0],$daybook[1],$daybook[2],$res[4],$res[7],$res[1],
                    $dayorder[0],$dayorder[1],$dayorder[2],$res[3],
                    $res[8],$res[9],$res[10]
                ] );

                $templateProcessor->saveAs( $d_kp.$f_kp );
                $query = "UPDATE kp_table2 SET file_n = '$f_kp' WHERE id_kp2 = $res[0]";
                $result = $connsql->prepare($query);
                $result->execute();
                    echo json_encode($d_kp.$f_kp);
                } else { echo json_encode(null); }
            break;

            case "4" :
                $query = "SELECT * FROM kp_table4 WHERE id_kp4 =$id_kp";
                $res = $connsql->query($query)->fetch(PDO::FETCH_NUM);
                if(!empty($res)){
                $daybook = array(); $dayorder = array(); $dayprobation = array();
                $daybook = convertdate($res[4]);
                $dayorder = convertdate($res[7]);
                $dayprobation = convertdate($res[10]);
                if ($res[25] == 1) { 
                    $word_kp = 'word-tmp/formkp4.docx' ;
                    $f_kp='formkp4_fill_'.$res[0].'_'.$res[3].'_'.$daybook[2].'.docx';
                    $d_kp = checkFolderY('formkp4-fill',$daybook[2]); 
                } else { 
                    $word_kp = 'word-tmp/formkpy3.docx' ;
                    $f_kp='formkpy3_fill_'.$res[0].'_'.$res[3].'_'.$daybook[2].'.docx';
                    $d_kp = checkFolderY('formkpy3-fill',$daybook[2]);  
                }
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($word_kp);
            
                $templateProcessor->setValue([
                    'numbook','t1','t2','t3','t4','t5','t6','t7','t8','t9','t10',
                    't11','t12','t13','t14','t15','t16','t17','t18','t19','t20'
                    ,'t21','t22','t23','t24','t25','t26','t27'
                ],[
                    $res[3],$daybook[0],$daybook[1],$daybook[2],$res[5],$res[6],
                    $res[2],$dayorder[0],$dayorder[1],$dayorder[2],$res[8],
                    convert_idcard($res[9]),$dayprobation[0],$dayprobation[1],$dayprobation[2],$res[11],
                    $res[12],$res[13],$res[14],$res[15],$res[16],
                    $res[17],$res[18],$res[19],convert_phone($res[20]),$res[21],
                    $res[22],$res[23]
                ] );

                $templateProcessor->saveAs( $d_kp.$f_kp );
                $query = "UPDATE kp_table4 SET file_n = '$f_kp' WHERE id_kp4 = $res[0]";
                $result = $connsql->prepare($query);
                $result->execute();
                    echo json_encode($d_kp.$f_kp);
                } else { echo json_encode(null); }
            break;

            case "5" :
                $query = "SELECT * FROM kp_table5 WHERE id_kp5 =$id_kp";
                $res = $connsql->query($query)->fetch(PDO::FETCH_NUM);
                if(!empty($res)){
                $daybook = array(); $dayorder = array(); 
                $daybook = convertdate($res[6]);
                $dayorder = convertdate($res[7]);
                if ($res[13] == 1) { 
                    $word_kp = 'word-tmp/formkp5.docx' ;
                    $f_kp='formkp5_fill_'.$res[0].'_'.$res[3].'_'.$daybook[2].'.docx';
                    $d_kp = checkFolderY('formkp5-fill',$daybook[2]); 
                } else { 
                    $word_kp = 'word-tmp/formkpy4.docx' ;
                    $f_kp='formkpy4_fill_'.$res[0].'_'.$res[3].'_'.$daybook[2].'.docx';
                    $d_kp = checkFolderY('formkpy4-fill',$daybook[2]);  
                }
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($word_kp);
            
                $templateProcessor->setValue([
                    'numbook','t1','t2','t3','t4','t5','t6',
                    't7','t8','t9','t10','t11','t12','t13'
                ],[
                    $res[3],$daybook[0],$daybook[1],$daybook[2],$res[5],$res[8],$res[2],
                    $dayorder[0],$dayorder[1],$dayorder[2],$res[4],
                    $res[9],$res[10],$res[11]
                ] );

                $templateProcessor->saveAs( $d_kp.$f_kp );
                $query = "UPDATE kp_table5 SET file_n = '$f_kp' WHERE id_kp5 = $res[0]";
                $result = $connsql->prepare($query);
                $result->execute();
                    echo json_encode($d_kp.$f_kp);
                } else { echo json_encode(null); }
            break;

            case "6" :
                $query = "SELECT * FROM kp_table6 WHERE id_kp6 =$id_kp";
                $res = $connsql->query($query)->fetch(PDO::FETCH_NUM);
                if(!empty($res)){
                $daybook = array(); $dayorder = array(); $daybookkp = array();
                $daybook = convertdate($res[5]);
                $dayorder = convertdate($res[6]);
                $daybookkp = convertdate($res[12]);
                if ($res[14] == 1) { 
                    $word_kp = 'word-tmp/formkp6.docx' ;
                    $f_kp='formkp6_fill_'.$res[0].'_'.$res[2].'_'.$daybook[2].'.docx';
                    $d_kp = checkFolderY('formkp6-fill',$daybook[2]); 
                } else { 
                    $word_kp = 'word-tmp/formkpy5.docx' ;
                    $f_kp='formkpy5_fill_'.$res[0].'_'.$res[2].'_'.$daybook[2].'.docx';
                    $d_kp = checkFolderY('formkpy5-fill',$daybook[2]);  
                }
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($word_kp);
            
                $templateProcessor->setValue([
                    'numbook','t1','t2','t3','t4','t5','t6',
                    't7','t8','t9','t10','t11','t12','t13','t14','t15'
                ],[
                    $res[2],$daybook[0],$daybook[1],$daybook[2],$res[4],$res[11],$daybookkp[0].' '.$daybookkp[1].' '.$daybookkp[2],
                    $res[7],$res[1],$dayorder[0],$dayorder[1],$dayorder[2],$res[3],$res[8],$res[9],$res[10]
                ] );

                $templateProcessor->saveAs( $d_kp.$f_kp );
                $query = "UPDATE kp_table6 SET file_n = '$f_kp' WHERE id_kp6 = $res[0]";
                $result = $connsql->prepare($query);
                $result->execute();
                    echo json_encode($d_kp.$f_kp);
                } else { echo json_encode(null); }
            break;

            default: echo json_encode(null) ;
            }}

}

function check_numbook(){
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
    $type_num = $_POST["num_type"];
    if(isset($type_num)) {
        switch( $type_num ) {
            case "1" : $table_c = "kp_table1"; break;
            case "2" : $table_c = "kp_table2"; break;
            case "4" : $table_c = "kp_table4"; break;
            case "5" : $table_c = "kp_table5"; break;
            case "6" : $table_c = "kp_table6"; break;
            default: $table_c = "kp_table1";

    } }
    $query = "SELECT book_num, date_book FROM $table_c WHERE book_num = $book_c AND date_book = '$date_c' ";

    $res = $connsql->query($query)->fetch(PDO::FETCH_NUM);
    if(!empty($res)){
    echo json_encode($res);
    } else { echo json_encode(null); }

}

function update_kp(){

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

    $type_num = $_POST["num_type"];
    $id_ukp = $_POST["id_kp"];
    if(isset( $type_num )) {
        switch( $type_num ) {
            case "1" :
                $val_insert = array($_POST["obt1"], $_POST["obt2"], date("Y-m-d",strtotime($_POST["obt3"])), $_POST["obt4"],
                $_POST["obt5"], $_POST["obt6"], date("Y-m-d",strtotime($_POST["obt7"])),
                date("Y-m-d",strtotime($_POST["obt8"])), $_POST["obt9"], $_POST["obt10"],
                $_POST["obt11"], $_POST["obt12"], $_POST["obt13"], $_POST["obt14"], $_POST["obt_kp"]);

                $query = "UPDATE kp_table1 SET blacknum = '$val_insert[0]', book_num = '$val_insert[1]',
                date_book = '$val_insert[2]',name_per = '$val_insert[3]',idcard_per = '$val_insert[4]',
                book_to = '$val_insert[5]',date_order = '$val_insert[6]',date_probation = '$val_insert[7]',
                time_probation = '$val_insert[8]',num_book1 = '$val_insert[9]',num_book2 = '$val_insert[10]',
                name_app = '$val_insert[11]',position1 = '$val_insert[12]',
                position2 = '$val_insert[13]',kp_type= '$val_insert[14]'
                WHERE id_kp1 = $id_ukp";

                $result = $connsql->prepare($query);
                $result->execute();
                $count = $result->rowCount();
            break; 
            case "2" :
                $val_insert = array($_POST["obt1"], $_POST["obt2"], $_POST["obt3"], $_POST["obt4"],
                date("Y-m-d",strtotime($_POST["obt5"])), date("Y-m-d",strtotime($_POST["obt6"])), $_POST["obt7"],
                $_POST["obt8"],$_POST["obt9"], $_POST["obt10"], $_POST["obt_kp"]);

                $query = "UPDATE kp_table2 SET blacknum = '$val_insert[0]', book_num = '$val_insert[1]',
                name_per = '$val_insert[2]',book_to = '$val_insert[3]',date_book = '$val_insert[4]',
                date_order = '$val_insert[5]',num_book1 = '$val_insert[6]',name_app = '$val_insert[7]',
                position1 = '$val_insert[8]',position2 = '$val_insert[9]',kp_type= '$val_insert[10]'
                WHERE id_kp2 = $id_ukp";

                $result = $connsql->prepare($query);
                $result->execute();
                $count = $result->rowCount();
            break; 
            case "4" :
                $val_insert = array($_POST["case_bid"], $_POST["obt1"], $_POST["obt2"], date("Y-m-d",strtotime($_POST["obt3"])), 
                $_POST["obt4"], $_POST["obt5"], $_POST["obt6"], $_POST["obt7"],
                date("Y-m-d",strtotime($_POST["obt8"])), date("Y-m-d",strtotime($_POST["obt9"])), $_POST["obt10"],
                $_POST["obt11"], $_POST["obt12"], $_POST["obt13"], $_POST["obt14"], $_POST["obt15"], $_POST["obt16"], 
                $_POST["obt17"], $_POST["obt18"], $_POST["obt19"], $_POST["obt20"],
                $_POST["obt21"], $_POST["obt22"], $_POST["obt_kp"] );

                $query = "UPDATE kp_table4 SET blacknum = '$val_insert[0]', rednum = '$val_insert[1]',
                book_num = '$val_insert[2]',date_book = '$val_insert[3]',name_per = '$val_insert[4]',
                idcard_per = '$val_insert[5]',book_to = '$val_insert[6]',num_book1 = '$val_insert[7]',
                date_order = '$val_insert[8]',date_probation = '$val_insert[9]',time_probation = '$val_insert[10]',
                address_1 = '$val_insert[11]',address_2 = '$val_insert[12]',address_3 = '$val_insert[13]',
                address_4 = '$val_insert[14]',address_5 = '$val_insert[15]',address_6 = '$val_insert[16]',
                address_7 = '$val_insert[17]',address_8 = '$val_insert[18]',address_9 = '$val_insert[19]',
                name_app = '$val_insert[20]',position1 = '$val_insert[21]',position2 = '$val_insert[22]',
                kp_type= '$val_insert[23]'
                WHERE id_kp4 = $id_ukp";

                $result = $connsql->prepare($query);
                $result->execute();
                $count = $result->rowCount();
            break; 
            case "5" :
                $val_insert = array($_POST["case_bid"], $_POST["obt1"], $_POST["obt2"], $_POST["obt3"], $_POST["obt4"],
                date("Y-m-d",strtotime($_POST["obt5"])), date("Y-m-d",strtotime($_POST["obt6"])), $_POST["obt7"],
                $_POST["obt8"],$_POST["obt9"], $_POST["obt10"], $_POST["obt_kp"]);

                $query = "UPDATE kp_table5 SET blacknum = '$val_insert[0]', rednum = '$val_insert[1]', 
                book_num = '$val_insert[2]', name_per = '$val_insert[3]',book_to = '$val_insert[4]',
                date_book = '$val_insert[5]', date_order = '$val_insert[6]',num_book1 = '$val_insert[7]',
                name_app = '$val_insert[8]', position1 = '$val_insert[9]',position2 = '$val_insert[10]',
                kp_type= '$val_insert[11]'
                WHERE id_kp5 = $id_ukp";

                $result = $connsql->prepare($query);
                $result->execute();
                $count = $result->rowCount();
            break; 
            case "6" :
                $val_insert = array( $_POST["obt1"], $_POST["obt2"], $_POST["obt3"], $_POST["obt4"],
                date("Y-m-d",strtotime($_POST["obt5"])), date("Y-m-d",strtotime($_POST["obt6"])), $_POST["obt7"],
                $_POST["obt8"],$_POST["obt9"], $_POST["obt10"], $_POST["obt11"],
                 date("Y-m-d",strtotime($_POST["obt12"])), $_POST["obt_kp"] );

                $query = "UPDATE kp_table6 SET blacknum = '$val_insert[0]', book_num = '$val_insert[1]',
                name_per = '$val_insert[2]',book_to = '$val_insert[3]',date_book = '$val_insert[4]',
                date_order = '$val_insert[5]',num_book1 = '$val_insert[6]',name_app = '$val_insert[7]',
                position1 = '$val_insert[8]',position2 = '$val_insert[9]',book_numkp = '$val_insert[10]',
                date_bookkp = '$val_insert[11]',kp_type= '$val_insert[12]'
                WHERE id_kp6 = $id_ukp";

                $result = $connsql->prepare($query);
                $result->execute();
                $count = $result->rowCount();
            break; 
            default : $count = null;
        }}
        if (isset($count)){ echo json_encode($count); } else { echo json_encode(null); }

}

function update_case_kp(){
    
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

    $caseB = $_POST["caseB"];
    $type_num = $_POST["num_type"];

    if(isset($type_num)) {
        switch( $type_num ) {
            case "1" : $table_c = "kp_table1"; break;
            case "2" : $table_c = "kp_table2"; break;
            case "4" : $table_c = "kp_table4"; break;
            case "5" : $table_c = "kp_table5"; break;
            case "6" : $table_c = "kp_table6"; break;
            default: $table_c = "kp_table1";
    } }
    $query = "SELECT * FROM $table_c WHERE blacknum = '$caseB'";
    $res = $connsql->query($query)->fetchAll(PDO::FETCH_NUM);
    if(!empty($res)){
        echo json_encode($res);
        } else { echo json_encode(null); }

}

function search_kp(){
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
    $caseB = $_POST["caseB"];
    $type_num = $_POST["num_type"];

    if(isset( $type_num )) {
        switch( $type_num ) {
            case "5" : 
                $query = "SELECT blacknum,rednum, name_per, book_num, date_book, kp_type FROM kp_table4 WHERE blacknum = '$caseB'";
                $reskp4 = $connsql->query($query)->fetchAll(PDO::FETCH_NUM);
                if(!empty($reskp4)){
                    echo json_encode($reskp4);
                }else{
                    echo json_encode(null);
                } 
            break;
            case "6" :
                $query = "SELECT blacknum, name_per, book_num, date_book, kp_type FROM kp_table1 WHERE blacknum = '$caseB'";
                $reskp1 = $connsql->query($query)->fetchAll(PDO::FETCH_NUM);
                $query = "SELECT blacknum, name_per, book_num, date_book, kp_type FROM kp_table2 WHERE blacknum = '$caseB'";
                $reskp2 = $connsql->query($query)->fetchAll(PDO::FETCH_NUM);
                if(!empty($reskp1 && $reskp2)){
                    echo json_encode(array("valuekp1" => $reskp1, "valuekp2" => $reskp2));
                }else{
                    echo json_encode(null);
                } 
            break;
            default: echo json_encode(null);
    } }

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
            if(strpos(substr($date, 8, 1),"0") !== false){
                $day = substr($date, 9, 1);
            } else { $day = substr($date, 8, 2); }
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

        function convert_phone($phone) {
            if(!empty($phone)){
                $phone_fill = substr($phone, 0, 3)."-".substr($phone, 3, 4)."-".
                substr($phone, 6, 3);
                return $phone_fill;
            } else {  return '-' ; }
                
        }


?>