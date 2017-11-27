<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Nexus</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/jquery-1.11.3.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.validate.js"></script>
    <script src="/assets/js/jquery-2.1.0.min.js"></script>
    <script src="/assets/js/app.js"></script>
</head>

<body>
<div class="container">
    <header>

        <div class="page-header">
            <h1>Nexus</h1>
            <p><i>odd jobs platform</i></p>
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li><a href="/">Home</a></li>
                            <li><a href="/index/contact">Contact</a></li>
                        </ul>
                        <div class="col-sm-3 col-md-3" style="margin-left: 470px">
                            <form class="navbar-form" role="search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="q">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><i
                                                    class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if(!isLoggedIn()): ?>
                            <li><a href="/index/register"><span class="glyphicon glyphicon-user"></span>
                                    Register</a></li>
                            <li><a href="/index/login"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                            </li>
                            <?php else: ?>
                                <li><a href="/user/myaccount">My Account</a></li>
                                <li><a href="/user/logout"><span class="glyphicon glyphicon-log-out"></span>
                                        Logout</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>