<?php

// PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require __DIR__ . '/phpmailer/PHPMailer-master/src/Exception.php';
require __DIR__ . '/phpmailer/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/phpmailer/PHPMailer-master/src/SMTP.php';

$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form values
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');
    $comment = trim($_POST['comment'] ?? '');

    if ($name === '') {
        $errors[] = 'U moet nog een naam invullen.';
    }

    if ($email === '') {
        $errors[] = 'U moet nog een emailadres invullen.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Het emailadres is niet geldig.';
    }

    if ($phone_number === '') {
        $errors[] = 'U moet nog een telefoonnummer invullen.';
    } elseif (strlen($phone_number) > 20) {
        $errors[] = 'Het telefoonnummer is te lang.';
    }

    if ($comment === '') {
        $errors[] = 'U heeft geen bericht gemaakt om te verzenden.';
    }

    if (empty($errors)) {

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'danielleruwaard8@gmail.com';
            $mail->Password = 'vlpf tefl dbeb kumg';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom(
                'danielleruwaard8@gmail.com',
                'Operative Natuur Tracker'
            );

            $mail->addAddress(
                'danielleruwaard8@gmail.com',
                'Daniëlle Ruwaard'
            );

            $mail->addReplyTo(
                $email,
                $name
            );

            $mail->isHTML(true);

            $mail->Subject = 'Nieuwe melding';

            // HTML version
            $mail->Body = '
                <p>
                    <strong>Naam:</strong><br>
                    ' . htmlspecialchars($name) . '
                </p>

                <p>
                    <strong>Email:</strong><br>
                    ' . htmlspecialchars($email) . '
                </p>

                <p>
                    <strong>Telefoonnummer:</strong><br>
                    ' . htmlspecialchars($phone_number) . '
                </p>

                <p>
                    <strong>Melding:</strong><br>
                    ' . nl2br(htmlspecialchars($comment)) . '
                </p>
            ';

            $mail->AltBody =
                "Nieuwe melding\n\n" .
                "Naam: " . $name . "\n" .
                "Email: " . $email . "\n" .
                "Telefoonnummer: " . $phone_number . "\n\n" .
                "Melding:\n" .
                $comment;

            $mail->send();

            $success = 'Melding succesvol verstuurd!';

            header('Location: /?success=email');
        } catch (Exception $e) {

            $errors[] = 'De email kon niet worden verzonden. Probeer het later opnieuw.';
            // $errors[] = $mail->ErrorInfo;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/report.css">
    <title>Operative Natuur Tracker</title>
</head>

<body>
<div class="app-frame">
    <header class="hero">
        <div class="top-button">
            <a href="Index.php">
                <img src="/images/back.png" alt="Terug knop" style="width:42px;height:42px;">
            </a>
        </div>

        <div class="top-button">
            <a href="sos.html">
                <img src="/images/SOS.png" alt="SOS knop" style="width:42px;height:42px;">
            </a>
        </div>
    </header>

    <main>
        <?php if ($success): ?>
            <div class="success-message">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p>
                        <?= htmlspecialchars($error) ?>
                    </p
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <section class="md:max-w-[1000px] md:m-auto">
            <div class="font-bold text-xl">
                Melding maken
            </div>

            <form method="post">
                <div class="md:flex md:justify-between md:grid md:grid-cols-3 gap-6">
                    <div>
                        <label for="name">
                            Naam*
                        </label>

                        <input
                                type="text"
                                id="name"
                                name="name"
                                required
                                class="bg-white rounded-md"
                                value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                        >
                    </div>

                    <div>
                        <label for="email">
                            Email*
                        </label>

                        <input
                                type="email"
                                id="email"
                                name="email"
                                required
                                class="bg-white rounded-md"
                                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        >
                    </div>

                    <div>
                        <label for="phone_number">
                            Telefoonnummer*
                        </label>

                        <input
                                type="tel"
                                name="phone_number"
                                id="phone_number"
                                required
                                class="bg-white rounded-md"
                                value="<?= htmlspecialchars($_POST['phone_number'] ?? '') ?>"
                        >
                    </div>
                </div>

                <div class="flex flex-col">

                    <label for="comment">
                        Uw melding*
                    </label>

                    <textarea
                            class="bg-white rounded-md"
                            name="comment"
                            id="comment"
                            required
                            cols="30"
                            rows="10"
                    ><?= htmlspecialchars($_POST['comment'] ?? '') ?></textarea>
                </div>

                <div class="grid col-span-1 col-start-3">
                    <button
                            class="cta-button font-normal bg-white rounded-md flex justify-center p-1"
                            type="submit"
                    >
                        Verzenden
                    </button>
                </div>
            </form>
        </section>
    </main>
</div>
</body>
</html>




