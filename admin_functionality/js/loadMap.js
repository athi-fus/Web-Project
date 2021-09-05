const mymap = L.map('mapid').setView([37.983810, 23.727539], 5); //Latitude, longitude, zoom level 

var marker = L.marker([0,0]);

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
    let uReq = new XMLHttpRequest(); // New request object

            
    uReq.open("get", "sql/loadLatLong.php", true);
    uReq.onload = function() {
        const counter = JSON.parse(this.responseText);
        console.log(counter);
        for(var i=1; i<counter.length; i++){
             marker = new L.marker([counter[i].latitude,counter[i].longitude]).addTo(mymap);
            console.log(marker);
            
            
        }
    };
    uReq.send();
}