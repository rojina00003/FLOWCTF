<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"> <!-- bootstrap 5 -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>

<!-- navbar -->
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-dark bg-black fixed-top custom-navbar">
                <div class="container-fluid">
                    <a href=index.php class="navbar-brand brand" style="font-family: 'Space Mono', monospace;"><span
                            class="brand">FLOWCTF</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item align">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Play</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="registration.php" aria-current="page">Join</a>
                            </li>
                    </div>
                </div>
            </nav>
        </div>
    </div>
<!-- register Form -->
    <div class='container'>
        <div class='row align-items-center justify-content-center'>
            <div class='col-md-6'>
                <form class="form" name="join" action="action.php" method="post">
                    <div class="form-group">
                        <label for="playerEmail">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                            placeholder="Enter email" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="playerName" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            aria-describedby="usernameHelp" required>
                        <small id="usernameHelp" class="form-text">
                            Username must not contain special characters.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="playerPassword" class="form-label">Password</label> 
                        <input type="password" class="form-control" id="password" name="password" minlength="8" required>
                        <small id="passwordHelpBlock" class="form-text">
                            Your password must be 8-20 characters long.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="playerPassword" class="form-label"
                            aria-describedby="confirmPasswordHelpBlock">Confirm Password</label>
                        <input type="password" id="confirmPassword" class="form-control" name="confirmPassword" minlength="8" required>
                        <div class="invalid-feedback">
                            Password didn't match.
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">I agree to the terms and conditions</label>
                    </div>
                    <button style="margin-top:15px" type="submit" name="joinPlayer" id="register"
                        class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../script/bootstrap.bundle.min.js"></script> <!-- bootstrap js -->
    <script src="../script/validate.js"></script>

</body>


</html>
