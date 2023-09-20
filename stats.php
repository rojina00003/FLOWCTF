<?php
// session check
session_start();

if ($_SESSION['role']!='admin'){
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
<!--  navbar -->
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
                                <a class="nav-link" href="adashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="stats.php" aria-current="page"> Stats</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="requests.php">Requests</a>
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


<!-- total number of challenges -->

    <div class="container p-0">
        <div class="row">
            <div class="col p-1 d-flex">
                <div class="card card-body rounded justify-content-center">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="auto" fill="currentColor"
                                class="bi bi-activity" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z" />
                            </svg>
                        </div>
                        <div class="col-9 text-center">
                            <h4><?php
                                $cq= "SELECT count(id) FROM challenges";
                                $r = $conn->query($cq);
                                $fd = $r->fetch_assoc();
                                echo $fd['count(id)'];
                            ?></h4>
                            <span class="text-uppercase card-size">Total Challenges</span>
                        </div>
                    </div>
                </div>
            </div>
<!-- total number of players -->
            <div class="col p-1 d-flex">
                <div class="card card-body rounded justify-content-center">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="auto" fill="currentColor"
                                class="bi bi-people" viewBox="0 0 16 16">
                                <path
                                    d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                            </svg>
                        </div>
                        <div class="col-9 text-center">
                            <h4><?php
                            $pq= "SELECT count(id) FROM players";
                            $pr = $conn->query($pq);
                            $pd = $pr->fetch_assoc();
                            echo $pd['count(id)']-1;?>
                            </h4>
                            <span class="text-uppercase card-size">Total Users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- leaderbords -->
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
