<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

    <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

    <title>@yield('title') | actNow</title>
</head>
<body>
@if(Auth::check())
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ URL::to('dashboard',array(),false) }}">actNow</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ URL::to('logout',array(),false) }}">Logout</a></li>
                    </ul>
                    <div id="status" class="navbar-form navbar-left"></div>
                </div>
        </div>
    </nav>
@endif
<div class="container-fluid" id="all-content">
    <div class="row">
        @if(Auth::check())
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li><a href="/">Petitions</a></li>
                    <li><a href="/subscribers">Subscribers</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Stats</a></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </div>
        @endif
    @yield('content')
    </div>
</div>

<script type="text/javascript">
    var myTextEl = document.getElementById('all-content');
    myTextEl.innerHTML = Autolinker.link(myTextEl.innerHTML);
</script>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>