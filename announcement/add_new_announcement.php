<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Πρόσθεσε/ανακοίνωση</title>
    <link rel="icon" href="../image/image-8.webp">
    <link rel="stylesheet" href="../general/style_main.css">

    <?php
    /* To κάνω για να προσθέσω τα στοιχεία που έγραψε ο χρήστης στα labels στην βάση δεδομένων*/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        /*ελέγχω αν ο χρήστης πάτησε το κουμπί πρόσθεσε*/
        if($_POST['submit'] == 'Πρόσθεσε'){
            $link = 1; // άχρηστη γραμμή κώδικα, απλά για να μην εμφανίζει error στην μεταβλητή $link παρακάτω
            include("../general/connect_database.php");

            /* ελέγχω αν η μεταβλητές έχουν πάρει τιμή για να μην εχω error στην βάση*/
            if(isset($_POST['date'])){
                $date = $_POST['date'];
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

            /*Πρόσθετο τα στοιχειά στην βάση*/
            $query = "INSERT INTO communications (dates, subject, main_text) VALUES ('$date', '$subject', '$text')";
            if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                header("Location:../announcement/announcement.php");
            }
        }
    }
    ?>
</head>
<body>
<?php
// αν ο χρήστης είναι συνδεδεμένος και προσπαθήσει να φορτώσει την σελίδα add_new_announcement.php τότε φορτώνεται η σελίδα login.php
if (!isset($_SESSION['connected_username'])){
    header("Location: ../login-logout/login.php");
}
?>

<!------------  Επικεφαλίδα σελίδας  ------------------>
<header >
    <h1 id="header">Πρόσθεσε μία ανακοίνωση</h1>
</header>

<!------------- κάνω διαχωρισμό στο κύριο μέρος έτσι όπως θέλω να εμφανίζεται τα στοιχειά -------->
<section>
    <!------------  Το μενού της σελίδας ------------------>
    <?php require '../general/navigation.php';?>
    <!------------ περιεχόμενο σελίδας -------------------->
    <article>
        <!----------- το φόρουμ για να προσθέσω τα στοιχεία ----------------->
        <form action="add_new_announcement.php" method="post" class="add_item">
            <label>Ημερομηνία:</label><br>
            <input type="date"  style=" width: 500px;" placeholder="πληκτρολόγησε!" name="date" required><br><br>

            <label >Θέμα:</label><br>
            <input type="text" style=" width: 500px;" placeholder="πληκτρολόγησε!" name="sub" required><br><br>

            <label >Κείμενο:</label><br>
            <input type="text" style=" width: 500px;" placeholder="πληκτρολόγησε!" name="text" required><br><br>

            <input name="submit" type="submit" value="Πρόσθεσε" id="add"/>
        </form>
        <!------- Δημιουργία κουμπιού top  button ----------->
       <!-- <button  id="top_Btn" ><a href="#top">top</a></button>-->
    </article>
</section>
</body>
</html>
