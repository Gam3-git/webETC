function date_case(datetext){
    if (datetext[2] != null){ 
        datecase =  datetext;
        datecase[2] = datecase[2].substring(2, 0);
        datecase[0] = parseInt(datecase[0]) + 543;
        return datecase[2]+"/"+datecase[1]+"/"+datecase[0];
    } else { return null; }
}
function date_case2(datetext){
    if (datetext[0] != null){ 
        datecase =  datetext;
        datecase[0] = datecase[0].substring(2, 0);
        datecase[2] = parseInt(datecase[2]) - 543;
        return datecase[2]+"-"+datecase[1]+"-"+datecase[0];
    } else { return; }
}

function search_case(num_type){
    
    $.ajax({
        type: "POST",
        url: "probation.php",
        data: { "action": "1",
                "caseB" : $("#caseB").val() },
        beforeSend: function() {
            // $("#obt1").empty();
            $('#form1')[0].reset();
            set_vari(num_type);

            Swal.fire({
                title: 'กำลังค้นหาข้อมูล...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            });
        },
        success: function(result){
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
            setTimeout(function () { location.reload() }, 1000);
        } else {
            // console.log(jsonData);
            Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,});
            $("#form_per").show();
            var temp1 ='<thead><tr><th>ลำดับ</th><th>ชื่อ-สกุล จำเลย</th><th>เลขบัตรประชาชน</th><th>เลือกข้อมูล</th></tr></thead><tbody>';
                        $('#objTable_per').empty().append(temp1);       
                        for(var i = 0; i < jsonData.length; i++) {
                            var temp = '<tr><td>' +(i+1)+'</td>';
                            temp+= '<td>' +jsonData[i]['ชื่อ และ นามสกุล']+ '</td>';
                            temp+= '<td>' +jsonData[i]['IDCard']+ '</td>';
                            temp+= '<td><a href="#" onclick="per_select(this);" data-id ='+jsonData[i]['หมายเลขดำที่/พศ']+
                            ' data-name ="'+jsonData[i]['ชื่อ และ นามสกุล']+'" data-idcard= '+jsonData[i]['IDCard']+
                            ' data-type= '+num_type+' class="btn btn-success">เลือก</a></td></tr>';
                            $('#objTable_per').append(temp);
                        } $('#objTable_per').append('</tbody>');
        }
    }, 
            error:function(msg){
                console.log( "error:", msg );
            }
        });
}

function search_casered(num_type){
    
    $.ajax({
        type: "POST",
        url: "probation.php",
        data: { "action": "8",
                "caseB" : $("#caseB").val() },
        beforeSend: function() {
            // $("#obt1").empty();
            $('#form1')[0].reset();
            set_vari(num_type);

            Swal.fire({
                title: 'กำลังค้นหาข้อมูล...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            });
        },
        success: function(result){
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
            setTimeout(function () { location.reload() }, 1000);
        } else {
            console.log(jsonData);
            Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,});
            $("#form_per").show();
            var temp1 ='<thead><tr><th>ลำดับ</th><th>เลขคดีแดง</th><th>วันตัดสิน</th><th>ชื่อ-สกุล จำเลย</th><th>เลขบัตรประชาชน</th><th>ที่อยู่</th><th>เลือกข้อมูล</th></tr></thead><tbody>';
                        $('#objTable_per').empty().append(temp1);       
                        for(var i = 0; i < jsonData.length; i++) {
                            var red_num = jsonData[i]['ผ/ฝ']+jsonData[i]['หมายเลขแดงที่']+'/'+jsonData[i]['พศa'];
                            var temp = '<tr><td>' +(i+1)+'</td>';
                            temp+= '<td class=text-danger>' +red_num+'</td>';
                            temp+= '<td>' +date_case(jsonData[i]['วันเดือนปีที่ตัดสิน'].split("-"))+ '</td>';
                            temp+= '<td>' +jsonData[i]['ชื่อ และ นามสกุล']+ '</td>';
                            temp+= '<td>' +jsonData[i]['IDCard']+ '</td>';
                            temp+= '<td>' +jsonData[i]['ที่อยู่']+ '</td>';
                            temp+= '<td><a href="#" onclick="per_select(this);" data-id ='+red_num+
                            ' data-bid ="'+jsonData[i]['หมายเลขดำที่/พศ']+
                            '" data-date-e ="'+date_case(jsonData[i]['วันเดือนปีที่ตัดสิน'].split("-"))+
                            '" data-name ="'+jsonData[i]['ชื่อ และ นามสกุล']+'" data-idcard= '+jsonData[i]['IDCard']+
                            ' data-type= '+num_type+' class="btn btn-success">เลือก</a></td></tr>';
                            $('#objTable_per').append(temp);
                        } $('#objTable_per').append('</tbody>');
        }
    }, 
            error:function(msg){
                console.log( "error:", msg );
            }
        });
}

