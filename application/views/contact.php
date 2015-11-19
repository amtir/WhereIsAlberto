<!-- 
    Contact page, where users can leave a message.
-->


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Contact WhereIsAlberto</title>

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
                <li><a href="<?php echo base_url("index.php/albertos/view/registerTrack"); ?>">Register/Track</a></li>
                <!--li><a href="welcome_page">Blog</a></li-->
                <li class="active"><a href="<?php echo base_url("index.php/albertos/view/contact"); ?>">Contact</a></li>
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
                    <h3>WhereIsAlberto?<span class="text-muted">&raquo; Contact Us</span></h3><hr>
                    <p class="lead">Please find bellow our contact details. Do not hesitate to contact us if have any question, enquiry or suggestion for the WhereIsAlberto? Web-App, we need to hear from you:.</p>
                </div>
            </div>
        </div>            
    </div>
    <!-- End of intro-bloc -->
      

      
    
        <div class="container tpad">
            <!--div class="row">

                <div class="map">
                <iframe width="100%" height="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Pfingstweidstrasse%20102%208005%20Z%C3%BCrich%20Switzerland&key=AIzaSyD4-cWq4uiUB2cj2kKeUjSvh_TXdtrhzqM"></iframe>      
                    </div>
                </div-->
                <div class="row">
                    <div class="col-sm-8">
                        <h3>Get in touch</h3><hr>
                        <form class="form-horizontal  role=form">
                            <div class="form-group tpad">
                                <label for="email" class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group tpad">
                                <label for="message" class="col-lg-2 control-label">Message</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" id="message" rows="6" placeholder="Message..."></textarea>
                                </div>
                            </div>
                            <div class="form-group tpad">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Send</a>
                                </div>
                            </div><br>
                        </form>
                    </div>
                    <div class="modal fade myModalWin" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModallabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h3 class="modal-title">Thank you for submitting</h3>
                                </div>
                                <div class="modal-body">
                                    <p>We appreciate you getting in touch. Please be patient, we will contact you shortly with a reply.</p>
                                    <p>The WhereIsAlberto Team</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="welcome_page" class="btn btn-default btn-lg">OK</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        
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
  </body>
</html>
