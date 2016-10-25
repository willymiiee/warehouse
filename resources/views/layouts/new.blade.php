<!DOCTYPE html>
<html>
    <head>
        <title>Warehouse System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- jQuery UI -->
        <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

        <!-- Bootstrap -->
        <link href="{{ url('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- styles -->
        <link href="{{ url('css/styles.css') }}" rel="stylesheet">

        <link href="{{ url('css/sweetalert.css') }}" rel="stylesheet">

        @yield('css')
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <!-- Logo -->
                        <div class="logo">
                            <h1><a href="{{ url('/home') }}">Warehouse System</a></h1>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-lg-12">
                            <!--
                                <div class="input-group form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">Search</button>
                                    </span>
                                </div>
                            -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="navbar navbar-inverse" role="banner">
                            <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
                                <ul class="dropdown-menu animated fadeInUp">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                                </li>
                            </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-md-2">
                    <div class="sidebar content-box" style="display: block;">
                        <ul class="nav">
                            <!-- Main menu -->
                            <li><a href="{{ url('/home') }}"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                            <li><a href="{{ url('/request-form') }}"><i class="glyphicon glyphicon-tasks"></i> Form Request</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-10">

                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">
                                @yield('title')
                            </div>
                        </div>
                        <div class="panel-body">
                            @yield('content')
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <footer>
            <div class="container">

                <!--
                <div class="copy text-center">
                    Copyright 2014 <a href='#'>Website</a>
                </div>
                -->

            </div>
        </footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <!-- jQuery UI -->
        <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>

        @yield('javascript')

        <script src="{{ url('js/custom.js') }}"></script>

        <script src="{{ url('js/sweetalert.min.js') }}"></script>
    </body>
</html>