<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Πρόσθεσε/Εργασίες</title>
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
            if(isset($_POST['object'])){
                $object = $_POST['object'];
            }else{
                $object = null;
            }
            if(isset($_POST['ann'])){
                $ann = $_POST['ann'];
            }else{
                $ann = null;
            }
            if(isset($_POST['del'])){
                $del = $_POST['del'];
            }else{
                $del = null;
            }
            if(isset($_POST['date'])){
                $date = $_POST['date'];
            }else{
                $date = null;
            }

            /*Πρόσθετο τα στοιχειά στην βάση*/
            $query = "INSERT INTO home_work ( objectives, name_file, deliverable, date_deliveries) VALUES ( '$object', '$ann', '$del', '$date')";
            if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                /*Προσθετο την εργασια στης ανακοινωσεις*/
                $date_ann = $date;
                $subject_ann = $object;
                $mf='<a href="'.$ann.'">'.$ann.'</a>';
                $text_ann = $del.$mf;
                /*Πρόσθετο τα στοιχειά στην βάση*/
                $query = "INSERT INTO communications (dates, subject, main_text) VALUES ('$date_ann','$subject_ann', '$text_ann')";
                $results = mysqli_query($link, $query); // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
                header("Location: ../home_work/homework.php");
            }

        }
    }
    ?>
</head>
<body>
<?php
// αν ο χρήστης είναι συνδεδεμένος και προσπαθήσει να φορτώσει την σελίδα add_new_homework.php τότε φορτώνεται η σελίδα login.php
if (!isset($_SESSION['connected_username'])){
    header("Location: ../login-logout/login.php");
}
?>

<!------------  Επικεφαλίδα σελίδας  ------------------>
<header >
    <h1 id="header">Πρόσθεσε μια έργασίες</h1>
</header>

<!------------- κάνω διαχωρισμό στο κύριο μέρος έτσι όπως θέλω να εμφανίζεται τα στοιχειά -------->
<section>
    <!------------ Το μενού της σελίδας ------------------>
    <?php require '../general/navigation.php';?>
    <!------------ περιεχόμενο σελίδας -------------------->
    <article>
        <!----------- το φόρουμ για να προσθέσω τα στοιχεία ----------------->
        <form action="add_new_homework.php" method="post" class="add_item">
            <label>Στόχοι:</label><br>
            <input type="text"  style=" width: 500px;" placeholder="πληκτρολόγησε!" name="object" required><br><br>

            <label >όνομα θέση αρχείου:</label><br>
            <input type="file" style=" width: 500px;"  name="ann" required><br><br>

            <label >Παραδοτέο:</label><br>
            <input type="text" style=" width: 500px;" placeholder="πληκτρολόγησε!" name="del" required><br><br>

            <label >Ημερομηνία παράδοσης:</label><br>
            <input type="date" style=" width: 500px;" placeholder="πληκτρολόγησε!" name="date" required><br><br>

            <input name="submit" type="submit" value="Πρόσθεσε" id="add"/>
        </form>
        <!------- Δημιουργία κουμπιού top  button ----------->
        <!-- <button  id="top_Btn" ><a href="#top">top</a></button>-->
    </article>
</section>
</body>
</html>