
function court_text(){
    $.getJSON('court.json', function(msg) { 
        $("#courtN").html(msg.courtN);
    });
}

function date_case(datetext){
    if (datetext[2] != null){ 
        datecase =  datetext;
        datecase[2] = datecase[2].substring(2, 0);
        datecase[0] = parseInt(datecase[0]) + 543;
        return datecase[2]+"/"+datecase[1]+"/"+datecase[0];
    } else { return; }
}
function date_case2(datetext){
    if (datetext[0] != null){ 
        datecase =  datetext;
        datecase[0] = datecase[0].substring(2, 0);
        datecase[2] = parseInt(datecase[2]) - 543;
        return datecase[1]+"/"+datecase[0]+"/"+datecase[2];
    } else { return; }
}

function search_jud(){

        $.ajax({
            url: "/access2praxticol/rcase/rcase.php",
            type: "POST",
            data: { "action": "1"},
            cache: false,
            beforeSend: function() {
                Swal.fire({
                    title: 'กำลังดึงข้อมูลตุลาการ...',
                    icon: 'warning',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading()
                      }
                }); 
            },
            success: function(result,textStatus, jqXHR){
                console.log(textStatus + ": " + jqXHR.status);
            var jsonData = JSON.parse(result);
            if(jsonData == null){
                // console.log(jsonData); 
                Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
            } else {
                // console.log(jsonData); 
                Swal.close(); 
                $("#obt7").empty();$("#obt8").empty();$("#obt10").empty();  
                const j_text = jsonData.judtext.map(item => {
                    return { itemId:  item.work+' : '+item.ผู้พิพากษาตัดสิน, itemName: item.ผู้พิพากษาตัดสิน };
                });
                // console.log(newjsondata);
                var options = j_text;
                    var selectJ1 = document.getElementById('obt7');
                    var selectJ2 = document.getElementById('obt8');
                    for(var i = 0, l = options.length; i < l; i++){
                        var option = options[i];
                        selectJ1.options.add( new Option(option.itemId, option.itemName) );
                        selectJ2.options.add( new Option(option.itemId, option.itemName) );
                    }

                    const w_text = jsonData.win_result.map(item => {
                        return { itemId:  item.id+' : '+item.whowin, itemName: item.id };
                    });
                    var options = w_text;
                        var selectJ1 = document.getElementById('obt10');
                        for(var i = 0, l = options.length; i < l; i++){
                            var option = options[i];
                            selectJ1.options.add( new Option(option.itemId, option.itemName) );
                    }
            }
        }, 
                    error:function(msg){
                        console.log( "error:", msg );
                    }
                });
        
}

function red_num(){
    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { "action": "7",
                "casetype": $("#obt2").text() },
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'ค้นหาเลขแดง...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            }); 
        },
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
        } else {
            // console.log(jsonData); 
            Swal.close(); 
            let sameDay = new Date();
            $("#obt15").val(sameDay.toLocaleDateString("th-TH"));
            $("#obt12").val( jsonData[1] ); $("#obt13").val( jsonData[2] ); 
            
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
}

