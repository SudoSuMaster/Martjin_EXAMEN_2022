<?php
#connect
$mysqli = new mysqli('localhost', 'root', '', 'project6') or
 die(mysqli_error($mysqli));

 //de afdeling array waar om gevraagd werd
 function afdeling() {
    $afdeling = array("Accountants","Receptie","HRM","Belastingadviseurs","Administratie","Directie");
    foreach ($afdeling as $value) {
        echo "<option value=$value> $value </option>";
        }
}
 //de bold functie, die ik op een totaal perfecte manier heb gemaakt, zonder ook maar een beetje onhandig te doen.
function bold(){
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['FamilieLeden'])) {
        $FamilieLeden = $_POST['FamilieLeden'];
        echo "<B> $FamilieLeden </B> ";  
        }
    }
}

//stijl voor de html tables zodat er nog lijnen te zien zijn
 ?>
 <style>
    table, th, td {
        border: 2px solid black;
    }
</style>
