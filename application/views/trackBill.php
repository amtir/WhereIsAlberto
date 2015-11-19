<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Trace/Track WhereIsAlberto</title>
   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
      <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
      <script src="<?php echo base_url("assets/js/albertoScript.js"); ?>" ></script>
    
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
                    <h3>WhereIsAlberto?<span class="text-muted">&raquo; Tracking</span></h3><hr>
                    <p class="lead">Tracing back the locations and owners of your bill/banknote.</p>
                </div>
            </div>
        </div>            
    </div>
    <!-- End of intro-bloc -->
      
    <!--div class="page-content"-->   
        <div class="container">
                <div class="row">

                    <div class="col-sm-6" id="trackTable">                    
      
                        <h2>Previous locations and owners</h2>

                        <?php echo '<p>WhereIsAlberto Serial Number ' . $traces[0]->serial_number .':</p>'; ?>

                        <table class="table table-condensed table-hover">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Location</th>
                                <th>Email</th>
                              </tr>
                            </thead>
                            <tbody>
                                
                             <?php 

                                foreach ($traces as $row) {
                                         echo '<tr>'.
                                        '<td>'. $row->trace_date .'</td>'.
                                        '<td>'. $row->first_name.'</td>'.
                                        '<td>'. $row->last_name .'</td>'.
                                        '<td>'. $row->location .'</td>'.
                                         '<td>'. $row->email .'</td>'.
                                        '</tr>';
                                }

                            ?>
                                                                  
                            </tbody>
                            
                        </table>
                                           
                    </div>
                    
                    <div class="col-sm-6">
                        <!--p id="demo">Click the button to get your position.</p>
                        <button onclick="getLocation()">Try It</button-->
                        <p id="coordinates"></p>
                        <div id="map_canvas"></div>
                        
                        <script>
                                function showPosition() {
                          
                         <?php 
                                foreach ($traces as $row) {
                                    echo 'loc = new google.maps.LatLng('. $row->gps_lat.','.$row->gps_long.');';
                                    echo 'bounds.extend(loc);';
                                    echo 'addMarker(loc, "'. $row->trace_date .' ' . $row->first_name.' '.$row->last_name.', '. $row->location.'", "active");';
                                    echo '  map.fitBounds(bounds);';
                                    echo ' map.panToBounds(bounds); ';     
                                }
                        ?>
                                }
                        </script>
                        
                       
                    </div>
                    

                </div>  
        </div>
    <!--/div-->
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