function search_casered(){

    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { "action": "2",
                "casetext": $("#caseT").val() },
        cache: false,
        beforeSend: function() {
                $("#form_r").hide(); $("#form_p").hide(); $("#obt14").hide();
                $("#obt1").html(' ');$("#obt2").html(' ');$("#obt3").html(' ');
                $("#obt4").html(' ');$("#obt5").html(' ');$("#obt6").html(' ');
                $('#form1').trigger("reset"); $('#form3').trigger("reset"); $("#obt9").empty(); 
                $("#obt7").prop("selectedIndex", 0);
                $("#obt8").prop("selectedIndex", 0);
                $("#obt10").prop("selectedIndex", 0);
                $("#obt11").prop("selectedIndex", 0);
            Swal.fire({
                title: 'กำลังค้นหา...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            }); 
        },
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
        } else {
            // console.log(jsonData); 
            if (jsonData.constructor !== Array) { 
                Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,}); 
                $('#form1').trigger("reset"); $('#form3').trigger("reset"); $("#obt9").empty(); 
                $("#obt1").html(jsonData.case_result[0]);
                $("#obt2").html(jsonData.case_result[2]);
                $("#obt3").html(jsonData.case_result[3]);
                $("#obt4").html(date_case(jsonData.case_result[4].split("-")));
                $("#obt5").html(jsonData.case_result[5]);
                $("#obt6").html(jsonData.case_result[6]);

                const e_text = jsonData.end_result.map(item => {
                    return { itemId:  item.no+' : '+item.sp, itemName: item.id };
                });
                var options = e_text;
                    var selectJ1 = document.getElementById('obt9');
                    for(var i = 0, l = options.length; i < l; i++){
                        var option = options[i];
                        selectJ1.options.add( new Option(option.itemId, option.itemName) );
                }
                if (jsonData.case_result[1]=='แพ่ง'){ tableP_detail(); } else { tableR_detail(); }
                $("#obt7").focus();
            } else {
                // console.log(jsonData); 
                var date_red = new Date(jsonData[3]);
                Swal.fire({
                    title: "คดีเสร็จแล้ว <h5 class = 'text-danger'> เมื่อวันที่ : "+date_red.toLocaleDateString("th-TH")+ 
                    " เลขแดง : "+jsonData[0]+jsonData[1]+"/"+jsonData[2]+"</h5>",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'ปิด',
                    confirmButtonColor: '#000',
                    denyButtonText: 'ลบเลขแดง',
                    denyButtonColor: '#FF0000',
                  }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        Swal.close(); 
                        $("#caseT").focus();
                    } else if (result.isDenied) {
                        Swal.fire({
                            title: "ยืนยัน ลบ ข้อมูล",
                            showCancelButton: true,
                            cancelButtonText: "ปิด",
                            confirmButtonText: 'ยืนยัน',
                            confirmButtonColor: '#FF0000',
                          }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                del_red();
                            //   Swal.fire('Saved!', '', 'success');
                            } })
                    }
                })
            }

        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
    
}

  function tableP_detail() {
            $.ajax({
                url: "/access2praxticol/rcase/rcase.php",
                type: "POST",
                data: { 
                    "action": "3",
                    "casetext": $("#caseT").val()
                    },
                cache: false,
                success: function(result,textStatus, jqXHR){
                    console.log(textStatus + ": " + jqXHR.status);
                var jsonData = JSON.parse(result);
                if(jsonData == null){
                    console.log(jsonData); 
                    $('#objTable_p').empty(); 
                } else {
                    // console.log(jsonData); 
                    $("#form_p").show();$("#form_r").hide(); $("#obt14").hide();
                    var temp1 ='<thead><tr><th>วันนัดพิจารณา</th><th>รายการนัดฯ</th><th>เวลา</th><th>ลบข้อมูลวันนัด</th></tr></thead><tbody>';
                        $('#objTable_p').empty().append(temp1);       
                        for(var i = 0; i < jsonData.length; i++) {
                            var temp = '<tr><td>' +date_case(jsonData[i]['วันปัจจุบัน'].split("-"))+ '</td>';
                            temp+= '<td>' + jsonData[i]['นัดมาทำไม']+ '</td>';
                            timec = jsonData[i]['เวลา'].split(".");
                            if (timec[0].toString().length <= 1){
                                var timecase = '0' + timec[0].toString() + ':' + timec[1].toString() + '0 น.';
                            } else {
                            var timecase = timec[0].toString() + ':' + timec[1].toString() + '0 น.';
                            }
                            temp+= '<td>' + timecase + '</td>';
                            temp+= '<td><a href="#" onclick="del_date_appoint(this);" data-id ='+jsonData[i]['หมายเลขคดีดำที่/พศ']+' data-name ='+jsonData[i]['นัดมาทำไม']+' data-date= '+jsonData[i]['วันปัจจุบัน']+' class="btn btn-danger">ลบข้อมูล</a></td></tr>';
                            $('#objTable_p').append(temp);
                        } $('#objTable_p').append('</tbody>');
                    
                }
            }, 
                        error:function(msg){
                            console.log( "error:", msg );
                        }
                    });
}

function tableR_detail() {
    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { 
            "action": "4",
            "casetext": $("#caseT").val()
            },
        cache: false,
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
            $('#objTable_r').empty(); 
        } else {
            // console.log(jsonData); 
            $("#form_p").hide();$("#form_r").show(); $("#obt14").show();
            var temp1 ='<thead><tr><th>ลำดับ</th><th>ชื่อ-สกุล จำเลย</th><th>ผลการตัดสิน</th><th>บันทึกข้อมูล</th></tr></thead><tbody>';
                $('#objTable_r').empty().append(temp1);       
                for(var i = 0; i < jsonData.jum_result.length; i++) {
                    var temp = '<tr><td>' +jsonData.jum_result[i]['จำเลยที่']+ '</td>';
                    temp+= '<td>' + jsonData.jum_result[i]['ชื่อ และ นามสกุล']+ '</td>';

                    temp+= '<td><select class="form-select'+i+'" style="font-size:20px;">';
                    const e_text = jsonData.pipaksa_result.map(item => {
                        return { itemId:  item.id+' : '+item.kumpaksa, itemName: item.id };
                    });
                    var options = e_text;
                    for(var j = 0; j < options.length; j++ ){
                        temp+='<option value='+options[j].itemName+'>'+options[j].itemId+'</option>';
                    }

                    temp+= '</select></td>';
                    
                    temp+= '<td><a href="#" onclick="jum_just(this,'+i+');" data-id ='+jsonData.jum_result[i]['หมายเลขดำที่/พศ']+' data-no ='+jsonData.jum_result[i]['จำเลยที่']+' class="btn btn-primary">บันทึกข้อมูล</a></td></tr>';
                    $('#objTable_r').append(temp);
                } 
                $('#objTable_r').append('</tbody>');
            
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
}

