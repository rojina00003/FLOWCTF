<?php

session_start();

if ($_SESSION['role']!='admin'){
    header("location:dashboard.php");
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
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
                                <a class="nav-link" href="adashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="stats.php"> Stats</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="requests.php" aria-current="page">Requests</a>
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

<!-- fetching challenges that neeeds approval -->

    <?php
    $challenges = "SELECT * FROM pending_challenges
    WHERE challengeStatus='Requested'";
    $result = $conn->query($challenges);
    $data = $result->fetch_array();
    $count = $result->num_rows;
    // shows error 404 if challenge are not requested
    if ($count==0){?>
    <div class="container p-0">
        <div class="row">
            <div class="col p-1 d-flex">
                <div class="card card-body rounded justify-content-center">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20rem" height="15rem" fill="currentColor"
                                class="bi bi-bug-fill" viewBox="0 0 16 16" style="color:#DDF45B">
                                <path
                                    d="M4.978.855a.5.5 0 1 0-.956.29l.41 1.352A4.985 4.985 0 0 0 3 6h10a4.985 4.985 0 0 0-1.432-3.503l.41-1.352a.5.5 0 1 0-.956-.29l-.291.956A4.978 4.978 0 0 0 8 1a4.979 4.979 0 0 0-2.731.811l-.29-.956z" />
                                <path
                                    d="M13 6v1H8.5v8.975A5 5 0 0 0 13 11h.5a.5.5 0 0 1 .5.5v.5a.5.5 0 1 0 1 0v-.5a1.5 1.5 0 0 0-1.5-1.5H13V9h1.5a.5.5 0 0 0 0-1H13V7h.5A1.5 1.5 0 0 0 15 5.5V5a.5.5 0 0 0-1 0v.5a.5.5 0 0 1-.5.5H13zm-5.5 9.975V7H3V6h-.5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 0-1 0v.5A1.5 1.5 0 0 0 2.5 7H3v1H1.5a.5.5 0 0 0 0 1H3v1h-.5A1.5 1.5 0 0 0 1 11.5v.5a.5.5 0 1 0 1 0v-.5a.5.5 0 0 1 .5-.5H3a5 5 0 0 0 4.5 4.975z" />
                            </svg>
                        </div>
                        <div class="col-9 text-center">
                            <h4>
                                <div class="jumbotron jumbotron-fluid">
                                    <div class="container">
                                        <h1 class="display-4" style="color:#FA1E1E">ERROR 404
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                fill="currentColor" class="bi bi-patch-exclamation-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                        </h1>
                                        <p class="lead">Requests Not Found</p>
                                    </div>
                                </div>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }
    else{?>
    <div class="container">
        <div class="row">
            <?php
                $challenges = "SELECT * FROM pending_challenges
                WHERE challengeStatus='Requested'";
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
<!-- approve modal trigring button -->
                <button type="button" class="btn btn-success" style="margin-bottom:15px;" data-bs-toggle="modal"
                    data-bs-target="#approveModal<?php echo $data['id'];?>">Approve</button>



                <!-- Modal -->
                <div class="modal" id="approveModal<?php echo $data['id'];?>" tabindex="-1"
                    aria-labelledby="approveLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title" id="updateLabel">Challenge Review</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="action.php" method="post">
                                    <div class="form-group">
                                        <label for="challengeName">Challenge Name</label>
                                        <input type="text" class="form-control" id="challengeName" name="challengeName"
                                            aria-describedby="challengeHelp"
                                            value="<?php echo $data['challengeName'];?>" maxlength="20">
                                        <small id="challengeHelp" class="form-text text-muted">Use short name for
                                            challenges(!>20).</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="challengeDescription" class="form-label">Challenge
                                            Description</label>
                                        <input type="text" class="form-control" id="challenegDescription"
                                            name="challengeDescription" aria-describedby="descHelp" maxlength="80"
                                            value="<?php echo $data['challengeDescription'];?>">
                                        <small id="descHelp" class="form-text text-muted">Keep it short(!>80)</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="challengeType" class="form-label">Challenge Type</label>
                                        <input type="text" class="form-control" id="challengeType" name="challengeType"
                                            value="<?php echo $data['challengeType'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="challengePoint" class="form-label">Challenge Point</label>
                                        <input type="text" class="form-control" id="challengePoint"
                                            name="challengePoint" maxlength="3"
                                            value="<?php echo $data['challengePoint'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="challengeLink" class="form-label">Challenge Link</label>
                                        <input type="text" class="form-control" id="challengeLink" name="challengeLink"
                                            value="<?php echo $data['challengeLink'];?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="challengeId" name="challengeId"
                                            value="<?php echo $data['id'];?>" hidden>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="challengeAuthor"
                                            name="challengeAuthor" value="<?php echo $data['challengeAuthor'];?>"
                                            hidden>
                                    </div>

                                    <div class="form-group">
                                        <label for="challengePoint" class="form-label">FLAG</label>
                                        <input type="text" class="form-control" id="flag" name="flag"
                                            value="<?php echo $data['challengeFlag'];?>">
                                    </div>

                            </div>
                            <div class="modal-footer form-group">

                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="addByPlayer">Confirm
                                    Approve</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<!-- delte trigring modal -->
                <button type="button" class="btn btn-danger" style="margin-bottom:15px;" data-bs-toggle="modal"  data-bs-target="#deleteModal<?php echo $data['id'];?>">Delete</button>


                <!-- Modal -->
                <div class="modal" id="deleteModal<?php echo $data['id'];?>" tabindex="-1" aria-labelledby="deleteLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title" id="deleteModalLabel">Delete Challenge</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h3>Do you really want to delete this challenge?</h3>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger"><a
                                        href="action.php?pdid=<?php echo $data['id']; ?>">Confirm Delete</a></button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <?php } ?>

        </div>
    </div>
    <?php
    }
?>



</body>

</html>
