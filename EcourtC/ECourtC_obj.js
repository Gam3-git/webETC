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
        return datecase[1]+"/"+datecase[0]+"/"+datecase[2];
    } else { return; }
}


function search_ECourtC(){
    
    $.ajax({
        url: "/webETC/ECourtC/connect_ECourtC.php",
        type: "POST",
        cache: false,
        data:{
            text_date: date_case2($("#date_text").val().split("/")),
            room_text: $('#room_text').val(),
        },
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
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            // console.log(jsonData); 
            Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
            $('#objTable').DataTable().clear().draw();
            $('#objTable').DataTable().destroy();
            $('#objTable').DataTable ();
        } else {
            // console.log(jsonData); 
            Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,});
            $('#objTable').DataTable().clear().draw();
            $('#objTable').DataTable().destroy();
        
            var temp1 = '<thead class=bg-success><tr><th>หมายเลขคดีดำ</th><th>ข้อหา</th><th>ประเภทนัด</th><th>การดำเนินการ</th><th>บัลลังก์</th><th>หมายเหตุ</th><th>บันทึกข้อมูล</th></tr></thead><tbody>';
            $('#objTable').empty().append(temp1);
            for(var i = 0; i < jsonData.length; i++) {
                var temp = '<tr><td>'+jsonData[i]['หมายเลขดำที่/พศ']+'</td>';
                temp += '<td style="width: 20%">'+jsonData[i]['ข้อหา']+'</td>';
                temp += '<td>'+jsonData[i]['tot']+'</td>';
                temp += '<td>'+jsonData[i]['เสร็จ/ไม่เสร็จ']+'</td>';
                temp += '<td>'+jsonData[i]['ห้องพิจารณาคดีที่']+'</td>';
                temp += '<td>'+jsonData[i]['ผู้ขอเลื่อนคดี']+'</td>';
                temp += '<td><button type="button" class="btn btn-success" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#update_d"'+ 
                'data-case_id="'+jsonData[i]['หมายเลขดำที่/พศ']+
                // '" data-appointment_date="'+jsonData[i]['วันปัจจุบัน']+
                // '" data-appointment_detail="'+jsonData[i]['นัดมาทำไม']+
                // '" data-room="'+jsonData[i]['ห้องพิจารณาคดีที่']+
                // '" data-remark="'+jsonData[i]['ผู้ขอเลื่อนคดี']+
                '" data-type_case="'+jsonData[i]['ความ']+
                // '" data-detail_case="'+jsonData[i]['ข้อหา']+
                // '" data-type_appiont="'+jsonData[i]['tot']+
                '" ">SAVE</button></td>/tr>';
                $('#objTable').append(temp);
            } $('#objTable').append('</tbody>');
         $('#objTable').DataTable();
         }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
        
}

function update_ECourtC() {
    $.ajax({
        url: "/webETC/ECourtC/update_ecourtc.php",
        type: "POST",
        cache: false,
        data:{
            case_id: $('#case_id').val(),
            text_detail: $('input[name=optC]:checked', '#Form_EcourtC').val(),
            text_date: date_case2($("#date_text").val().split("/")),
        },
        success: function(dataResult){
            var dataResult = JSON.parse(dataResult);
            if(dataResult.statusCode==200){
                $('#update_d').modal('toggle'); 
                // alert('Data Save successfully !');	
                $('#objTable').empty();
                search_ECourtC(); 	
            } else {
                $('#update_d').modal('toggle'); 
                Swal.fire({ title: "ERROR", icon: "error", showConfirmButton: false, timer: 1000,});
            }
        }, 
        error:function(msg){
            console.log( "error:", msg );
        }
    });

}

