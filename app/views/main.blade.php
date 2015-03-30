<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('/css/shop-homepage.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.scripts IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.scripts doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.scripts"></script>
        <script src="https://oss.maxcdn.com/libs/respond.scripts/1.4.2/respond.min.scripts"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    @include('navigation')

    <!-- Login -->
    @if($page == 'login')
   <div class="login">
   	<h1>Login</h1>
       <form method="post">
       	<input type="text" name="u" placeholder="Username" required="required" />
           <input type="password" name="p" placeholder="Password" required="required" />
           <button type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
       </form>
   </div>
    @endif
    <!-- Home content -->
    @if($page == 'home')
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Shop Name</p>
                <div class="list-group">
                    <a href="#" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>
            </div>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="{{asset('/img/MOTOX.jpg')}}" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">     
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>

                <h3>Voorgestelde producten</h3>
                <hr>

                <div class="row">
                @foreach ($products as $product)
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="{{asset( '/img/back.png')}}" height="180" alt="">
                        <div class="caption">
                            <h4 class="pull-right">${{$product->prijs}}</h4>
                            <h4><a href="#">{{$product->titel}}</a>
                            </h4>
                            <p>{{$product->beschrijving}}</p>
                        </div>
                        <div class="ratings">
                            <p class="pull-right">15 reviews</p>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->
    @endif
    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Kaspar's Webshop 2015</p>
                </div>
            </div>
        </footer>



    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="{{asset('/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
     <script src="{{ asset('/js/bootstrap.min.js')}}"></script>

     <!-- Javascript app-->
     <script src="{{ asset('/js/app.js')}}"></script>

      <!-- Javascript Lightbox-->
      <script src="{{ asset('/js/jquery.lightbox_me.js')}}"></script>





</body>

</html>
