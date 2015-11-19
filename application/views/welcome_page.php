<!-- 

Welcome page, explaining the purpose/aim of this website.

I used HTML5, CSS, and JavaScript libraries such as BootStrap and JQuery offering a better compatibility between browsers and a better responsiveness across different size devices. (smartphone, tablet, PC)

Some of the libraries are available on-line using the CDN Content Delivery Networks. 

Therefore, to take advantage of this web-app and have a better users' experience, you should use a recent browser with an internet connection. 15/06/2105


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
    <title>Welcome WhereIsAlberto page</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">
      
    <link href="<?php echo base_url("assets/css/alberto.css"); ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->




    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      //"photo":"http://whereisalberto.com/assets/images/Alberto.png",
      "logo":"http://whereisalberto.com/assets/images/Alberto.png",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Lausanne",
        "addressRegion": "CH",
        "postalCode": "1007",
        "streetAddress": "Banks Street"
      },
      "name": "Where is Alberto",
      "description":"WhereIsAlberto is a web-application designed to trace the previous and next locations and owners of your special banknotes, stamped and registered.",
      "telephone": "(0041) 00 000 000",
      "url": "http://whereisalberto.com/"
    }
    </script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68241103-2', 'auto');
  ga('send', 'pageview');

</script>

  </head>
    
  <body>
      
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68241103-2', 'auto');
  ga('send', 'pageview');

</script>

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
                <li class="active"><a href="<?php echo base_url("index.php/albertos/view/welcome_page"); ?>">Home</a></li>                
                <li><a href="<?php echo base_url("index.php/albertos/view/registerTrack"); ?>">Register/Track</a></li>
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
                    <h3>WhereIsAlberto?<span class="text-muted">&raquo; Banknotes' Tracking</span></h3><hr>
                    <p class="lead">WhereIsAlberto? is a web-application designed to trace the previous and next locations and owners of your special banknotes, stamped and registered. We regularly offer various gifts to thank you.</p>
        
                </div>
            </div>
        </div>            
    </div>          
   
    <!-- End of intro-bloc -->
    
    <div class="container">
        <div class="row">
             <h3>To get started tracking your bills, please click bellow</h3>
        </div>
       
           
        <div class="row">

            <div class="col-xs-12">
             <p class="lead">By entering the details of your banknote, you will get back a list of all the owners, cities, and countries where your banknote has been recorded.</p>
            </div>
   </div>
         
 <div class="row">
             <div class="col-xs-12">
            <p class="lead">You can start and enter your own banknote to track! You will be notified when your banknote are found next.</p>

            <br><p> 
                <a class="btn btn-large btn-primary" href="<?php echo base_url("index.php/albertos/view/registerTrack"); ?>">Register/Track your banknote now!</a>

            </p>   <br><br>

            </div>
        </div> 
           
        </div>  
    </div>
    <!-- End Page Content -->
      
    

<!------------------inserting microData----------------------->
 <!------------------inserting microData----------------------->
 
    <div class="ftr" itemscope itemtype="http://schema.org/Organization">
        <div class="container">
            <div class="row">
                <footer><br>
                    <div class="pull-left ft_space">
                        
			<address>
      <h3><span itemprop="name">WhereIsAlberto</span></h3>
      	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<span itemprop="streetAddress">Banks Street<br></span>
          	<span itemprop="postalCode">1007 </span>
          	<span itemprop="addressLocality">Lausanne, Switzerland<br></span>
	</div>
                            <a href="mailto: info@whereisalberto.com">
					<span itemprop="email">info@whereisalberto.com</span>    </a><br>
                            <abbr title="Phone">P:</abbr>
					<span itemprop="telephone">+41 21 000 00 00</span>
                        </address>
                    </div>
                    <div class="pull-right ft_space">
                        <img  class="img img-responsive tpad" itemprop="logo" src="<?php echo base_url("assets/images/eyesLook.png"); ?>">
                        <p>
                        <span itemprop="url" >www.whereisalberto.com</span>
                        <br>&copy; WhereIsAlberto 2015</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>
<!---------------------------------------->
<!---------------------------------------->
</div>
       
      
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>
  </body>
</html>