function search_casekp(num_type){
    $.ajax({
        type: "POST",
        url: "probation.php",
        data: { "action": "7",
                "num_type" : num_type,
                "caseB" : $("#caseB").val() },
        beforeSend: function() {
            $('#form1')[0].reset();
            set_vari(num_type);
            Swal.fire({
                title: 'กำลังค้นหาข้อมูล...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            });
        },
        success: function(result){
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
            setTimeout(function () { location.reload() }, 1000);
        } else {
            // console.log(jsonData);
            Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,});
            $("#form_per").show();
            var temp1 ='<thead><tr><th>ลำดับ</th><th>ชื่อ-สกุล จำเลย</th><th>เลขหนังสือ</th><th>วันที่หนังสือ</th><th>เลือกข้อมูล</th></tr></thead><tbody>';
                $('#objTable_per').empty().append(temp1);  

            if(num_type != null ){
                switch( num_type ) {
                    case 5 : 
                    if(jsonData != null) {
                        for(var i = 0; i < jsonData.length; i++) {
                            if (jsonData[i][5] == "1"){ var kp_type = 'เลือก ค.ป.4';} 
                            else { var kp_type = 'เลือก ค.ป.ย.3'; }
                            var temp = '<tr><td>' +(i+1)+'</td>';
                            temp+= '<td>' +jsonData[i][2]+ '</td>';
                            temp+= '<td>' +jsonData[i][3]+ '</td>';
                            temp+= '<td>' +date_case(jsonData[i][4].split("-"))+ '</td>';
                            temp+= '<td><a href="#" onclick="per_select(this);" data-bid ="'+jsonData[i][0]+
                            '" data-id ="'+jsonData[i][1]+'" data-name ="'+jsonData[i][2]+'" data-booknum= '+jsonData[i][3]+
                            ' data-bookdate= '+date_case(jsonData[i][4].split("-"))+' data-kptype ="'+jsonData[i][5]+
                            '" data-type= '+num_type+' class="btn btn-success">'+kp_type+'</a></td></tr>';
                        $('#objTable_per').append(temp); }
                    }
                        $('#objTable_per').append('</tbody>');
                    break;

                    case 6 : 
                    if(jsonData.valuekp1 != null) {
                        for(var i = 0; i < jsonData.valuekp1.length; i++) {
                            if (jsonData.valuekp1[i][4] == "1"){ var kp_type = 'เลือก ค.ป.1';} 
                            else { var kp_type = 'เลือก ค.ป.ย.1'; }
                            var temp = '<tr><td>' +(i+1)+'</td>';
                            temp+= '<td>' +jsonData.valuekp1[i][1]+ '</td>';
                            temp+= '<td>' +jsonData.valuekp1[i][2]+ '</td>';
                            temp+= '<td>' +date_case(jsonData.valuekp1[i][3].split("-"))+ '</td>';
                            temp+= '<td><a href="#" onclick="per_select(this);" data-id ='+jsonData.valuekp1[i][0]+
                            ' data-name ="'+jsonData.valuekp1[i][1]+'" data-booknum= '+jsonData.valuekp1[i][2]+
                            ' data-bookdate= '+date_case(jsonData.valuekp1[i][3].split("-"))+' data-kptype ="'+jsonData.valuekp1[i][4]+
                            '" data-type= '+num_type+' class="btn btn-success">'+kp_type+'</a></td></tr>';
                        $('#objTable_per').append(temp); }
                    }
                    if(jsonData.valuekp2 != null) {
                        for(var i = 0; i < jsonData.valuekp2.length; i++) {
                            if (jsonData.valuekp2[i][4] == "1"){ var kp_type = 'เลือก ค.ป.2';} 
                            else { var kp_type = 'เลือก ค.ป.ย.2'; }
                            var temp = '<tr><td>' +(i+1)+'</td>';
                            temp+= '<td>' +jsonData.valuekp2[i][1]+ '</td>';
                            temp+= '<td>' +jsonData.valuekp2[i][2]+ '</td>';
                            temp+= '<td>' +date_case(jsonData.valuekp2[i][3].split("-"))+ '</td>';
                            temp+= '<td><a href="#" onclick="per_select(this);" data-id ='+jsonData.valuekp2[i][0]+
                            ' data-name ="'+jsonData.valuekp2[i][1]+'" data-booknum= '+jsonData.valuekp2[i][2]+
                            ' data-bookdate= '+date_case(jsonData.valuekp2[i][3].split("-"))+' data-kptype ="'+jsonData.valuekp2[i][4]+
                            '" data-type= '+num_type+' class="btn btn-success">'+kp_type+'</a></td></tr>';
                        $('#objTable_per').append(temp); }
                    }
                        $('#objTable_per').append('</tbody>');
                    break;
                    default : ('#objTable_per').append('</tbody>');
            }}


        }
    }, 
            error:function(msg){
                console.log( "error:", msg );
            }
        });
}

function per_select(e) {
    if ( $(e).attr("data-type") != null ){
        switch( $(e).attr("data-type") ) {
            case "1" : 
                $("#obt1").val($(e).attr("data-id"));
                $("#obt4").val($(e).attr("data-name"));
                $("#obt5").val($(e).attr("data-idcard"));
            break;
            case "2" : 
                $("#obt1").val($(e).attr("data-id"));
                $("#obt3").val($(e).attr("data-name"));
            break;
            case "4" : 
                $("#obt1").val($(e).attr("data-id"));
                $("#obt8").val($(e).attr("data-date-e"));
                $("#obt9").val($(e).attr("data-date-e"));
                $("#obt4").val($(e).attr("data-name"));
                $("#obt5").val($(e).attr("data-idcard"));
                $("#case_bid").val($(e).attr("data-bid"));
            break;
            case "5" : 
                $('input[name="obt_kp"]').attr('checked', false);
                $("#case_bid").val($(e).attr("data-bid"));
                $("#obt1").val($(e).attr("data-id"));
                $("#obt3").val($(e).attr("data-name"));
                $("#obt5").val($(e).attr("data-bookdate"));
                $('input:radio[name=obt_kp][value='+$(e).attr("data-kptype")+']').attr('checked', true);
            break;
            case "6" : 
                $('input[name="obt_kp"]').attr('checked', false);
                $("#obt1").val($(e).attr("data-id"));
                $("#obt3").val($(e).attr("data-name"));
                $("#obt11").val($(e).attr("data-booknum"));
                $("#obt12").val($(e).attr("data-bookdate"));
                $('input:radio[name=obt_kp][value='+$(e).attr("data-kptype")+']').attr('checked', true);
            break;
            default : $("#obt1").val(" ");
    }}
                $("#form_per").hide();
                $("#saveBtn").attr("disabled", false);
    }

