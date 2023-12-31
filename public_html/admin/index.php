<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "config.php";
    session_start();

    // Redirect to the dashboard if the user is already logged in
    if (isset($_SESSION["username"])) {
        header("Location: https://news478.000webhostapp.com/admin/post.php");
        exit();
    }

    if (isset($_POST['login'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            echo '<div class="alert alert-danger">All Fields must be entered.</div>';
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = md5($_POST['password']);

            $sql = "SELECT user_id, username, role FROM user WHERE username = '{$username}' AND password = '{$password}'";

            $result = mysqli_query($conn, $sql) or die("Query Failed.");

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Generate a random session token
                $sessionToken = bin2hex(random_bytes(32));

        $updateTokenSql = "UPDATE user SET session_token = '{$sessionToken}' WHERE user_id = '{$row['user_id']}'";
        $updateTokenResult = mysqli_query($conn, $updateTokenSql);

        if ($updateTokenResult === false) {
        die("Token Update Failed: " . mysqli_error($conn));
        }

        mysqli_query($conn, $updateTokenSql) or die("Token Update Failed.");


                // Store the session token in a secure cookie
                setcookie("session_token", $sessionToken, 0, "/", "", true, true);

                $_SESSION["username"] = $row['username'];
                $_SESSION["user_id"] = $row['user_id'];
                $_SESSION["user_role"] = $row['role'];

                header("Location: https://news478.000webhostapp.com/admin/post.php");
                exit();
            } else {
                echo '<div class="alert alert-danger">Username and Password are not matched.</div>';
            }
        }
    }
}
?>


<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form End -->
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
