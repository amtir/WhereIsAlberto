

/*--------------------------------------------------



-------------------------------------------------------*/

var map;
    var markersArray = [];
    var image = "/assets/images/Alberto_reduct4.png";
    var bounds = new google.maps.LatLngBounds();
    var loc;
    var strTrackTableHtm;


//console.info(b'debug text...');


    function addMarker(location, name, active) {          
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            title: name,
            status: active,
            icon: image
        });
    }




// Run when the DOM is ready
$(function(){
    
        var mapOptions = { mapTypeId: google.maps.MapTypeId.ROADMAP };
        map =  new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        showPosition();

       
//function getLocation() {
    //if (navigator.geolocation) { // the check sould be done in amout, before to reach this code and write into the db if necessary
        //navigator.geolocation.getCurrentPosition(showPosition, showError);
   // } 
  //  else {
  //     currPos.innerHTML = "Geolocation is not supported by this browser.";
  //      window.location.href = "register_track.htm";
  //  }
//}

    

});
