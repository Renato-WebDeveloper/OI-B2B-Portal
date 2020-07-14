setInterval(function ajax_bdon() {
var result;
    $.ajax({
    url: "../ajax_request/api-bd-on.php",
    type: "POST",
    dataType: "html",
    success: function(data) {
        result = data;
        document.getElementById("bd_on").innerHTML = data;
        console.log(data);
        },

    }).done(function(resposta) {
    console.log(resposta);

    }).fail(function(jqXHR, textStatus ) {
    console.log("Request failed: " + textStatus);
                

    });

    } , 1000);


setInterval(function ajax_bdcorr() {
    var count;
        $.ajax({
        url: "../ajax_request/api-corr.php",
        type: "POST",
        dataType: "html",
        success: function(data) {
            count = data;
            document.getElementById("bd_corr").innerHTML = count;
            },
        
        }).done(function(resposta) {
        console.log(resposta);
        
        }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);
                        
        
        });
        
        } , 3000);


setInterval(function ajax_bd_rep() {
    var count;
        $.ajax({
        url: "../ajax_request/api-bd-rep.php",
        type: "POST",
        dataType: "html",
        success: function(data) {
            count = data;
            document.getElementById("bd_rep").innerHTML = count;
            },
        
        }).done(function(resposta) {
        console.log(resposta);
        
        }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);
                        
        
        });
        
        } , 3000);
        


setInterval(function ajax_bd_ontime() {
    var count;
        $.ajax({
        url: "../ajax_request/api-bd-ontime.php",
        type: "POST",
        dataType: "html",
        success: function(data) {
            count = data;
            document.getElementById("bd_ontime").innerHTML = count;
            },
        
        }).done(function(resposta) {
        console.log(resposta);
        
        }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);
                        
        
        });
        
        } , 3000);
        

setInterval(function ajax_bd_date_corr() {
    var count;
        $.ajax({
        url: "../ajax_request/api-last-date-bdcorr.php",
        type: "POST",
        dataType: "html",
        success: function(data) {
            count = data;
            document.getElementById("last-date").innerHTML = count;
            },
        
        }).done(function(resposta) {
        console.log(resposta);
        
        }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);
                        
        
        });
        
        } , 400);


setInterval(function ajax_sharepoing() {
    var count;
        $.ajax({
        url: "../ajax_request/api-last-date-sharepoint.php",
        type: "POST",
        dataType: "html",
        success: function(data) {
            count = data;
            document.getElementById("last-date-sharepoint").innerHTML = count;
            },
        
        }).done(function(resposta) {
        console.log(resposta);
        
        }).fail(function(jqXHR, textStatus ) {
        console.log("Request failed: " + textStatus);
                        
        
        });
        
        } , 400);



        