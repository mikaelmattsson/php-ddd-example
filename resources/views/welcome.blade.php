<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300" rel="stylesheet" type="text/css">

    <style>
        html, body {
            margin: 0;
            padding: 0;
        }

        body {
            font-weight: 300;
            font-family: 'Lato', sans-serif;
            font-size: 18px;
        }

        .container {
            text-align: center;

        }

        .content {
            margin-top: 200px;
        }

        .title {
            font-size: 56px;
            font-weight: 100;
            margin-bottom: 20px;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>

</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">DDD Blog</div>
        <form action="/post" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="text">
            <input type="submit">
        </form>
    </div>
</div>
</body>
</html>