function dropdown_type(type_case) { 
    if (type_case == 'แพ่ง'){ var temp_r = '<p class="text-light bg-dark"> รายละเอียดคดี </p>'+
    '<input type="radio" name="optC" value="1" checked>  สืบพยาน '+
    '<input type="radio" name="optC" value="2">  ไม่สืบพยาน ';
    $('#Form_EcourtC').empty().append(temp_r);

    } else { var temp_r = '<p class="text-light bg-dark"> รายละเอียดคดี </p>'+
        '<input type="radio" name="optC" value="1" checked>  ไต่สวน '+
        '<input type="radio" name="optC" value="2">  จำเลยรับสารภาพ '+
        '<input type="radio" name="optC" value="3">  จำเลยปฏิเสธ  ';
        
        $('#Form_EcourtC').empty().append(temp_r);
    }
}

function report_ECourtC() {
    $.ajax({
        url: "/webETC/ECourtC/view_ECC.php",
        type: "POST",
        cache: false,
        data:{
            text_m: $('#m_list12').val(),
            text_y: $('#y_list65').val(),
            text_detail: $('input[name=optR]:checked', '#Form_report').val(),
        },
        
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
            var jsonData = JSON.parse(result);
            if(jsonData == null){
                // console.log(jsonData); 
                Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
                $('#report_ecc').modal('toggle'); 
            } else {
                // console.log(jsonData); 
                Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,});
                $('#report_ecc').modal('toggle');
                // let samed = new Date();
                // const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                // let year = samed.toLocaleDateString("th-TH", options);
                if ($('input[name=optR]:checked', '#Form_report').val() == "แพ่ง") {

                var temp1 = '<thead><tr><th>ลำดับ</th><th>หมายเลขคดีดำ</th><th>คดีจัดการพิเศษ<br>(ไม่สืบพยาน)</th><th>คดีจัดการพิเศษ<br>(สืบพยาน)</th><th>คดีสามัญ<br>(สืบพยาน)</th><th>หมายเหตุ</th></tr></thead><tbody>';
                $('#objReport').empty().append(temp1);
                for(var i = 0; i < jsonData.length; i++) {
                    var temp = '<tr><td>'+(i+1)+'</td>';
                    temp += '<td style="width: 20%">'+jsonData[i][0]+'<br>'+jsonData[i][1]+'</td>';

                    if ( jsonData[i][2] == '1' && jsonData[i][3] == '1' ) {
                            temp += '<td style="width: 15%"></td> <td style="width: 15%"></td> <td style="width: 15%"><i class="fa-solid fa-check fa-1x"></i></td>';
                    } else if ( jsonData[i][2] == '2' && jsonData[i][3] == '1' ) {
                            temp += '<td style="width: 15%"></td> <td style="width: 15%"><i class="fa-solid fa-check fa-1x"></i></td> <td style="width: 15%"></td>';
                    } else if ( jsonData[i][2] == '2' && jsonData[i][3] == '2' ) {
                            temp += '<td style="width: 15%"><i class="fa-solid fa-check fa-1x"></i></td> <td style="width: 15%"></td> <td style="width: 15%"></td>';
                    } else {
                        temp += '<td>-</td><td>-</td><td>-</td>'; 
                    }
                    temp += '<td></td>';
                    $('#objReport').append(temp);
                } $('#objReport').append('</tbody>');
                $("#text_NR").html('แบบรายงานสถิติการพิจารณาคดีแพ่งโดยวิธีการทางอิเล็กทรอนิกส์<br>ศาลจังหวัดสมุทรสงคราม ประจำเดือน '+$('#m_list12').val()+' '+$('#y_list65').val()); 
                    
                } else { 

                var temp1 = '<thead><tr><th>ลำดับ</th><th>หมายเลขคดีดำ</th><th>จำเลยรับสารภาพ</th><th>จำเลยปฏิเสธ</th><th>ไต่สวน</th><th>หมายเหตุ</th></tr></thead><tbody>';
                $('#objReport').empty().append(temp1);
                for(var i = 0; i < jsonData.length; i++) {
                    var temp = '<tr><td>'+(i+1)+'</td>';
                    temp += '<td style="width: 20%">'+jsonData[i][0]+'</td>';

                    switch (jsonData[i][1]) {
                        case '1' :
                            temp += '<td style="width: 15%"></td><td style="width: 15%"></td><td style="width: 15%"><i class="fa-solid fa-check fa-1x"></i></td>';
                            break;
                        case '2' :
                            temp += '<td style="width: 15%"><i class="fa-solid fa-check fa-1x"></i></td><td style="width: 15%"></td><td style="width: 15%"></td>';
                            break;
                        case '3' :
                            temp += '<td style="width: 15%"></td><td style="width: 15%"><i class="fa-solid fa-check fa-1x"></i></td><td style="width: 15%"></td>';
                            break;
                        default: temp += '<td>-</td><td>-</td><td>-</td>'; break;
                    }
                    temp += '<td></td>';
                    $('#objReport').append(temp);
                } $('#objReport').append('</tbody>'); 
                  $("#text_NR").html('แบบรายงานสถิติการพิจารณาคดีอาญาในลักษณะการประชุมทางจอภาพ<br>ศาลจังหวัดสมุทรสงคราม ประจำเดือน '+$('#m_list12').val()+' '+$('#y_list65').val());

                } 
            }
        }, 
                    error:function(msg){
                        console.log( "error:", msg );
                    }
    });

}

