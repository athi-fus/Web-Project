let uReq = new XMLHttpRequest(); // New request object

        
uReq.open("get", "sql/loadAvgWait.php", true);
uReq.onload = function() {
    const counter = JSON.parse(this.responseText);
    console.log(counter); 
    
        for(var i in counter){
        // var output='';
        // output += 
        //     '<div class="canvas-item">'+
        //         '<canvas class="chart" id="myChart"></canvas>'+
        //         '<div class="text-info-age">Average age per Content-Type: '+ counter[0].ContentType +' in database is: '+ counter[0].AverageAge + '</div>'+
        //         '<div class="text-info-age">Average age per Content-Type: '+ counter[1].ContentType +' in database is: '+ counter[1].AverageAge + '</div>'+
        //         '<div class="text-info-age">Average age per Content-Type: '+ counter[2].ContentType +' in database is: '+ counter[2].AverageAge + '</div>'+
        //         '<div class="text-info-age">Average age per Content-Type: '+ counter[3].ContentType +' in database is: '+ counter[3].AverageAge + '</div>'+
        //     '</div>';
            
        // // document.getElementById("welcomeText").innerHTML = '';
        // document.getElementById("canvas-item").innerHTML = output;
        
    
        const ctx = document.getElementById('myChart2').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [counter[0].hour],
                datasets: [{
                    data: [counter[0].Average],
                    backgroundColor: 'rgb(194, 153, 255)',
                    borderWidth: 1,
                    barThickness: 20,
                    borderColor: 'rgb(194, 153, 255)',
                    hoverBorderWidth: 3,
                    borderWidth: 1
                }]
            },
            options: {
                responsive:false,
                plugins:{
                    legend:{
                        display : false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
            
            });  
    }
};
uReq.send();
