$("#selectUsers").click(function(){

    let uReq = new XMLHttpRequest(); // New request object

            
    uReq.open("get", "sql/loadUsers.php", true);
    uReq.onload = function() {
        const counter = this.responseText;
        var output='';
        
        output += 
                '<div class="canvas-item">'+
                    '<canvas class="chart" id="myChart"></canvas>'+
                    '<div class="text-info-js">Records of registered users in database are: '+ counter + '.</div>'+
                '</div>';
            
        // document.getElementById("welcomeText").innerHTML = '';
        document.getElementById("canvas-item").innerHTML = output;

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Users'],
                datasets: [{
                    data: [counter],
                    backgroundColor:'#9bc5c3',
                    borderWidth: 1,
                    barThickness: 20,
                    borderColor:'#9bc5c3',
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
                        text: 'Records of registered users',
                        color:'#9bc5c3'
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
        var methods = [];
        var records = [];
    
        for(var i=0; i<counter.length; i++){
            var obj = counter[i];
            methods.push(obj.reqMethod);
            records.push(obj.number);


            var output='';
            output += 
                    '<div class="canvas-item">'+
                        '<canvas class="chart" id="myChart"></canvas>'+
                        '<div class="text-info-two">Records per Methods: <br>'+ methods +'<br> in database are: <br>'+ records + '.</div>'+
                    '</div>';
                
            // document.getElementById("welcomeText").innerHTML = '';
            document.getElementById("canvas-item").innerHTML = output;
            
        }    
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: methods,
                datasets: [{
                    data: records,
                    backgroundColor:'#9bc5c3',
                    borderWidth: 1,
                    barThickness: 20,
                    borderColor:'#9bc5c3',
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
                        text: 'Records per Method',
                        color:'#9bc5c3'
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

$("#selectResponseStatus").click(function(){

    let uReq = new XMLHttpRequest(); // New request object

            
    uReq.open("get", "sql/loadResponseStatus.php", true);
    uReq.onload = function() {
        const counter = JSON.parse(this.responseText);
        var statuses = [];
        var records = [];

        for(var i=0; i<counter.length;i++){
            var obj = counter[i];
            statuses.push(obj.res_status);
            records.push(obj.number);

            var output='';
            output += 
                    '<div class="canvas-item">'+
                        '<canvas class="chart" id="myChart"></canvas>'+
                        '<div class="text-info-two">Records per Statuses: <br>'+ statuses +'<br> in database are: <br>'+ records + '.</div>'+
                    '</div>';
                
            // document.getElementById("welcomeText").innerHTML = '';
            document.getElementById("canvas-item").innerHTML = output;
        }        
        
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: statuses,
                datasets: [{
                    data: records,
                    backgroundColor:'#9bc5c3',
                    borderWidth: 1,
                    barThickness: 20,
                    borderColor:'#9bc5c3',
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
                        text: 'Records per Status',
                        color:'#9bc5c3'
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

$("#selectDomains").click(function(){

    let uReq = new XMLHttpRequest(); // New request object

            
    uReq.open("get", "sql/loadReqUrl.php", true);
    uReq.onload = function() {
        const counter = this.responseText;
        var output='';
        
        output += 
                '<div class="canvas-item">'+
                    '<canvas class="chart" id="myChart"></canvas>'+
                    '<div class="text-info-js">Records of unique domains in database are: '+ counter + '.</div>'+
                '</div>';
            
        // document.getElementById("welcomeText").innerHTML = '';
        document.getElementById("canvas-item").innerHTML = output;

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Unique Domains'],
                datasets: [{
                    data: [counter],
                    backgroundColor:'#9bc5c3',
                    borderWidth: 1,
                    barThickness: 20,
                    borderColor:'#9bc5c3',
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
                        text: 'Records of unique domains in database',
                        color:'#9bc5c3'
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
        var output='';
        
        output += 
                '<div class="canvas-item">'+
                    '<canvas class="chart" id="myChart"></canvas>'+
                    '<div class="text-info-js">Records of unique ISPs in database are: '+ counter + '.</div>'+
                '</div>';
            
        // document.getElementById("welcomeText").innerHTML = '';
        document.getElementById("canvas-item").innerHTML = output;

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Unique ISPs'],
                datasets: [{
                    data: [counter],
                    backgroundColor:'#9bc5c3',
                    borderWidth: 1,
                    barThickness: 20,
                    borderColor:'#9bc5c3',
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
                        text: 'Records of unique ISPs in database',
                        color:'#9bc5c3'
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

$("#selectAge").click(function(){

    let uReq = new XMLHttpRequest(); // New request object

            
    uReq.open("get", "sql/loadAvgAge.php", true);
    uReq.onload = function() {
        const counter = JSON.parse(this.responseText); 
        var contentTypes = [];
        var avgAge = [];
    
        for(var i=0;i<counter.length;i++){
            var obj = counter[i];
            contentTypes.push(obj.ContentType);
            avgAge.push(obj.AverageAge);

            var output='';
            output += 
                '<div class="canvas-item">'+
                    '<canvas class="chart" id="myChart"></canvas>'+
                    '<div class="text-info-age">Average age per Content-Type: <br>'+ contentTypes +'<br> in database is: <br>'+ avgAge + '.</div>'+
                '</div>';
                
            // document.getElementById("welcomeText").innerHTML = '';
            document.getElementById("canvas-item").innerHTML = output;
            
            
        }
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: contentTypes,
                datasets: [{
                    data: avgAge,
                    backgroundColor:'#9bc5c3',
                    borderWidth: 1,
                    barThickness: 20,
                    borderColor:'#9bc5c3',
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
                        text: 'Average age per Content-Type',
                        color:'#9bc5c3'
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

