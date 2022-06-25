<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Πρόσθεσε/Έγγραφα</title><link rel="icon" href="../image/image-8.webp">
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
            if(isset($_POST['title'])){
                $title = $_POST['title'];
            }else{
                $title = null;
            }
            if(isset($_POST['dis'])){
                $dis = $_POST['dis'];
            }else{
                $dis = null;
            }
            if(isset($_POST['text'])){
                $text = $_POST['text'];
            }else{
                $text = null;
            }

            /*Πρόσθετο τα στοιχειά στην βάση*/
            $query = "INSERT INTO writing (title, description, name_file) VALUES ('$title', '$dis', '$text')";
            if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                header("Location:documents.php");
            }
        }
    }
    ?>
</head>
<body>
<?php
// αν ο χρήστης είναι συνδεδεμένος και προσπαθήσει να φορτώσει την σελίδα add_new_documents.php τότε φορτώνεται η σελίδα login.php
if (!isset($_SESSION['connected_username'])){
    header("Location: ../login-logout/login.php");
}
?>

<!------------  Επικεφαλίδα σελίδας  ------------------>
<header >
    <h1 id="header">Πρόσθεσε ενα έγγραφο</h1>
</header>

<!------------- κάνω διαχωρισμό στο κύριο μέρος έτσι όπως θέλω να εμφανίζεται τα στοιχειά -------->
<section>
    <!------------  Το μενού της σελίδας  ------------------>
    <?php require '../general/navigation.php';?>
    <!------------ περιεχόμενο σελίδας-------------------->
    <article>
        <!----------- το φόρουμ για να προσθέσω τα στοιχεία ----------------->
        <form action="add_new_documents.php" method="post" class="add_item">
            <label>Τίτλο εγγράφου:</label><br>
            <input type="text"  style=" width: 500px;" placeholder="πληκτρολόγησε!" name="title" required><br><br>

            <label >Περιγραφή:</label><br>
            <input type="text" style=" width: 500px;" placeholder="πληκτρολόγησε!" name="dis" required><br><br>

            <label >όνομα θέση αρχείου:</label><br>
            <input type="file" style=" width: 500px;"  name="text" required><br><br>

            <input name="submit" type="submit" value="Πρόσθεσε" id="add"/>
        </form>
        <!------- Δημιουργία κουμπιού top  button ----------->
        <!-- <button  id="top_Btn" ><a href="#top">top</a></button>-->
    </article>
</section>
</body>
</html>