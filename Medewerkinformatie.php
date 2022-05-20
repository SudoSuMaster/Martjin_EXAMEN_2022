<!DOCTYPE html>
<?php
include 'functions.php';
?>
<html>
    <head>
        <title> medewerkinformatie </title>
    </head>
    <body>
    <!--een simpele form en table, dit hoef ik niet uit te leggen-->
    <table class="table">
        <form action="Vervolginformatie.php" method="post">
        <tr>
            <td> Voornaam </td>
            <td> <input required type="text" name="Voornaam" pattern="[^()/><\][\\\x22;|]+" maxlength = "40"> </td>
        </tr >
        <tr>
            <td> Achternaam </td>
            <td> <input required type="text" name="Achternaam" pattern="[^()/><\][\\\x22;|]+" maxlength = "40"> </td>
        </tr >
        <tr>
            <td> Personeelsnummer </td>
            <td> <input required type="number" name="Personeelsnummer" min="1" max="99999999999"> </td>
        </tr >
        <tr>
            <td> Afdeling </td>
            <td> 
            <select required name="Afdeling">    
            <?php
            //de automatische function vanuit functions.php opzoeken.
               afdeling()
               
            ?>
            </select>

            </td>
        </tr >
        <tr>
            <td> Familie komt mee </td>
            <td> 
                <select name="Familie"> 
                <option value="Nee"> Nee </option>
                <option value="Ja"> Ja </option>
                </select> 
            </td>
        </tr >
    </table>
    <input type="submit">
            </form>
    </body>
</html>