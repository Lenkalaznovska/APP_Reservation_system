<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervace</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            flex-direction: column;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: left;
            margin-bottom: 20px;
            max-width: 100%;
            box-sizing: border-box;
            margin-top: 20px; /* Odsazení shora */
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .update-message {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        @media (max-width: 400px) {
            form {
                width: 90%;
            }
        }
        
        footer {
            margin-top: auto;
        }
    </style>

</head>
<body>

<form action="" method="POST">
    <label for="Jmeno">Jméno:</label>
    <input type="text" name="Jmeno" value="<?= isset($row['Jmeno']) ? htmlspecialchars($row['Jmeno']) : ''; ?>" required>

    <label for="Telefon">Telefon:</label>
    <input type="text" name="Telefon" pattern="\d{9,14}" title="Telefonní číslo musí mít 9-14 čísel." value="<?= isset($row['Telefon']) ? htmlspecialchars($row['Telefon']) : ''; ?>" required>

    <label for="Email">E-mail:</label>
    <input type="email" name="Email" value="<?= isset($row['Email']) ? htmlspecialchars($row['Email']) : ''; ?>" required>

    <label for="Pocet_osob">Počet osob:</label>
    <input type="number" name="Pocet_osob" min="0" required>

    <label for="Datum">Datum:</label>
    <input type="date" name="Datum" value="<?= isset($row['Datum']) ? $row['Datum'] : ''; ?>" required>

    <label for="Cas">Čas:</label>
    <input type="time" name="Cas" value="<?= isset($row['Cas']) ? $row['Cas'] : ''; ?>" required>

    <input type="submit" name="Rezervovat" value="Nová rezervace">
    <input type="submit" name="UpdateReservation" value="Aktualizovat rezervaci">
</form>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

include "conn.php"; // Připojení k databázi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Rezervovat"]) || isset($_POST["UpdateReservation"])) {
        $jmeno = mysqli_real_escape_string($conn, htmlspecialchars($_POST["Jmeno"]));
        $telefon = mysqli_real_escape_string($conn, htmlspecialchars($_POST["Telefon"]));
        $email = mysqli_real_escape_string($conn, htmlspecialchars($_POST["Email"]));
        $pocet_osob = intval($_POST["Pocet_osob"]);
        $datum = $_POST["Datum"];
        $cas = $_POST["Cas"];

        // Další bezpečnostní opatření: Validace telefonního čísla
        if (!preg_match("/^\d{9,14}$/", $telefon)) {
            echo "Chyba: Neplatné telefonní číslo!";
            exit;
        }

        // Konfigurace PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '777167f4dc47cf';
            $mail->Password = '3ec490f771ef3b'; // Změňte na skutečné heslo SMTP
            $mail->SMTPSecure = 'Smtp';
            $mail->Port = 2525;
                  
            //Odesílatel
            $mail->setFrom('lenkalaznovska@seznam.cz', 'Lenka Lážnovská');

            //Přidání příjemce
            $mail->addAddress($email, $jmeno);

            //Vlastnosti e-mailu
            $mail->isHTML(true);
            $mail->Subject = 'Potvrzeni rezervace';

            // Tělo e-mailu s informacemi o rezervaci
            $mail->Body = "Vase rezervace byla uspesne provedena.<br>";
            $mail->Body .= "Jmeno: $jmeno<br>";
            $mail->Body .= "Telefon: $telefon<br>";
            $mail->Body .= "E-mail: $email<br>";
            $mail->Body .= "Pocet osob: $pocet_osob<br>";
            $mail->Body .= "Datum: $datum<br>";
            $mail->Body .= "Cas: $cas<br>";
            
            // Pokud se jedná o novou rezervaci
            if (isset($_POST["Rezervovat"])) {
                // Kontrola existence záznamu na stejný den
                $check_sql = "SELECT * FROM rezervace WHERE Telefon = ? AND Datum = ?";
                $check_stmt = mysqli_prepare($conn, $check_sql);
                mysqli_stmt_bind_param($check_stmt, "ss", $telefon, $datum);
                mysqli_stmt_execute($check_stmt);
                $result = mysqli_stmt_get_result($check_stmt);

                if ($existing_row = mysqli_fetch_assoc($result)) {
                    // Záznam již existuje na stejný den

                    mysqli_stmt_close($check_stmt);
                    mysqli_close($conn);
                    exit; // Ukončíme skript, aby nedošlo k vložení nové rezervace
                }

                mysqli_stmt_close($check_stmt);

                // Záznam neexistuje na stejný den, provede se vložení
                $insert_sql = "INSERT INTO rezervace (Jmeno, Telefon, Email, Pocet_osob, Datum, Cas) VALUES (?, ?, ?, ?, ?, ?)";
                $insert_stmt = mysqli_prepare($conn, $insert_sql);

                // Při úspěchu provedení dotazu
                if ($insert_stmt) {
                    mysqli_stmt_bind_param($insert_stmt, "ssssss", $jmeno, $telefon, $email, $pocet_osob, $datum, $cas);
                    $success = mysqli_stmt_execute($insert_stmt);
                    mysqli_stmt_close($insert_stmt);

                    if ($success) {
                        // Odešle e-mail potvrzení
                        $mail->send();
                        echo "Rezervace byla úspěšně provedena!";
                    } else {
                        echo "Chyba při provedení rezervace: " . mysqli_error($conn);
                    }
                } else {
                    echo "Chyba při přípravě dotazu: " . mysqli_error($conn);
                }
            }

            // Pokud se jedná o aktualizaci rezervace
            if (isset($_POST["UpdateReservation"])) {
                // Aktualizace záznamu pouze pokud je datum v databázi jiné než nově zadané datum
                $check_sql = "SELECT Datum FROM rezervace WHERE Telefon = ? AND Datum = ?";
                $check_stmt = mysqli_prepare($conn, $check_sql);
                mysqli_stmt_bind_param($check_stmt, "ss", $telefon, $datum);
                mysqli_stmt_execute($check_stmt);
                $result = mysqli_stmt_get_result($check_stmt);

                if ($existing_row = mysqli_fetch_assoc($result)) {
                    // Datum se liší, provedeme aktualizaci
                    $update_sql = "UPDATE rezervace SET Jmeno = ?, Email = ?, Pocet_osob = ?, Datum = ?, Cas = ? WHERE Telefon = ? AND Datum = ?";
                    $update_stmt = mysqli_prepare($conn, $update_sql);

                    // Při úspěchu provedení dotazu
                    if ($update_stmt) {
                        mysqli_stmt_bind_param($update_stmt, "ssissss", $jmeno, $email, $pocet_osob, $datum, $cas, $telefon, $datum);
                        $success = mysqli_stmt_execute($update_stmt);
                        mysqli_stmt_close($update_stmt);

                        if ($success) {
                            // Odešle e-mail potvrzení
                            $mail->send();
                            echo '<div class="update-message">Záznam byl úspěšně aktualizován!</div>';
                        } else {
                            echo "Chyba při provedení dotazu: " . mysqli_error($conn);
                        }
                    } else {
                        echo "Chyba při přípravě dotazu: " . mysqli_error($conn);
                    }
                } else {
                    echo "Chyba při provedení dotazu: " . mysqli_error($conn);
                }

                mysqli_stmt_close($check_stmt);
            }
        } catch (Exception $e) {
            echo "E-mail se nepodařilo odeslat. Chyba: {$mail->ErrorInfo}";
        }
    }
}

mysqli_close($conn);
?>

</body>

<footer>
    <!-- Chat Tawk.to -->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/65dcd4538d261e1b5f65849b/1hnj9qq2j';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
</footer>

</html>