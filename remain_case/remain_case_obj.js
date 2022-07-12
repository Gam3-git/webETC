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

function date_case3(dnum){
    var yt = Math.trunc(dnum/365) ; var mt = 0; var dt = 0; 
    var cal_m = dnum-(365*yt) ;
    switch (true) {
        case cal_m >= 1 && cal_m <= 31 :
            mt = 0; 
            dt = cal_m - 0 ;         
            break;
        case cal_m >= 32 && cal_m <= 59 :
            mt = 1; 
            dt = cal_m - 31 ;         
            break;
        case cal_m >= 60 && cal_m <= 90 :
            mt = 2; 
            dt = cal_m - 59 ;         
            break;
        case cal_m >= 91 && cal_m <= 120 :
            mt = 3; 
            dt = cal_m - 90 ;         
            break;
        case cal_m >= 121 && cal_m <= 151 :
            mt = 4; 
            dt = cal_m - 120 ;         
            break;
        case cal_m >= 152 && cal_m <= 181 :
            mt = 5; 
            dt = cal_m - 151 ;         
            break;
        case cal_m >= 182 && cal_m <= 212 :
            mt = 6; 
            dt = cal_m - 181 ;         
            break;
        case cal_m >= 213 && cal_m <= 243 :
            mt = 7;
            dt = cal_m - 212 ;         
            break;
        case cal_m >= 244 && cal_m <= 273 :
            mt = 8; 
            dt = cal_m - 243 ;         
            break;
        case cal_m >= 274 && cal_m <= 304 :
            mt = 9; 
            dt = cal_m - 273 ;         
            break;
        case cal_m >= 305 && cal_m <= 334 :
            mt = 10; 
            dt = cal_m - 304 ;         
            break;
        case cal_m >= 335 && cal_m <= 365 :
            mt = 11; 
            dt = cal_m - 334 ;         
            break;
    }
    // var dt = cal_m-(30*mt) ;
    if (yt != 0){
        return "(ระยะเวลาค้าง : "+yt +" ปี "+ mt +" เดือน "+ dt + " วัน)";
    }else {
        return "(ระยะเวลาค้าง : "+ mt +" เดือน "+ dt + " วัน)";
    }
   
    
                    
}

function search_remain_C(){
    
    $.ajax({
        url: "/webETC/remain_case/connect_remain_case.php",
        type: "POST",
        data: { "action": "1"},
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังคำนวณข้อมูล...',
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
            // console.log(Object.keys(jsonData).length );
            Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,});
            $("#Rn1").html(jsonData.all_remain_count+' คดี');
            $("#Rn2").html(jsonData.threeM_remain+' คดี');
            $("#Rn3").html(jsonData.sixM_remain+' คดี');
            $("#Rn4").html(jsonData.OneY_remain+' คดี');
            $("#Rn5").html(jsonData.TwoY_remain+' คดี');
            $("#Rn6").html(jsonData.ThreeY_remain+' คดี');
            $("#Rn7").html(jsonData.FourY_remain+' คดี');
            $("#Rn8").html(jsonData.FiveY_remain+' คดี');
            $("#Rn9").html(jsonData.SixY_remain+' คดี');  
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
        
}

