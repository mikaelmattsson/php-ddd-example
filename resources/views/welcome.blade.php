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

        .posts {
            margin: 0 auto;
            padding: 30px;
        }

        .posts article {
            text-align: left;
            padding: 15px;
            border: 1px solid #bbb;
            margin-bottom: 15px;
        }
    </style>


</head>
<body>
<div class="container" ng-app="app" ng-controller="AppController as ctrl">
    <div class="content">
        <div class="title">DDD Blog</div>
        <form action="/post" method="post" ng-submit="newPost()">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" ng-model="token">
            <input type="text" name="text" ng-model="text">
            <input type="submit">
        </form>

        <div class="posts">
            <article ng-repeat="post in ctrl.posts">
                <p ng-bind="post.text"></p>
            </article>
        </div>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-resource.min.js"></script>
<script>
    var app = angular.module('app', ['ngResource']);

    app.controller('AppController', AppController);

    function AppController($resource) {
        var ctrl = this;
        var Post = $resource('/post/:postId', {postId: '@id'});

        ctrl.posts = [];

        Post.query(function (result) {
            ctrl.posts = result;
        });
    }

</script>
</body>
</html>
