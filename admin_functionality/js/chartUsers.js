var oReq = new XMLHttpRequest(); // New request object
        
oReq.open("get", "sql/loadUsers.php", true);
oReq.onload = function() {
    const counter = this.responseText;
    // console.log(counter); 

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Users'],
            datasets: [{
                label: 'SUM OF REGISTERED USERS',
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
                            family: 'Allison',
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
oReq.send();
