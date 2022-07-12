<?php
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "gdms";
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);
        $conn -> set_charset("utf8"); /*แปลงภาษา */
        $today = date("Y-m-d");
        // $before_today = Date("Y-m-d", strtotime("$today -1 Day"));
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // echo "Connected successfully";
        
        $sql = "SELECT form, title, created_at, asarabun_comment, dateput FROM files WHERE dateput >= '$today'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        $num_1=$result->num_rows;
        // while($row = $result->fetch_assoc()) {  
        //     echo "<br>หนังสือของ : " .$row["form"]. "<br> เรื่อง : " . $row["title"]. "<br> วันรับ : " . $row["created_at"]. 
        //     "<br> ส่วนช่วย : " . $row["asarabun_comment"]. "<br> วันที่จ่าย : " . $row["dateput"]." <br><br>";
        // }
        } else {
            $num_1=0;
        // echo "ไม่มีข้อมูล";
        }
        $sql = "SELECT id FROM files WHERE date_checkdirector IS NULL";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $num_2=$result->num_rows;
        } else { $num_2=0; }
        $sql = "SELECT id FROM files WHERE to_boss = 1 AND date_checkboss IS NULL";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $num_3=$result->num_rows;
        } else { $num_3=0; }
        $sql = "SELECT files.id,file_user.user_id FROM files 
        LEFT JOIN file_user ON files.id = file_user.file_id
        WHERE dateput >= '$today'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {  
                while($row = $result->fetch_assoc()){
                    $list[] = $row['id'];
                }; 
                $check_array = (array_count_values($list));
                // print_r($check_array); echo "<br><br>";
                $num_5 = array();
                foreach($check_array as $key => $value)
                {
                    if($value > 20 )
                    {
                        $num_5[]=$key;
                    }
                }
                // print_r($num_5);
                if(count($num_5) > 0){
                    $num_4 = count($num_5);
                } else { $num_4=0;}
        } else { $num_4=0; }

        $conn->close();
        $message = "มีหนังสือเวียนจ่ายวันนี้ : ".$num_1. " เรื่อง \nเป็นหนังสือเวียนทราบทั่วกัน : " .$num_4. " เรื่อง\n";
        $message2 = "มีหนังสือ เสนอ ผอ. : " .$num_2. " เรื่อง \nมีหนังสือ เสนอ ท่านหัวหน้า : " .$num_3. " เรื่อง\n";
      ?>