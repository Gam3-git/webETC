
function app_point(){

    // for(var i = 1; i < 11; i++) {
    //     var urldel ='https://sheetdb.io/api/v1/i1e1tjhyjzjcc/all?sheet=Sheet'+i;
    //     if (i !== 6 & i !== 7){
    //         axios.delete(urldel).then( response => {console.log(response.data);});
    //     }
    // }
    var check_date = new Date();
    var options_week = { weekday: 'short' };
    var options = { month: 'numeric', day: 'numeric', year: 'numeric' };
    var check_week = new Date().toLocaleString('en-US', options_week);
    switch (check_week) {
        case 'Sun' : var check_day = check_date.setDate(check_date.getDate() + 1); break;
        case 'Mon' : var check_day = check_date; break;
        case 'Tue' : var check_day = check_date.setDate(check_date.getDate() - 1); break;
        case 'Wed' : var check_day = check_date.setDate(check_date.getDate() - 2); break;
        case 'Thu' : var check_day = check_date.setDate(check_date.getDate() - 3); break;
        case 'Fri' : var check_day = check_date.setDate(check_date.getDate() - 4); break;
        case 'Sat' : var check_day = check_date.setDate(check_date.getDate() + 2); break;
        default : var check_day = check_date; break;
    }

    console.log(new Date(check_day).toLocaleString('en-US', options));
    result_day = new Date(check_day);
    
    for(var i = 1; i < 11; i++) {
        $.ajax({
            url: "/webETC/appointcase/connect_appointcase.php",
            type: "POST",
            async : false,
            cache: false,
            data:{ action_date : result_day.toLocaleString('en-US', options)},  
           success: function(result,textStatus, jqXHR){
            console.log(textStatus + ": " + jqXHR.status);

            var jsonData = JSON.parse(result);
            var urlpost ='https://sheetdb.io/api/v1/i1e1tjhyjzjcc?sheet=Sheet'+i;
            if(jsonData == null){
                    console.log(jsonData); 
            } else {
                console.log(jsonData); 
                if (i !== 6 & i !== 7){
                        console.log(jsonData.length); 
                        axios.post(urlpost,{
                        "data": result
                            }).then( response => {
                                console.log(response.data);
                            });
                        }
             }
        }, 
                    error:function(msg){
                        console.log( "error:", msg );
                    }
                });

            result_day = result_day.setDate(result_day.getDate() + 1);
            result_day = new Date(result_day);
        
    }


          // axios.post('https://sheetdb.io/api/v1/i1e1tjhyjzjcc',{
          //     "data": [
          //       { "name": "Scott", "email": "Scjaott", "message": "Scmaott" },
          //       { "name": "maga", "email": "jacob", "message": "only" },
          //       { "name": "maga", "email": "jacob", "message": "only" },
          //       { "name": "maga", "email": "jacob", "message": "only" },
          //       { "name": "maga", "email": "jacob", "message": "only" },
          //       { "name": "maga", "email": "jacob", "message": "only" },
          //       { "name": "maga", "email": "jacob", "message": "only" }
          //     ]
          // }).then( response => {
          //     console.log(response.data);
          // });
        
          // axios.get('https://sheetdb.io/api/v1/i1e1tjhyjzjcc')
          // .then( response => {
          // console.log(response.data);
          // });
          		
  

}
