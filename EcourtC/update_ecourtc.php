<?php 

    $db = 'D:/DATA2Agenct/dataAccess.mdb';
    $driverdb = 'odbc:Driver={Microsoft Access Driver (*.mdb)};';
    $conn = new PDO($driverdb."Dbq=$db", null, null);

    $case_id = $_POST['case_id'];
	$text_detail = $_POST['text_detail'];
    $text_date = $_POST["text_date"];

    
    $TableN1 = 'แผนกรับฟ้อง';
    $TableN2 = 'สมุดนัดพิจารณา';
    $FiledN1 = 'หมายเลขดำที่/พศ';  //แผนกรับฟ้อง
    $FiledN2 = 'หมายเลขคดีดำที่/พศ'; //สมุดนัด 
    $FiledN3 = 'วันปัจจุบัน'; 
    $TextV = '[แผนกรับฟ้อง].[หมายเลขดำที่/พศ], [สมุดนัดพิจารณา].[วันปัจจุบัน], [สมุดนัดพิจารณา].[นัดมาทำไม], [สมุดนัดพิจารณา].[ห้องพิจารณาคดีที่], [สมุดนัดพิจารณา].[ผู้ขอเลื่อนคดี], [แผนกรับฟ้อง].[ความ], [แผนกรับฟ้อง].[ข้อหา], [แผนกรับฟ้อง].[tot]';
 
     $query = ConvertTIS620("SELECT $TextV FROM [$TableN1] LEFT JOIN [$TableN2] ON [$TableN1].[$FiledN1] = [$TableN2].[$FiledN2] WHERE [$TableN1].[$FiledN1] = '$case_id' AND [$TableN2].[$FiledN3] = #$text_date#");


        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_NUM);
        $res = ArrayEncodeTH($row);
    //    print_r ($res);

    $up_query = ConvertTIS620("INSERT INTO ECourtC (case_id, appointment_date, appointment_detail, room, remark, type_case, detail_case, type_appiont, Ecase_Check, Ecase_detail) VALUES ('$res[0]', '$res[1]', '$res[2]', '$res[3]', '$res[4]', '$res[5]', '$res[6]', '$res[7]', 1, '$text_detail')") ;
    $up_result = $conn->prepare($up_query);

    if ( $up_result->execute() ) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
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