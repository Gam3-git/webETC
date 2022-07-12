function date_case(datetext){
    if (datetext[2] != null){ 
        datecase =  datetext;
        datecase[2] = datecase[2].substring(2, 0);
        datecase[0] = parseInt(datecase[0]) + 543;
        return datecase[2]+"/"+datecase[1]+"/"+datecase[0];
    } else { return; } }

function date_case2(datetext){
    if (datetext[0] != null){ 
        datecase =  datetext;
        datecase[0] = datecase[0].substring(2, 0);
        datecase[2] = parseInt(datecase[2]) - 543;
        return datecase[1]+"/"+datecase[0]+"/"+datecase[2];
    } else { return; } }

    function search_case(){

        $.ajax({
            url: "social_ser.php",
            type: "POST",
            data: { "action": "1",
                    "casetext": $("#caseT").val() },
            cache: false,
            beforeSend: function() {
                    $("#section_1").show();
                    $("#obt1").html(' ');$("#obt2").html(' ');$("#obt3").html(' ');
                    $("#obt4").html(' ');$("#obt5").html(' ');$("#obt6").html(' ');
                    $('#objTable_p').empty(); $('#objTable_k').empty();
                    $('#form1').trigger("reset"); $('#form2').trigger("reset"); $('#form3').trigger("reset"); 
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
                Swal.fire({ title: "ไม่พบข้อมูลหรือไม่มีเลขแดง", icon: "error", showConfirmButton: false, timer: 1000,});
            } else {
                console.log(jsonData); 
                Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,}); 
                    $("#obt1").html(jsonData.case_result[0]+jsonData.case_result[1]+'/'+jsonData.case_result[2]);
                    $("#obt2").html(jsonData.case_result[5]);
                    $("#obt3").html(jsonData.case_result[6]);
                    $("#obt4").html(jsonData.case_result[0]+jsonData.case_result[3]+'/'+jsonData.case_result[4]);
                    $("#obt5").html(jsonData.case_result[7]);
                    $("#obt6").html(jsonData.case_result[8]);

                    $("#obt7").val(jsonData.case_result[0]+jsonData.case_result[1]+'/'+jsonData.case_result[2]);
                    $("#obt8").val(jsonData.case_result[0]+jsonData.case_result[3]+'/'+jsonData.case_result[4]);
                    var date_now = new Date();
                    $("#obt9").val(date_now.toLocaleDateString("th-TH"));
                    $("#obt10").val(jsonData.case_result[7]);
                    $("#obt11").val(jsonData.case_result[8]);
                    $("#obt12").val(jsonData.case_result[6]);
                    

                    if(jsonData.jum_result != null){
                    
                    var temp1 ='<tbody';
                    $('#objTable_p').empty().append(temp1);       
                    for(var i = 0; i < jsonData.jum_result.length; i++) {
                        var temp = '<tr><td>ชื่อ : '+jsonData.jum_result[i]['ชื่อ และ นามสกุล']+' '+
                        '<td><a href="#" onclick="set1_data(this);" data-name ="'+jsonData.jum_result[i]['ชื่อ และ นามสกุล']+
                        '"data-1t="'+jsonData.jum_result[i]['สัญชาติ']+
                        '"data-2t="'+jsonData.jum_result[i]['อาชีพ']+
                        '"data-3t="'+jsonData.jum_result[i]['อายุ']+
                        '"data-4t="'+jsonData.jum_result[i]['ตรอก']+
                        '"data-5t="'+jsonData.jum_result[i]['ซอย']+
                        '"data-6t="'+jsonData.jum_result[i]['อยู่บ้านเลขที่']+
                        '"data-7t="'+jsonData.jum_result[i]['หมู่']+
                        '"data-8t="'+jsonData.jum_result[i]['ถนน']+
                        '"data-9t="'+jsonData.jum_result[i]['ตำบล']+
                        '"data-10t="'+jsonData.jum_result[i]['อำเภอ']+
                        '"data-11t="'+jsonData.jum_result[i]['จังหวัด']+
                        '"data-12t="'+jsonData.jum_result[i]['โทรศัพท์']+
                        '" class="btn btn-primary"> + </a></td></tr>';
                        temp+= '<tr><td>ที่อยู่ : '+jsonData.jum_result[i]['ที่อยู่']+'</td><td></td></tr>';
                       $('#objTable_p').append(temp);
                    } $('#objTable_p').append('</tbody>');
                    }
                    if(jsonData.jumkum_result != null){
                    var temp1 ='<tbody';
                    $('#objTable_k').empty().append(temp1);       
                    for(var i = 0; i < jsonData.jumkum_result.length; i++) {
                        var temp = '<tr><td>จำเลยที่ '+jsonData.jumkum_result[i]['จำเลยที่']+' '+
                        jsonData.jumkum_result[i]['ชื่อ และ นามสกุล']+'</td><td>คำพิพาษา : '+
                        jsonData.jumkum_result[i]['kumpaksa']+'</td></tr>';
                        temp+= '<tr><td>ให้กักขัง: '+jsonData.jumkum_result[i]['ให้กักขัง']+
                        'ตั้งแต่วันที่: '+jsonData.jumkum_result[i]['ตั้งแต่วันที่']+'</td>';
                        temp+='<td><a href="#" onclick="set2_data(this);" data-name ="'+jsonData.jumkum_result[i]['ชื่อ และ นามสกุล']+
                        '"data-k1t="'+jsonData.jumkum_result[i]['kumpaksa']+
                        '"data-k2t="'+jsonData.jumkum_result[i]['ให้กักขัง']+
                        '"data-k3t="'+jsonData.jumkum_result[i]['ตั้งแต่วันที่']+
                        '" class="btn btn-primary"> + </a></td></tr>';
                       $('#objTable_k').append(temp);
                    } $('#objTable_k').append('</tbody>');
                    }
                } 
        }, 
                    error:function(msg){
                        console.log( "error:", msg );
                    }
                });
        
    }


    function set1_data(e) {
        $("#obt16").val($(e).attr("data-name"));
        $("#obt17").val($(e).attr("data-2t"));
        $("#obt21").val($(e).attr("data-3t"));
        $("#obt22").val($(e).attr("data-6t"));
        $("#obt23").val($(e).attr("data-7t"));
        $("#obt24").val($(e).attr("data-8t"));
        $("#obt25").val($(e).attr("data-4t")+' '+$(e).attr("data-5t"));
        $("#obt26").val($(e).attr("data-9t"));
        $("#obt27").val($(e).attr("data-10t"));
        $("#obt28").val($(e).attr("data-11t"));
        $("#obt29").val($(e).attr("data-12t"));
      }

      function set2_data(e) {
        $("#obt13").val($(e).attr("data-k1t"));
      }