function search_remain_D(num){
    
    $.ajax({
        url: "/webETC/remain_case/connect_remain_detail.php?num="+num,
        type: "POST",
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังคำนวณข้อมูล...',
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
            // console.log(Object.keys(jsonData).length );
            Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,});
            var temp1 = '<thead class=text-center><tr><th>ลำดับ</th><th>หมายเลขคดีดำ</th><th>คู่ความ</th><th>เหตุที่นัด</th><th>วันนัด<br>(สุดท้าย)</th><th>ผู้พิพากษาเจ้าของสำนวน</tr></thead><tbody>';
            var casetext = ''; var loopcase = 1; 
            $('#objReport').empty().append(temp1);
            for(var i = 0; i < jsonData.length; i++) {
                if (casetext != jsonData[i]['หมายเลขดำที่/พศ']){
                    
                    var temp = '<tr><td>'+loopcase+'</td>';
                    temp += '<td style=width:10%;>'+jsonData[i]['หมายเลขดำที่/พศ']+'</td>';
                    temp += '<td style=width:35%;> โจทก์ : '+jsonData[i]['โจทก์']+'<br> จำเลย : '+jsonData[i]['จำเลย']+'</td>';
                    temp += '<td style=width:20%;>'+jsonData[i]['M2']+'<br>'+date_case3(jsonData[i]['M3']);+'</td>';
                    var datecase = new Date(jsonData[i]['M1']);
                    temp += '<td style=width:10%;>'+datecase.toLocaleDateString('th-TH')+'</td>';
                    temp += '<td style=width:20%;>'+jsonData[i]['ชื่อผู้พิพากษา']+'</td></tr>';
                    loopcase++;
                } else {
                    var temp = '<tr><td></td><td></td><td></td>';
                    temp += '<td style=width:20%;>'+jsonData[i]['นัดมาทำไม']+jsonData[i]['M2']+'</td>';
                    // var datecase = new Date(jsonData[i]['วันปัจจุบัน']);
                    var datecase = new Date(jsonData[i]['M1']);
                    temp += '<td style=width:10%;>'+datecase.toLocaleDateString('th-TH')+'</td><td></td></tr>';
                }
                casetext = jsonData[i]['หมายเลขดำที่/พศ'];
                // temp += '<td>'+datecase.toLocaleDateString('th-TH')+'</td></tr>';
                $('#objReport').append(temp);
            } $('#objReport').append('</tbody>'); 

            $("#text_R").html('คดีค้างทั้งหมด '+(loopcase-1)+' คดี');
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
        
}

function search_remain_C2(){
    $.ajax({
        url: "/webETC/remain_case/connect_remain_case.php",
        type: "POST",
        data: { "action": "2"},
        cache: false,
        success: function(textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);
            Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,});
        
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
}

