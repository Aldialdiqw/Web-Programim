<?php
function myErrorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
    // Krijimi i një mesazhi të formatuar për gabimin
    $errorMessage = "Gabim: [$errno] $errstr - në linjën $errline në skedarin $errfile" . PHP_EOL;
    $errorMessage .= "Konteksti: " . print_r($errcontext, true) . PHP_EOL;

    // Shkruaj gabimin në një skedar log
    error_log($errorMessage, 3, 'error_log.txt');

    // Shfaq një mesazh të personalizuar te përdoruesit (opsionale)
    if ($errno == E_USER_ERROR) {
        echo "<b>FATAL ERROR</b> [$errno] $errstr<br>\n";
        echo " Ndodhi në linjën $errline në skedarin $errfile";
        exit(1);
    }

    // Mos e ekzekuto trajtuesin PHP të gabimeve
    return true;
}

// Përcaktimi i funksionit të personalizuar për trajtimin e gabimeve
set_error_handler('myErrorHandler');
?>
