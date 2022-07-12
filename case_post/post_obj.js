function date_case(datetext){
    if (datetext[2] != null){ 
        datecase =  datetext;
        datecase[2] = datecase[2].substring(2, 0);
        datecase[0] = parseInt(datecase[0]) + 543;
        return datecase[2]+"/"+datecase[1]+"/"+datecase[0];
    } else { return null; }
}

function search_post(num){
    if (num >= 2){
        // alert ($('#PostText').val());
        linkajax ="/webETC/case_post/connect_post.php?PostText="+$("#PostText").val()+"&S_num="+num;
        
    }  else { linkajax ="/webETC/case_post/connect_post.php"; }
    
    if (linkajax !== 'undefined'){
    $.ajax({
        type: "POST",
        url: linkajax,
        success: function(result){
        var jsonData = JSON.parse(result);
        if(jsonData == null){
            alert("ไม่พบข้อมูล");
        } else {
            // alert(jsonData);
            // $('#form1')[0].reset();
            $('#obt1').empty();
            for(var i = 0; i < 50; i++) {
                // for(var i = 0; i < jsonData.length; i++) {
                var temp = '<thead class=bg-danger><tr><th>วันที่ส่ง</th><th>หมายเลขคดีดำ</th><th>รหัสซองไปรษณีย์</th><th>เลขหนังสือ</th></tr></thead><tbody>';
                temp += '<tr><td>' +date_case(jsonData[i]['datesend'].split("-"))+ '</td>';
                temp += '<td class=text-success>'+jsonData[i]['case_id']+'</td>';
                temp += '<td> <a href="https://track.thailandpost.co.th/?trackNumber='+jsonData[i]['sendno']+'" target="_blank">'+jsonData[i]['sendno']+'</a></td>';
                temp += '<td>'+jsonData[i]['book_no']+'</td></tr>';
                temp += '<tr><td class=bg-secondary>ส่งถึง</td><td>'+jsonData[i]['sendto']+'</td>';
                temp += '<td>'+jsonData[i]['address']+'</td><td></td></tr>';
                $('#obt1').append(temp);
            } $('#obt1').append('</tbody>');
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
        }
}