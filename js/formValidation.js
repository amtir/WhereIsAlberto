


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
    var reg2 = new RegExp("([A-Z-a-z]|[0-9]){3,}");

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

//--------------------------------------------------------------------
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



//-----------------------------------------------------------


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

    // form submit validation (click event)
    formRegist.register.addEventListener("click", CheckForm);
           
    
    function CheckForm(e){
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
             formRegist.messLoc.innerHTML="Please enter your location, at least 3 characters or digits.";
            formRegist.messLoc.style.color = "red"
            e.preventDefault();
        }else{
            formRegist.messLoc.innerHTML="Location OK.";
            formRegist.messLoc.style.color = "green"
        }
        
        if(msg !=""){
         
            e.preventDefault();             
        }
        else{
            msg += "Form is valid!\nSubmitting...";
            msg+= "<p>Please accept to share your Geo-location. We will update our information about this banknote/bill and will present to you with a table/map containing the information you are seeking.</p>";
           // alert("Form is valid!\nSubmitting...\nPlease share your Geolocation.");
         
                 store.set("fname", formRegist.firstName.value );
                 store.set("lname", formRegist.lastName.value);
                 store.set("sn",formRegist.serialNumber.value);
                 store.set("email",formRegist.email.value);
                 store.set("location",formRegist.location.value);
                 
        }
    }
    
 

});



// End of the form validation ----------------------------------------------