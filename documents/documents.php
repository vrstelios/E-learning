<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Έγγραφα μαθήματος</title>
    <link rel="icon" href="../image/image-8.webp">
    <link rel="stylesheet" href="../general/style_main.css">

    <?php
    include_once("../general/connect_database.php");

    $query = "SELECT roles FROM account WHERE login_name='".$_SESSION['connected_username']." '"; // έλεγχος του username  αν υπάρχει στη βάση


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
// αν ο χρήστης είναι συνδεδεμένος και προσπαθήσει να φορτώσει την σελίδα documents.php τότε φορτώνεται η σελίδα login.php
if (!isset($_SESSION['connected_username'])){
    header("Location: ../login-logout/login.php");
}
?>

<!------------  Επικεφαλίδα σελίδας  ------------------>
<header >
    <h1 id="header"><img src="../image/image-5.jpg" alt="error_404" width="137" height="146"> Έγγραφα μαθήματος</h1>
</header>

<!------------- κάνω διαχωρισμό στο κύριο μέρος έτσι όπως θέλω να εμφανίζεται τα στοιχειά -------->
<section>
    <!------------   Το μενού της σελίδας ------------------>
    <?php require '../general/navigation.php';?>
    <!------------περιεχόμενο σελίδας -------------------->
    <article>
        <!-------- κώδικας για την εμφάνιση της Προσθήκη νέας ανακοίνωσης αν ο χρήστης είναι tutor --------------------->
        <?php
        if($_SESSION['roles'] == "tutor"){
            echo "<a style='color: steelblue' href='add_new_documents.php'>Προσθήκη νέου έγγραφου</a>.";
            echo "<hr>";
        }
        ?>
        <!-------- κώδικας για την εμφάνιση όλων των ανακοινώσεων --------------------->
        <?php
        $query = "SELECT * FROM writing ";// ψάχνω όλες τα εργαφα στην βάση
        $results = mysqli_query($link, $query);// έλεγχος αν εκτελέστηκε επιτυχώς το ερώτημα στην βάση
        while ($row = mysqli_fetch_array($results)) {//για κάθε μια την εμφανίζω όπως πρέπει
            echo "<h2 style='color: steelblue'><b>";
            echo $row['title']/*,$row['id']*/;
            echo "</b></h2>";
            echo "<p class='insane_txt'>";
            echo "Περιγραφή: ",$row['description'];
            echo "</p>";
            echo "<p class='insane_txt'>";
            echo '<a href="../file/'.$row['name_file'].'">download</a>';
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