function del_date_appoint(e) {
    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { 
            "action": "5",
            "casetext": $(e).attr("data-id"),
            "casedate": $(e).attr("data-date"),
            "casename": $(e).attr("data-name")
            },
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังลบข้อมูล...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            }); 
        },
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
        } else {
            // console.log(jsonData); 
            Swal.fire({ title: "ลบ "+jsonData+" วัน",icon: "success", showConfirmButton: false, timer: 1000,});
            tableP_detail(); 
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
  }

  function jum_just(e,num) {
      
    var text_opti = $(".form-select"+num).find('option:selected').val();
    //   alert($(e).attr("data-id")+$(e).attr("data-no")+text_opti);
      $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { 
            "action": "6",
            "casetext": $(e).attr("data-id"),
            "caseno": $(e).attr("data-no"),
            "casek_id": text_opti
            },
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังบันทึก...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            }); 
        },
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
        } else {
            // console.log(jsonData); 
            Swal.fire({ title: "เพิ่มข้อมูล "+jsonData+" คน",icon: "success", showConfirmButton: false, timer: 1000,});
            tableR_detail(); 
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
  }

function update_red(){
    if($("#obt14").is(':visible')){ var penaty = $("#obt11").val() }else{ var penaty = null }
    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { "action": "8",
                "case_bnum": $("#obt1").text(), 
                "case_j": $("#obt7").val(), 
                "case_ju": $("#obt8").val(),  
                "case_end": $("#obt9").val(),  
                "case_win": $("#obt10").val(), 
                "case_penaty": penaty, 
                "case_rnum": $("#obt12").val(), 
                "case_ry": $("#obt13").val(),
                "case_rday": date_case2($("#obt15").val().split("/")),
                "case_uname": $("#userNa").val()
            },
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'ค้นหาเลขแดง...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            }); 
        },
        success: function(result,textStatus, jqXHR){
        console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
            // Swal.close();
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
        } else {
            // console.log(jsonData); 
            Swal.fire({ title: "บันทึกข้อมูลเสร็จ "+jsonData+" คดี",icon: "success", showConfirmButton: false, timer: 1000,});
            // setTimeout(function() { location.reload(); }, 5000);
            
            
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
}

function del_red(){
    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { 
            "action": "9",
            "case_bnum": $("#caseT").val()
            },
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังลบข้อมูล...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            }); 
        },
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
        } else {
            // console.log(jsonData); 
            Swal.fire({ title: "ลบ "+jsonData+" รายการ",icon: "success", showConfirmButton: false, timer: 1000,});
            $("#caseT").focus(); 
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
}

function max_red(){
    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { 
            "action": "10"
            },
        cache: false,
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
        } else {
            // console.log(jsonData); 
            var temp1 ='<thead><tr><th>ลำดับ</th><th>ประเภทคดี</th><th>เลขแดงล่าสุด</th><th>ปี</th><th>เพิ่ม</th><th>ลด</th></tr></thead><tbody>';
                $('#objred').empty().append(temp1);       
                for(var i = 0; i < jsonData.length; i++) {
                    var temp = '<tr><td>'+(i+1)+'</td><td class=text-left style=width:35%>' +jsonData[i]['T_red']+ '</tdstyle=>';
                    temp+= '<td class=text-danger>' + jsonData[i]['Red']+ '</td><td>' + jsonData[i]['Year']+ '</td>';
                    temp+= '<td><a href="#" onclick="plus_maxred(this);" data-id ='+jsonData[i]['T_red']+' data-num ='+jsonData[i]['Red']+' data-year= '+jsonData[i]['Year']+' class="btn btn-success"> + </a></td>';
                    temp+= '<td><a href="#" onclick="del_maxred(this);" data-id ='+jsonData[i]['T_red']+' data-num ='+jsonData[i]['Red']+' data-year= '+jsonData[i]['Year']+' class="btn btn-danger"> - </a></td></tr>';
                    $('#objred').append(temp);
                } $('#objred').append('</tbody>');
            
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
}

