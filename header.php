<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: "Roboto", sans-serif;
        }

        :root {
            --main-color: #088178;
            --text-color: #333333;
            --bg-color: #25292d;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: #373b3e;
        }

        a {
            text-decoration: none;
        }

        .container {
            margin-left: auto;
            margin-right: auto;
            padding-left: 50px;
            padding-right: 50px;
        }

        /*small*/
        @media (min-width:768px) {
            .container {
                width: 750px;
            }

        }

        @media (min-width:992px) {
            .container {
                width: 970px;
            }
        }

        @media (min-width:1200px) {
            .container {
                width: 90%;
            }
        }

        .header {
            margin-top: 20px;
        }

        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: var(--bg-color);
            border-radius: 30px;
        }

        .header .container .logo {
            font-size: 35px;
            color: white;
            text-decoration: none;
        }

        .header .container .logo span {
            color: white;
        }

        .header .container ul {
            display: flex;
            list-style: none;
        }

        .header .container ul li {
            padding: 0 20px;
        }

        .header .container ul li a {
            color: white;
            font-size: 20px;
            text-decoration: none;
            transition: .5s;

        }

        .header .container ul li a:hover {
            color: #d9d9d9;
            text-decoration: underline;

        }

        /*End Header*/
    </style>
</head>

<body>

    <div class="header">
        <div class="container">
            <a href="" class="logo"><span>Student System</span></a>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php
                if (empty($_COOKIE['user'])) { ?>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php
                } else { ?>
                    <li><a href="create.php">Add Student</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php  }
                ?>
            </ul>
        </div>
    </div>
</body>

</html>