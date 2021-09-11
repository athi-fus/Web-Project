showContentTypes();

    function showContentTypes(){
        let uReq = new XMLHttpRequest(); // New request object
            
        uReq.open("get", "sql/loadCTcheck.php", true);
        uReq.onload = function() {
            const counter = JSON.parse(this.responseText);
            for(var i in counter){
                $(".ct-wrapper").append('<div class="ct-checkbox-wrapper"><input type="checkbox" required id="'+ counter[i].ContentType + '" class="ct-box" value="'+ counter[i].ContentType +'"><label  for="'+ counter[i].ContentType + '">'+ '&nbsp &nbsp'+ counter[i].ContentType + '</label></div>');
            }
        };
        uReq.send();
    }

showContentTypesCache();

    function showContentTypesCache(){
        let uReq = new XMLHttpRequest(); // New request object
            
        uReq.open("get", "sql/loadCache.php", true);
        uReq.onload = function() {
            const counter = JSON.parse(this.responseText);
            for(var i in counter){
                $(".ct-wrapper-cache").append('<div class="ct-checkbox-wrapper-cache"><input type="checkbox" required id="'+ counter[i].ContentType + '" class="ct-box-cache" value="'+ counter[i].ContentType +'"><label  for="'+ counter[i].ContentType + '">'+ '&nbsp &nbsp'+ counter[i].ContentType + '</label></div>');
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

    showISPcache();

    function showISPcache(){
        let uReq = new XMLHttpRequest(); // New request object
            
        uReq.open("get", "sql/loadISPname.php", true);
        uReq.onload = function() {
            const counter = JSON.parse(this.responseText);
            for(var i in counter){
                $(".isp-wrapper-cache").append('<div class="isp-checkbox-wrapper-cache"><input type="checkbox" required id="'+ counter[i].provider + '" class="isp-box-cache" value="'+ counter[i].provider +'"><label  for="'+ counter[i].provider + '">'+ '&nbsp &nbsp'+ counter[i].provider + '</label> </div>');
            }
        };
        uReq.send();
    }
// Check if the "all" checkboxes are checked and if "checked" check them.
    $("#allCT").click(function(){
            $(".ct-box").prop("checked", $(this).prop("checked"));
        });

    $("#allISP").click(function(){
            $(".isp-box").prop("checked", $(this).prop("checked"));
        });
    $("#allCT-cache").click(function(){
        $(".ct-box-cache").prop("checked", $(this).prop("checked"));
    });

    $("#allISP-cache").click(function(){
            $(".isp-box-cache").prop("checked", $(this).prop("checked"));
        });

$("#submit").click(function(){

    $('#canvas-item').empty().append('<canvas class="chart" id="TTLchart"></canvas>');
    var content_types = [];
    var isps = [];

    checkBoxes();

    function checkBoxes(){
        var ct_box = document.getElementsByClassName('ct-box');
        for(var k=1; k<ct_box.length; k++){
            if(ct_box[k].checked == true){
                content_types.push(ct_box[k].value);
            }else if(!(checked = $(".ct-checkbox-wrapper > input[type=checkbox]:checked").length)){
                alert("You must check at least one checkbox for Content Types.");
                return false;
            }  
        }
        var isp_box = document.getElementsByClassName('isp-box');
        for(var k=1; k<isp_box.length; k++){
            if(isp_box[k].checked == true){
                isps.push(isp_box[k].value);
            }else if(!(checked = $(".isp-checkbox-wrapper > input[type=checkbox]:checked").length)){
                alert("You must check at least one checkbox for ISPs.");
                return false;
            } 
        }
        content_types = JSON.stringify(content_types).replace(/\[/g, "(").replace(/\]/g, ")");
        isps = JSON.stringify(isps).replace(/\[/g, "(").replace(/\]/g, ")");

        $.ajax({
            url:"sql/loadTTL.php",
            method: "POST",
            data:{
                content_types: content_types,
                isps: isps
            },
            success: function(res){
                // Get the data from php file and assign then into a variable
                res = JSON.parse(res);
                console.log(res);

                // Create arrays that gonna store information from database.
                var maxAges = [];
                var maxAgesUnsorted = [];
                var step_labels = [];
                var final_labels = [];
                var final_data = new Array(10).fill(0);
                var records = [];
               

                for(var k=0;k<res.length; k++){
                    records.push(parseInt(res[k].Records));
                }

                for(var i=0; i<res.length; i++){
                    maxAges.push(parseInt(res[i].MaxAge.match(/\d+/)));
                    maxAgesUnsorted.push(parseInt(res[i].MaxAge.match(/\d+/)));
                    
                }
                maxAges.sort((a,b)=>a-b);
                if(maxAges.length == 1){
                    firstAge = 0;
                    lastAge = maxAges[0];
                }else{
                    firstAge = maxAges[0];
                    lastAge = maxAges[maxAges.length-1];
                }
                
                var step = (lastAge - firstAge)/10 ;

                for(var j = 0; j<=10; j++){
                    step_labels.push(firstAge+j*step);        
                }
                // console.log(step_labels);

                for(var v=0; v<10; v++){
                    if(v == 9){
                        final_labels.push(step_labels[v]+'-'+(step_labels[v+1]));
                    }else{
                        final_labels.push(step_labels[v]+'-'+(step_labels[v+1]-1));
                    }
                    
                }

                for(var p=0; p<maxAgesUnsorted.length; p++){
                    for(var h=0; h<10; h++){
                        if(step_labels[h] <= maxAgesUnsorted[p] && maxAgesUnsorted[p] <= step_labels[h+1] ){
                           final_data[h] += records[p];
                        }
                    }
                }

                
                // setup
                const dataTTL = {
                    labels: final_labels,
                        datasets: [{
                            data: final_data,
                            backgroundColor: '#9bc5c3',
                            borderWidth: 1,
                            barThickness: 20,
                            hoverBorderWidth: 3,
                            borderWidth: 1
                        }]
                };

                // config TTL
                const config2 = {
                    type: 'bar',
                    data: dataTTL,
                    options: {
                        responsive:false,
                        plugins:{
                            legend:{
                                display : false,
                            },
                            title: {
                                    display: true,
                                    text: 'TTL per Content Type',
                                    color: '#9bc5c3'
                                }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                };

                // render TTL block

                const TTLchart = new Chart(
                document.getElementById('TTLchart'),
                config2
                );     
                    
            }
        });
    }
});


$("#submitCache").click(function(){

    $('#canvas-item').empty().append('<canvas class="chart" id="CacheChart"></canvas>');
    var content_types = [];
    var isps = [];

    checkBoxes();

    function checkBoxes(){
        var ct_box = document.getElementsByClassName('ct-box-cache');
        for(var k=1; k<ct_box.length; k++){
            if(ct_box[k].checked == true){
                content_types.push(ct_box[k].value);
            }else if(!(checked = $(".ct-checkbox-wrapper-cache > input[type=checkbox]:checked").length)){
                alert("You must check at least one checkbox for Content Types.");
                return false;
            }  
        }
        var isp_box = document.getElementsByClassName('isp-box-cache');
        for(var k=1; k<isp_box.length; k++){
            if(isp_box[k].checked == true){
                isps.push(isp_box[k].value);
            }else if(!(checked = $(".isp-checkbox-wrapper-cache > input[type=checkbox]:checked").length)){
                alert("You must check at least one checkbox for ISPs.");
                return false;
            } 
        }
        content_types = JSON.stringify(content_types).replace(/\[/g, "(").replace(/\]/g, ")");
        isps = JSON.stringify(isps).replace(/\[/g, "(").replace(/\]/g, ")");
        console.log(content_types);

        $.ajax({
            url:"sql/loadCacheDirec.php",
            method: "POST",
            data:{
                content_types: content_types,
                isps: isps
            },
            success: function(res){
                // Get the data from php file and assign then into a variable
                res = JSON.parse(res);
                console.log(res);

                var recordsPublic = 0;
                var recordsPrivate = 0;
                var recordsNocache = 0;
                var recordsNostore = 0;
                var totalRecords = 0;
                var chartData = [];

                for(var i=0; i<res.length; i++){
                    var obj = res[i];
                    
                    if(obj.Cacheability.match(/public/g)){
                        recordsPublic += parseInt(obj.Records);
                    }if(obj.Cacheability.match(/private/g)){
                        recordsPrivate += parseInt(obj.Records);
                    }if(obj.Cacheability.match(/no-cache/g)){
                        recordsNocache += parseInt(obj.Records);
                    }if(obj.Cacheability.match(/no-store/g)){
                        recordsNostore += parseInt(obj.Records);
                    }
                    totalRecords = recordsNocache + recordsPublic + recordsPrivate + recordsNostore;
                }
                chartData.push((recordsPublic/totalRecords)*100);
                chartData.push((recordsPrivate/totalRecords)*100);
                chartData.push((recordsNocache/totalRecords)*100);
                chartData.push((recordsNostore/totalRecords)*100);
                
                //setup
                const dataCache = {
                    labels: ['Public','Private','No-cache','No-store'],
                        datasets: [{
                            data: chartData,
                            backgroundColor: '#9bc5c3',
                            borderWidth: 1,
                            barThickness: 20,
                            hoverBorderWidth: 3,
                            borderWidth: 1
                        }]
                };

                //config
                const config ={
                    type: 'bar',
                    data: dataCache,
                    options: {
                        responsive:false,
                        plugins:{
                            legend:{
                                display : false,
                            },
                            title: {
                                    display: true,
                                    text: 'Percentage of cacheability directives',
                                    color: '#9bc5c3'
                                }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                };

                // render init block
                const cacheChart = new Chart(
                    document.getElementById('cacheChart'),
                    config
                );      
                    
            }
        });
    }
});