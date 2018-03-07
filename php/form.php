<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $naam_praktijk = $_POST['naam_praktijk'];
        $plaats_praktijk = $_POST['plaats_praktijk'];
        $telefoonnummer = $_POST['telefoonnummer'];
        $emailadres = $_POST['emailadres'];
        $opmerking = $_POST['opmerking'];
        if ($_POST['check-information'] != '') {
          $information = 'Ik wil graag meer informatie ontvangen over myopie management in de praktijk';
        };
        if ($_POST['check-seminar'] != '') {
          $seminar = 'Ik ben geïnteresseerd in een Myopie Management seminar';
        };
        if ($_POST['check-accountmanager'] != '') {
          $accountmanager = 'Ik wil graag een afspraak inplannen met mijn Procornea Accountmanager';
        };
        if ($_POST['check-belafspraak'] != '') {
          $belafspraak = 'Graag plan ik een belafspraak in met de Helpdesk van Procornea';
        };

        // Check that data was sent to the mailer.
        if ( !filter_var($emailadres, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Er is iets fout gegaan met het verzenden. Probeer later opnieuw.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = $emailadres;

        // Set the email subject.
        $subject = "Uw inschrijving op ikkijkverder.nl";

        // Build the email content.
        $email_content = '<html><body>';
        $email_content .= "Voornaam: $voornaam</br>";
        $email_content .= "Achternaam: $achternaam</br>";
        $email_content .= "Naam praktijk: $naam_praktijk</br>";
        $email_content .= "Plaats praktijk: $plaats_praktijk</br>";
        $email_content .= "Telefoonnummer: $telefoonnummer</br>";
        $email_content .= "Emailadres: $emailadres</br>";
        $email_content .= "Opmerking: $opmerking</br>";
        $email_content .= '<ul>';
        $email_content .= '<li>' .$information. '</li>';
        $email_content .= '<li>' .$seminar. '</li>';
        $email_content .= '<li>' .$accountmanager. '</li>';
        $email_content .= '<li>' .$belafspraak. '</li>';
        $email_content .= '</ul>';
        $email_content .= '</html></body>';

        // Build the email headers.
        $email_headers = "From: Procornea <info@procornea.nl>\n";
        $email_headers .= "Content-Type: text/html; charset=iso-8859-1\n";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Bedankt! Uw inschrijving is geregistreerd.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Er is iets fout gegaan met het verzenden. Probeer later opnieuw.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Er is iets fout gegaan met het verzenden. Probeer later opnieuw.";
    }

?>