function editkp_select(e) {
    if ( $(e).attr("data-type") != null ){
        $('#form1')[0].reset();
        $('input[name="obt_kp"]').attr('checked', false);
        switch( $(e).attr("data-type") ) {
            case "1" : 
                for(var i = 1; i < 15; i++) {
                    $("#obt"+i).val($(e).attr("data-obt"+i));
                }
            break;
            case "2" : 
                for(var i = 1; i < 11; i++) {
                    $("#obt"+i).val($(e).attr("data-obt"+i));
                }
            break;
            case "4" : 
                for(var i = 1; i < 23; i++) {
                    $("#obt"+i).val($(e).attr("data-obt"+i));
                }
                $("#case_bid").val($(e).attr("data-case_bid"));
            break;
            case "5" : 
                for(var i = 1; i < 11; i++) {
                    $("#obt"+i).val($(e).attr("data-obt"+i));
                }
                $("#case_bid").val($(e).attr("data-case_bid"));
            break;
            case "6" : 
                for(var i = 1; i < 13; i++) {
                    $("#obt"+i).val($(e).attr("data-obt"+i));
                }
            break;
            default : $("#obt1").val(" ");
    }}
            $("#editBtn").attr("data-id", $(e).attr("data-id"));
            $("#showBtn").attr("data-id", $(e).attr("data-id"));
            $("#form_per").hide();
            $("#editBtn").attr("disabled", false);
            $("#showBtn").attr("disabled", false);
            $('input:radio[name=obt_kp][value='+$(e).attr("data-obt_kp")+']').attr('checked', true);
    }


function set_vari(num) {
    if ( num != null ){
        switch( num ) {
            case 1 : 
            $.getJSON('court.json', function(msg) { 
                $("#obt6").val(msg.bookto); 
                $("#obt12").val(msg.nameA); 
                $("#obt13").val(msg.position1); 
                $("#obt14").val(msg.position2);
            }); 

            $("#obt9").val("11.30");

            $("#saveBtn").attr("disabled", true);
            $("#showBtn").attr("disabled", true);
            $("#editBtn").attr("disabled", true);
            $("#form_per").hide();
            
            $("#obt3").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true },);

            $("#obt7").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true });

            $("#obt8").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true });

            $("#obt3").datepicker("setDate",  new Date());
            $("#obt7").datepicker("setDate",  new Date());
            $("#obt8").datepicker("setDate",  new Date());
            
            $('input:radio[name=obt_kp][value=1]').attr('checked', true);

            break;

            case 2 : 
            $.getJSON('court.json', function(msg) { 
                $("#obt4").val(msg.bookto); 
                $("#obt8").val(msg.nameA); 
                $("#obt9").val(msg.position1); 
                $("#obt10").val(msg.position2); 
            }); 

            $("#saveBtn").attr("disabled", true);
            $("#showBtn").attr("disabled", true);
            $("#editBtn").attr("disabled", true);
            $("#form_per").hide();
            
            $("#obt5").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true },);
            $("#obt6").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true });
                
            $("#obt5").datepicker("setDate",  new Date());
            $("#obt6").datepicker("setDate",  new Date());

            $('input:radio[name=obt_kp][value=1]').attr('checked', true);
            break;

            case 4 : 
            $.getJSON('court.json', function(msg) { 
                $("#obt6").val(msg.bookto); 
                $("#obt20").val(msg.nameA); 
                $("#obt21").val(msg.position1); 
                $("#obt22").val(msg.position2); 
            }); 

            $("#obt10").val("11.30");
            $("#saveBtn").attr("disabled", true);
            // $("#showBtn").attr("disabled", true);
            $("#editBtn").attr("disabled", true);
            $("#form_per").hide();
            
            $("#obt3").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true },);
            $("#obt8").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true });
            $("#obt9").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true });
                
            $("#obt3").datepicker("setDate",  new Date());
            $("#obt8").datepicker("setDate",  new Date());
            $("#obt9").datepicker("setDate",  new Date());

            $('input:radio[name=obt_kp][value=1]').attr('checked', true);

            $.Thailand({ 
                database: 'jquery.Thailand.js/database/db.json', // path หรือ url ไปยัง database
                $district: $('#obt15'), // input ของตำบล
                $amphoe: $('#obt16'), // input ของอำเภอ
                $province: $('#obt17'), // input ของจังหวัด
                $zipcode: $('#obt18'), // input ของรหัสไปรษณีย์
            });
            break;

            case 5 : 
            $.getJSON('court.json', function(msg) { 
                $("#obt4").val(msg.bookto); 
                $("#obt8").val(msg.nameA); 
                $("#obt9").val(msg.position1); 
                $("#obt10").val(msg.position2); 
            }); 

            $("#saveBtn").attr("disabled", true);
            $("#showBtn").attr("disabled", true);
            $("#editBtn").attr("disabled", true);
            $("#form_per").hide();
            
            $("#obt5").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true },);
            $("#obt6").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true });
                
            $("#obt5").datepicker("setDate",  new Date());
            $("#obt6").datepicker("setDate",  new Date());
            $('input:radio[name=obt_kp][value=1]').attr('checked', true);

            break;

            case 6 : 
            $.getJSON('court.json', function(msg) { 
                $("#obt4").val(msg.bookto); 
                $("#obt8").val(msg.nameA); 
                $("#obt9").val(msg.position1); 
                $("#obt10").val(msg.position2); 
            }); 

            $("#saveBtn").attr("disabled", true);
            $("#showBtn").attr("disabled", true);
            $("#editBtn").attr("disabled", true);
            $("#form_per").hide();
            
            $("#obt5").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true },);
            $("#obt6").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true });
            $("#obt12").datepicker({
                language:'th-th',
                format:'dd/mm/yyyy',
                autoclose: true });
                
            $("#obt5").datepicker("setDate",  new Date());
            $("#obt6").datepicker("setDate",  new Date());
            $("#obt12").datepicker("setDate",  new Date());
            $('input:radio[name=obt_kp][value=1]').attr('checked', true);
            break;

            default : $("#obt1").val(" ");
    }}
}

