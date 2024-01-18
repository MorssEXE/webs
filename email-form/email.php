<?php
mb_internal_encoding("UTF-8");
$hlaska = '';


if (isset($_POST['jmeno']))
    $jmeno = $_POST['jmeno'];
else
    $jmeno = '';

if (isset($_POST['prijmeni']))
    $prijmeni = $_POST['prijmeni'];
else
    $prijmeni = '';

if (isset($_POST['email']))
    $email = $_POST['email'];
else
    $email = '';

if (isset($_POST['info']))
    $info = $_POST['info'];
else
    $info = '';

if ($_POST) {
    if (
        isset($_POST['jmeno']) && $_POST['jmeno'] &&
        isset($_POST['prijmeni']) && $_POST['prijmeni'] &&
        isset($_POST['email']) && $_POST['email'] &&
        isset($_POST['info']) && $_POST['info']
    ) {
        $adresa = "danko.tomis@seznam.cz";
        $hlavicka = "From" . $_POST["email"];
        $hlavicka .= "\nMIME-Version: 1.0\n";
        $hlavicka .= "Content-Type: text/html; charset=\"utf-8\"\n";

        $overeni = mb_send_mail($adresa, $_POST["dotaz"], $_POST["info"], $hlavicka);
        if ($overeni) {
            $hlaska = "Vážený/a " . $_POST["jmeno"] . " " .
                $_POST["prijmeni"] . ", Váš e-mail byl odeslán";
        } else {
            $hlaska = "Vážený/a " . $_POST["jmeno"] . " " .
                $_POST["prijmeni"] . ", Váš e-mail se nepodařilo poslat";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomis e-mail</title>
    <link href='styles.css' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="container">
        <form action="" method="POST" class="form">
            <div class="form-group">
                <label for="jmeno">Jméno:</label>
                <input type="text" id="jmeno" name="jmeno" value="<?php echo htmlspecialchars($jmeno) ?>">
            </div>
            <div class="form-group">
                <label for="prijmeni">Příjmení:</label>
                <input type="text" id="prijmeni" name="prijmeni" value="<?php echo htmlspecialchars($prijmeni) ?>">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
            </div>

            <div class="form-group">
                <label for="info">Vzkaz</label>
                <textarea id="info" name="info" placeholder="Zde napište vzkaz"></textarea>
            </div>

            <div class="form-group">
                <label for="dotaz">Druh dotazů:</label>
                <select name="dotaz" id="dotaz">
                    <optgroup label="Připomínka">
                        <option value="obsah">Připomínka k obsahu</option>
                        <option value="design">Připomínka k designu</option>
                    </optgroup>
                    <optgroup label="Informace">
                        <option value="zadost">Žádost o informaci</option>
                        <option value="nabidka">Nabídka informace</option>
                    </optgroup>
                </select>
            </div>

            <input type="submit" name="odeslat" value="Odeslat" class="submit-button">
        </form>
        <div class="message-div">
            <?php
            if ($hlaska) {
                $messageClass = $overeni ? 'success-message' : 'failure-message';
                echo ('<p class="message ' . $messageClass . '">' . htmlspecialchars($hlaska) . '</p>');
            }
            ?>
        </div>
    </div>
</body>


</html>