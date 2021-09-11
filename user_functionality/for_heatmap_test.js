var mymap = L.map('mapid').setView([38.272689, 21.621094], 13);

var marker = L.marker([38.107547, 21.502991]);
marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

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
                        
    let cReq = new XMLHttpRequest(); // New request object
    cReq.open("get", "for_heatmap.php", true);

    cReq.onload = function cooFunc() {
        const counter = JSON.parse(this.responseText);
        console.log(counter); 
      
        // or the shorthand way
        var dict = {};
        var dataa = [];
        
        function myFunction(item) {
            var dict = {
                lat: parseFloat(item.lat),
                lng: parseFloat(item.lng),
                'count': parseInt(item.count)
            };
            
            dataa.push(dict);
            //dataa.push([parseFloat(item.lat), parseFloat(item.lng), parseInt(item.count)]);
    
        }

        counter.forEach(myFunction);
        //document.getElementById("demo3").innerHTML = JSON.stringify(dataa);

        let testData = {
            max: 8,
            data: dataa
            };
            let cfg = {
            // radius should be small ONLY if scaleRadius is true (or small radius is intended)
            // if scaleRadius is false it will be the constant radius used in pixels
            "radius": 40,
            "maxOpacity": 0.8,
            // scales the radius based on map zoom
            "scaleRadius": false,
            // if set to false the heatmap uses the global maximum for colorization
            // if activated: uses the data maximum within the current map boundaries
            //   (there will always be a red spot with useLocalExtremas true)
            "useLocalExtrema": false,
            // which field name in your data represents the latitude - default "lat"
            latField: 'lat',
            // which field name in your data represents the longitude - default "lng"
            lngField: 'lng',
            // which field name in your data represents the data value - default "value"
            valueField: 'count'
            };
            
        let heatmapLayer =  new HeatmapOverlay(cfg);
            
        mymap.addLayer(heatmapLayer);
        heatmapLayer.setData(testData);

        console.log(dataa);
    };
    cReq.send();




}