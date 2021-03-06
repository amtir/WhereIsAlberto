
/*       _\|/_
         (o o)
 +----oOO-{_}-OOo----------------------+
 |       Programmer: Akram M'Tir       |
 |   Address: Chemin de montelly 68    |
 |            1007 Lausanne            |
 |             Switzerland             |
 |      Phone: 0041 78 858 49 02       |
 |   E-mail1: akram.mtir@hotmail.com   |
 |    E-mail2: akram.mtir@gmail.com    |
 |  Studies: MSc Computer Science UK   |
 |          EPFL Engineer CH           |
 |           Date: 06-11-15            |
 +------------------------------------*/

/*--------------------------------------------------

Simple javascript to mimic and simulate the server side behavior.
Bunch of data objects to simulate the historical of the banknote grabbed from the database.
These data plus the current user geolocation position are then represented in a google map and a table.

By this means we offer to the user users and stakeholders a real prototype (GUI, front-side HTML5/CSS/JS) where they can experiment, test and have a better idea of what they really want.

-------------------------------------------------------*/

var map;
    var markersArray = [];
    var image = "images/Alberto_reduct.png";
    var bounds = new google.maps.LatLngBounds();
    var loc;
    var strTrackTableHtm;

    // dynamic array
    var banknote_track = [];
    // Banknote/Bill contructor
    function banknote(rank, firstName, lastName, location, date, email, gpsLat, gpsLong  ){
        
        this.rank=rank;
        this.firstName = firstName || "unknown";
        this.lastName = lastName || "unknown";
        this.location= location || "unknown";
        this.date=date || "unknown";
        this.email=email || "unknown";
        this.gpsLat = gpsLat;
        this.gpsLong = gpsLong;
    
    }




    // Dummy bunch of records/data to show the feasibility. These records should be replaced by data coming from our server/data-base.
banknote_track.push(new banknote(1, 'Tom', 'Johnson' , 'Zurich' , '08/03/2015',"Tom.John@gmail.com", "47.42305555555555","8.521666666666668"));                 
banknote_track.push(new banknote(2, 'Peter', 'White' , 'Geneva' , '25/03/2015',"Peter.White@hotmail.com","46.18805555555555","6.198888888888889"));

banknote_track.push(new banknote(3, 'Hans', 'Jackson' , 'Bern' , '12/04/2015',"Hans.Peter@gmail.com","46.913888888888884","7.496944444444445"));

banknote_track.push(new banknote(4, 'John', 'Lee' , 'Lucerne' , '18/04/2015',"John.Lee@yahoo.com","47.05027777777777","8.306111111111111"));
    
banknote_track.push(new banknote(5, 'Sandy', 'Lewis' , 'Basel' , '04/05/2015',"Sandy.Lewis@hotmail.com","47.56666666666667","7.614999999999999"));

banknote_track.push(new banknote(6, 'Alice', 'Miler' , 'Saint Gallen' ,'18/05/2015' , "Alice.Wonder@hotmail.com","47.42388888888889","9.374722222222223"));

banknote_track.push(new banknote(7, 'Alberto', 'Martinez' , 'Lugano' , '05/06/2015',"Albert.Martinez@gmail.com", "46.01138888888889","8.995833333333332"));





//---------------------------------------------------
window.store = {
    localStoreSupport : function() {
        try {
            return 'localStorage' in window && window['localStorage'] !== null;
        } catch (e) {
            return false;
        }
    },
    set : function(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else {
            var expires = "";
        }
        if( this.localStoreSupport() ) {
            localStorage.setItem(name, value);
        }
        else {
            document.cookie = name+"="+value+expires+"; path=/";
        }
    },
    get : function(name) {
        if( this.localStoreSupport() ) {
            return localStorage.getItem(name);
        }
        else {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
    },
    del : function(name) {
        if( this.localStoreSupport() ) {
            localStorage.removeItem(name);
        }
        else {
            this.set(name,"",-1);
        }
    }
}


//-----------------------------------------------------

    // Simple structure of the table to complete the visual information on the map.
        strTrackTableHtm =  '<h2>Previous locations and owners</h2>';
            strTrackTableHtm += '<p>WhereIsAlberto Serial Number ' + store.get('sn') +':</p>'
         //   strTrackTableHtm += '<p>WhereIsAlberto Serial Number 00K5911063:</p>';
 
                     strTrackTableHtm +=
                    '<table class="table table-condensed table-hover">'+
                        '<thead>'+
                          '<tr>'+
                            '<th>Rank</th>'+
                            '<th>Date</th>'+
                            '<th>Firstname</th>'+
                            '<th>Lastname</th>'+
                            '<th>Location</th>'+
                            '<th>Email</th>'+
                          '</tr>'+
                        '</thead>'+
                        '<tbody>';
               

//---------------------------------------------------
function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
}


//---------------------------------------------------
    function addMarker(location, name, active) {          
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            title: name,
            status: active,
            icon: image
        });
    }


//---------------------------------------------------
function showPosition(position) {
    
    var currPos = document.getElementById("coordinates");
    
    currPos.innerHTML = "Your current position is : <br>Latitude: " + position.coords.latitude + 
    ",  Longitude: " + position.coords.longitude;	
    

    var d = new Date();
    var dateUser = d.getDate().toString() +"/"+ (d.getMonth()+1).toString() + "/"+d.getFullYear().toString();
        // personal user details
 
        
        banknote_track.push(new banknote(8, store.get('fname'), store.get('lname'), store.get('location'), dateUser, store.get('email') , position.coords.latitude, position.coords.longitude));
        
    
    var mapOptions = { mapTypeId: google.maps.MapTypeId.ROADMAP };
    
    map =  new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    var elem;
    for (elem in banknote_track){
            loc = new google.maps.LatLng(banknote_track[elem].gpsLat,banknote_track[elem].gpsLong);

            bounds.extend(loc);
            addMarker(loc, banknote_track[elem].rank + '\n' +banknote_track[elem].firstName + ' ' + banknote_track[elem].lastName +'\n' +banknote_track[elem].date + '\n' + banknote_track[elem].location, "active");
        
        strTrackTableHtm +=  '<tr>'+
                            '<td>'+ banknote_track[elem].rank + '</td>'+
                            '<td>'+ banknote_track[elem].date +'</td>'+
                            '<td>'+ banknote_track[elem].firstName +'</td>'+
                            '<td>'+ banknote_track[elem].lastName +'</td>'+
                            '<td>'+ banknote_track[elem].location +'</td>'+
                            '<td>'+ banknote_track[elem].email+'</td>'+
                          '</tr>';

    }
    
                            
    strTrackTableHtm += '</tbody>'+'</table>';
    
    map.fitBounds(bounds);
    map.panToBounds(bounds);        
    
    $(trackTable).html(strTrackTableHtm);
      
}


//---------------------------------------------------


// Run when the DOM is ready
$(function(){
       
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } 
    else {
        currPos.innerHTML = "Geolocation is not supported by this browser.";
        window.location.href = "register_track.htm";
    }
    

});
