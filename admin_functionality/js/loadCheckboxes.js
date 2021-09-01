// Functions for fetching data from database in order to show them up as checkboxes.
    showContentTypes();

    function showContentTypes(){
        let uReq = new XMLHttpRequest(); // New request object
            
        uReq.open("get", "sql/loadCT.php", true);
        uReq.onload = function() {
            const counter = JSON.parse(this.responseText);
            for(var i in counter){
                $(".content-types").append('<input type="checkbox" required id="'+ counter[i].ContentType + '" class="ct-box" value="'+ counter[i].ContentType +'">').append('<label  for="'+ counter[i].ContentType + '">'+ counter[i].ContentType +'&nbsp &nbsp &nbsp'+ '</label>')
            }
        };
        uReq.send();
    }

    showRequestedMethods();

    function showRequestedMethods(){
        let uReq = new XMLHttpRequest(); // New request object
            
        uReq.open("get", "sql/loadRM.php", true);
        uReq.onload = function() {
            const counter = JSON.parse(this.responseText);
            for(var i in counter){
                $(".req-methods").append('<input type="checkbox" required id="'+ counter[i].req_method + '" class="rm-box" value="'+ counter[i].req_method +'">').append('<label  for="'+ counter[i].req_method + '">'+ counter[i].req_method +'&nbsp &nbsp &nbsp'+ '</label>')
            }
        };
        uReq.send();
    }

    showISP();

    function showISP(){
        let uReq = new XMLHttpRequest(); // New request object
            
        uReq.open("get", "sql/loadISPname.php", true);
        uReq.onload = function() {
            const counter = JSON.parse(this.responseText);
            for(var i in counter){
                $(".isps").append('<input type="checkbox" required id="'+ counter[i].provider + '" class="isp-box" value="'+ counter[i].provider +'">').append('<label  for="'+ counter[i].provider + '">'+ counter[i].provider +'&nbsp &nbsp &nbsp'+ '</label>')
            }
        };
        uReq.send();
    }

// Check if the "all" checkboxes are checked and if "checked" check them.
    $("#allCT").click(function(){
        $(".ct-box").prop("checked", $(this).prop("checked"));
    });

    $("#allDays").click(function(){
        $(".days-box").prop("checked", $(this).prop("checked"));
    });

    $("#allRM").click(function(){
        $(".rm-box").prop("checked", $(this).prop("checked"));
        
    });

    $("#allISP").click(function(){
        $(".isp-box").prop("checked", $(this).prop("checked"));
    });

