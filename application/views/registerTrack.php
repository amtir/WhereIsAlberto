<!--
    Registration / Track/Trace page

# 25/-6/2015
The PHP server back side php script has been added using the codeigniter free, lightweight, M-V-C framework.
By this means we generate custom dynamic pages and adds another more secure layer on the server side prior to insert/save or retrieve data from the MySQL database server. 

# 27/06/2015
With some operating systems/devices, the geo-location is disabled and we won't be able to get the gps coordinates.
Therefore, I added a request to decode users' addresses via google geolocation api web-service and get back the gps address.

-->


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Register/Trace WhereIsAlberto</title>
      
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
    <script src="<?php echo base_url("assets/js/formValidation.js"); ?>" ></script>
    

    <!-- Bootstrap -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">
      
    <link href="<?php echo base_url("assets/css/alberto.css"); ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


  </head>
    
  <body>
      
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span> <!-- sr-only available to screen reader only -->
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>  
              <a class="navbar-brand" href="<?php echo base_url("index.php/albertos/view/welcome_page"); ?>">WhereIsAlberto</a>
        </div>
        
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url("index.php/albertos/view/welcome_page"); ?>">Home</a></li>                
                <li class="active"><a href="<?php echo base_url("index.php/albertos/view/registerTrack"); ?>">Register/Track</a></li>
                <!--li><a href="welcome_page">Blog</a></li-->
                <li><a href="<?php echo base_url("index.php/albertos/view/contact"); ?>">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Social<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://www.facebook.com">Facebook</a></li>
                        <li><a href="http://www.twitter.com">Twitter</a></li>
                        <li><a href="http://plus.google.com">Google+</a></li>
                        <li><a href="http://www.linkedin.com">LinkedIn</a></li>
                    </ul>
                </li>
            </ul>  
        </div>          
      </nav>
      <!-- End Navigation -->
      
    <div class="intro-block">     
        <div class="container">
            <div class="row"> 
                <div class="col-xs-3">
                    <img class="img-circle img-responsive " src="<?php echo base_url("assets/images/Alberto.png"); ?>">
                </div>
                <div class="col-xs-9">
                    <h3>WhereIsAlberto?<span class="text-muted">&raquo; Register/Track</span></h3><hr>
                    <p class="lead">You found a WhereIsAlberto banknote, and want to see where it has been?</p>
                </div>
            </div>
        </div>            
    </div>
    <!-- End of intro-bloc -->
      
    <!--div class="page-content"-->   
        <div class="container">
                <div class="row">
                    <h3>To see where your banknote has been, please start below:</h3><hr>
                    <!--div class="col-xs-3"></div-->
                    <div class="col-xs-8 col-xs-offset-2">
                    <img class="img img-responsive tpad" src="<?php echo base_url("assets/images/Switzerland_100_CHF_revReduct4.png"); ?>">
                    </div>
                    
                </div>  
            
             <!-- form errors from the server (php codeigniter server script) -->   
            <div style="background:red;color:white;font-weight:bold">
                <?php 
                    if(isset($errors)){ 
                        echo $errors;
                     }
                    if(isset($snerrors)){ 
                        echo $snerrors;
                    }     
                ?>
            </div>
              
            <!-- Form -->
                <form class="form-horizontal  role=form" action="<?php echo base_url("index.php/albertos/view/formctrl"); ?>" method="post">
                 
                <div class="row">                
                  
                    <div class="col-xs-8 col-xs-offset-2">
                       

                            <div class="form-group tpad">
                                <label for="SerialNumber" class="col-sm-2 control-label">Serial Number</label>
                                <div class="col-sm-10">
                                    <input type="text" maxlength="10" required pattern="([A-Za-z]|[0-9]){10}" class="form-control" name='serialnumber' id="SerialNumber" placeholder="Serial Number (10 letters & digits)..." style="text-transform:uppercase"   value='<?php if(isset($sn)){ echo $sn;}?>'  >
                                    <span id="messSN"></span> 
                                </div>
                            </div>
                        </div>
                    </div>
                            
                <div class="row">                  
                    <div class="col-xs-8 col-xs-offset-2">
                            <div class="form-group tpad">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name='email' placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value='<?php if(isset($email)){ echo $email;}?>'  >
                                    <span id="messEmail"></span>
                                </div>
                            </div>
                       </div>
                    </div>
                   
                <div class="row">                  
                    <div class="col-xs-8 col-xs-offset-2">
                            <div class="form-group tpad">
                                <label for="firstName" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                     <input type="text" maxlength="15" class="form-control" id="firstName" name='firstname' placeholder="Please enter your first name..."  required pattern="[A-Z-a-z]{3,}"  value='<?php if(isset($firstname)){ echo $firstname;}?>'  >
                                    <span id="messFN"></span> 
                                </div>
                            </div>
                       </div>
                    </div>
                            
                <div class="row">                  
                    <div class="col-xs-8 col-xs-offset-2">
                            <div class="form-group tpad">
                                <label for="lastName" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                     <input type="text" maxlength="15"  class="form-control" id="lastName" name='lastname' placeholder="Please enter your last name..." required pattern="[A-Z-a-z]{3,}" value='<?php if(isset($lastname)){ echo $lastname;}?>'   >
                                    <span id="messLN"></span> 
                                </div>
                            </div>
                       </div>
                    </div>
                         
                <div class="row">                  
                    <div class="col-xs-8 col-xs-offset-2">
                            <div class="form-group tpad">
                                <label for="location" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                     <input type="text" maxlength="58"  class="form-control" id="location" name='location' placeholder="Postcode City, Country..." required pattern="[0-9A-Z-a-z ,]{3,}" value='<?php if(isset($location)){ echo $location;}?>' >
                                    <span id="messLoc"></span> 
                                     <input type="hidden" name="gps_lat" id="gps_lat" value="">
                                     <input type="hidden" name="gps_long" id="gps_long" value="">
                                </div>
                            </div>
                       </div>
                    </div>
                            
                <!--div class="row">                  
                    <div class="col-xs-8 col-xs-offset-2">
                            <div class="form-group tpad">
                                <label for="optOwner" class="col-sm-2 control-label">Are you the owner of this bill?</label>
                                <div id="optOwner" class="col-sm-10">  
                                    <div class="col-xs-2">
                                    <label><input type="radio" name="owner" id="ownerYes" class="form-control" value="YES" checked>YES</label>
                                        </div>
                                    <div class="col-xs-2">
                                    <label><input type="radio" name="owner" id="ownerNo" class="form-control" value="NO">NO</label>
                                        </div>
                                </div>
                            </div>
                       </div>
                    </div-->
                            
                <div class="row">                  
                    <div class="col-xs-8 col-xs-offset-2">
                            <div class="form-group tpad">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <!-- <a id="btnRegister" href="trackBill" class="btn btn-success btn-lg">Continue >>></a> -->
                                    <input id="btnRegister" type="submit" name="submit" value="Continue >>>" class="btn btn-primary">
                                </div>
                            </div><br>
                          </div>
                    </div>
                         <!--?php echo form_close(); ?-->
                         </form> 
            
                    </div>
      
                    <div class="modal fade myModalWin" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModallabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title">Thank you for your help!</h3>
                                </div>
                                <div class="modal-body">
                                    <p>The Form is valid! Submitting...</p>
                                    <p>If you are a new user, your details will be registered for our mailing-list about this banknote.</p>
                                    <p>Please share your Geo-location. We will update our information about this banknote and will present you a table and a map containing the information you are seeking.</p>
                                    <p>The WhereIsAlberto Team</p>
                                </div>
                                <div class="modal-footer">
                                    <div id="followPage">
                                        <a href='#' class='btn btn-success btn-sm'>OK</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               

    <!-- End Page Content -->
      
    <div class="ftr">
        <div class="container">
            <div class="row">
                <footer>
                    <div class="pull-left ft_space">
                        <address>
                            <h3>WhereIsAlberto</h3>     
                            Switzerland<br>
                            <a href="mailto: info@whereisalberto.com">info@whereisalberto.com</a><br>
                        </address>
                    </div>
                    <div class="pull-right ft_space">
                        <img class="img img-responsive tpad" src="<?php echo base_url("assets/images/eyesLook.png"); ?>">
                        <p>&copy; WhereIsAlberto 2015</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>
       
      
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
    <script>
         
      
      </script>
  </body>
</html>
