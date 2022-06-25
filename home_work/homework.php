<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <title>Εργασίες</title>
    <link rel="icon" href="../image/image-8.webp">
    <link rel="stylesheet" href="../general/style_main.css">
    <link rel="stylesheet" href="style_homework.css">
    <?php
    include_once("../general/connect_database.php");

    $query = "SELECT roles FROM account WHERE login_name='".$_SESSION['connected_username']."'"; // έλεγχος του username  αν υπάρχει στη βάση

    if ($results = mysqli_query($link, $query)) { // έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
        $num_results = mysqli_num_rows($results);
        if ($num_results > 0) {
            $row = mysqli_fetch_assoc($results);
            $_SESSION['roles'] = $row["roles"];// ΟΡΙΖΟΥΜΕ ΤΗΝ "ΚΑΘΟΛΙΚΗ" ΜΕΤΑΒΛΗΤΗ ΓΙΑ ΤΟ roles ΤΟΥ ΧΡΗΣΤΗ
        }
    }
    ?>
</head>
<body>
<?php
// αν ο χρήστης είναι συνδεδεμένος και προσπαθήσει να φορτώσει την σελίδα homework.php τότε φορτώνεται η σελίδα login.php
if (!isset($_SESSION['connected_username'])){
    header("Location: ../login-logout/login.php");
}
?>

<!------------  Επικεφαλίδα σελίδας  ------------------>
<header >
    <h1 id="header"><img src="../image/image-6.jpg" alt="error_404" width="180" height="175"> Εργασίες</h1>
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
            echo "<a style='color: steelblue' href='add_new_homework.php'>Προσθήκη νέας εργασίας</a>.";
            echo "<hr>";
        }
        ?>
        <!------------  κώδικας για την εμφάνιση όλων των εργασιων ------------------>
        <?php
        $query = "SELECT * FROM home_work";//  ψάχνω όλες της εργασιες στην βάση
        $results = mysqli_query($link, $query);// έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
        while ($row = mysqli_fetch_array($results)) {//για κάθε μια την εμφανίζω όπως πρέπει
            echo "<h2 style='color: steelblue'><b>";
            echo "Εργασία"," ",$row['id'];
            echo "</b></h2>";
            echo "<p class='insane_txt'>";
            echo "Στόχοι: Οι στόχοι τις εργασίας είναι";
            echo "</p>";
            echo "<ol class='insane_block'>";
            echo $row['objectives'];
            echo "</ol>";
            echo "<p class='insane_txt'>";
            echo "Εκφώνηση: Κατεβάστε την εκφώνηση της εργασίας από  ";
            echo '<a href="../file/'.$row['name_file'].'">εδω</a>';
            echo "</P>";
            echo "<ol class='insane_block'>";
            echo " Παραδοτέα: ",$row['deliverable'];
            echo "</ol>";
            echo "<p class='insane_txt'><a style='color: red'>";
            echo "Ημερομηνία παράδοσης:</a>",$row['date_deliveries'];
            echo "</P>";
            echo "<hr>";
        }
        ?>
        <br><br>
        <!------- Δημιουργία κουμπιού top  button ----------->
        <button  id="top_Btn" ><a href="#top" style="color: #f7fafb;text-decoration: none" >top</a></button>
    </article>
</section>

</body>
</html>