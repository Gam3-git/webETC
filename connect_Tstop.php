<?php 

            $db = 'D:/DATA2Agenct/access2search.mdb';
            $driverdb = 'odbc:Driver={Microsoft Access Driver (*.mdb)};';
            $conn = new PDO($driverdb."Dbq=$db", null, null);
            $TableN1 = 'Tstop';
            $FiledN1 = 'DateT';
            $queryRT = "SELECT Count($FiledN1) FROM $TableN1 Where $FiledN1 = date() ";
            $resultRT = $conn -> prepare($queryRT);
            $resultRT -> execute();
            $rowRT = $resultRT->fetchAll(PDO::FETCH_NUM);
            print_r ($rowRT); echo "<br><br>";
            if($rowRT[0][0] != 0){$work = 1;}else{$work = 0;}  
 
?>