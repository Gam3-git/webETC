<?php 

$_POST['action'] = "1";
// $_POST['casetext'] = "อ10/63";
// $_POST['caseno'] = "1";
// $_POST['casek_id'] = "101";
// $_POST['casetype'] = "คดีอาญา";

// $_POST['case_bnum'] ="พ31/65" ; 
// $_POST['case_j'] ="ท1" ; 
// $_POST['case_ju'] ="ท2" ; 
// $_POST['case_end'] ="2" ; 
// $_POST['case_win'] ="3" ; 
// $_POST['case_penaty'] = null ; 
// $_POST['case_rnum'] ="8588" ; 
// $_POST['case_ry'] ="65" ; 
// $_POST['case_rday'] ="03/10/2022" ; 
// $_POST['case_uname'] ="ทดสอบ" ; 



if(isset($_POST['action'])) {
    switch( $_POST['action'] ) {
        case "1" : func1(); break;
        case "2" : func2(); break;
        case "3" : func3(); break;
        case "4" : func4(); break;
        case "5" : func5(); break;
        case "6" : func6(); break;
        case "7" : func7(); break;
        case "8" : func8(); break;
        case "9" : func9(); break;
        case "10" : func10(); break;
        case "11" : func11(); break;
        case "12" : func12(); break;
        case "13" : func13(); break;
        case "14" : func14(); break;
        case "15" : func15(); break;
        case "16" : func16(); break;
        case "17" : func17(); break;
        default: echo json_encode(null);
}} else { echo json_encode(null); }


function func17(){     
    // $file = "\\\\SERVER\\ETC\\dataRAccess.mdb";
    
    $file = "C:/xampp/htdocs/access2praxticol/storage/dataRAccess.mdb";
    if (is_file($file)) {
        echo"File exists.\r\n";
    } else {
        echo"File not exists.\r\n";
    }}


// ตุลาการ
    function func1(){

        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        // $db = "\\\\SERVER\\ETC\\dataRAccess.mdb";
        // $driverdb = "odbc:testdb";

        try {
            $conn = new PDO($driverdb."Dbq=$db", null, null);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        }catch(PDOException $e)
        {
          echo $e->getMessage();                         
        }

        

        // $db = 'D:/DATA2Agenct/dataRRAccess.mdb';
        // $driverdb = 'odbc:Driver={Microsoft Access Driver (*.mdb)};';
        // $conn = new PDO($driverdb."Dbq=$db", null, null);

        $query = ConvertTIS620("SELECT [ผู้พิพากษาตัดสิน],[work] FROM [-ผู้พิพากษา] WHERE [mayhad] BETWEEN 0 AND 1 order by [work] asc");
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        $judtext = ArrayEncodeTH2D($row);

        $query = ConvertTIS620("SELECT * FROM 1Whowin ");
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetchALL(PDO::FETCH_ASSOC);
        $win_result = ArrayEncodeTH2D($row);

        if(!empty($judtext)){
            echo json_encode(array("judtext" => $judtext, "win_result" => $win_result));
        }else{
            $res = null;
            echo json_encode($judtext);
        }

    }
