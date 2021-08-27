$("#selectUsers").click(function(){

    let uReq = new XMLHttpRequest(); // New request object

            
    uReq.open("get", "sql/loadUsers.php", true);
    uReq.onload = function() {
        const counter = this.responseText;
        console.log(counter); 
        var output='';
        
        output += 
                '<div class="canvas-item">'+
                    '<canvas class="chart" id="myChart"></canvas>'+
                    '<div class="text-info">Records of registered users in database are: '+ counter + '</div>'+
                '</div>';
            
        document.getElementById("welcomeText").innerHTML = '';
        document.getElementById("canvas-item").innerHTML = output;

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Users'],
                datasets: [{
                    label: 'Sum of registered users',
                    data: [counter],
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
                        labels:{
                            color: 'rgb(194, 153, 255)',
                            font:{
                                size:12,
                                family: 'Lato',
                                weight: 'bold'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });  
        
        // Below with use it in order to update some fields of the graph
        // const button = document.getElementById('btn').addEventListener('click',loadData);
        // function loadData(){
        //     myChart.data.datasets[0].data = [50];
        //     myChart.update();
        // }
    };
    uReq.send();
});

$("#selectReqMethods").click(function(){

    let uReq = new XMLHttpRequest(); // New request object

            
    uReq.open("get", "sql/loadReqMethod.php", true);
    uReq.onload = function() {
        const counter = JSON.parse(this.responseText);
        // const counter = this.responseText;
        console.log(counter); 
        
        for(var i in counter){
            var output='';
            output += 
                    '<div class="canvas-item">'+
                        '<canvas class="chart" id="myChart"></canvas>'+
                        '<div class="text-info">Records per Method: '+ counter[0].req_method +' in database are: '+ counter[0].number + '</div>'+
                        '<div class="text-info">Records per Method: '+ counter[1].req_method +' in database are: '+ counter[1].number + '</div>'+
                    '</div>';
                
            document.getElementById("welcomeText").innerHTML = '';
            document.getElementById("canvas-item").innerHTML = output;
            
        
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [counter[0].req_method,counter[1].req_method],
                    datasets: [{
                        label: 'Records per Method',
                        data: [counter[0].number,counter[1].number],
                        backgroundColor: ['rgb(194, 153, 255)', 'rgb(194, 153, 255)' ],
                        borderWidth: 1,
                        barThickness: 20,
                        borderColor: ['rgb(194, 153, 255)', 'rgb(194, 153, 255)' ],
                        hoverBorderWidth: 3,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive:false,
                    plugins:{
                        legend:{
                            labels:{
                                color: 'rgb(194, 153, 255)',
                                font:{
                                    size:12,
                                    family: 'Lato',
                                    weight: 'bold'
                                }
                            }
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
});

$("#selectResponseStatus").click(function(){

    let uReq = new XMLHttpRequest(); // New request object

            
    uReq.open("get", "sql/loadResponseStatus.php", true);
    uReq.onload = function() {
        const counter = JSON.parse(this.responseText);
        console.log(counter); 
        
         for(var i in counter){
            var output='';
            output += 
                    '<div class="canvas-item">'+
                        '<canvas class="chart" id="myChart"></canvas>'+
                        '<div class="text-info">Records per Status: '+ counter[0].res_status +' in database are: '+ counter[0].number + '</div>'+
                        '<div class="text-info">Records per Status: '+ counter[1].res_status +' in database are: '+ counter[1].number + '</div>'+
                        '<div class="text-info">Records per Status: '+ counter[2].res_status +' in database are: '+ counter[2].number + '</div>'+
                        '<div class="text-info">Records per Status: '+ counter[3].res_status +' in database are: '+ counter[3].number + '</div>'+
                    '</div>';
                
            document.getElementById("welcomeText").innerHTML = '';
            document.getElementById("canvas-item").innerHTML = output;
            
        
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [counter[0].res_status,counter[1].res_status,counter[2].res_status,counter[3].res_status],
                    datasets: [{
                        label: 'Records per Method',
                        data: [counter[0].number,counter[1].number,counter[2].number,counter[3].number],
                        backgroundColor: ['rgb(194, 153, 255)','rgb(194, 153, 255)','rgb(194, 153, 255)','rgb(194, 153, 255)'],
                        borderWidth: 1,
                        barThickness: 20,
                        borderColor: ['rgb(194, 153, 255)','rgb(194, 153, 255)','rgb(194, 153, 255)','rgb(194, 153, 255)'],
                        hoverBorderWidth: 3,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive:false,
                    plugins:{
                        legend:{
                            labels:{
                                color: 'rgb(194, 153, 255)',
                                font:{
                                    size:12,
                                    family: 'Lato',
                                    weight: 'bold'
                                }
                            }
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
});

$("#selectDomains").click(function(){

    let uReq = new XMLHttpRequest(); // New request object

            
    uReq.open("get", "sql/loadReqUrl.php", true);
    uReq.onload = function() {
        const counter = this.responseText;
        console.log(counter); 
        var output='';
        
        output += 
                '<div class="canvas-item">'+
                    '<canvas class="chart" id="myChart"></canvas>'+
                    '<div class="text-info">Records of unique domains in database are: '+ counter + '</div>'+
                '</div>';
            
        document.getElementById("welcomeText").innerHTML = '';
        document.getElementById("canvas-item").innerHTML = output;

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Unique Domains'],
                datasets: [{
                    label: 'Records of unique domains',
                    data: [counter],
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
                        labels:{
                            color: 'rgb(194, 153, 255)',
                            font:{
                                size:12,
                                family: 'Lato',
                                weight: 'bold'
                            }
                        }
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

$("#selectISP").click(function(){

    let uReq = new XMLHttpRequest(); // New request object

            
    uReq.open("get", "sql/loadISP.php", true);
    uReq.onload = function() {
        const counter = this.responseText;
        console.log(counter); 
        var output='';
        
        output += 
                '<div class="canvas-item">'+
                    '<canvas class="chart" id="myChart"></canvas>'+
                    '<div class="text-info">Records of unique ISPs in database are: '+ counter + '</div>'+
                '</div>';
            
        document.getElementById("welcomeText").innerHTML = '';
        document.getElementById("canvas-item").innerHTML = output;

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Unique ISPs'],
                datasets: [{
                    label: 'Records of unique ISPs',
                    data: [counter],
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
                        labels:{
                            color: 'rgb(194, 153, 255)',
                            font:{
                                size:12,
                                family: 'Lato',
                                weight: 'bold'
                            }
                        }
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