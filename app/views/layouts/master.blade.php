<html>
<head>
    <title>Note To Myself - @yield('nameOfPage')</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <style>
        img{
            width:200px;
            height:200px;
        }
    </style>

</head>
<body>
@yield('title')

<div class="container">
    @yield('content')
</div>
</body>
</html>


