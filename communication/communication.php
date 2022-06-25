<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <title>Επικοινωνία</title>
    <link rel="icon" href="../image/image-8.webp">
    <link rel="stylesheet" href="../general/style_main.css">
    <link rel="stylesheet" href="style_communication.css">
</head>
<body>
<?php
// αν ο χρήστης είναι συνδεδεμένος και προσπαθήσει να φορτώσει την σελίδα communication.php τότε φορτώνεται η σελίδα login.php
if (!isset($_SESSION['connected_username'])){
    header("Location: ../login-logout/login.php");
}
?>

<!------------  Επικεφαλίδα σελίδας  ------------------>
<header >
    <h1 id="header"><img src="../image/image-4.jpg" alt="error_404" width="122" height="100"> Επικοινωνία</h1>
</header>

<!-------------  κάνω διαχωρισμό στο κύριο μέρος έτσι όπως θέλω να εμφανίζεται τα στοιχειά -------->
<section>
    <!------------  ο μενού της σελίδας ------------------>
    <?php require '../general/navigation.php';?>
    <!------------ περιεχόμενο σελίδας -------------------->
    <article>
        <h2 style="color: steelblue"><b>Αποστολή e-mail μέσω web φόρμας</b></h2>
        <!---------- φορμα για αποστολη email ---------------------->
        <?php
        /* αν ο χρήστης δεν έχει πατήσει το κουμπί στείλε email του εμφανίζει το μενού παρακάτω*/
        if(!isset($_POST["submit"])){?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">

            Αποστολέας:<input type="email" id="email" placeholder="πεδίο για την δν/ση του αποστολέα" name="to_email" required><br><br>

            Θέμα:<input id="fthema" placeholder="πεδίο για το θέμα" name="subject" required><br><br>

            Κείμενο:<textarea rows="10"  id="ftext" cols="20" placeholder="πεδίο για το κείμενο"  name="message" required></textarea>

            <br><br>
            <input type="submit" id="spend" name="submit" value="Στείλε Email">
        </form>
        <?php
        }else{
            /*αλλιώς του στέλνει το email*/
            include_once("../general/connect_database.php");
            $query = "SELECT * FROM account";//ψάχνει όλα τα account στην βάση
            $results = mysqli_query($link, $query);// έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
            while ($row = mysqli_fetch_array($results)) {//το κάνει μέχρι να περάσει όλους τους χρήστες
                if($row['roles'] == "tutor"){//ελέγχει αν είναι tutor
                    if(isset($_POST["to_email"])){
                        $to_email = $row['login_name'];
                        $subject = $_POST["subject"];
                        $body = $_POST["message"];
                        $h = $row['first_name'];
                        $headers = "From: $h";

                        if ( mail($to_email, $subject, $body, $headers)) {//στέλνει το email με της μεταβλητές που είχε πάρει από τα labels
                            echo("Email successfully sent to $to_email...");
                        } else {
                            echo("Email sending failed...");
                        }
                    }
                    echo '<br>';
                }
            }
        }
        ?>
        <hr>
        <!-------- κείμενο σελίδας -------->
        <h2 style="color: steelblue"><b>Αποστολή e-mail με χρήση e-mail διεύθυνσης</b></h2>
        <p class="insane_txt">Εναλλακτικά μπορείτε να αποστείλετε e-mail στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου <a href="mailto:tutor@csd.auth.test.gr"><i>tutor@csd.auth.test.gr</i></a> </p>
    </article>
</section>
</body>
</html>