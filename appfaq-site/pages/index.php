<?php
$titre = "Accueil";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index-style.css">
    <title>ProjetM2L</title>
</head>

<body>
    <div class="barre_haute">
        <h2>AppFaq - M2L</h2>
        <a onclick="show_register()" id="register">S'inscrire</a>
        <a onclick="show_login()" id ="login">Se connecter</a>
    </div>
<div id="overlay"></div>
    <div class="content">
        <h1><?= $titre ?></h1>


        <div id="pop-up_form">

            <form action="subpages/login.php" method="post" id="login_form">
                <div class="inputs">
                    <label for="Pseudo">Pseudo</label> <br> 
                    <input type="text" name="Pseudo" id="pseudo">

                </div>

                <!-- <div class="inputs">
                    <label for="Email">Email</label> <br>
                    <input type="text" name="Email" id="email">
                </div> -->

                <div class="inputs">
                    <label for="Password">Mot de passe</label> <br>
                    <input type="password" name="Password" id="password">
                </div>
                <div class="inputs">
                    <label for="ligue">Ligue</label> <br>
                    <select name="ligue" id="ligue">
                        <option value="foot" selected>Football</option>
                        <option value="basket">Basket</option>
                        <option value="volley">Volleyball</option>
                        <option value="rugby">Rugby</option>
                    </select>
                </div>
                <div>
                    <input type="submit" value="Enregistrer" id="submit">
                    <input type="reset" value="Annuler" id="reset" onclick="hideall()">
                </div>

            </form>

                            <form action="subpages/register.php" method="post" id="register_form">
                <div class="inputs">
                    <label for="Pseudo">Pseudo</label> <br> 
                    <input type="text" name="Pseudo" id="pseudo">

                </div>

                <div class="inputs">
                    <label for="Email">Email</label> <br>
                    <input type="text" name="Email" id="email">
                </div>

                <div class="inputs">
                    <label for="Password">Mot de passe</label> <br>
                    <input type="password" name="Password" id="password">
                </div>
                <div class="inputs">
                    <label for="ligue">Ligue</label> <br>
                    <select name="ligue" id="ligue">
                        <option value="foot" selected>Football</option>
                        <option value="basket">Basket</option>
                        <option value="volley">Volleyball</option>
                        <option value="rugby">Rugby</option>
                    </select>
                </div>
                <div>
                    <input type="submit" value="Enregistrer" id="submit">
                    <input type="reset" value="Annuler" id="reset" onclick="hideall()">
                </div>

            </form>
        </div>

    </div>
    <div class="footer">
        <p>placeholder</p>
    </div>

<script>

function show_login() {
    document.getElementById("register_form").style.display  = "none";
    document.getElementById("login_form").style.display     = "block";
    document.getElementById("pop-up_form").style.display    = "block";
    document.getElementById("overlay").style.display        = "block";
}

function show_register() {
    document.getElementById("login_form").style.display     = "none";
    document.getElementById("register_form").style.display  = "block";
    document.getElementById("pop-up_form").style.display    = "block";
    document.getElementById("overlay").style.display        = "block";


}

function hideall() {
    document.getElementById("login_form").style.display     = "none";
    document.getElementById("register_form").style.display  = "none";
    document.getElementById("pop-up_form").style.display    = "none";
    document.getElementById("overlay").style.display        = "none";
}


// $(document).ready(function () {
//     $("#login").click(function () {
//         $("#pop-up_login").show();
//     });
//     //Contact Form validation on click event
//     $("#login_form").on("submit", function () {
//         var valid = true;
//         $(".info").html("");
//         $("inputBox").removeClass("input-error");
        
//         var userName = $("#userName").val();
//         var userEmail = $("#userEmail").val();
//         var subject = $("#subject").val();
//         var message = $("#message").val();

//         if (userName == "") {
//             $("#userName-info").html("required.");
//             $("#userName").addClass("input-error");
//         }
//         if (userEmail == "") {
//             $("#userEmail-info").html("required.");
//             $("#userEmail").addClass("input-error");
//             valid = false;
//         }
//         if (!userEmail.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/))
//         {
//             $("#userEmail-info").html("invalid.");
//             $("#userEmail").addClass("input-error");
//             valid = false;
//         }

//         if (subject == "") {
//             $("#subject-info").html("required.");
//             $("#subject").addClass("input-error");
//             valid = false;
//         }
//         if (message == "") {
//             $("#userMessage-info").html("required.");
//             $("#message").addClass("input-error");
//             valid = false;
//         }
//         return valid;
//     });
// });

</script>

</body>

</html>