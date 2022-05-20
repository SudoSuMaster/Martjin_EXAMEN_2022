<!DOCTYPE html>
<?php
session_start();
include 'functions.php';
?>
<html>
    <head>
        <title> Vervolginformatie </title>
    </head>
    <body>
<?php
//als je niet van pagina 1 komt (en dus de post niet hebt) stuur ze dan terug naar de eerste pagina
if( empty( $_POST['Voornaam']) ) {
    Echo "uh-oh er gaat iets fout, druk op de reset knop om het opnieuw te proberen";
    ?> 
    <form action="Medewerkinformatie.php" method="post">
    <input name="Reset" type="submit" value="Reset">
    </form> 
    <?php
} else { ?>



<!--een simpele form, dit hoef ik niet uit te leggen.-->
    <table class="table">
    <form action="Overzicht.php" method="post">
    <tr>
        <td>Vegetarisch</td>
        <td>
        <select required name="Vegetarisch"> 
            <option value="Nee"> Nee </option>
            <option value="Ja"> Ja </option>
        </select> 
        </td>
    </tr >
    <tr>
                    <td> Komt u met de auto? </td>
                    <td>
                        <input type="checkbox" id="Ja" name=Auto value="Ja">
                    </td>
                </tr>
    <tr>
        <td> Intresse gebieden </td>
        <td>
        <input type="checkbox" id="Actief" name=Actief value="Actief">
        <label for="Actief"> Actief </label><br>
        <input type="checkbox" id="Spelletjes" name=Spelletjes value="Spelletjes">
        <label for="Spelletjes"> Spelletjes </label><br>
        <input type="checkbox" id="Cultuur" name=Cultuur value="Cultuur">
        <label for="Cultuur"> Cultuur </label><br>
        <input type="checkbox" id="Natuur" name=Natuur value="Natuur">
        <label for="Natuur"> Natuur </label><br>
        </td>
    </tr>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //als er een post is, dan zet deze ff om naar een variabele zodat ik weet of er wel of geen familie komt
  $Familie = $_POST['Familie'];
  if($Familie == "Ja") {
    ?>
    <tr>
            <td> Beschrijf uw familie leden </td>
            <td> <input required type="text" name="FamilieLeden" pattern="[^()/><\][\\\x22;|]+" > </td>
  </tr> 
    <?php
    }}
    //ach, toch alleen? ja- dan hoef je ook niets daarvan in te vullen-

    //ben je van de directie en weet je niet hoe je moet rijden? hier kun je een taxi aanschaffen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $AfdelingDirectie = $_POST['Afdeling'];
        if($AfdelingDirectie == "Directie") {
          ?>
          <tr>
                  <td> Moet er een taxi geregeld worden? </td>
                  <td> 
                  <select name="Taxi"> 
                    <option value="Ja"> Ja </option>
                    <option value="Nee"> Nee </option>
                </td>
        </tr> 
          <?php
          }  } 
    ?>

    </table>
    <?php  //ff alle posts omzetten in sessies zodat ik deze nog kan gebruiken op overzicht.php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $_SESSION["Voornaam"] = $_POST['Voornaam'];
     $_SESSION["Achternaam"] = $_POST['Achternaam'];
     $_SESSION["Personeelsnummer"] = $_POST['Personeelsnummer'];
     $_SESSION["Afdeling"] = $_POST['Afdeling'];
        if($Familie == "Nee") {
        $_SESSION["Familie"] = $_POST['Familie'];
        }
    }
    ?>
    <input type="submit">
    </form>

    <?php } ?>
    </body>
</html>