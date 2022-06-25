<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ανακοινώσεις</title>
    <link rel="icon" href="../image/image-8.webp">
    <link rel="stylesheet" href="../general/style_main.css">

    <?php
    include("../general/connect_database.php");

    $query = "SELECT roles FROM account WHERE login_name='".$_SESSION['connected_username']." '"; // έλεγχος του username  αν υπάρχει στη βάση

    if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
        $num_results = mysqli_num_rows($results);
        if ($num_results > 0) {
            $row = mysqli_fetch_assoc($results);
            $_SESSION['roles'] = $row["roles"];// ΟΡΙΖΟΥΜΕ ΤΗΝ "ΚΑΘΟΛΙΚΗ" ΜΕΤΑΒΛΗΤΗ ΓΙΑ ΤΟ roles ΤΟΥ ΧΡΗΣΤΗ
        }
    }
    /*ελέγχω αν ο χρήστης πάτησε το κουμπί διαγραφή*/
    if(isset($_GET['pressed_delete'])){
        //περνούμε το id του χρήστη από το κουμπί
        $query = "DELETE FROM communications WHERE id='".$_GET['pressed_delete']." '";
        $results = mysqli_query($link, $query); // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
    }


    /*ελέγχω αν ο χρήστης πάτησε το κουμπί επεξεργασία*/
    if(isset($_GET['pressed_processing'])){
        $_SESSION['id'] = $_GET['pressed_processing'];//βάζω το id που παίρνω από το κουμπί σε καθολική μεταβλητή για να το χρησιμοποιήσω στην processing_announcement
        header("Location:processing_announcement.php");
    }
    ?>
</head>
<body>
<?php
// αν ο χρήστης είναι συνδεδεμένος και προσπαθήσει να φορτώσει την σελίδα announcement.php τότε φορτώνεται η σελίδα login.php
if (!isset($_SESSION['connected_username'])){
    header("Location: ../login-logout/login.php");
}
?>

<!------------  Επικεφαλίδα σελίδας  ------------------>
<header >
    <h1 id="header"><img src="../image/image-2.jpg" alt="error_404" width="173" height="166"> Ανακοινώσεις</h1>
</header>

<!------------- κάνω διαχωρισμό στο κύριο μέρος έτσι όπως θέλω να εμφανίζεται τα στοιχειά -------->
<section>
    <!------------  Το μενού της σελίδας ------------------>
    <?php require '../general/navigation.php';?>
    <!------------ περιεχόμενο σελίδας -------------------->
    <article>
        <!-------- κώδικας για την εμφάνιση της Προσθήκη νέας ανακοίνωσης αν ο χρήστης είναι tutor --------------------->
        <?php
        if($_SESSION['roles'] == "tutor"){
            echo "<a style='color: steelblue' href='add_new_announcement.php'>Προσθήκη νέας ανακοίνωσης</a>.";
            echo "<hr>";
        }
        ?>
        <!-------- κώδικας για την εμφάνιση όλων των ανακοινώσεων  --------------------->
        <?php
        $query = "SELECT * FROM communications ";// ψάχνω όλες της ανακοίνωσης στην βάση
        $results = mysqli_query($link, $query);// έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
        while ($row = mysqli_fetch_array($results)) {//για κάθε μια την εμφανίζω όπως πρέπει
            if($_SESSION['roles'] == 'tutor'){
                $get_id = $row['id'];
                echo "<a href='?pressed_processing=$get_id'><button id='btn'>επεξεργασία</button></a>";
                echo "<a href='?pressed_delete=$get_id'><button id='btn'>διαγραφή</button></a>";
            }
            echo "<h2 style='color: steelblue'><b>";
            echo $row['subject']," ",$row['id'];
            echo "</b></h2>";
            echo "<p class='insane_txt'><b>Ημερομηνία:</b>";
            echo $row['dates'];
            echo "<br><br></p>";
            echo "<p class='insane_txt'>";
            echo "<b>Θέμα:</b>",$row['main_text'];
            echo "</P>";
            echo "<hr>";
        }
        ?>
        <br><br><br><br>
        <!------- Δημιουργία κουμπιού top  button ----------->
        <button  id="top_Btn" ><a href="#top" style="color: #f7fafb;text-decoration: none" >top</a></button>
    </article>
</section>
</body>
</html>