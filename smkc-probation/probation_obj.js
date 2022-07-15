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

// ------------------------------------ค้นหาจากเลขคดี-------------------------------------------------------

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
                            temp+= '<td><a href="#" onclick="per_select(this);" data-id ='+jsonData[i]['หมายเลขดำที่/พศ']+' data-name ="'+jsonData[i]['ชื่อ และ นามสกุล']+'" data-idcard= '+jsonData[i]['IDCard']+' data-type= '+num_type+' class="btn btn-success">เลือก</a></td></tr>';
                            $('#objTable_per').append(temp);
                        } $('#objTable_per').append('</tbody>');
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
                $("#form_per").hide();
                $("#saveBtn").attr("disabled", false);
            break;
            case "2" : 
                $("#obt1").val($(e).attr("data-id"));
                $("#obt3").val($(e).attr("data-name"));
                $("#form_per").hide();
                $("#saveBtn").attr("disabled", false);
            break;
            default : $("#obt1").val(" ");
    }}
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

            $("#saveBtn").attr("disabled", true);
            $("#showBtn").attr("disabled", true);
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

            break;
            default : $("#obt1").val(" ");
    }}
}

function save_kp1(){
    // console.log($("#obt1").val()+$("#obt2").val()+$("#obt3").val()+$("#obt4").val()
    // +$("#obt5").val()+$("#obt6").val()+$("#obt7").val()+$("#obt8").val()
    // +$("#obt9").val()+$("#obt10").val()+$("#obt11").val()+$("#obt12").val()
    // +$("#obt13").val()+$("#obt14").val());
    // console.log( typeof $("#obt3").val() );
    
    $.ajax({
        type: "POST",
        url: "probation.php",
        data: { "action": "2",
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
            },
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
            $("#showBtn").attr("disabled", false);
        }
    }, 
            error:function(msg){
                console.log( "error:", msg );
            }
        });
}

function load_kp1(){
    $.ajax({
        type: "POST",
        url: "probation.php",
        data: { "action": "3" },
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
            // console.log(jsonData);
            Swal.fire({ title: "ดาวน์โหลดสำเร็จ",icon: "success", showConfirmButton: false, timer: 2000,});
            window.open(jsonData , '_self');
        }
    }, 
            error:function(msg){
                console.log( "error:", msg );
            }
        });
}

function save_kp2(){

    $.ajax({
        type: "POST",
        url: "probation.php",
        data: { "action": "6",
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
            },
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
            $("#showBtn").attr("disabled", false);
        }
    }, 
            error:function(msg){
                console.log( "error:", msg );
            }
        });
}

function load_kp2(){
    $.ajax({
        type: "POST",
        url: "probation.php",
        data: { "action": "7" },
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

function checkInp_kp1(var_check,num_type) {
    if(var_check == 0){
        Swal.fire({ title: "ใส่เลขหนังสือ", icon: "error", showConfirmButton: false, timer: 1000,});
        return false;
    } else { 
        if (num_type != null){
            switch( num_type ) {
                case 1 : var action_num = "4" ;
                           var obt_date = date_case2( $("#obt3").val().split("/"));
                break;
                case 2 : var action_num = "5" ; 
                           var obt_date = date_case2( $("#obt5").val().split("/"));
                break;
                default : var action_num = "4" ; 
            } }

        $.ajax({
            type: "POST",
            url: "probation.php",
            data: { "action": action_num,
                    "obt2" : $("#obt2").val(),
                    "obt3" : obt_date
                      },
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
                if (num_type != null){
                    switch( num_type ) {
                        case 1 : save_kp1(); break;
                        case 2 : save_kp2(); break;
                        default : return false; 
                    } }
               
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
