<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>

    <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

    <title>@yield('title') | actNow</title>
</head>
<body class="lean_body">
<div class="container-fluid" id="all-content">
    <div class="row">
        @yield('content')
    </div>
</div>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>