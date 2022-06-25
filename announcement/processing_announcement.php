<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>επεξεργασία/ανακοίνωση</title>
    <link rel="icon" href="../image/image-8.webp">
    <link rel="stylesheet" href="../general/style_main.css">

    <?php
    /*Αν ο χρηστης ανοιξει την καρτελα processing_announcement.php χωρις να εχει επιλεξει ανακοινωσει να μην βγαλει error*/
    if(!isset($_SESSION['id'])){
        $_SESSION['id'] = '';
    }
    /* To κάνω για να προσθέσω τα στοιχεία που έγραψε ο χρήστης στα labels στην βάση δεδομένων*/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        /*ελέγχω αν ο χρήστης πάτησε το κουμπί Ενημέρωση*/
        if($_POST['submit'] == 'Ενημέρωση'){
            $link = 1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
            include("../general/connect_database.php");

            /* ελέγχω αν η μεταβλητές έχουν πάρει τιμή για να μην εχω error στην βάση*/
            if(isset($_POST['dates'])){
                $date = $_POST['dates'];
            }else{
                $date = null;
            }
            if(isset($_POST['sub'])){
                $subject = $_POST['sub'];
            }else{
                $subject = null;
            }
            if(isset($_POST['text'])){
                $text = $_POST['text'];
            }else{
                $text = null;
            }

            /*ενημερωνο τα στοιχειά στην βάση*/
            $query = "UPDATE  communications SET dates='$date', subject='$subject', main_text='$text' WHERE id='".$_SESSION['id']."'";
            if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                header("Location:announcement.php");
            }
        }
    }

    ?>

</head>
<body>
<?php
// αν ο χρήστης είναι συνδεδεμένος και προσπαθήσει να φορτώσει την σελίδα processing_announcement.php τότε φορτώνεται η σελίδα login.php
if (!isset($_SESSION['connected_username'])){
    header("Location: ../login-logout/login.php");
}
?>

<!------------  Επικεφαλίδα σελίδας  ------------------>
<header >
    <h1 id="header">Επεξεργασού στην ανακοίνωση</h1>
</header>

<!------------- κάνω διαχωρισμό στο κύριο μέρος έτσι όπως θέλω να εμφανίζεται τα στοιχειά -------->
<section>
    <!------------  Το μενού της σελίδας ------------------>
    <?php require '../general/navigation.php';?>
    <!------------ περιεχόμενο σελίδας -------------------->
    <article >
        <!----------- το φόρουμ για να Ενημέρωση  τα στοιχεία ----------------->
        <form action="processing_announcement.php" method="post" enctype="multipart/form-data" class="add_item">
            <?php
            include("../general/connect_database.php");
            //$id = $_SESSION['id'];
            $query = "SELECT * FROM communications WHERE id='".$_SESSION['id']."'";
            $results = mysqli_query($link, $query);
            $row = mysqli_fetch_assoc($results);

                echo '<p>
            <label>Ημερομηνία:</label><br>
            <input type="date"  style=" width: 500px;" " name="dates" value="'.$row['dates'].'" required><br><br>

            <label >Θέμα:</label><br>
            <input type="text" style=" width: 500px;"  name="sub" value="'.$row['subject'].'" required><br><br>

            <label >Κείμενο:</label><br>
            <input type="text" style=" width: 500px;" name="text" value="'.$row['main_text'].'" required><br><br>
            </p>';

            ?>
            <input name="submit" type="submit" value="Ενημέρωση" id="add"/>
        </form>

        <!------- Δημιουργια κουμπιου top  button ----------->
        <!-- <button  id="top_Btn" ><a href="#top">top</a></button>-->
    </article>
</section>
</body>
</html>