function save_kp(num_type){
    if ( num_type != null ){
        switch( num_type ) {
            case 1 : 
            var data_senda = { "action": "2",
                "num_type" : "1",
                "obt_kp" : $("#obt_kp:checked").val(),
                "obt1" : $("#obt1").val(),
                "obt2" : $("#obt2").val(),
                "obt3" : date_case2( $("#obt3").val().split("/") ),
                "obt4" : $("#obt4").val(),
                "obt5" : $("#obt5").val(),
                "obt6" : $("#obt6").val(),
                "obt7" : date_case2( $("#obt7").val().split("/") ),
                "obt8" : date_case2( $("#obt8").val().split("/") ),
                "obt9" : $("#obt9").val(),
                "obt10" : $("#obt10").val(),
                "obt11" : $("#obt11").val(),
                "obt12" : $("#obt12").val(),
                "obt13" : $("#obt13").val(),
                "obt14" : $("#obt14").val() }
            break;
            case 2 : 
            var data_senda = { "action": "2",
                "num_type" : "2",
                "obt_kp" : $("#obt_kp:checked").val(),
                "obt1" : $("#obt1").val(),
                "obt2" : $("#obt2").val(),
                "obt3" : $("#obt3").val(),
                "obt4" : $("#obt4").val(),
                "obt5" : date_case2( $("#obt5").val().split("/") ),
                "obt6" : date_case2( $("#obt6").val().split("/") ),
                "obt7" : $("#obt7").val(),
                "obt8" : $("#obt8").val(),
                "obt9" : $("#obt9").val(),
                "obt10" : $("#obt10").val()
            }
            break;
            case 4 : 
            var data_senda = { "action": "2",
                "num_type" : "4",
                "obt_kp" : $("#obt_kp:checked").val(),
                "case_bid" : $("#case_bid").val(),
                "obt1" : $("#obt1").val(),
                "obt2" : $("#obt2").val(),
                "obt3" : date_case2( $("#obt3").val().split("/") ),
                "obt4" : $("#obt4").val(),
                "obt5" : $("#obt5").val(),
                "obt6" : $("#obt6").val(),
                "obt7" : $("#obt7").val(),
                "obt8" : date_case2( $("#obt8").val().split("/") ),
                "obt9" : date_case2( $("#obt9").val().split("/") ),
                "obt10" : $("#obt10").val(),
                "obt11" : $("#obt11").val(),
                "obt12" : $("#obt12").val(),
                "obt13" : $("#obt13").val(),
                "obt14" : $("#obt14").val(),
                "obt15" : $("#obt15").val(),
                "obt16" : $("#obt16").val(),
                "obt17" : $("#obt17").val(),
                "obt18" : $("#obt18").val(),
                "obt19" : $("#obt19").val(),
                "obt20" : $("#obt20").val(),
                "obt21" : $("#obt21").val(),
                "obt22" : $("#obt22").val()
            }
            break;
            case 5 : 
            var data_senda = { "action": "2",
                "num_type" : "5",
                "obt_kp" : $("#obt_kp:checked").val(),
                "case_bid" : $("#case_bid").val(),
                "obt1" : $("#obt1").val(),
                "obt2" : $("#obt2").val(),
                "obt3" : $("#obt3").val(),
                "obt4" : $("#obt4").val(),
                "obt5" : date_case2( $("#obt5").val().split("/") ),
                "obt6" : date_case2( $("#obt6").val().split("/") ),
                "obt7" : $("#obt7").val(),
                "obt8" : $("#obt8").val(),
                "obt9" : $("#obt9").val(),
                "obt10" : $("#obt10").val()
            }
            break;
            case 6 : 
            var data_senda = { "action": "2",
                "num_type" : "6",
                "obt_kp" : $("#obt_kp:checked").val(),
                "obt1" : $("#obt1").val(),
                "obt2" : $("#obt2").val(),
                "obt3" : $("#obt3").val(),
                "obt4" : $("#obt4").val(),
                "obt5" : date_case2( $("#obt5").val().split("/") ),
                "obt6" : date_case2( $("#obt6").val().split("/") ),
                "obt7" : $("#obt7").val(),
                "obt8" : $("#obt8").val(),
                "obt9" : $("#obt9").val(),
                "obt10" : $("#obt10").val(),
                "obt11" : $("#obt11").val(),
                "obt12" : date_case2( $("#obt12").val().split("/") )
            }
            break;
            default : var data_senda = null ;
    }}
     
    $.ajax({
        type: "POST",
        url: "probation.php",
        data: data_senda ,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังบันทึกข้อมูล...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            });
        },
        success: function(result){
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            Swal.fire({ title: "บันทึกไม่สำเร็จ", icon: "error", showConfirmButton: false, timer: 1000,});
            setTimeout(function () { location.reload() }, 1000);
        } else {
            // console.log(jsonData);
            Swal.fire({ title: "บันทึกสำเร็จ",icon: "success", showConfirmButton: false, timer: 1500,});
            $("#editBtn").attr("disabled", false);
            $("#showBtn").attr("disabled", false);
            $("#saveBtn").attr("disabled", true);
            $("#editBtn").attr("data-id", jsonData);
            $("#showBtn").attr("data-id", jsonData);
        }
    }, 
            error:function(msg){
                console.log( "error:", msg );
            }
        });
}

