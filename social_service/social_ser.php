<?php 
// $_POST['action'] = "1";
// $_POST['casetext'] = "อ10/65";

if(isset($_POST['action'])) {
    switch( $_POST['action'] ) {
        case "1" : func1(); break;
        default: echo json_encode(null);
}} else { echo json_encode(null); }

// ดึงคดีดำ
function func1(){

    $db = 'D:/DATA2Agenct/dataAccess.mdb';
    $driverdb = 'odbc:Driver={Microsoft Access Driver (*.mdb)};';
    $conn = new PDO($driverdb."Dbq=$db", null, null);
    $casetext = $_POST['casetext'];

    $TextV = '[แผนกรับฟ้อง].[ผ/ฝ],[แผนกรับฟ้อง].[หมายเลขดำที่],[แผนกรับฟ้อง].[พศ],[แผนกรับฟ้อง].[หมายเลขแดงที่],[แผนกรับฟ้อง].[พศa],
    [แผนกรับฟ้อง].[ความa],[แผนกรับฟ้อง].[ข้อหา],[แผนกรับฟ้อง].[โจทก์],[แผนกรับฟ้อง].[จำเลย]';
    $query = ConvertTIS620("SELECT $TextV FROM [แผนกรับฟ้อง] WHERE [แผนกรับฟ้อง].[หมายเลขดำที่/พศ] ='$casetext' AND [แผนกรับฟ้อง].[วันเดือนปีที่ตัดสิน] Is NOT Null AND ([แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 1 OR [แผนกรับฟ้อง].[คำฟ้อง/คำร้อง] = 2) ");
    $result = $conn->prepare($query);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_NUM);
    if (!empty($row)){
    $row[1] = intval($row[1]); $row[2] = intval($row[2]); $row[3] = intval($row[3]); $row[4] = intval($row[4]);
    $case_result = ArrayEncodeTH($row); 
    if(!empty($case_result)){ 
        $TextV = '[จำเลยหมาย].[ชื่อ และ นามสกุล],[จำเลยหมาย].[สัญชาติ],[จำเลยหมาย].[อาชีพ],
        [จำเลยหมาย].[อายุ],[จำเลยหมาย].[ตรอก],[จำเลยหมาย].[ซอย],[จำเลยหมาย].[อยู่บ้านเลขที่],
        [จำเลยหมาย].[หมู่],[จำเลยหมาย].[ถนน],[จำเลยหมาย].[ตำบล],[จำเลยหมาย].[อำเภอ],
        [จำเลยหมาย].[จังหวัด],[จำเลยหมาย].[โทรศัพท์],[จำเลยหมาย].[ที่อยู่]';
        $query = ConvertTIS620("SELECT $TextV FROM [จำเลยหมาย] WHERE [จำเลยหมาย].[หมายเลขดำที่/พศ] ='$casetext'
        AND [จำเลยหมาย].[อำเภอ] IS NOT NULL AND [จำเลยหมาย].[จังหวัด] IS NOT NULL ");
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetchALL(PDO::FETCH_ASSOC);
        $jum_result = ArrayEncodeTH2D($row); 
    
        $TextV = '[จำเลย].[จำเลยที่],[จำเลย].[ชื่อ และ นามสกุล],[1konpipaksa].kumpaksa,[จำเลย].[ให้กักขัง],[จำเลย].[ตั้งแต่วันที่]';
        $query = ConvertTIS620("SELECT $TextV FROM [จำเลย] INNER JOIN 1konpipaksa ON [จำเลย].[คำพิพากษา] = [1konpipaksa].id
        WHERE [จำเลย].[หมายเลขดำที่/พศ] ='$casetext' AND [จำเลย].[สถานะ] = 1");
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetchALL(PDO::FETCH_ASSOC);
        $jumkum_result = ArrayEncodeTH2D($row);

    if(empty($jum_result)){ $jum_result = null; } 
    if(empty($jumkum_result)) { $jumkum_result = null; }

    echo json_encode(array("case_result" => $case_result, "jum_result" => $jum_result, "jumkum_result" => $jumkum_result)); }
        
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