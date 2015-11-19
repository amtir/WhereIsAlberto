
 


/* Form validation -----------------------------------------------------------

Should HTML5 fails? 
I have implemented a simple validation javascript form to offer to our users a better experience. This client side form validation should in any case replace the server-side check validation. 

------------------------------------------------------------------*/
    var formRegist ;
    // form submit validation  Reg-Expressions
    var regEmail=new RegExp("[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$");
    var regSN = new RegExp("([A-Za-z]|[0-9]){10}");
    var reg_SN = new RegExp("([A-Za-z0-9])"); ///^[a-z0-9]+$/i
    var reg_sn = new RegExp("([a-z])");

    var reg = new RegExp("([a-zA-Z]){3,}");
    var reg2 = new RegExp("([A-Z-a-z ,]|[0-9]){3,}");

    var gps_lat;
    var gps_long;

    var urlRest = "http://maps.googleapis.com/maps/api/geocode/json?address=";
    var xmlhttp = new XMLHttpRequest();

    // Banknote/Bill contructor
    function banknote(rank, firstName, lastName, location, date, email, gpsLat, gpsLong, sn  ){
        
        this.rank=rank;
        this.firstName = firstName || "unknown";
        this.lastName = lastName || "unknown";
        this.location= location || "unknown";
        this.date=date || "unknown";
        this.email=email || "unknown";
        this.gpsLat = gpsLat;
        this.gpsLong = gpsLong;
        this.serialNumber = sn || "unknown";
    
    }



