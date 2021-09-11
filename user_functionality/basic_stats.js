let uReq = new XMLHttpRequest(); // New request object
uReq.open("get", "user_records.php", true);
uReq.onload = function() {
    const counter = JSON.parse(this.responseText);
    console.log(counter); 
    var output='';
    
    output += 
        '<h3>My stats:</h3>'+ 
                '<table>'+
                    '<tr>'+
                        '<th>Latest Upload</th>'+
                        '<th>Num of Records</th>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>'+ counter[0].LastUpload+'</td>'+
                    '<td>'+ counter[0].numOfRecords+'</td>'+
                    '</tr>'+
                '</table>';

        document.getElementById("userStats").innerHTML = output;   
}
              
uReq.send();