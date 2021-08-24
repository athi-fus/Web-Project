const button = document.getElementById('btn').addEventListener('click',loadData);
    
    function loadData(){
        var oReq = new XMLHttpRequest(); // New request object
        
        oReq.open("get", "loadFields.php", true);
        oReq.onload = function() {
            const counter = this.responseText;
            
            console.log(counter); 
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Users'],
                    datasets: [{
                        label: 'Sum of registered users',
                        data: [counter],
                        backgroundColor: 'transparent',
                        borderWidth: 1,
                        barThickness: 15,
                        borderColor: 'rgb(0, 255, 255)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        };
        oReq.send();
        
    }