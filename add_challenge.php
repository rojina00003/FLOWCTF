<?php
// session check for player
session_start();

if ($_SESSION['role']!='player' ){
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
    <title>Add Challenge</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css"> <!-- bootstrap 5 -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
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
                                <a class="nav-link" href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="leaderboard.php"> Leaderboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="add_challenge.php" aria-current="page">Add
                                    Challenge</a>
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

    <!-- for adding challenge -->
    <div class="container">
        <div class="row">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Challenge
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="exampleModalLabel">Add Challenge</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="action.php" method="post">
                                <div class="form-group">
                                    <label for="challengeName">Challenge Name</label>
                                    <input type="text" class="form-control" id="challengeName" name="challengeName"
                                        aria-describedby="challengeHelp" placeholder="WISE" maxlength="20">
                                    <small id="challengeHelp" class="form-text text-muted">Use short name for
                                        challenges(!>20).</small>
                                </div>
                                <div class="form-group">
                                    <label for="challengeDescription" class="form-label">Challenge Description</label>
                                    <input type="text" class="form-control" id="challenegDescription"
                                        name="challengeDescription" aria-describedby="descHelp" maxlength="80">
                                    <small id="descHelp" class="form-text text-muted">Keep it short(!>80)</small>
                                </div>
                                <div class="form-group">
                                    <label for="challengeType" class="form-label">Challenge Type</label>
                                    <select class="form-select" name="challengeType">
                                        <option value="Easy">Easy</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Hard">Hard</option>
                                        <option value="Insane">Insane</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="challengeLink" class="form-label">Challenge Link</label>
                                    <input type="text" class="form-control" id="challengeLink" name="challengeLink">
                                </div>

                                <div class="form-group">
                                    <label for="challengePoint" class="form-label">FLAG</label>
                                    <input type="text" class="form-control" id="flag" name="flag"
                                        placeholder="FLOWCTF{...............}">
                                </div>
                                <button style="margin-top:15px" type="submit" name="addChallengePlayer"
                                    class="btn btn-primary">ADD</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<!-- Fetching request data of user -->
    <div class="container">
        <div class="row">
            <?php
            $user=$_SESSION['username'];
            $challenges = "SELECT * FROM pending_challenges WHERE challengeAuthor='$user'";
            $result = $conn->query($challenges);
            while ($data=$result->fetch_assoc()){?>
            <div class="col-md-3 card">
                <h1 class="challenge"><?php echo $data['challengeName']; ?></h1>
                <h4>Type: <span class="ctype"><?php 
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
                    ?></span></h4>
                <small>Author: <?php echo $data['challengeAuthor']; ?></small>
                <p class="point text-end"><?php 
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
                ?></p>
                <p><?php echo $data["challengeDescription"]; ?></p>
                <p>Attachement: <a href="<?php echo $data["challengeLink"];?>">Link</a></p>
                <form>
                    <div class="form-group">
                        <?php
                            if($data['challengeStatus'] == 'Approved'){?>
                        <button type="button" class="btn btn-success"><?php echo $data["challengeStatus"];?></button>
                        <?php }
                        else{?>
                        <buttton type="button" class="btn btn-primary"><?php echo $data["challengeStatus"];?></button>
                            <?php } ?>
                    </div>
                </form>
            </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>