function load_kp(num_type){
    if ( num_type != null ){
        switch( num_type ) {
            case 1 : 
            var data_senda = { "action": "3","num_type" : "1", "kp_id" : $("#showBtn").attr("data-id") }
            break;
            case 2 : 
            var data_senda = { "action": "3","num_type" : "2", "kp_id" : $("#showBtn").attr("data-id")  }
            break;
            case 4 : 
            var data_senda = { "action": "3","num_type" : "4", "kp_id" : $("#showBtn").attr("data-id")  }
            break;
            case 5 : 
            var data_senda = { "action": "3","num_type" : "5", "kp_id" : $("#showBtn").attr("data-id")  }
            break;
            case 6 : 
            var data_senda = { "action": "3","num_type" : "6", "kp_id" : $("#showBtn").attr("data-id")  }
            break;
            default : var data_senda = null ;
        }}

    $.ajax({
        type: "POST",
        url: "probation.php",
        data: data_senda ,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังดาวน์โหลดไฟล์...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            });
        },
        success: function(result){
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            Swal.fire({ title: "ดาวน์โหลดไม่สำเร็จ", icon: "error", showConfirmButton: false, timer: 1000,});
            setTimeout(function () { location.reload() }, 1000);
        } else {
            console.log(jsonData);
            Swal.fire({ title: "ดาวน์โหลดสำเร็จ",icon: "success", showConfirmButton: false, timer: 2000,});
            window.open(jsonData , '_self');
        }
    }, 
            error:function(msg){
                console.log( "error:", msg );
            }
        });
}

