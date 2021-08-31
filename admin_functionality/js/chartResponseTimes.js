showContentTypes();

function showContentTypes(){
    let uReq = new XMLHttpRequest(); // New request object
        
    uReq.open("get", "sql/loadCT.php", true);
    uReq.onload = function() {
        const counter = JSON.parse(this.responseText);
        for(var i in counter){
            $(".content-types").append('<input type="checkbox" id="'+ counter[i].ContentType + '" name="'+ counter[i].ContentType +'" value="'+ counter[i].ContentType +'">').append('<label  for="'+ counter[i].ContentType + '">'+ counter[i].ContentType +'&nbsp &nbsp &nbsp'+ '</label>')
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
            $(".req-methods").append('<input type="checkbox" id="'+ counter[i].req_method + '" name="'+ counter[i].req_method +'" value="'+ counter[i].req_method +'">').append('<label  for="'+ counter[i].req_method + '">'+ counter[i].req_method +'&nbsp &nbsp &nbsp'+ '</label>')
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
            $(".isps").append('<input type="checkbox" id="'+ counter[i].provider + '" name="'+ counter[i].provider +'" value="'+ counter[i].provider +'">').append('<label  for="'+ counter[i].provider + '">'+ counter[i].provider +'&nbsp &nbsp &nbsp'+ '</label>')
        }
    };
    uReq.send();
}

$("#submit").click(function(){
    let uReq = new XMLHttpRequest(); // New request object

            
    uReq.open("get", "sql/loadAvgWait.php", true);
    uReq.onload = function() {
        const counter = JSON.parse(this.responseText);
        var hours = [];
        var avgTime = [];
        var hourslabel = [];
        var waitData= [];
        for(var w=0; w<25; w++){
            hourslabel.push(w);
        }
        for(var j=0; j<25 ; j++){
            for(var i=0; i<counter.length; i++){
                var obj = counter[i];
                avgTime.push(obj.Average);
                hours.push(obj.hour);
                if(hours[i] == hourslabel[j]){
                    waitData[j] = avgTime[i];
                    break;
                }else{
                    waitData[j] = 0;
                }
                // var output='';
                // output += 
                //     '<div class="canvas-item">'+
                //         '<canvas class="chart" id="myChart"></canvas>'+
                //         '<div class="text-info-age">Average age per Content-Type: '+ counter[0].ContentType +' in database is: '+ counter[0].AverageAge + '</div>'+
                //     '</div>';
                    
                // // document.getElementById("welcomeText").innerHTML = '';
                // document.getElementById("canvas-item").innerHTML = output;
            }
        }
        const ctx = document.getElementById('myChart2').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: hourslabel,
                datasets: [{
                    data: waitData,
                    backgroundColor: 'rgb(194, 153, 255)',
                    borderWidth: 1,
                    barThickness: 20,
                    hoverBorderWidth: 3,
                    borderWidth: 1
                }]
            },
            options: {
                responsive:false,
                plugins:{
                    legend:{
                        display : false,
                    },
                    title: {
                            display: true,
                            text: 'Average Response Time per Hour',
                            color: 'rgb(194, 153, 255)'
                        }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
            
        }); 
    };
    uReq.send();
});