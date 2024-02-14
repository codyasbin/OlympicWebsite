<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login to Fun Olympic Games</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="container-fluid ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mt-4">
                    <h2 class="display-4">Login to </h2>
                    <h1 class="display-4">Fun Olympic Games </h1>
                    <h4>Get the Olympic Highlights for free</h4>
                    <img src=" assets/img/slide2.jpg" alt="" class="img-thumbnail">
                </div>
                <div class="col-md-6 mt-lg-5 bg-info  " style="border-radius: 10px; padding:100px 50px;">

                    <form action="" method="post">
                        <div class="form-group ">
                            <label for="Username">username:</label>
                            <input type="username" class="form-control" name="username" id="username" placeholder="username">
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="bi bi-lock"></i> Password:</label>
                            <div class="input-group ">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="showPasswordToggle">
                                        <i class="bi bi-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <script>
                            const passwordInput = document.getElementById('password');
                            const showPasswordToggle = document.getElementById('showPasswordToggle');

                            showPasswordToggle.addEventListener('click', () => {
                                if (passwordInput.type === 'password') {
                                    passwordInput.type = 'text';
                                    showPasswordToggle.innerHTML = '<i class="bi bi-eye-slash" aria-hidden="true"></i>';
                                } else {
                                    passwordInput.type = 'password';
                                    showPasswordToggle.innerHTML = '<i class="bi bi-eye" aria-hidden="true"></i>';
                                }
                            });
                        </script>
                        <div class="g-recaptcha" data-sitekey="6Leei2AoAAAAAFcQOfwIcx4kCHg8FbHdMOKexmZB"></div>

                        <br>
                        <button type="submit" class="btn  btn-warning" name="submit">Login</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                        <div class="form-group mt-3">
                            <a href="forgot-password.php" class="btn btn-primary btn-block">Forgot Password?</a>
                        </div>
                        <div class="form-group mt-3">
                            <a href="usersignup.php" class="btn btn-success btn-block">Create new account</a>
                        </div>
                    </form>
                    <?php
                    // connecting database  with file name 'connection.php'
                    include "connection.php";
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['g-recaptcha-response'])) {
                        $secretkey = "6Leei2AoAAAAAIhxCM6r-o5TquBrZyHWQyLYAQtg";
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $response = $_POST['g-recaptcha-response'];
                        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
                        $request = file_get_contents($url);
                        $data = json_decode($request);
                        $a = $_POST['username'];
                        $b = md5($_POST['password']);
                        if ($a == '' || $b == '') {
                            echo "<div class='alert alert-warning'> some fields are empty! </div>";
                        } else {
                            $query = "select * from users where username='$a' and password='$b'";
                            $run = mysqli_query($conn, $query);
                            if (mysqli_num_rows($run) > 0) {
                                $_SESSION['username'] = $a;
                                echo "<script>window.open('userindex.php','_self') </script>";
                            } else {
                                echo "<div class='alert alert-danger'> Invalid User! </div>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>