function update_kp(kp_id,num_type){
    if ( num_type != null ){
        switch( num_type ) {
            case 1 : 
            var data_senda = { "action": "5",
                "num_type" : "1",
                "id_kp" : kp_id,
                "obt_kp" : $("#obt_kp:checked").val(),
                "obt1" : $("#obt1").val(),
                "obt2" : $("#obt2").val(),
                "obt3" : date_case2( $("#obt3").val().split("/") ),
                "obt4" : $("#obt4").val(),
                "obt5" : $("#obt5").val(),
                "obt6" : $("#obt6").val(),
                "obt7" : date_case2( $("#obt7").val().split("/") ),
                "obt8" : date_case2( $("#obt8").val().split("/") ),
                "obt9" : $("#obt9").val(),
                "obt10" : $("#obt10").val(),
                "obt11" : $("#obt11").val(),
                "obt12" : $("#obt12").val(),
                "obt13" : $("#obt13").val(),
                "obt14" : $("#obt14").val() 
            }
            break;
            case 2 : 
            var data_senda = { "action": "5",
                "num_type" : "2",
                "id_kp" : kp_id ,
                "obt_kp" : $("#obt_kp:checked").val(),
                "obt1" : $("#obt1").val(),
                "obt2" : $("#obt2").val(),
                "obt3" : $("#obt3").val(),
                "obt4" : $("#obt4").val(),
                "obt5" : date_case2( $("#obt5").val().split("/") ),
                "obt6" : date_case2( $("#obt6").val().split("/") ),
                "obt7" : $("#obt7").val(),
                "obt8" : $("#obt8").val(),
                "obt9" : $("#obt9").val(),
                "obt10" : $("#obt10").val()
            }
            break;
            case 4 : 
            var data_senda = { "action": "5",
                "num_type" : "4",
                "id_kp" : kp_id,
                "case_bid" : $("#case_bid").val(),
                "obt_kp" : $("#obt_kp:checked").val(),
                "obt1" : $("#obt1").val(),
                "obt2" : $("#obt2").val(),
                "obt3" : date_case2( $("#obt3").val().split("/") ),
                "obt4" : $("#obt4").val(),
                "obt5" : $("#obt5").val(),
                "obt6" : $("#obt6").val(),
                "obt7" : $("#obt7").val(),
                "obt8" : date_case2( $("#obt8").val().split("/") ),
                "obt9" : date_case2( $("#obt9").val().split("/") ),
                "obt10" : $("#obt10").val(),
                "obt11" : $("#obt11").val(),
                "obt12" : $("#obt12").val(),
                "obt13" : $("#obt13").val(),
                "obt14" : $("#obt14").val(),
                "obt15" : $("#obt15").val(),
                "obt16" : $("#obt16").val(),
                "obt17" : $("#obt17").val(),
                "obt18" : $("#obt18").val(),
                "obt19" : $("#obt19").val(),
                "obt20" : $("#obt20").val(),
                "obt21" : $("#obt21").val(),
                "obt22" : $("#obt22").val()
            }
            break;
            case 5 : 
            var data_senda = { "action": "5",
                "num_type" : "5",
                "id_kp" : kp_id ,
                "case_bid" : $("#case_bid").val(),
                "obt_kp" : $("#obt_kp:checked").val(),
                "obt1" : $("#obt1").val(),
                "obt2" : $("#obt2").val(),
                "obt3" : $("#obt3").val(),
                "obt4" : $("#obt4").val(),
                "obt5" : date_case2( $("#obt5").val().split("/") ),
                "obt6" : date_case2( $("#obt6").val().split("/") ),
                "obt7" : $("#obt7").val(),
                "obt8" : $("#obt8").val(),
                "obt9" : $("#obt9").val(),
                "obt10" : $("#obt10").val()
            }
            break;
            case 6 : 
            var data_senda = { "action": "5",
                "num_type" : "6",
                "id_kp" : kp_id ,
                "obt_kp" : $("#obt_kp:checked").val(),
                "obt1" : $("#obt1").val(),
                "obt2" : $("#obt2").val(),
                "obt3" : $("#obt3").val(),
                "obt4" : $("#obt4").val(),
                "obt5" : date_case2( $("#obt5").val().split("/") ),
                "obt6" : date_case2( $("#obt6").val().split("/") ),
                "obt7" : $("#obt7").val(),
                "obt8" : $("#obt8").val(),
                "obt9" : $("#obt9").val(),
                "obt10" : $("#obt10").val(),
                "obt11" : $("#obt11").val(),
                "obt12" : date_case2( $("#obt12").val().split("/") )
            }
            break;
            default : var data_senda = null ;
    }}

    $.ajax({
        type: "POST",
        url: "probation.php",
        data: data_senda ,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังบันทึกข้อมูล...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            });
        },
        success: function(result){
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            Swal.fire({ title: "บันทึกไม่สำเร็จ", icon: "error", showConfirmButton: false, timer: 1000,});
            setTimeout(function () { location.reload() }, 1000);
        } else {
            // console.log(jsonData);
            Swal.fire({ title: "บันทึกสำเร็จ",icon: "success", showConfirmButton: false, timer: 1500,});
            $("#showBtn").attr("data-id", kp_id);
        }
    }, 
            error:function(msg){
                console.log( "error:", msg );
            }
        });
}