function cal_detail(){
    $.ajax({
        url: "/webETC/remain_case/connect_remain_case.php",
        type: "POST",
        data: { "action": "3"},
        cache: false,
        beforeSend: function() {
            Swal.fire({
                title: 'กำลังคำนวณข้อมูล...',
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
            Swal.fire({ icon: "success", showConfirmButton: false, timer: 1000,});
            var all_c = 0; var all_total = 0; var j = 3; var k = 4;
            var all_B = 0; var all_P = 0; var all_R = 0;
            
            for(var i = 2; i < 24; i+=3 ){
                all_B += parseInt(jsonData[i]); 
                all_P += parseInt(jsonData[j]); j += 3;
                all_R += parseInt(jsonData[k]); k += 3;
            }
            all_total = all_B + all_P + all_R ;

            var temp1 = '<thead class=text-center><tr><th>ลำดับ</th><th>ระยะเวลาค้าง</th><th>คดีผู้บริโภค</th><th>คดีแพ่ง</th><th>คดีอาญา</th><th>รวม</th></tr></thead><tbody>';
            $('#objReport').empty().append(temp1);
                var temp = '<tr><td>'+1+'</td><td style=width:35%;> ค้างไม่เกิน 3 เดือน</td>';
                    temp += '<td>'+jsonData[2]+'</td><td>'+jsonData[3]+'</td><td>'+jsonData[4]+'</td>';
                    all_c = parseInt(jsonData[2])+parseInt(jsonData[3])+parseInt(jsonData[4]);
                    temp += '<td>'+all_c+'</td></tr>'; 

                    temp += '<tr><td>'+2+'</td><td style=width:35%;> ค้างไม่เกิน 6 เดือน</td>';
                    temp += '<td>'+jsonData[5]+'</td><td>'+jsonData[6]+'</td><td>'+jsonData[7]+'</td>';
                    all_c = parseInt(jsonData[5])+parseInt(jsonData[6])+parseInt(jsonData[7]);
                    temp += '<td>'+all_c+'</td></tr>'; 

                    temp += '<tr><td>'+3+'</td><td style=width:35%;> ค้างไม่เกิน 1 ปี</td>';
                    temp += '<td>'+jsonData[8]+'</td><td>'+jsonData[9]+'</td><td>'+jsonData[10]+'</td>';
                    all_c = parseInt(jsonData[8])+parseInt(jsonData[9])+parseInt(jsonData[10]);
                    temp += '<td>'+all_c+'</td></tr>'; 

                    temp += '<tr><td>'+4+'</td><td style=width:35%;> ค้างไม่เกิน 2 ปี</td>';
                    temp += '<td>'+jsonData[11]+'</td><td>'+jsonData[12]+'</td><td>'+jsonData[13]+'</td>';
                    all_c = parseInt(jsonData[11])+parseInt(jsonData[12])+parseInt(jsonData[13]);
                    temp += '<td>'+all_c+'</td></tr>'; 

                    temp += '<tr><td>'+5+'</td><td style=width:35%;> ค้างไม่เกิน 3 ปี</td>';
                    temp += '<td>'+jsonData[14]+'</td><td>'+jsonData[15]+'</td><td>'+jsonData[16]+'</td>';
                    all_c = parseInt(jsonData[14])+parseInt(jsonData[15])+parseInt(jsonData[16]);
                    temp += '<td>'+all_c+'</td></tr>'; 

                    temp += '<tr><td>'+6+'</td><td style=width:35%;> ค้างไม่เกิน 4 ปี</td>';
                    temp += '<td>'+jsonData[17]+'</td><td>'+jsonData[18]+'</td><td>'+jsonData[19]+'</td>';
                    all_c = parseInt(jsonData[17])+parseInt(jsonData[18])+parseInt(jsonData[19]);
                    temp += '<td>'+all_c+'</td></tr>'; 

                    temp += '<tr><td>'+7+'</td><td style=width:35%;> ค้างไม่เกิน 5 ปี</td>';
                    temp += '<td>'+jsonData[20]+'</td><td>'+jsonData[21]+'</td><td>'+jsonData[22]+'</td>';
                    all_c = parseInt(jsonData[20])+parseInt(jsonData[21])+parseInt(jsonData[22]);
                    temp += '<td>'+all_c+'</td></tr>'; 

                    temp += '<tr><td>'+8+'</td><td style=width:35%;> ค้างเกิน 5 ปี</td>';
                    temp += '<td>'+jsonData[23]+'</td><td>'+jsonData[24]+'</td><td>'+jsonData[25]+'</td>';
                    all_c = parseInt(jsonData[23])+parseInt(jsonData[24])+parseInt(jsonData[25]);
                    temp += '<td>'+all_c+'</td></tr>'; 

                    temp += '<tr><td></td><td style=width:35%;> รวม </td>';
                    temp += '<td>'+all_B+'</td><td>'+all_P+'</td><td>'+all_R+'</td><td>'+all_total+'</td></tr></tbody>';
                $('#objReport').append(temp);
        }
    }, 
                error:function(msg){
                    console.log( "error:", msg );
                }
            });
}

// ไม่ผ่าน ปริ้น pdf 
function pdf_make(textrec){ 
    pdfMake.fonts = {
    Saraban: {
        normal: 'Sarabun-Regular.ttf',
        bold: 'Sarabun-Bold.ttf',
        italics: 'Sarabun-Italic.ttf',
        bolditalics: 'Sarabun-BoldItalic.ttf'
    },
    };

    var val = textrec;
    var docDefinition = {

        content: [
            {text:val}
            ],

        defaultStyle:{font: "Saraban"},
    };
    pdfMake.createPdf(docDefinition).download();
    // pdfMake.createPdf(docDefinition).open();


}

// ไม่ผ่าน ปริ้น pdf 
function pdf_make1(textss){ 
        pdfMake.fonts = {
            Saraban: {
                normal: 'Sarabun-Regular.ttf',
                bold: 'Sarabun-Bold.ttf',
                italics: 'Sarabun-Italic.ttf',
                bolditalics: 'Sarabun-BoldItalic.ttf'
            },
            };

        function ParseContainer(cnt, e, p, styles) {
            var elements = [];
            var children = e.childNodes;
            if (children.length != 0) {
                for (var i = 0; i < children.length; i++) p = ParseElement(elements, children[i], p, styles);
            }
            if (elements.length != 0) {            
                for (var i = 0; i < elements.length; i++) cnt.push(elements[i]);
            }
            return p;
            }
            
            function ComputeStyle(o, styles) {
            for (var i = 0; i < styles.length; i++) {
                var st = styles[i].trim().toLowerCase().split(":");
                if (st.length == 2) {
                    switch (st[0]) {
                        case "font-size":{
                            o.fontSize = parseInt(st[1]);
                            break;
                        }
                        case "text-align": {
                            switch (st[1]) {
                                case "right": o.alignment = 'right'; break;
                                case "center": o.alignment = 'center'; break;
                            }
                            break;
                        }
                        case "font-weight": {
                            switch (st[1]) {
                                case "bold": o.bold = true; break;
                            }
                            break;
                        }
                        case "text-decoration": {
                            switch (st[1]) {
                                case "underline": o.decoration = "underline"; break;
                            }
                            break;
                        }
                        case "font-style": {
                            switch (st[1]) {
                                case "italic": o.italics = true; break;
                            }
                            break;
                        }
                    }
                }
            }
            }
            
            function ParseElement(cnt, e, p, styles) {
            if (!styles) styles = [];
            if (e.getAttribute) {
                var nodeStyle = e.getAttribute("style");
                if (nodeStyle) {
                    var ns = nodeStyle.split(";");
                    for (var k = 0; k < ns.length; k++) styles.push(ns[k]);
                }
            }
            
            switch (e.nodeName.toLowerCase()) {
                case "#text": {
                    var t = { text: e.textContent.replace(/\n/g, "") };
                    if (styles) ComputeStyle(t, styles);
                    p.text.push(t);
                    break;
                }
                case "b":case "strong": {
                    //styles.push("font-weight:bold");
                    ParseContainer(cnt, e, p, styles.concat(["font-weight:bold"]));
                    break;
                }
                case "u": {
                    //styles.push("text-decoration:underline");
                    ParseContainer(cnt, e, p, styles.concat(["text-decoration:underline"]));
                    break;
                }
                case "i": {
                    //styles.push("font-style:italic");
                    ParseContainer(cnt, e, p, styles.concat(["font-style:italic"]));
                    //styles.pop();
                    break;
                    //cnt.push({ text: e.innerText, bold: false });
                }
                case "span": {
                    ParseContainer(cnt, e, p, styles);
                    break;
                }
                case "br": {
                    p = CreateParagraph();
                    cnt.push(p);
                    break;
                }
                case "table":
                    {
                        var t = {
                            table: {
                                widths: [],
                                body: []
                            }
                        }
                        var border = e.getAttribute("border");
                        var isBorder = false;
                        if (border) if (parseInt(border) == 1) isBorder = true;
                        if (!isBorder) t.layout = 'noBorders';
                        ParseContainer(t.table.body, e, p, styles);
            
                        var widths = e.getAttribute("widths");
                        if (!widths) {
                            if (t.table.body.length != 0) {
                                if (t.table.body[0].length != 0) for (var k = 0; k < t.table.body[0].length; k++) t.table.widths.push("*");
                            }
                        } else {
                            var w = widths.split(",");
                            for (var k = 0; k < w.length; k++) t.table.widths.push(w[k]);
                        }
                        cnt.push(t);
                        break;
                    }
                case "tbody": {
                    ParseContainer(cnt, e, p, styles);
                    //p = CreateParagraph();
                    break;
                }
                case "tr": {
                    var row = [];
                    ParseContainer(row, e, p, styles);
                    cnt.push(row);
                    break;
                }
                case "td": {
                    p = CreateParagraph();
                    var st = {stack: []}
                    st.stack.push(p);
            
                    var rspan = e.getAttribute("rowspan");
                    if (rspan) st.rowSpan = parseInt(rspan);
                    var cspan = e.getAttribute("colspan");
                    if (cspan) st.colSpan = parseInt(cspan);
            
                    ParseContainer(st.stack, e, p, styles);
                    cnt.push(st);
                    break;
                }
                case "div":case "p": {
                    p = CreateParagraph();
                    var st = {stack: []}
                    st.stack.push(p);
                    ComputeStyle(st, styles);
                    ParseContainer(st.stack, e, p);
            
                    cnt.push(st);
                    break;
                }
                default: {
                    console.log("Parsing for node " + e.nodeName + " not found");
                    break;
                }
            }
            return p;
            }
            
            function ParseHtml(cnt, htmlText) {
            var html = $(htmlText.replace(/\t/g, "").replace(/\n/g, ""));
            var p = CreateParagraph();
            for (var i = 0; i < html.length; i++) ParseElement(cnt, html.get(i), p);
            }
            
            function CreateParagraph() {
            var p = {text:[]};
            return p;
            }
            
            //currently should be wraped in tag div or span
            var simpleHtm = "<table>"; 
            simpleHtm += textss;  
            simpleHtm += "</table>";
             content = [];
            ParseHtml(content, simpleHtm);
            
            var docDefinition = {

                content:content,
                defaultStyle:{font: "Saraban"},
            };
            pdfMake.createPdf(docDefinition).open();
            // pdfMake.createPdf({content: content}).open();

}