function del_ECourt() {
    $.ajax({
        url: "/webETC/ECourtC/del_ECC.php",
        type: "POST",
        cache: false,
        success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
            var jsonData = JSON.parse(result);
            if(jsonData == null){
                // console.log(jsonData); 
                Swal.fire({ title: "ไม่พบข้อมูล", icon: "error", showConfirmButton: false, timer: 1000,});
            } else {
                // console.log(jsonData); 
                Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,});
                var temp1 = '<thead><tr><th>ลำดับ</th><th>หมายเลขคดีดำ</th><th>รายละเอียดนัด</th><th>วันนัดพิจารณา</th><th>ลบ</th></tr></thead><tbody>';
                $('#objReport').empty().append(temp1);
                for(var i = 0; i < jsonData.length; i++) {
                    var temp = '<tr><td>'+(i+1)+'</td>';
                    temp += '<td>'+jsonData[i][0]+'</td>';
                    temp += '<td style="width: 35%">'+jsonData[i][1]+'</td><td>'+date_case(jsonData[i][2].split("-"))+'</td>';
                    temp += '<td><a href="#" onclick="del_date(this);" data-id ='+jsonData[i][0]+' data-date= '+jsonData[i][2]+' class="btn btn-danger">ลบ</a></td></tr>';
                    $('#objReport').append(temp);
                } $('#objReport').append('</tbody>');
            }
        }, 
                    error:function(msg){
                        console.log( "error:", msg );
                    }
    });

}


function del_date(e) {

    Swal.fire({
        title: 'ยืนยันการลบ ?',
        showCancelButton: true,
        confirmButtonText: 'Delete',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          
            $.ajax({
                url: "/webETC/ECourtC/del_query.php",
                type: "POST",
                data: { 
                    "casetext": $(e).attr("data-id"),
                    "casedate": $(e).attr("data-date")
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
                    Swal.fire({ title: "ลบ "+jsonData+" คดี",icon: "success", showConfirmButton: false, timer: 1000,});
                    del_ECourt(); 
                }
            }, 
                        error:function(msg){
                            console.log( "error:", msg );
                        }
                    });


        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })



    
  }


 function ExportPDF() {
    html2canvas(document.getElementById('objReport'), {
        onrendered: function (canvas) {
            var data = canvas.toDataURL();
            var docDefinition = {
                content: [{
                    image: data,
                    width: 500
                }]
            };
            pdfMake.createPdf(docDefinition).download("Table.pdf");
        }
    });
}
//  objReport