// ดึงคดีดำและตรวจคดีแดง
    function func2(){

        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
        $casetext = $_POST['casetext'];

        $query = ConvertTIS620("SELECT [แผนกรับฟ้อง].[ผ/ฝ],[แผนกรับฟ้อง].[หมายเลขแดงที่],[แผนกรับฟ้อง].[พศa],[แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] 
        FROM [แผนกรับฟ้อง] WHERE [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] ='$casetext' AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Not Null");
        $ch_red = $conn->prepare($query);
        $ch_red->execute();
        $row_red = $ch_red->fetch(PDO::FETCH_NUM);

        if ($row_red < 1){

                $TextV = '[แผนกรับฟ้อง].[หมายเลขดำที่/พศ],[แผนกรับฟ้อง].[ความ],[แผนกรับฟ้อง].[ความa],[แผนกรับฟ้อง].[ข้อหา],
                [แผนกรับฟ้อง].[วันเบิกนัดหน้า],[แผนกรับฟ้อง].[โจทก์],[แผนกรับฟ้อง].[จำเลย]';
                $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง] WHERE [หมายเลขดำที่/พศ] ='$casetext'
                AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is Null");
                $result = $conn->prepare($query);
                $result->execute();
                $row = $result->fetch(PDO::FETCH_NUM);
                if (!empty($row)){
                $case_result = ArrayEncodeTH($row);
                if(!empty($case_result)){
                if($case_result[1] != 'แพ่ง'){
                    $query = ConvertTIS620("SELECT * FROM 1end WHERE id BETWEEN 7 AND 14");
                }else {
                    $query = ConvertTIS620("SELECT * FROM 1end WHERE id BETWEEN 1 AND 6 OR id = 15");
                }
                    $result = $conn->prepare($query);
                    $result->execute();
                    $row = $result->fetchALL(PDO::FETCH_ASSOC);
                    $end_result = ArrayEncodeTH2D($row);

                echo json_encode(array("case_result" => $case_result, "end_result" => $end_result));

                } else { echo json_encode(null); }
            } else { echo json_encode(null); }

          } else {
            $row_red[1] = intval($row_red[1]);
            $row_red[2] = intval($row_red[2]);
            $red_num = ArrayEncodeTH($row_red);
            echo json_encode($red_num);
            // echo json_encode('test');
          }

    }
// ดึงวันนัดแพ่ง
    function func3(){

        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
        $casetext = $_POST['casetext'];

        $TextV = '[หมายเลขคดีดำที่/พศ],[นัดมาทำไม],[วันปัจจุบัน],[เวลา]';
        $query = ConvertTIS620("SELECT $TextV FROM [สมุดนัดพิจารณา] WHERE [หมายเลขคดีดำที่/พศ] ='$casetext' AND [วันปัจจุบัน] >= Date()");
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetchALL(PDO::FETCH_ASSOC);
        $nud_result = ArrayEncodeTH2D($row);

        if(!empty($nud_result)){
        echo json_encode($nud_result);
        } else { echo json_encode(null); }

    }
// ดึงจำเลยอาญา
    function func4(){

        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
        $casetext = $_POST['casetext'];

        $TextV = '[หมายเลขดำที่/พศ],[จำเลยที่],[ชื่อ และ นามสกุล]';
        $query = ConvertTIS620("SELECT $TextV FROM [จำเลย] WHERE [หมายเลขดำที่/พศ] ='$casetext' AND [คำพิพากษา] IS NULL AND [สถานะ] = 1 order by [จำเลยที่] asc ");
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetchALL(PDO::FETCH_ASSOC);
        $jum_result = ArrayEncodeTH2D($row);

            
        $query = ConvertTIS620("SELECT * FROM 1konpipaksa WHERE id >= 100");
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetchALL(PDO::FETCH_ASSOC);
        $pipaksa_result = ArrayEncodeTH2D($row);

        if(!empty($jum_result)){
            echo json_encode(array("jum_result" => $jum_result, "pipaksa_result" => $pipaksa_result));
        } else { echo json_encode(null); }

    }
// ลบวันนัดแพ่่ง
    function func5(){
        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
        $casetext = $_POST['casetext']; $casedate = $_POST['casedate']; $casename = $_POST['casename'];

        $query = ConvertTIS620("DELETE FROM [สมุดนัดพิจารณา] WHERE [หมายเลขคดีดำที่/พศ] ='$casetext' AND [นัดมาทำไม] ='$casename' AND [วันปัจจุบัน] =#$casedate#");
        $result = $conn->prepare($query);
        $result->execute();
        $count = $result->rowCount();
        if ($count > 0){
        echo json_encode($count);
        } else { echo json_encode(null); }

    }
