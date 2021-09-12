// Submit button in order to apply filters and show graph
$("#submit").click(function(){

    $('#canvas-item').empty().append('<canvas class="chart" id="myChart2"></canvas>');
    var content_types = [];
    var days = [];
    var req_methods = [];
    var isps = [];

// Check which box is checked and push its value to the empty array created above
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

        var days_box = document.getElementsByClassName('days-box');
        for(var k=1; k<days_box.length; k++){
            if(days_box[k].checked == true){
                days.push(days_box[k].value);
            }else if(!(checked = $(".days-checkbox-wrapper > input[type=checkbox]:checked").length)){
                alert("You must check at least one checkbox for Days of week.");
                return false;
            }
        }

        var rm_box = document.getElementsByClassName('rm-box');
        for(var k=1; k<rm_box.length; k++){
            if(rm_box[k].checked == true){
                req_methods.push(rm_box[k].value);
            }else if(!(checked = $(".rm-checkbox-wrapper > input[type=checkbox]:checked").length)){
                alert("You must check at least one checkbox for HTTP request methods.");
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

        // Replace the [] with () in order to pass the values of the arrays into php files that gonna connect with the sql query.
        content_types = JSON.stringify(content_types).replace(/\[/g, "(").replace(/\]/g, ")"); 
        days = JSON.stringify(days).replace(/\[/g, "(").replace(/\]/g, ")");
        req_methods = JSON.stringify(req_methods).replace(/\[/g, "(").replace(/\]/g, ")");
        isps = JSON.stringify(isps).replace(/\[/g, "(").replace(/\]/g, ")");

        $.ajax({
            url:"sql/loadAvgWait.php",
            method: "POST",
            data:{
                content_types: content_types,
                days: days,
                req_methods: req_methods,
                isps: isps
            },
            success: function(res){
                if(res){
                    // Get the data from php file and assign then into a variable
                    res = JSON.parse(res);
                    console.log(res);

                    // Create arrays that gonna store information from database.
                    var hours = [];
                    var avgTime = [];
                    var hourslabel = [];
                    var waitData = [];

                    //Create the hours label for graph
                    for(var w=0; w<25; w++){ 
                        hourslabel.push(w);
                    }

                    // Assign the proper values from database to hours and avgWait
                    for(var j=0; j<25 ; j++){  
                        for(var i=0; i<res.length; i++){
                            var obj = res[i];
                            avgTime.push(obj.Average);
                            hours.push(obj.hour);
                            if(hours[i] == hourslabel[j]){
                                waitData[j] = avgTime[i];
                                break;
                            }else{
                                waitData[j] = 0;
                            }
                        }
                    }

                    // Create graph and assign the proper values on it
                    const ctx = document.getElementById('myChart2').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: hourslabel,
                            datasets: [{
                                data: waitData,
                                backgroundColor: '#9bc5c3',
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
                                        color: '#9bc5c3'
                                    }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                        
                    });      
                }else{
                    alert('Please select one of each filter');
                } 
            }
        });
    }
});