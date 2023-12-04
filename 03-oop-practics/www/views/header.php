<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= isset($title) ? $title : "Mon site"?></title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/bootstrap/v4.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 5rem;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Title</a>
    <ul class="nav navbar-nav">
        <li class="nav-item active">
            <a href="#" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <a href="#about" class="nav-link">About</a>
        </li>
    </ul>
</nav>

<div class="container">


