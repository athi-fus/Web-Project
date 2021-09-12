const mymap = L.map('mapid').setView([37.983810, 23.727539], 6); //Latitude, longitude, zoom level 

// Set a marker for the map
var marker = L.marker([0,0]);

// We define the api tokens and style of map that gonna be displayed on the page
 var  baselayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiYXRoaWZ1cyIsImEiOiJja3M0ZmxsNDgyNGp2MnFtc2Zuc3ZhMzVhIn0.7ksVgRuaF49NHovtEWChXA'
        }).addTo(mymap);

loadLatLong();

function loadLatLong(){
    let uReq = new XMLHttpRequest(); // Ajax call

            
    uReq.open("get", "sql/loadLatLong.php", true);
    uReq.onload = function() {
        const counter = JSON.parse(this.responseText);
        var latlngs = [];
        var userIcon = new L.Icon({
            iconUrl: 'imgs/marker.png',
            iconSize: [40, 40],
            popupAnchor: [1, -16],
        });
        
        // Here we create a loop that gonna put markers on map based on the data that were exported from database through Ajax call
        // There is also an if condition that changes dynamically thickness of polylines that connext these two markers
        // Red marker is for user location and blue marker is for server location
        for(var i=0; i<counter.length; i++){ 
            markerServer = new L.marker([counter[i].latitude,counter[i].longitude]).addTo(mymap).bindPopup('Marker for Server Ips');
            markerUser = new L.marker([counter[i].lat,counter[i].lon],{icon: userIcon}).addTo(mymap).bindPopup('Marker for User Ips');
            latlngs.push([[counter[i].latitude,counter[i].longitude],[counter[i].lat,counter[i].lon]]);
            var thickness;
            if(counter[i].records < 2){
               thickness = 0.25;
            }else if(counter[i].records >= 2 && counter[i].records < 6){
                thickness = 0.5;
            }else if(counter[i].records >= 6 && counter[i].records < 10){
                thickness = 1;
            }else{
                thickness = counter[i].records/10; //Each time see the records and divide them by 10. ex 20 records = 2 thickness
            }
            
            L.polyline(latlngs, {color: 'black', weight: thickness}).addTo(mymap); //Create the polylines for each pair of userIps and ServerIps
            
        }
        console.log(latlngs);
    };
    uReq.send();
}