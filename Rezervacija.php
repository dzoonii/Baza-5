<!DOCTYPE HTML>  
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervacija bioskopske karte</title>
</head>
<body> 
    <?php
    $txt="";
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $ime = $mail=$film=$termin=$brsedista = $greskaIme = $greskaEmail =$greskafilm=$greskatermin=$greskasediste=$greskavreme="";
        if(isset($_POST["submit"]))
        {
            $ime=$_POST["ime"];
            $mail=$_POST["mail"];
            $film=$_POST["izbor"];
            $termin=$_POST["izbor1"];
            $brsedista=$_POST["sediste"];
        }
        
        $br = 0;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["ime"])) {
                $greskaIme = "Ime je obavezno";
            } else {
                $ime = test_input($_POST["ime"]);
                if (!preg_match("/^[A-Za-z\s]*$/", $ime))
                    $greskaIme = "Ime nije u dobrom formatu";
                else {
                    $greskaIme = "";
                    $br++;
                }
            }
            }
            if (empty($_POST["izbor"])) {
                $greskafilm = "Morate izabrati film";
            }
                if (empty($_POST["izbor1"])) {
                    $greskavreme = "Morate izabrati vreme";
                }
                    if (empty($_POST["sediste"])) {
                        $greskasediste = "Morate izabrati sediste";
                    }
            if(isset($_POST["submit"]))
            {
                $mail = test_input($_POST["mail"]);
            }
            
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
                $greskaEmail = "Mejl nije u dobrom formatu";
            else {
                $greskaEmail = "";
                $br++;
            }   
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bioskop";
    
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
    
            $sql = "INSERT INTO rezervacija (firstname, Film, email,termin,broj_sedista)
            VALUES ('$ime', '$mail', '$film','$termin','$brsedista')";
    
            if ($conn->query($sql) === TRUE) {
            // echo "uspesno ste uneli podatke";
            } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
    
            $conn->close();
    
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Ime:
            <input type="text" name="ime" id="ime" require value=""><span class="error">* <?php echo $greskaIme; ?></span>
       <br> mail:
            <input type="text" name="mail" id="mail" value=""><?php echo $greskaEmail; ?>
        <br>
        Film:
            <select name="izbor" id="izbor" require value=" <?php echo $greskafilm; ?>"><span class="error">* <?php echo $greskafilm; ?></span><br>>
            <option value="#"></option>
                <option value="rambo">Rambo</option>
                <option value="rode">Rode u magli</option>
                <option value="terminator">Terminator</option>
            </select>
        <br>
        Termin:
            <select name="izbor1" id="izbor1" value="<?php echo $greskavreme; ?>"><span class="error">* <?php echo $greskavreme ?></span><br>>>
            <option value="#"></option>
                <option value="16h">16h</option>
                <option value="18h">18h</option>
                <option value="20h">20h</option>
            </select>
        <br>
        Broj sedista: <input type="text" name="sediste" placeholder="Morate izabrati sedište" ><span class="error">* <?php echo $greskasediste; ?></span><br>
        <br><br>
        <input type="submit" name="submit" value="Potvrdi" onclick="Brisanje()">
        
    </form>
    <a href="./Prikazi.php">Prikazi podatke</a>
</body>
</html>