// Run when the DOM is ready
$(function(){
    
    formRegist = { // traverse the DOM tree and fetch some node elements

            register: document.getElementById("btnRegister"),
            email: document.getElementById("email"),
            messEmail: document.getElementById("messEmail"),
            serialNumber: document.getElementById("SerialNumber"),
            messSN: document.getElementById("messSN"),
            firstName: document.getElementById("firstName"),
            messFN: document.getElementById("messFN"),
            lastName: document.getElementById("lastName"),
            messLN: document.getElementById("messLN"),
            location: document.getElementById("location"),
            messLoc: document.getElementById("messLoc"),
            tt: document.getElementById("textInfo"),
            fw: document.getElementById("followPage")
    }

    // Form validation: registering click event to the handler function
    formRegist.register.addEventListener("click", CheckForm);
           
                // Ask for the geolocation
                if (navigator.geolocation) { 
                    navigator.geolocation.getCurrentPosition(sendPosition, showError);
                    console.log("End shared geolocation gps api request");
                } 
                

    
    
      function sendPosition(position) {         
                                    gps_lat= position.coords.latitude;
                                    gps_long= position.coords.longitude;
                                    console.log( position.coords.latitude);
                                    console.log( position.coords.longitude);
                                    document.getElementById("gps_lat").value = gps_lat;
                                    document.getElementById("gps_long").value = gps_long;
                                    console.log( document.getElementById("gps_lat").value);
                                    console.log( document.getElementById("gps_long").value);
            }
    
    
    function showError(error) {
            x=formRegist.register;
            formRegist.register.style.color = "red";
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation.";
             e.preventDefault();
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable.";
             e.preventDefault();
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out.";
             e.preventDefault();
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred.";
             e.preventDefault();
            break;
    }
}
    
    
    
    
    function CheckForm(e){
        
        formRegist.email.value=formRegist.email.value.trim();
        formRegist.serialNumber.value=formRegist.serialNumber.value.trim();
        formRegist.firstName.value= formRegist.firstName.value.trim();
        formRegist.lastName.value=formRegist.lastName.value.trim();
        formRegist.location.value=formRegist.location.value.trim();
        
        
        var msg = "";
        if (!regEmail.test(formRegist.email.value)){
            //Please enter your email address in the format someone@example.com.
            formRegist.messEmail.innerHTML="Please enter your email address in the format someone@example.com.";
            formRegist.messEmail.style.color = "red"
            e.preventDefault();
            msg +="\nyour email address";
        }else{
            formRegist.messEmail.innerHTML="Email OK.";
            formRegist.messEmail.style.color = "green"
        }
        
        if (!regSN.test(formRegist.serialNumber.value)){
            msg +="\nyour Serial Number";
            formRegist.messSN.innerHTML="Please enter your Serial Number (10 letters & digits) 00K5911063.";
            formRegist.messSN.style.color = "red"
            e.preventDefault();
        }else{
            formRegist.messSN.innerHTML="Serial Number OK.";
            formRegist.messSN.style.color = "green"
        }
        
        if (!reg.test(formRegist.firstName.value)){
            msg +="\nyour first name";
            formRegist.messFN.innerHTML="Please enter your first name, at least 3 characters such as Sam or Tom.";
            formRegist.messFN.style.color = "red"
            e.preventDefault();
        }else{
            formRegist.messFN.innerHTML="First Name OK.";
            formRegist.messFN.style.color = "green"
        }
        
        if (!reg.test(formRegist.lastName.value)){
            msg +="\nyour last name";
            formRegist.messLN.innerHTML="Please enter your last name, at least 3 characters such as Lee or Law.";
            formRegist.messLN.style.color = "red"
            e.preventDefault();
        }else{
            formRegist.messLN.innerHTML="Last Name OK.";
            formRegist.messLN.style.color = "green"
        }
        
        
        
        
        if (!reg2.test(formRegist.location.value)){
            msg +="\nyour location";
             formRegist.messLoc.innerHTML="Please enter your address (postcode, city and country).";
            formRegist.messLoc.style.color = "red"
            e.preventDefault();
        }else{
            
                    //console.log("decoding address via google geolocation api web-service ");
                    urlRest = "http://maps.googleapis.com/maps/api/geocode/json?address=";
                    urlRest=urlRest+document.getElementById("location").value;
                    //console.log(urlRest);
                    //We send a request to the server, we use the open() and send() methods of the XMLHttpRequest object:
                    xmlhttp.open("GET", urlRest, false);  //using async=true asynchronous requests
                    xmlhttp.send(); // 	send(string), string: Only used for POST requests
            
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
                        //The JavaScript function JSON.parse(text) is used to convert a JSON text into a JavaScript object:
                        var objJSON = JSON.parse(xmlhttp.responseText);
                            if(objJSON.status == "OK"){   // we check that indeed the address location exists
                                formRegist.messLoc.innerHTML="Location OK.";
                                formRegist.messLoc.style.color = "green"
                                
                            }
                            else{
                                formRegist.messLoc.innerHTML="Please enter your address (postcode city country) For example: 1211 Geneva Switzerland";
                                formRegist.messLoc.style.color = "red"
                                e.preventDefault();
                            }
                    }
                    else  {
                            formRegist.messLoc.innerHTML="Please enter your address (postcode city country) For example: 1211 Geneva Switzerland";
                            formRegist.messLoc.style.color = "red"
                            e.preventDefault();
                    }
            
            
        }
        
        if(msg !==""){
            e.preventDefault();
        }
        else{
               
            if (navigator.geolocation) { // the check sould be done in amout, before to reach this code and write into the db if necessary
                    //navigator.geolocation.getCurrentPosition(sendPosition, showError);
                if ((typeof gps_lat != 'undefined')||(typeof gps_long != 'undefined')) {
                     // alert("[OK] The form is valid.\n\[OK] Geolocation shared.\n\nSubmitting...");
                }else{
                    // if the gps localisation doesn't work properly through geolocation, then we try to decode the address via a web-service request.
                   if ((typeof gps_lat == 'undefined')||(typeof gps_long == 'undefined')) {
                    //console.log("decoding address via google geolocation api web-service ");
                    urlRest = "http://maps.googleapis.com/maps/api/geocode/json?address=";
                    urlRest=urlRest+document.getElementById("location").value;
                    //console.log(urlRest);

                    //We send a request to the server, we use the open() and send() methods of the XMLHttpRequest object:
                    xmlhttp.open("GET", urlRest, false);  //using async=true asynchronous requests
                    xmlhttp.send(); // 	send(string), string: Only used for POST requests
                    
                     if (xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
                        //The JavaScript function JSON.parse(text) is used to convert a JSON text into a JavaScript object:
                        var objJSON = JSON.parse(xmlhttp.responseText);
                            if(objJSON.status == "OK"){
                                gps_lat= (objJSON.results[0]).geometry.location.lat;
                                gps_long= (objJSON.results[0]).geometry.location.lng; 
                                //console.log( gps_lat);
                                //console.log( gps_long);
                                document.getElementById("gps_lat").value = gps_lat;
                                document.getElementById("gps_long").value = gps_long;
                            }
                            else{ // redundant code
                                //console.log("ZERO_RESULTS");
                               // alert("[OK] The form is valid.\n\[XX] Please share your Geolocation or enter a valid address \nThen submit" );
                                formRegist.messLoc.innerHTML="Please enter your address (postcode city country) For example: 1211 Geneva Switzerland";
                                formRegist.messLoc.style.color = "red"
                                e.preventDefault();
                            }
                    }
                    else  { // redundant code
                            //console.log("REQUEST_RESULT: " + xmlhttp.status);
                            //alert("[OK] The form is valid.\n\[XX] Please share your Geolocation or enter a valid address \nThen submit" );
                            formRegist.messLoc.innerHTML="Please enter your address (postcode city country) For example: 1211 Geneva Switzerland";
                            formRegist.messLoc.style.color = "red"
                            e.preventDefault();
                    }
                    
                }
                     

                }
                
                //console.log("End gps request");
                } 

        }
    }
    
   


    

});



// End of the form validation ----------------------------------------------