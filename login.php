<?php
include("db_connection.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare('SELECT username , password From users WHERE username=? AND password=?');
    $stmt->execute([$username, $password]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        setcookie("user", $username, strtotime("+1 year"));
        header("location:index.php");
        exit();
    } else {
        $error = '<p style="margin-bottom:10px; color:red; font-size:17px; font-weight:bold;">username or password incorrect</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

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


        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 99.6px);
        }

        .center .form {
            width: 500px;
            text-align: center;
            background-color: #626060;
            padding: 25px;
            border-radius: 25px;
        }

        .center .form form {
            width: 100%;
        }

        .center .form form h1 {

            margin-bottom: 15px;
            color: #dee2e6;

        }

        .center .form form .input-box {
            width: 100%;
            height: 50px;
            margin-bottom: 35px;
        }

        .center .form form .input-box input {
            width: 100%;
            height: 100%;
            border: none;
            border: 2px solid var(--text-color);
            border-radius: 25px;
            color: var(--text-color);
            font-size: 15px;
            padding: 20px 40px 20px 20px;
            outline: none;
            background: #a6a0a0;

        }

        .center .form form .input-box input::placeholder {
            color: var(--text-color);
        }

        .center .form form button {
            width: 100%;
            height: 40px;
            background-color: #373b3e;
            color: white;
            outline: none;
            border: none;
            border: 1px solid var(--text-color);
            border-radius: 25px;
            font-size: 17px;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .center .form form .link {
            color: var(--text-color);
            font-size: 15px;
            font-weight: bold;

        }

        .center .form form .link a {
            color: white;
            text-decoration: none;
        }

        .center .form form .link a:hover {
            text-decoration: underline;

        }

        .username-er,
        .email-er,
        .password-er,
        .confirmpassword-er {
            text-align: start;
            margin-left: 10px;
            margin-top: 5px;
            color: #fe2222;
            font-weight: bold;
            display: none;
            font-size: 14px;

        }

        .check {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="container">
            <a href="" class="logo"><span>Student System</span></a>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </div>
    </div>

    <div class="center">
        <div class="form">
            <form action="<?php $_SERVER["PHP_SELF"]; ?>" id="form" method="POST">
                <h1>Login</h1>
                <?php if (isset($error)) {
                    echo $error;
                } ?>
                <p class="check">please check your data</p>
                <div class="input-box">
                    <input type="text" placeholder="Username" id="username" name="username">
                    <p class="username-er"></p>

                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" id="password" name="password">
                    <p class="password-er"></p>

                </div>

                <button type="submit">login</button>
                <p class="link">Don't have account? <a href="register.php">create account</a></p>
            </form>
        </div>
    </div>

    <script src="js/login.js"></script>

</body>

</html>