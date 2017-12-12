<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Banking</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
     <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/style.css" rel="stylesheet">

  </head>
  <body>
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <nav class="navbar navbar-inverse navbar-fixed-top ">
         <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    Online Banking System</a>
            </div>
            <div>
              <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Personal Banking
                      <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Saving Account</a></li>
                        <li><a href="#">Fixed Account</a></li>
                      </ul>
                </li>
                <li><a target="_blank" href="faq.php">FAQS</a></li>
                <li><a href="login.php">LogIn</a></li>
              </ul>
            </div>
        </div>
    </nav>
    <br/><br/>
     <div class="container">
         <h1 class="text-center text-info">Welcome To Our Online Banking System </h1>
         <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
        <img src="picture/master.jpg" alt="Chania">
      <div class="carousel-caption">
        <h3>Master Card</h3>
        <p>Make your travelling easy.</p>
      </div>
    </div>

    <div class="item">
        <img src="picture/foreign.jpg" alt="Chania">
      <div class="carousel-caption">
        <h3>Foreign Currency</h3>
        <p>We provide many kinds of foreign currency.</p>
      </div>
    </div>

    <div class="item">
        <img src="picture/visa.jpg" alt="Flower">
      <div class="carousel-caption">
        <h3>VISA CARD</h3>
        <p>Make purchase globally at any time .</p>
      </div>
    </div>

    <div class="item">
        <img src="picture/gold.jpg" alt="Flower">
      <div class="carousel-caption">
        <h3>Secure</h3>
        <p>Yeah,your money is secure with a regular interest.</p>
      </div>
    </div>
  </div> <!---Emd of Carousel--->

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
     </div>
    <br/>
 <footer class="footer2">
            <div class="container" style="padding-top: 15px;"> 
                <center><h4><span class="label label-success white">© All Rights Reserved | Design by&nbsp; SOETHUHEIN</span></h4></center>
            </div>
        </footer>   
 
  </body>
  
</html>