// ตัดสินจำเลยอาญา
    function func6(){

        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
        $casetext = $_POST['casetext']; $caseno = (int)$_POST['caseno']; $casek_id = (int)$_POST['casek_id'];

        $query = ConvertTIS620("UPDATE [จำเลย] SET [จำเลย].[คำพิพากษา] = $casek_id WHERE [จำเลย].[หมายเลขดำที่/พศ] ='$casetext' AND [จำเลย].[จำเลยที่] = $caseno ");
        $result = $conn->prepare($query);
        $result->execute();
        $count = $result->rowCount();

        // echo($query);

        if ($count > 0){
        echo json_encode($count);
        } else { echo json_encode(null); }

    }
// คำนวนหาเลขแดงและเพิ่ม
    function func7(){

        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
    
        $casetype = $_POST['casetype'];
        $TextV = 'Max([แผนกรับฟ้องแดง].[หมายเลขแดงที่]) AS Red, Max([แผนกรับฟ้องแดง].[พศa]) AS Year';
        $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้องแดง] WHERE [ความa] ='$casetype' ");
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_NUM);

        if (!empty($row)){
        // $case_result = ArrayEncodeTH($row);

        $case_result = [intval($row[0]+1).'/'.intval($row[1]),$row[0]+1,$row[1]+0];

        $up_query = ConvertTIS620("INSERT INTO [แผนกรับฟ้องแดง] ([หมายเลขแดงที่],[พศa],[ความa]) VALUES ('$case_result[1]', '$case_result[2]', '$casetype')") ;
        $up_result = $conn->prepare($up_query);

            if ( $up_result->execute() ) {
                echo json_encode($case_result); 
            } else  {echo json_encode(null); }
        } else { echo json_encode(null); }

      
    }
// ออกแดง
    function func8(){
        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
        $case_bnum = $_POST['case_bnum']; $case_j = $_POST['case_j']; $case_ju = $_POST['case_ju'];
        $case_end = (int)$_POST['case_end']; $case_win = (int)$_POST['case_win']; $case_penaty = $_POST['case_penaty'];
        $case_rnum = (int)$_POST['case_rnum']; $case_ry = (int)$_POST['case_ry']; $case_rday = $_POST['case_rday'];
        $case_uname = $_POST['case_uname'];
        // $case_uday = strtotime("2010.12.11");
        $case_uday = date("m/d/Y", strtotime("+1 month", strtotime($case_rday)));

        $query = ConvertTIS620("UPDATE [แผนกรับฟ้อง] SET [แผนกรับฟ้อง].[ผู้พิพากษาตัดสิน] = '$case_j',
        [แผนกรับฟ้อง].[องค์คณะ] = '$case_ju',[แผนกรับฟ้อง].[เสร็จเพราะ] = $case_end, [แผนกรับฟ้อง].[ใครชนะ] = $case_win,
        [แผนกรับฟ้อง].[penalty] = '$case_penaty',[แผนกรับฟ้อง].[หมายเลขแดงที่] = $case_rnum,[แผนกรับฟ้อง].[พศa] = $case_ry,
        [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] = '$case_rday',[แผนกรับฟ้อง].[วันครบอุทธรณ์] ='$case_uday',
        [แผนกรับฟ้อง].[เหตุที่ค้าง] = 16,[แผนกรับฟ้อง].[namedang] = '$case_uname',[แผนกรับฟ้อง].[namework] = '$case_uname',
        [แผนกรับฟ้อง].[Timework] = NOW()
        WHERE [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] ='$case_bnum'");
        $result = $conn->prepare($query);
        $result->execute();
        $count = $result->rowCount();

        if ($count > 0){
        echo json_encode($count);
        } else { echo json_encode(null); }

      
    }
// ลบข้อมูลออกแดง
    function func9(){
        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
        $case_bnum = $_POST['case_bnum'];

        $query = ConvertTIS620("UPDATE [แผนกรับฟ้อง] SET [แผนกรับฟ้อง].[ผู้พิพากษาตัดสิน] = NULL,[แผนกรับฟ้อง].[องค์คณะ] = NULL,
        [แผนกรับฟ้อง].[เสร็จเพราะ] = NULL, [แผนกรับฟ้อง].[ใครชนะ] = NULL,
        [แผนกรับฟ้อง].[หมายเลขแดงที่] = NULL, [แผนกรับฟ้อง].[พศa] = NULL,
        [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] = NULL, [แผนกรับฟ้อง].[วันครบอุทธรณ์] = NULL,
        [แผนกรับฟ้อง].[เหตุที่ค้าง] = 14,[แผนกรับฟ้อง].[namedang] = NULL ,[แผนกรับฟ้อง].[Timework] = NOW()
        WHERE [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] ='$case_bnum'");
        $result = $conn->prepare($query);
        $result->execute();
        $count = $result->rowCount();

        if ($count > 0){
        echo json_encode($count);
        } else { echo json_encode(null); }
    }
// ดึงค่าเลขแดงล่าสุด
    function func10(){
        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);

        $TextV = '[แผนกรับฟ้องแดง].[ความa] AS T_red, Max([แผนกรับฟ้องแดง].[หมายเลขแดงที่]) AS Red, Max([แผนกรับฟ้องแดง].[พศa]) AS Year';
        $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้องแดง] GROUP BY [แผนกรับฟ้องแดง].[ความa]");
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetchALL(PDO::FETCH_ASSOC);
        $redmax_result = ArrayEncodeTH2D($row);
        
        if (!empty($redmax_result)){
            for($i=0; $i<sizeof($redmax_result); $i++){
                $redmax_result[$i]['Red'] = intval($redmax_result[$i]['Red']);
                $redmax_result[$i]['Year'] = intval($redmax_result[$i]['Year']);
            }
            echo json_encode($redmax_result); 
            } else  {echo json_encode(null); }

    }