function update_case_kp(num_type){
    if ( num_type != null ){
        switch( num_type ) {
            case 1 : 
            var data_senda = { "action": "6",
            "num_type" : "1",
            "caseB" : $("#caseB").val()
            }
            break;
            case 2 : 
            var data_senda = { "action": "6",
            "num_type" : "2",
            "caseB" : $("#caseB").val()
            }
            break;
            case 4 : 
            var data_senda = { "action": "6",
            "num_type" : "4",
            "caseB" : $("#caseB").val()
            }
            break;
            case 5 : 
            var data_senda = { "action": "6",
            "num_type" : "5",
            "caseB" : $("#caseB").val()
            }
            break;
            case 6 : 
            var data_senda = { "action": "6",
            "num_type" : "6",
            "caseB" : $("#caseB").val()
            }
            break;
            default : var data_senda = null ;
    }}

    $.ajax({
        type: "POST",
        url: "probation.php",
        data: data_senda ,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังค้นหาข้อมูล...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            });
        },
        success: function(result){
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            Swal.fire({ title: "ค้นหาไม่พบ", icon: "error", showConfirmButton: false, timer: 1000,});
            setTimeout(function () { location.reload() }, 1000);
        } else {
            console.log(jsonData);
            Swal.fire({ title: "สำเร็จ",icon: "success", showConfirmButton: false, timer: 1500,});
            $("#saveBtn").attr("disabled", true);
            $("#form_per").show();
            if(num_type != null ){
                switch( num_type ) {
                    case 1 :
                        var temp1 ='<thead><tr><th>ลำดับ</th><th>ชื่อ-สกุล จำเลย</th><th>เลชหนังสือ</th><th>วันที่หนังสือ</th><th>เลือกข้อมูล</th></tr></thead><tbody>';
                        $('#objTable_per').empty().append(temp1);       
                        for(var i = 0; i < jsonData.length; i++) {
                            var temp = '<tr><td>' +(i+1)+'</td>';
                            temp+= '<td>' +jsonData[i][4]+ '</td>';
                            temp+= '<td>' +jsonData[i][2]+ '</td>'; 
                            temp+= '<td>' +date_case(jsonData[i][3].split("-"))+ '</td>'; 
                            temp+= '<td><a href="#" onclick="editkp_select(this);" data-obt1 ="'+jsonData[i][1]+
                            '" data-obt2 ="'+jsonData[i][2]+'" data-obt3 ="'+date_case(jsonData[i][3].split("-"))+'" data-obt4 ="'+jsonData[i][4]+
                            '" data-obt5 ="'+jsonData[i][5]+'" data-obt6 ="'+jsonData[i][6]+'" data-obt7 ="'+date_case(jsonData[i][7].split("-"))+
                            '" data-obt8 ="'+date_case(jsonData[i][8].split("-"))+'" data-obt9 ="'+jsonData[i][9]+'" data-obt10 ="'+jsonData[i][10]+
                            '" data-obt11 ="'+jsonData[i][11]+'" data-obt12 ="'+jsonData[i][12]+'" data-obt13 ="'+jsonData[i][13]+
                            '" data-obt14 ="'+jsonData[i][14]+'" data-obt_kp ="'+jsonData[i][16]+
                            '" data-type ="' +num_type+'" data-id ="'+jsonData[i][0]+
                            '" class="btn btn-success">เลือก</a></td></tr>';
                            $('#objTable_per').append(temp);
                        } $('#objTable_per').append('</tbody>');
                    break;
                    case 2 :
                        var temp1 ='<thead><tr><th>ลำดับ</th><th>ชื่อ-สกุล จำเลย</th><th>เลขหนังสือ</th><th>วันที่หนังสือ</th><th>เลือกข้อมูล</th></tr></thead><tbody>';
                        $('#objTable_per').empty().append(temp1);       
                        for(var i = 0; i < jsonData.length; i++) {
                            var temp = '<tr><td>' +(i+1)+'</td>';
                            temp+= '<td>' +jsonData[i][3]+ '</td>';
                            temp+= '<td>' +jsonData[i][2]+ '</td>'; 
                            temp+= '<td>' +date_case(jsonData[i][5].split("-"))+ '</td>'; 
                            temp+= '<td><a href="#" onclick="editkp_select(this);" data-obt1 ="'+jsonData[i][1]+
                            '" data-obt2 ="'+jsonData[i][2]+'" data-obt3 ="'+jsonData[i][3]+'" data-obt4 ="'+jsonData[i][4]+
                            '" data-obt5 ="'+date_case(jsonData[i][5].split("-"))+'" data-obt6 ="'+date_case(jsonData[i][6].split("-"))+
                            '" data-obt7 ="'+jsonData[i][7]+'" data-obt8 ="'+jsonData[i][8]+'" data-obt9 ="'+jsonData[i][9]+
                            '" data-obt10 ="'+jsonData[i][10]+'" data-obt_kp ="'+jsonData[i][12]+
                            '" data-type ="' +num_type+'" data-id ="'+jsonData[i][0]+
                            '" class="btn btn-success">เลือก</a></td></tr>';
                            $('#objTable_per').append(temp);
                        } $('#objTable_per').append('</tbody>');
                    break;
                    case 4 :
                        var temp1 ='<thead><tr><th>ลำดับ</th><th>ชื่อ-สกุล จำเลย</th><th>เลขหนังสือ</th><th>วันที่หนังสือ</th><th>เลือกข้อมูล</th></tr></thead><tbody>';
                        $('#objTable_per').empty().append(temp1);       
                        for(var i = 0; i < jsonData.length; i++) {
                            var temp = '<tr><td>' +(i+1)+'</td>';
                            temp+= '<td>' +jsonData[i][8]+ '</td>';
                            temp+= '<td>' +jsonData[i][3]+ '</td>'; 
                            temp+= '<td>' +date_case(jsonData[i][4].split("-"))+ '</td>'; 
                            temp+= '<td><a href="#" onclick="editkp_select(this);" data-obt1 ="'+jsonData[i][2]+
                            '" data-obt2 ="'+jsonData[i][3]+'" data-obt3 ="'+date_case(jsonData[i][4].split("-"))+
                            '" data-obt4 ="'+jsonData[i][8]+'" data-obt5 ="'+jsonData[i][9]+'" data-obt6 ="'+jsonData[i][5]+
                            '" data-obt7 ="'+jsonData[i][6]+'" data-obt8 ="'+date_case(jsonData[i][7].split("-"))+
                            '" data-obt9 ="'+date_case(jsonData[i][10].split("-"))+'" data-obt10 ="'+jsonData[i][11]+
                            '" data-obt11 ="'+jsonData[i][12]+'" data-obt12 ="'+jsonData[i][13]+'" data-obt13 ="'+jsonData[i][14]+
                            '" data-obt14 ="'+jsonData[i][15]+'" data-obt15 ="'+jsonData[i][16]+'" data-obt16 ="'+jsonData[i][17]+
                            '" data-obt17 ="'+jsonData[i][18]+'" data-obt18 ="'+jsonData[i][19]+'" data-obt19 ="'+jsonData[i][20]+
                            '" data-obt20 ="'+jsonData[i][21]+'" data-obt21 ="'+jsonData[i][22]+'" data-obt22 ="'+jsonData[i][23]+
                            '" data-obt_kp ="'+jsonData[i][25]+'" data-type ="' +num_type+
                            '" data-case_bid ="'+jsonData[i][1]+'" data-id ="'+jsonData[i][0]+
                            '" class="btn btn-success">เลือก</a></td></tr>';
                            $('#objTable_per').append(temp);
                        } $('#objTable_per').append('</tbody>');
                    break;
                    case 5 :
                        var temp1 ='<thead><tr><th>ลำดับ</th><th>ชื่อ-สกุล จำเลย</th><th>เลขหนังสือ</th><th>วันที่หนังสือ</th><th>เลือกข้อมูล</th></tr></thead><tbody>';
                        $('#objTable_per').empty().append(temp1);       
                        for(var i = 0; i < jsonData.length; i++) {
                            var temp = '<tr><td>' +(i+1)+'</td>';
                            temp+= '<td>' +jsonData[i][4]+ '</td>';
                            temp+= '<td>' +jsonData[i][3]+ '</td>'; 
                            temp+= '<td>' +date_case(jsonData[i][6].split("-"))+ '</td>'; 
                            temp+= '<td><a href="#" onclick="editkp_select(this);" data-obt1 ="'+jsonData[i][2]+
                            '" data-obt2 ="'+jsonData[i][3]+'" data-obt3 ="'+jsonData[i][4]+'" data-obt4 ="'+jsonData[i][5]+
                            '" data-obt5 ="'+date_case(jsonData[i][6].split("-"))+'" data-obt6 ="'+date_case(jsonData[i][7].split("-"))+
                            '" data-obt7 ="'+jsonData[i][8]+'" data-obt8 ="'+jsonData[i][9]+'" data-obt9 ="'+jsonData[i][10]+
                            '" data-obt10 ="'+jsonData[i][11]+'" data-obt_kp ="'+jsonData[i][13]+
                            '" data-type ="' +num_type+'" data-id ="'+jsonData[i][0]+
                            '" data-case_bid ="'+jsonData[i][1]+'" class="btn btn-success">เลือก</a></td></tr>';
                            $('#objTable_per').append(temp);
                        } $('#objTable_per').append('</tbody>');
                    break;
                    case 6 :
                        var temp1 ='<thead><tr><th>ลำดับ</th><th>ชื่อ-สกุล จำเลย</th><th>เลขหนังสือ</th><th>วันที่หนังสือ</th><th>เลือกข้อมูล</th></tr></thead><tbody>';
                        $('#objTable_per').empty().append(temp1);       
                        for(var i = 0; i < jsonData.length; i++) {
                            var temp = '<tr><td>' +(i+1)+'</td>';
                            temp+= '<td>' +jsonData[i][3]+ '</td>';
                            temp+= '<td>' +jsonData[i][2]+ '</td>'; 
                            temp+= '<td>' +date_case(jsonData[i][5].split("-"))+ '</td>'; 
                            temp+= '<td><a href="#" onclick="editkp_select(this);" data-obt1 ="'+jsonData[i][1]+
                            '" data-obt2 ="'+jsonData[i][2]+'" data-obt3 ="'+jsonData[i][3]+'" data-obt4 ="'+jsonData[i][4]+
                            '" data-obt5 ="'+date_case(jsonData[i][5].split("-"))+'" data-obt6 ="'+date_case(jsonData[i][6].split("-"))+
                            '" data-obt7 ="'+jsonData[i][7]+'" data-obt8 ="'+jsonData[i][8]+'" data-obt9 ="'+jsonData[i][9]+
                            '" data-obt10 ="'+jsonData[i][10]+'" data-obt11 ="'+jsonData[i][11]+
                            '" data-obt12 ="'+date_case(jsonData[i][12].split("-"))+'" data-obt_kp ="'+jsonData[i][14]+
                            '" data-type ="' +num_type+'" data-id ="'+jsonData[i][0]+
                            '" class="btn btn-success">เลือก</a></td></tr>';
                            $('#objTable_per').append(temp);
                        } $('#objTable_per').append('</tbody>');
                    break ; 
                    default : ('#objTable_per').append('</tbody>');
                }
            }
           
        }
    }, 
            error:function(msg){
                console.log( "error:", msg );
            }
        });
}

