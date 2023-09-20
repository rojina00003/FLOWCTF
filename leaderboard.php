<?php
// session check
session_start();

if ($_SESSION['role']=='admin'){
    header("location:adashboard.php");
}
elseif($_SESSION['role']!="player"){
    header("location:login.php");
}
require("database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                                <a class="nav-link" href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="leaderboard.php" aria-current="page"> Leaderboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="add_challenge.php">Add Challenge</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
<!-- fetching user and their score -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="leaderboard">Leaderboard</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $players = "SELECT * FROM players
                        WHERE username!='admin' 
                        ORDER BY score DESC";
                        $result = $conn->query($players);
                        $rank=1;
                        while ($data=$result->fetch_assoc() and $rank){?>
                        <tr>
                            <th scope="row"><?php echo $rank;?></th>
                            <td scope="row"><?php echo $data['username']; ?></td>
                            <td scope="row"><?php echo $data['score']; ?></td>
                        </tr>
                        <?php
                        $rank++;
    }
    ?>
            </div>
        </div>
    </div>


</body>

</html>
