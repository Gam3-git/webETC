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

            $queryRT = "SELECT sub1.Count_1,sub2.Count_2,sub3.Count_3,sub4.Count_4
            FROM  (SELECT Count([หมายเลขดำที่/พศ]) AS Count_1 FROM [Succ_r]) AS sub1, 
            (SELECT Count([หมายเลขดำที่/พศ]) AS Count_2 FROM [Succ_r] WHERE [เสร็จเพราะ] BETWEEN 8 AND 9) AS sub2,  
            (SELECT Count([หมายเลขดำที่/พศ]) AS Count_3 FROM [Succ_r] WHERE [เสร็จเพราะ] = 7) AS sub3, 
            (SELECT Count([หมายเลขดำที่/พศ]) AS Count_4 FROM [Succ_r] WHERE [เสร็จเพราะ] BETWEEN 10 AND 14) AS sub4;
              
              
            SELECT sub1.Count_1, sub2.Count_2, sub3.Count_3, sub4.Count_4, sub5.Count_5, sub6.Count_6, sub7.Count_7
            FROM (SELECT Count([หมายเลขดำที่/พศ]) AS Count_1 FROM [Succ_Pb]) AS sub1, 
            (SELECT Count([หมายเลขดำที่/พศ]) AS Count_2 FROM [Succ_Pb] WHERE [ระยะเวลา] BETWEEN 0 AND 31) AS sub2,
            (SELECT Count([หมายเลขดำที่/พศ]) AS Count_3 FROM [Succ_Pb] WHERE [ระยะเวลา] BETWEEN 32 AND 90) AS sub3,
             (SELECT Count([หมายเลขดำที่/พศ]) AS Count_4 FROM [Succ_Pb] WHERE [ระยะเวลา] BETWEEN 91 AND 182) AS sub4,
              (SELECT Count([หมายเลขดำที่/พศ]) AS Count_5 FROM [Succ_Pb] WHERE [ระยะเวลา] BETWEEN 183 AND 366) AS sub5,
               (SELECT Count([หมายเลขดำที่/พศ]) AS Count_6 FROM [Succ_Pb] WHERE [ระยะเวลา] BETWEEN 367 AND 731) AS sub6,
                (SELECT Count([หมายเลขดำที่/พศ]) AS Count_7 FROM [Succ_Pb] WHERE [ระยะเวลา] >= 732) AS sub7;


            SELECT sub1.Count_1, sub2.Count_2, sub3.Count_3, sub4.Count_4, sub5.Count_5, sub6.Count_6, sub7.Count_7, sub8.Count_8, sub9.Count_9, sub10.Count_10, sub11.Count_11
            FROM (SELECT Count([หมายเลขดำที่/พศ]) AS Count_1 FROM [Succ_Pb]) AS sub1, 
            (SELECT Count([หมายเลขดำที่/พศ]) AS Count_2 FROM [Succ_Pb] WHERE [ทุนทรัพย์] = 0) AS sub2,
            (SELECT Count([หมายเลขดำที่/พศ]) AS Count_3 FROM [Succ_Pb] WHERE [ทุนทรัพย์] BETWEEN 1 AND 50000) AS sub3,
             (SELECT Count([หมายเลขดำที่/พศ]) AS Count_4 FROM [Succ_Pb] WHERE [ทุนทรัพย์] BETWEEN 50001 AND 300000) AS sub4,
              (SELECT Count([หมายเลขดำที่/พศ]) AS Count_5 FROM [Succ_Pb] WHERE [ทุนทรัพย์] BETWEEN 300001 AND 500000) AS sub5,
               (SELECT Count([หมายเลขดำที่/พศ]) AS Count_6 FROM [Succ_Pb] WHERE [ทุนทรัพย์] BETWEEN 500001 AND 1000000) AS sub6,
                (SELECT Count([หมายเลขดำที่/พศ]) AS Count_7 FROM [Succ_Pb] WHERE [ทุนทรัพย์] BETWEEN 1000001 AND 5000000) AS sub7,
                (SELECT Count([หมายเลขดำที่/พศ]) AS Count_8 FROM [Succ_Pb] WHERE [ทุนทรัพย์] BETWEEN 5000001 AND 10000000) AS sub8,
                (SELECT Count([หมายเลขดำที่/พศ]) AS Count_9 FROM [Succ_Pb] WHERE [ทุนทรัพย์] BETWEEN 10000001 AND 50000000) AS sub9,
                (SELECT Count([หมายเลขดำที่/พศ]) AS Count_10 FROM [Succ_Pb] WHERE [ทุนทรัพย์] BETWEEN 50000001 AND 100000000) AS sub10,
                (SELECT Count([หมายเลขดำที่/พศ]) AS Count_11 FROM [Succ_Pb] WHERE [ทุนทรัพย์] >= 100000001) AS sub11;

         

                


    
                SELECT sub1.Count_1, sub2.Count_2
                FROM (SELECT Count([ข้อหาเสร็จ_p].[หมายเลขดำที่/พศ]) AS Count_1
                FROM 1kohaP LEFT JOIN ข้อหาเสร็จ_p ON [1kohaP].[no] = [ข้อหาเสร็จ_p].[เรื่อง] 
                GROUP BY [1kohaP].[no], [1kohaP].[เรื่อง] ORDER BY [1kohaP].[no]) AS sub1,
                (SELECT Count([ข้อหารับใหม่_P].[หมายเลขดำที่/พศ]) AS Count_2
                FROM 1kohaP LEFT JOIN ข้อหารับใหม่_P ON [1kohaP].[no] = [ข้อหารับใหม่_P].[เรื่อง] 
                GROUP BY [1kohaP].[no], [1kohaP].[เรื่อง] ORDER BY [1kohaP].[no]) AS sub2; 


                GROUP BY [1kohaP].[no], [1kohaP].[เรื่อง]
                ORDER BY [1kohaP].[no];

                




 
?>