function del_maxred(e) {
    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { 
            "action": "11",
            "casetext": $(e).attr("data-id"),
            "casenum": $(e).attr("data-num"),
            "caseyear": $(e).attr("data-year")
            },
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังลบข้อมูล...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            }); 
        },
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
        } else {
            // console.log(jsonData); 
            Swal.fire({ title: "ลบ "+jsonData+" เลข",icon: "success", showConfirmButton: false, timer: 1000,});
            max_red();
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
  }

  function  plus_maxred(e) {
    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { 
            "action": "12",
            "casetext": $(e).attr("data-id"),
            "casenum": $(e).attr("data-num"),
            "caseyear": $(e).attr("data-year")
            },
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังลบข้อมูล...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            }); 
        },
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
        } else {
            // console.log(jsonData); 
            Swal.fire({ title: "เพิ่ม "+jsonData+" เลข",icon: "success", showConfirmButton: false, timer: 1000,});
            max_red();
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
  }

  function search_redDe(){

    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { "action": "13",
                "casetext": $("#caseT").val() },
        cache: false,
        beforeSend: function() {
                $("#obt1").html(' ');$("#obt2").html(' ');$("#obt3").html(' ');
                $("#obt4").html(' ');$("#obt5").html(' ');$("#obt6").html(' ');
                $('#form1').trigger("reset"); $('#form2').trigger("reset"); $('#form3').trigger("reset"); 
                $("#obt7").prop("selectedIndex", 0); 
                // $("#obt8").empty(); $("#obt9").empty();
                $("#obt10").prop("selectedIndex", 0);
                 // $("#obt11").empty(); $("#obt12").empty();
            Swal.fire({
                title: 'กำลังค้นหา...',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            }); 
        },
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
        } else {
            // console.log(jsonData); 
                Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,}); 
                $("#obt1").html(jsonData[0]);
                $("#obt2").html(jsonData[1]);
                $("#obt3").html(jsonData[2]);
                if( jsonData[4] === "" ){
                    var redtext = null;
                } else { 
                    var redtext = jsonData[3]+jsonData[4].substring(0, jsonData[4].length - 2)+"/"+jsonData[5].substring(0, jsonData[5].length - 2);
                }
                $("#obt4").html(redtext);
                $("#obt5").html(jsonData[6]);
                $("#obt6").html(jsonData[7]);
                $("#obt8").val( jsonData[9] ); 
                $("#obt9").val( date_case(jsonData[11].split("-")) ); 
                $("#obt11").val( jsonData[10] ); 
                $("#obt12").val( date_case(jsonData[12].split("-")) ); 

        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
    
}


function detail_casetemp(){

    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { "action": "14"},
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังดึงข้อมูล..',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            }); 
        },
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            // console.log(jsonData); 
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
        } else {
            // console.log(jsonData); 
            Swal.close(); 
            $("#obt7").empty(); $("#obt10").empty();  
            const Bsarabob_text = jsonData.Bsarabob_text.map(item => {
                return { itemId:  item.รหัส+' : '+item.เรื่อง, itemName: item.สารบบความ};
            });
            var options = Bsarabob_text;
            var selectJ1 = document.getElementById('obt7');
            selectJ1.options.add( new Option(' -- เลือกข้อมูล --', ' ') );
            for(var i = 0, l = options.length; i < l; i++){
                var option = options[i];
                selectJ1.options.add( new Option(option.itemId, option.itemName) );
                }

            const Rsarabob_text = jsonData.Rsarabob_text.map(item => {
                return { itemId:  item.รหัส+' : '+item.เรื่อง, itemName: item.สารบบคำพิพากษา };
             });
            var options = Rsarabob_text;
            var selectJ2 = document.getElementById('obt10');
            selectJ2.options.add( new Option(' -- เลือกข้อมูล --', ' ') );
            for(var i = 0, l = options.length; i < l; i++){
                var option = options[i];
                selectJ2.options.add( new Option(option.itemId, option.itemName) );
                }
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
    
}

function add_detail(num){
    if( num == 1 ){ 
        var action_num = "15";
        var day_num = date_case2($("#obt9").val().split("/"));
        var text_num = $("#obt8").val();
     } else {
        var action_num = "16";
        var day_num = date_case2($("#obt12").val().split("/"));
        var text_num = $("#obt11").val();
     }
    $.ajax({
        url: "/access2praxticol/rcase/rcase.php",
        type: "POST",
        data: { "action": action_num,
                "case_bnum": $("#obt1").text(), 
                "case_day": day_num,
                "case_text": text_num
            },
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังบันทึก',
                icon: 'warning',
                allowEscapeKey: false,
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading()
                  }
            }); 
        },
        success: function(result,textStatus, jqXHR){
        console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            console.log(jsonData); 
            // Swal.close();
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
        } else {
            // console.log(jsonData); 
            Swal.fire({ title: "บันทึกข้อมูลเสร็จ "+jsonData+" สารบบ",icon: "success", showConfirmButton: false, timer: 1000,});
            search_redDe(); 
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
}





// function datePick(e) {
//     $(e).datepicker({
//       language:'th-th',
//       format:'dd/mm/yyyy',
//       autoclose: true
//       });
// }    