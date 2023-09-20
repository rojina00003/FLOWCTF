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
<!-- navbar -->
<body>
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
                                <a class="nav-link active" href="dashboard.php" aria-current="page">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="leaderboard.php"> Leaderboard</a>
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
<!-- fetching challenges -->
    <div class="container">
        <div class="row">
            <?php
    $usernamePlayer=$_SESSION['username'];
        $challenges = "SELECT * FROM challenges
        WHERE challengeAuthor!='$usernamePlayer'";
        $result = $conn->query($challenges);
        while ($data=$result->fetch_assoc()){?>
            <div class="col-md-3 card" id="flag<?php echo $data['id']?>">
                <h1 class="challenge"><?php echo $data['challengeName']; ?></h1>
                <h4>Type: <span class="ctype">
                        <?php 
                        if($data['challengeType'] == 'Easy'){
                            echo "<font color=#7BEC18>{$data['challengeType']}</font>";
                        }
                        else if($data['challengeType'] == 'Medium'){
                            echo "<font color=yellow>{$data['challengeType']}</font>";
                        }
                        else if($data['challengeType'] == 'Hard'){
                            echo "<font color=blue>{$data['challengeType']}</font>";
                        }
                        else if($data['challengeType'] == 'Insane'){
                            echo "<font color=#FF0000>{$data['challengeType']}</font>";
                        }
                    ?>
                    </span></h4>
                <small>Author: <?php echo $data['challengeAuthor']; ?></small>
                <p class="point text-end">
                    <?php 
                        if($data['challengeType'] == 'Easy'){
                            echo "<font color=#7BEC18>[ {$data['challengePoint']} Points ]</font>";
                        }
                        else if($data['challengeType'] == 'Medium'){
                            echo "<font color=yellow>[ {$data['challengePoint']} Points ]</font>";
                        }
                        else if($data['challengeType'] == 'Hard'){
                            echo "<font color=blue>[ {$data['challengePoint']} Points ]</font>";
                        }
                        else if($data['challengeType'] == 'Insane'){
                            echo "<font color=red>[ {$data['challengePoint']} Points ]</font>";
                        }
                ?>
                </p>
                <p><?php echo $data["challengeDescription"]; ?></p>
                <p>Attachement: <a href="<?php echo $data["challengeLink"];?>">Link</a></p>
                <form action="action.php" method="post" class="flagSubmitPlayer">
                    <div class="form-group">
                        <input type="text" class="form-control" id="challengeId" name="challengeId"
                            value="<?php echo $data['id'];?>" hidden>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" class="flag" name="flag"
                            placeholder="Submit your flag here 🏴">
                        <button type="submit" class="btn btn-primary  flagSubmit" id="flagValue<?php echo $data['id'] ?>" name="flagSubmit" >Submit</button>
                    </div>
                </form>
            </div>
            <?php } ?>


        </div>
    </div>
</body>

</html>
