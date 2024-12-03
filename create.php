<?php
include 'db_connection.php';
if (empty($_COOKIE['user'])) {
    header("Location:login.php");
    exit;
}
$stmt2 = $conn->prepare('SELECT id FROM users WHERE username = ?');
$stmt2->execute([$_COOKIE['user']]);
$userid = $stmt2->fetchColumn();
$name = $email = $phone = $address = "";
$errorMessage = $successMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All fields are required.";
            break;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "Invalid email format.";
            break;
        }
        $stmt = $conn->prepare("INSERT INTO clients (name, email, phone, address, userid) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute([$name, $email, $phone, $address, $userid]);
        if (!$result) {
            $errorMessage = "Database error: " . $stmt->errorInfo()[2];
            break;
        }
        $successMessage = "Client added successfully.";
        header("Location:index.php");
        exit;
    } while (false);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myshop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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


        .form {
            background-color: #6a6868;
            padding: 40px;
            border-radius: 30px;
            font-size: 20px;
        }

        .form-control {
            background-color: #9d9d9d;
            width: 560px;
        }
    </style>

</head>

<body>
    <div class="header">
        <div class="container">
            <a href="" class="logo"><span>New Student</span></a>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </div>
    </div>
    <div class="container my-5">
        <?php
        if (!empty($errorMessage)) {
            echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong?>$errorMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
        }
        ?>
        <form method="post" class="form">
            <div class="row mb-3">
                <label class=" col-sm-3 col-form-label">Name</label>
                <div class=" col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class=" col-sm-3 col-form-label">Email</label>
                <div class=" col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class=" col-sm-3 col-form-label">phone</label>
                <div class=" col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class=" col-sm-3 col-form-label">Address</label>
                <div class=" col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong?>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }

            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="./index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>


</body>

</html>