//ลบค่าเลขแดงmax
    function func11(){
        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
        $casetext = $_POST['casetext']; $casenum = intval($_POST['casenum']); $caseyear = intval($_POST['caseyear']);
        $query = ConvertTIS620("DELETE FROM [แผนกรับฟ้องแดง] WHERE [ความa] = '$casetext' AND [หมายเลขแดงที่] = $casenum AND [พศa] = $caseyear");
        $result = $conn->prepare($query);
        $result->execute();
        $count = $result->rowCount();
        if ($count > 0){
        echo json_encode($count);
        } else { echo json_encode(null); }

    }

//เพิ่มค่าเลขแดงmax
    function func12(){
        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
        $casetext = $_POST['casetext']; $casenum = intval($_POST['casenum']+1); $caseyear = intval($_POST['caseyear']);
        $up_query = ConvertTIS620("INSERT INTO [แผนกรับฟ้องแดง] ([ความa],[หมายเลขแดงที่],[พศa]) VALUES ('$casetext', $casenum, $caseyear)") ;
        $up_result = $conn->prepare($up_query);
        $up_result->execute();
        $count = $up_result->rowCount();
        if ($count > 0){
        echo json_encode($count);
        } else { echo json_encode(null); }
    }

//ค้นคดีลงสารบบ
    function func13(){
        $json = file_get_contents('court.json');
        $dataj = json_decode($json, true);
        $db = $dataj['dbR'];
        $driverdb = $dataj['driverA'];
        $conn = new PDO($driverdb."Dbq=$db", null, null);
        $casetext = $_POST['casetext'];
            $TextV = '[แผนกรับฟ้อง].[หมายเลขดำที่/พศ],[แผนกรับฟ้อง].[ความa],[แผนกรับฟ้อง].[ข้อหา],[แผนกรับฟ้อง].[ผ/ฝ],
            [แผนกรับฟ้อง].[หมายเลขแดงที่],[แผนกรับฟ้อง].[พศa],[แผนกรับฟ้อง].[โจทก์],[แผนกรับฟ้อง].[จำเลย],Tsarabob.[หมายเลขดำที่/พศ],
            Tsarabob.[สารบบความ],Tsarabob.[สารบบคำพิพากษา],Tsarabob.DateK,Tsarabob.DateKS';
            $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง] 
            LEFT JOIN Tsarabob ON [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] = Tsarabob.[หมายเลขดำที่/พศ]
            WHERE [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] ='$casetext' ");
            $result = $conn->prepare($query);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_NUM);
            
            if (!empty($row)){
                $red_de_result = ArrayEncodeTH($row);
                echo json_encode($red_de_result);
            } else { echo json_encode(null); }

    }

