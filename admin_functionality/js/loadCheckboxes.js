// Functions for fetching data from database in order to show them up as checkboxes.
    showContentTypes();

    function showContentTypes(){
        let uReq = new XMLHttpRequest(); // New request object
            
        uReq.open("get", "sql/loadCT.php", true);
        uReq.onload = function() {
            const counter = JSON.parse(this.responseText);
            for(var i in counter){
                $(".ct-wrapper").append('<div class="ct-checkbox-wrapper"><input type="checkbox" required id="'+ counter[i].ContentType + '" class="ct-box" value="'+ counter[i].ContentType +'"><label  for="'+ counter[i].ContentType + '">'+ '&nbsp &nbsp'+ counter[i].ContentType + '</label></div>');
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
                $(".rm-wrapper").append('<div class="rm-checkbox-wrapper"><input type="checkbox" required id="'+ counter[i].req_method + '" class="rm-box" value="'+ counter[i].req_method +'"><label  for="'+ counter[i].req_method + '">'+ '&nbsp &nbsp'+ counter[i].req_method + '</label></div>');
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
                $(".isp-wrapper").append('<div class="isp-checkbox-wrapper"><input type="checkbox" required id="'+ counter[i].provider + '" class="isp-box" value="'+ counter[i].provider +'"><label  for="'+ counter[i].provider + '">'+ '&nbsp &nbsp'+ counter[i].provider + '</label> </div>');
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

