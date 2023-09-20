
<?php
session_start();
require("database.php");

// Registration action 

if(isset($_POST['joinPlayer'])){

    $email=strtolower($_POST['email']);
    $username=strtolower($_POST['username']);
    $password=md5($_POST['password']);
    $confirmPassword=md5($_POST['confirmPassword']);
    $join = "INSERT INTO players
    (id,email,username,password,role,score)
    VALUES (NULL,'$email','$username','$password','player',0)";
    $checkQuery = "SELECT * FROM players
    WHERE email='$email' OR username='$username'";
    $result = $conn->query($checkQuery);
    $data= $result->fetch_assoc();
    $count = $result->num_rows;
    if ($count>=1){
        echo "<script>alert('Username or Email already exists');
        window.location.href='registration.php';
        </script>";
    }
    else if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)){
    echo "<script>
    alert('Username cannot contain special characters or spaces');
    window.location.href = 'registration.php';
    </script>";
    }
    else if($password!=$confirmPassword){
    echo "<script>
    alert('Password does not match');
    window.location.href = 'registration.php';
    </script>";
    }
    else{
    $conn->query($join);
    echo "<script>
    alert('Registration Successful');
    window.location.href = 'login.php';
    </script>";
    }

    }

    // Login action

    if(isset($_POST['playPlayer'])){
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    $play = "SELECT * FROM players
    WHERE username='$username'
    AND password='$password'";

    $result = $conn->query($play);
    $data = $result->fetch_array();
    $count=$result->num_rows;

    if($count==1){
    $_SESSION['role']=$data['role'];
    $_SESSION['username']=$username;
    header("location:dashboard.php");
    }

    else{
    ?>
    <script>
    alert("Username or Password is incorrect");
    window.location.href = 'login.php';
    </script>
    <?php
    }
}

// Challenges added by admin

if (isset($_POST['addChallengeAdmin'])){
    $challengeName=$_POST["challengeName"];
    $challengeAuthor="admin";
    $challengeDescription=$_POST["challengeDescription"];
    $challengeType=$_POST["challengeType"];
    $challengeLink=$_POST["challengeLink"];
    $challengeFlag=$_POST["flag"];

    if ($challengeType==="Easy"){
        $challengePoint="20";
    }

    elseif ($challengeType==="Medium"){
        $challengePoint="40";
    }
    elseif ($challengeType==="Hard"){
        $challengePoint="70";
    }
    else{
        $challengePoint="100";
    }

    $add = "INSERT INTO challenges
    VALUES(NULL, '$challengeName', '$challengeAuthor', '$challengeDescription', '$challengeType', '$challengePoint', '$challengeLink', '$challengeFlag')";

    $conn->query($add);
    header("location:adashboard.php");
}

// Challenge added by player needs approval

if (isset($_POST['addChallengePlayer'])){
    $challengeName=$_POST["challengeName"];
    $challengeAuthor=$_SESSION['username'];
    $challengeDescription=$_POST["challengeDescription"];
    $challengeType=$_POST["challengeType"];
    $challengeLink=$_POST["challengeLink"];
    $challengeFlag=$_POST["flag"];
    $challengeStatus="Requested";

    if ($challengeType==="Easy"){
        $challengePoint="20";
    }

    elseif ($challengeType==="Medium"){
        $challengePoint="40";
    }
    elseif ($challengeType==="Hard"){
        $challengePoint="70";
    }
    else{
        $challengePoint="100";
    }


    $add = "INSERT INTO pending_challenges
    VALUES(NULL, '$challengeName', '$challengeAuthor', '$challengeDescription', '$challengeType', '$challengePoint', '$challengeLink', '$challengeFlag','$challengeStatus')";

    $conn->query($add);
    header("location:add_challenge.php");
}

// Delete action by admin 

if (isset($_GET['did'])){
	$did = $_GET['did'];
	$delete = "DELETE FROM challenges 
    WHERE id='$did'";
	$conn->query($delete);
    header("location:adashboard.php");
}

// Update challenge by admin

if (isset($_POST['updateChallengeAdmin'])){
    $challengeName=$_POST["challengeName"];
    $challengeAuthor=$_POST['challengeAuthor'];
    $challengeDescription=$_POST["challengeDescription"];
    $challengeType=$_POST["challengeType"];
    $challengeLink=$_POST["challengeLink"];
    $challengeFlag=$_POST["flag"];
    $challengeId=$_POST['challengeId'];


    if ($challengeType==="Easy"){
        $challengePoint="20";
    }

    elseif ($challengeType==="Medium"){
        $challengePoint="40";
    }
    elseif ($challengeType==="Hard"){
        $challengePoint="70";
    }
    else{
        $challengePoint="100";
    }


    $up = "UPDATE challenges 
    SET challengeName='$challengeName', challengeAuthor='$challengeAuthor', challengeDescription='$challengeDescription', challengeType='$challengeType', challengePoint='$challengePoint', challengeLink='$challengeLink', challengeFlag='$challengeFlag'
    WHERE id='$challengeId'";
    $conn->query($up);
    header("location:adashboard.php");
}

// Approve challenge of player by admin

if(isset($_POST['addByPlayer'])){
    $challengeName=$_POST["challengeName"];
    $challengeAuthor=$_POST['challengeAuthor'];
    $challengeDescription=$_POST["challengeDescription"];
    $challengeType=$_POST["challengeType"];
    $challengePoint=$_POST["challengePoint"];
    $challengeLink=$_POST["challengeLink"];
    $challengeFlag=$_POST["flag"];
    $challengeId=$_POST["challengeId"];

    $add = "INSERT INTO challenges
    VALUES(NULL, '$challengeName', '$challengeAuthor', '$challengeDescription', '$challengeType', '$challengePoint', '$challengeLink', '$challengeFlag')";

    $update_staus="UPDATE pending_challenges
    SET challengeStatus='Approved'
    WHERE id=$challengeId";

    $conn->query($add);
    $conn->query($update_staus);


    header("location:requests.php");
}

if (isset($_GET['pdid'])){
	$did = $_GET['pdid'];
	$delete = "DELETE FROM pending_challenges 
    WHERE id='$did'";
	$conn->query($delete);
    header("location:requests.php");
}



// flag check

if(isset($_POST['flagSubmit'])){
    $challengeId= $_POST['challengeId'];
    $flag=$_POST['flag'];

    $username = $_SESSION['username'];

    $player="SELECT * FROM players
    WHERE username = '$username'";

    $r=$conn->query($player);
    $playerData=$r->fetch_assoc();
    $previousScore=$playerData['score'];

    $getFlag="SELECT * FROM challenges
    WHERE id=$challengeId";
    $result = $conn->query($getFlag);
    $data=$result->fetch_assoc();

    $challengePoint=(int)$data['challengePoint'];

    if ($data['challengeFlag']=="$flag"){
        $addScore="UPDATE players
        SET score=$challengePoint + $previousScore
        WHERE username='$username'";
        $conn->query($addScore);
        ?>
        <script>
            alert("Flag is Correct");
            window.location.href = 'dashboard.php';
        </script>


    <?php } 
    else{
        ?>
<script>
        alert("Incorrect Flag!!!");
    window.location.href = 'dashboard.php';
</script>  
    <?php }
}
?>