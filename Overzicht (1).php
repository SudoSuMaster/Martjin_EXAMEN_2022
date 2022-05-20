<!DOCTYPE html>
<?php
session_start();
include 'functions.php';
?>
<html>
    <head>
        <title> Overzicht </title>
    </head>
    <body>
<?php
//als er geen sessie meer is, geef dit aan en zorg dat men naar de eerste pagina gaat.
if(empty($_SESSION["Voornaam"])){
    Echo "uh-oh er gaat iets fout, druk op de reset knop om het opnieuw te proberen";
                ?> 
                <form action="Medewerkinformatie.php" method="post">
                <input name="Reset" type="submit" value="Reset">
                </form> 
                <?php
} else {
//als de correct knop (onderaan deze pagina de eerste keer) is ingedrukt, voer dan de insert into database uit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['Correct'])) {
            //alle sessies omzetten in variabelen, makkelijker voor mij om mee te werken
            $voornaam = $_SESSION["Voornaam"];
            $achternaam = $_SESSION["Achternaam"];
            $personeelsnummer = $_SESSION["Personeelsnummer"];
            $afdeling = $_SESSION["Afdeling"];
            $familie = $_SESSION["Familie"];
            $vegetarisch = $_SESSION["Vegetarisch"];
            $auto = $_SESSION["Auto"];
            $interrese1 = $_SESSION["Interrese1"];
            $interrese2 = $_SESSION["Interrese2"];
            $interrese3 = $_SESSION["Interrese3"];
            $interrese4 = $_SESSION["Interrese4"];

             //zet de variabelen in de database
            $mysqli->query("INSERT INTO `inschrijfformulier`(`Voornaam`, `Achternaam`, `Personeelsnummer`, `Afdeling`, `Familie`, `Vegetarisch`, `Auto`, `Interrese1`, `Interrese2`, `Interrese3`, `Interrese4`) 
            VALUES ('$voornaam','$achternaam','$personeelsnummer','$afdeling','$familie','$vegetarisch','$auto','$interrese1','$interrese2','$interrese3','$interrese4')");
            echo "Bedankt voor uw inschrijving, U kunt de pagina nu sluiten.";
            ?>  <form action="Medewerkinformatie.php" method="post">
                <input name="Reset" type="submit" value="Reset">
                </form> <?php
                session_destroy();
            
        } else { ?>        
        Controleer uw gegevens
        <table>
            <tr>
                <td> Voornaam </td>
                <td> <?php echo $_SESSION["Voornaam"]; ?> </td>
            </tr>
            <tr>
                <td> Achternaam </td>
                <td> <?php echo $_SESSION["Achternaam"]; ?> </td>
            </tr>
            <tr>
                <td> Personeelsnummer </td>
                <td> <?php echo $_SESSION["Personeelsnummer"]; ?> </td>
            </tr>
            <tr>
                <td> Afdeling </td>
                <td> <?php echo $_SESSION["Afdeling"]; ?> </td>
            </tr>
            <tr>
                <td> 
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['FamilieLeden'])) {
                            ?>  <?php echo "Beschrijving van uw familie"; ?> <?php
                        }
                        else {
                            ?>  <?php echo "Komt uw familie mee?"; ?>  <?php
                        }
                    }
                    ?>
                </td>
                <td>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['FamilieLeden'])) {
                            ?>  <?php Bold(); ?> <?php
                            //als er nieuwe familie informatie is vanuit vervolginformatie.php, zet deze nieuwe informatie dan in de session.
                            $_SESSION["Familie"] = $_POST['FamilieLeden'];
                        } else {
                        ?>  <?php echo $_SESSION["Familie"]; ?>  <?php
                        }
                    }
                ?>
                </td>
            </tr>
            <tr>
                <td> Vegetarisch? </td>
                <td> 
                <?php 
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        echo $_POST['Vegetarisch'];
                        //verander de post in een session
                        $_SESSION["Vegetarisch"] = $_POST['Vegetarisch'];
                    }
                ?> 
                </td>
            </tr>
            <tr>
            <td> Komt u met de auto? </td>    
            <td>
                <?php
                //kijk of er een post binnen is, check dan of de posts "taxi" en "auto" informatie in zich hebben als de informatie leeg is, geef ze dan de variabele nee.
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['Taxi'])) {
                        $Taxi = $_POST['Taxi'];
                    } else {$Taxi = "Nee";}

                    if (isset($_POST['Auto'])){
                        $auto = $_POST['Auto'];
                    }else{ $auto = "nee"; }
                
                    //check welke mogelijkheid is aangeklikt. opties: ja/ja, ja/nee, nee/ja, nee/nee. pas dynamisch de sessie auto aan.
                if ($auto == $Taxi){
                    echo "Beide auto en taxi zijn geselecteerd, neem alstublieft contact op";
                    $_SESSION["Auto"] = "Cont";
                } elseif ($Taxi == "Ja"){ 
                    echo "U komt met een Taxi";
                    $_SESSION["Auto"] = "Taxi";
                } elseif ($auto == "Ja"){
                    echo "Ja";
                    $_SESSION["Auto"] = "Auto";
                } else {echo "Nee"; $_SESSION["Auto"] = "Nee";}
            }
                    ?>
                    </td>


            </tr>
            <tr>
                <td> Interesses </td>
                <td> <?php 
                $interressecheck = 0;
                //check voor de interesses, als de interesse er is, echo dan de naam en geef aan dat die interesse ..., ja is, 
                //als de interesse er niet is, dan is de interesse ..., nee.
        
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['Actief'])) {
                        $Actief = $_POST['Actief'];
                        echo "$Actief <br>";
                        $_SESSION["Interrese1"] = "Actief, Ja";
                    } else {$interressecheck++ ; $_SESSION["Interrese1"] = "Actief, Nee";}
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['Spelletjes'])) {
                        $Spelletjes = $_POST['Spelletjes'];
                        echo "$Spelletjes <br>";
                        $_SESSION["Interrese2"] = "Spelletjes, Ja";
                    } else {$interressecheck++ ; $_SESSION["Interrese2"] = "Spelletjes, Nee";}
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['Cultuur'])) {
                        $Cultuur = $_POST['Cultuur'];
                        echo "$Cultuur <br>";
                        $_SESSION["Interrese3"] = "Cultuur, Ja";
                    } else {$interressecheck++ ;  $_SESSION["Interrese3"] = "Cultuur, Nee";}
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['Natuur'])) {
                        $Natuur = $_POST['Natuur'];
                        echo "$Natuur <br>";
                        $_SESSION["Interrese4"] = "Natuur, Ja";
                    } else {$interressecheck++ ; $_SESSION["Interrese4"] = "Natuur, Nee";}
                }
                //als geen enkele interesse is aangegeven, voer dan dit in.
                if ($interressecheck == 4)
                {
                    echo "U heeft geen interesses aangegeven.";
                }
                
                ?> </td>
            </tr>

        
<tr>
    <td>
        <form action="Overzicht.php" method="post">
            <input name="Correct" type="submit" value="Correct">
        </form>
            </td>
            <td>
        <form action="Medewerkinformatie.php" method="post">
            <input name="Reset" type="submit" value="Reset">
        </form>
            </td>
            </tr>
        </table>
        <?php
            }
        }
    }
        ?>
    </body>
</html>