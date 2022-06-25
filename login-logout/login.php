<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" >
    <title>Σελίδα πιστοποίησης</title>
    <link rel="icon" href="../image/image-8.webp">
    <link rel="stylesheet" href="../general/style_main.css">
    <link rel="stylesheet" href="style_login.css">
    <?php
    $_SESSION['login'] = $_SESSION['connected_username'] = null;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            include_once("../general/connect_database.php");

            if (isset($_POST['name']) and isset($_POST['pass'])) { // ο χρήστης έχει δώσει κάποια τιμή στο πεδίο username και password του Login.php ( και έχει πατήσει το κουμπί Είσοδος)
                $username = $_POST['name'];
                $password = $_POST['pass'];

                $query = "SELECT login_name, password FROM account WHERE login_name='$username' AND password = '$password' "; // έλεγχος του username και password αν υπάρχει στη βάση

                if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                    $num_results = mysqli_num_rows($results);
                    if ($num_results > 0) {
                        $_SESSION['connected_username'] = $username; // ΟΡΙΖΟΥΜΕ ΤΗΝ "ΚΑΘΟΛΙΚΗ" ΜΕΤΑΒΛΗΤΗ ΓΙΑ ΤΟ USERNAME ΤΟΥ ΧΡΗΣΤΗ
                        header("location: ../home_page/index.php"); // Ανακατεύθυνση από την σελίδα Login στην index μόλις κάνει επιτυχή σύνδεση ο χρήστης
                    }

                }
                $_SESSION['login'] = "Το όνομα ή ο κωδικός είναι λάθος";
                @mysqli_free_result($results);
            }
        }
        ?>
</head>
<body id="body">
<div class="login">
    <!------------  Επικεφαλίδα σελίδας  ------------------>
    <br>
    <p class="title"><b>Πιστοποίηση</b></p>
    <!----------------------------------------------->
    <form method="post">
        <!------------  label login  ------------------>
        Όνομα: <input type="text" placeholder="Εισάγετε username" id="user"  name="name" required>
        <br>
        <!------------  label password  ------------------>
        <div class="pass">
            Κωδικό: <input type="password"  placeholder="Εισάγετε Κωδικό"  name="pass" required>
        </div>
        <br>
        <!-------- κατάλληλο μήνυμα αν ο κωδικός η το όνομα είναι λάθος ----------->
        <a style="color: red"><?php echo $_SESSION['login'] ?></a>
        <br>
        <!------------   κουμπί σύνδεσης ------------------>
        <input type="submit" id="log-in" name="submit" value="Είσοδος">
    </form>
</div>

</body>
</html>