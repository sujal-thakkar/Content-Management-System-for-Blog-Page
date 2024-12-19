<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .nav a {
            overflow: hidden;
            position: relative;
            display: inline-block;
        }

        .nav a::before,
        .nav a::after {
            content: '';
            position: absolute;
            width: 100%;
            left: 0;
        }

        .nav a::before {
            background-color: #54b3d6;
            height: 2px;
            bottom: 0;
            transform-origin: 100% 50%;
            transform: scaleX(0);
            transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
        }

        .nav a::after {
            content: attr(data-replace);
            height: 100%;
            top: 0;
            transform-origin: 100% 50%;
            transform: translate3d(200%, 0, 0);
            transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
            color: #54b3d6;
        }

        .nav a:hover::before {
            transform-origin: 0% 50%;
            transform: scaleX(1);
        }

        .nav a:hover::after {
            transform: translate3d(0, 0, 0);
        }

        .nav a span {
            display: inline-block;
            transition: transform .3s cubic-bezier(0.76, 0, 0.24, 1);
        }

        .nav a:hover span {
            transform: translate3d(-200%, 0, 0);
        }

        .nav a {
            text-decoration: none;
            color: #fff;
            font-weight: 700;
            vertical-align: top;
        }

        /* logout button style */

        .button-92 {
            --c: #fff;
            /* text color */
            background: linear-gradient(90deg, #0000 33%, #fff5, #0000 67%) var(--_p, 100%)/300% no-repeat,
                #004dff;
            /* background color */
            color: #0000;
            border: none;
            transform: perspective(500px) rotateY(calc(20deg*var(--_i, -1)));
            text-shadow: calc(var(--_i, -1)* 0.08em) -.01em 0 var(--c),
                calc(var(--_i, -1)*-0.08em) .01em 2px #0004;
            outline-offset: .1em;
            transition: 0.3s;
            text-decoration: none;
        }

        .button-92:hover,
        .button-92:focus-visible {
            --_p: 0%;
            --_i: 1;
        }

        .button-92:active {
            text-shadow: none;
            color: var(--c);
            box-shadow: inset 0 0 9e9q #0005;
            transition: 0s;
        }

        .button-92 {
            font-weight: bold;
            font-size: 2rem;
            margin: 0;
            cursor: pointer;
            padding: .1em .3em;
        }

        /* Dashboard logo hover style */

        .logo a {
            position: relative;
        }

        .logo a::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 4px;
            border-radius: 4px;
            background-color: #18272F;
            bottom: 0;
            left: 0;
            transform-origin: right;
            transform: scaleX(0);
            transition: transform .3s ease-in-out;
        }

        .logo a:hover::before {
            transform-origin: left;
            transform: scaleX(1);
        }
    </style>
</head>

<body>
    <div class="dashboard d-flex justify-content-between">
        <div class="sidebar bg-dark vh-100">
            <h1 class="bg-primary p-4 logo"><a href="./index.php" class="text-light text-decoration-none">Dashboard</a></h1>
            <div class="menues p-4 mt-5">
                <div class="menu nav">
                    <a href="create.php" id="style-2" data-replace="Add New Post"><span>Add New Post</span></a>
                </div>
                <div class="menu mt-5 nav">
                    <a href="../index.php" id="style-2" data-replace="Go To Home Page"><span>Go To Home Page</span></a>
                </div>
                <div class="menu mt-5">
                    <a href="logout.php" class="button-92" role="button">Logout</a>
                </div>

            </div>
        </div>