// ดึงรูปแบบสารบบ
function func14(){

    $json = file_get_contents('court.json');
    $dataj = json_decode($json, true);
    $db = $dataj['dbR'];
    $driverdb = $dataj['driverA'];
    $conn = new PDO($driverdb."Dbq=$db", null, null);
    
    $query = ConvertTIS620("SELECT * FROM [1สารบบความ]");
    $result = $conn->prepare($query);
    $result->execute();
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $Bsarabob_text = ArrayEncodeTH2D($row);

    $query = ConvertTIS620("SELECT * FROM [1สารบบคำพิพากษา]");
    $result = $conn->prepare($query);
    $result->execute();
    $row = $result->fetchALL(PDO::FETCH_ASSOC);
    $Rsarabob_text = ArrayEncodeTH2D($row);

    if(!empty($Bsarabob_text)){
        echo json_encode(array("Bsarabob_text" => $Bsarabob_text, "Rsarabob_text" => $Rsarabob_text));
    }else{
        echo json_encode(null);
    }

}

// อัพเดทสารบบดำ
function func15(){

    $json = file_get_contents('court.json');
    $dataj = json_decode($json, true);
    $db = $dataj['dbR'];
    $driverdb = $dataj['driverA'];
    $conn = new PDO($driverdb."Dbq=$db", null, null);

    $case_bnum = $_POST['case_bnum']; $case_day = $_POST['case_day']; $case_text = $_POST['case_text'];

    $query = ConvertTIS620("SELECT Tsarabob.[หมายเลขดำที่/พศ] FROM Tsarabob WHERE Tsarabob.[หมายเลขดำที่/พศ] ='$case_bnum'");
    $ch_case = $conn->prepare($query);
    $ch_case->execute();
    $row_ch = $ch_case->fetch(PDO::FETCH_NUM);
    if ($row_ch < 1){
        $up_query = ConvertTIS620("INSERT INTO Tsarabob ([หมายเลขดำที่/พศ],[สารบบความ],[DateK]) VALUES ('$case_bnum', '$case_text', '$case_day')") ;
        $up_result = $conn->prepare($up_query);
        $up_result->execute();
    } else {
        $up_query = ConvertTIS620("UPDATE Tsarabob SET [สารบบความ] = '$case_text', [DateK] = '$case_day' WHERE [หมายเลขดำที่/พศ] = '$case_bnum' ") ;
        $up_result = $conn->prepare($up_query);
        $up_result->execute();
    }
    $count = $up_result->rowCount();
    if ($count > 0){
        echo json_encode($count);
    } else { echo json_encode(null); }

}

// อัพเดทสารบบแดง
function func16(){

    $json = file_get_contents('court.json');
    $dataj = json_decode($json, true);
    $db = $dataj['dbR'];
    $driverdb = $dataj['driverA'];
    $conn = new PDO($driverdb."Dbq=$db", null, null);

    $case_bnum = $_POST['case_bnum']; $case_day = $_POST['case_day']; $case_text = $_POST['case_text'];

        $up_query = ConvertTIS620("UPDATE Tsarabob SET [สารบบคำพิพากษา] = '$case_text', [DateKS] = '$case_day' WHERE [หมายเลขดำที่/พศ] = '$case_bnum' ") ;
        $up_result = $conn->prepare($up_query);
        $up_result->execute();
        $count = $up_result->rowCount();
    if ($count > 0){
        echo json_encode($count);
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

?>