function checkInp_kp(var_check,num_type) {
    if(var_check == 0){
        Swal.fire({ title: "ใส่เลขหนังสือ", icon: "error", showConfirmButton: false, timer: 1000,});
        return false;
    } else { 
        if ( num_type != null ){
            switch( num_type ) {
                case 1 : 
                var data_senda = { "action": "4" ,
                    "obt2" : $("#obt2").val() ,
                    "obt3" : date_case2( $("#obt3").val().split("/")),
                    "num_type" : "1"
                    }
                break;
                case 2 : 
                var data_senda = { "action": "4" ,
                    "obt2" : $("#obt2").val() ,
                    "obt3" : date_case2( $("#obt5").val().split("/")),
                    "num_type" : "2"
                    }
                break;
                case 4 : 
                var data_senda = { "action": "4" ,
                    "obt2" : $("#obt2").val() ,
                    "obt3" : date_case2( $("#obt3").val().split("/")),
                    "num_type" : "4"
                    }
                break;
                case 5 : 
                var data_senda = { "action": "4" ,
                    "obt2" : $("#obt2").val() ,
                    "obt3" : date_case2( $("#obt5").val().split("/")),
                    "num_type" : "5"
                    }
                break;
                case 6 : 
                var data_senda = { "action": "4" ,
                    "obt2" : $("#obt2").val() ,
                    "obt3" : date_case2( $("#obt5").val().split("/")),
                    "num_type" : "6"
                    }
                break;
                default : var data_senda = null ;
            }}

        $.ajax({
            type: "POST",
            url: "probation.php",
            data: data_senda ,
            beforeSend: function() {
                Swal.fire({
                    icon: 'warning',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading()
                      }
                });
            },
            success: function(result){
            var jsonData = JSON.parse(result);
            if(jsonData == null){
                Swal.close();
                save_kp( num_type );
            } else {
                // console.log(jsonData);
                Swal.fire({ title: " เลขหนังสือซ้ำ ",icon: "warning", showConfirmButton: false, timer: 2000,});
                return false;
            }
        }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
    } 

}
