<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLOW CTF</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/aos.css" />
</head>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Oswald', sans-serif;
    font-size: 1.3rem;
    background: url(../assets/images/bg.jpg) no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: white;


}

a {
    color: black;
    text-decoration: none;
}

.container {
    max-width: 1100px;
    margin: auto;
    overflow: auto;
    padding: 0 2rem;
    color: black;
    opacity: 0.9;
}

.main-header {
    height: 55vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 2rem;
}

.main-header h1 {
    font-size: 4rem;
    margin-bottom: 2rem;
    line-height: 1.2;
}

.main-header h1 span {
    color: red;
}

.main-header p {
    font-size: 2rem;
}

img {
    width: 100%;
}

.card {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 2rem;
    background: #f1f1f1;
    margin-bottom: 2rem;
}

.card h3 {
    margin-bottom: 2rem;
}

.card img {
    height: 400px;

}

.card>div {
    padding: 2rem;
}

.card:nth-child(even) img {
    order: 2;
}

.btn {
    display: inline-block;
    background: black;
    color: white;
    padding: 0.8rem 1.8rem;
    margin-top: 2rem;
    cursor: pointer;
}

.btn:hover {
    opacity: 0.6;
}

@media(max-width:700px) {
    .card {
        display: block;
    }
}
</style>

<body>



    <header class="main-header">
        <h1><span>FLOW CTF</span></h1>
        <p>Flow along with you....🌊🌊🌊🌊</p>
    </header>

    <main class="container">
        <section class="card">
            <img src="../assets/images/play.jpeg" alt="">
            <div>
                <h3>READY TO PLAY?</h3>
                <p>Get a true experience of CTF.</br>Available 24 hours and updates frequently</p>
                <a href="registration.php" class="btn">Join</a>
            </div>
        </section>
        <section class="card" data-aos="fade-left">
            <img src="../assets/images/join.png" alt="">
            <div>
                <h3>GET A FLAG!</h3>
                <p>Get me a flag You get Points</br>
                    Beat the leaderboard
                </p>
                <a href="login.php" class="btn">Play</a>
            </div>
        </section>
        <section class="card" data-aos="fade-right">
            <img src="../assets/images/give_challenge.png" alt="">
            <div>
                <h3>HOST CHALLENGE?</h3>
                <p>With one click of admin your challenge is visibile to others.</br>
                    Give other players a tough competition
                </p>
                <a href="add_challenge.php" class="btn">Add Challenge</a>
            </div>
        </section>
        <section class="card" data-aos="fade-left">
            <img src="../assets/images/contact.jpg" alt="" width="100%">
            <div>
                <h3>Contact</h3>
                <p>Email: 210160@softwarica.edu.np</p>
                <p>Address: LocalHost</p>
                <p>GitHub: <a href=https://www.github.com/prashantstha17>github.com/prashantstha17</a></p>
                <a href="#" class="btn">Contact now</a>
            </div>
        </section>

    </main>

<!-- AOS initialize -->
    <script src="../script/aos.js"></script>
    <script>
    AOS.init({
        offset: 250,
        duration: 1000
    });
    </script>
</body>

</html>

</html>
