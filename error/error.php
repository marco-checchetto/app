<?php
$error_code = $_SERVER['REDIRECT_STATUS'];
$error_name = get_error_name($error_code);

function get_error_name($error_code) {
    $error_names = array(
        // Codici di errore HTTP della categoria 100
        100 => "Continue",
        101 => "Switching Protocols",
        102 => "Processing",
        
        // Codici di errore HTTP della categoria 200
        200 => "OK",
        201 => "Created",
        202 => "Accepted",
        203 => "Non-Authoritative Information",
        204 => "No Content",
        205 => "Reset Content",
        206 => "Partial Content",
        207 => "Multi-Status",
        
        // Codici di errore HTTP della categoria 300
        300 => "Multiple Choices",
        301 => "Moved Permanently",
        302 => "Found",
        303 => "See Other",
        304 => "Not Modified",
        305 => "Use Proxy",
        307 => "Temporary Redirect",
        308 => "Permanent Redirect",
        
        // Codici di errore HTTP della categoria 400
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        406 => "Not Acceptable",
        407 => "Proxy Authentication Required",
        408 => "Request Timeout",
        409 => "Conflict",
        410 => "Gone",
        411 => "Length Required",
        412 => "Precondition Failed",
        413 => "Payload Too Large",
        414 => "URI Too Long",
        415 => "Unsupported Media Type",
        416 => "Range Not Satisfiable",
        417 => "Expectation Failed",
        418 => "I'm a Teapot",
        421 => "Misdirected Request",
        422 => "Unprocessable Entity",
        423 => "Locked",
        424 => "Failed Dependency",
        426 => "Upgrade Required",
        428 => "Precondition Required",
        429 => "Too Many Requests",
        431 => "Request Header Fields Too Large",
        451 => "Unavailable For Legal Reasons",
        
        // Codici di errore HTTP della categoria 500
        500 => "Internal Server Error",
        501 => "Not Implemented",
        502 => "Bad Gateway",
        503 => "Service Unavailable",
        504 => "Gateway Timeout",
        505 => "HTTP Version Not Supported",
        506 => "Variant Also Negotiates",
        507 => "Insufficient Storage",
        508 => "Loop Detected",
        510 => "Not Extended",
        511 => "Network Authentication Required"
    );
    
    return isset($error_names[$error_code]) ? $error_names[$error_code] : "Unknown";
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <title>Error <?php echo "$error_code"; ?> | Museo IIS Falcone Righi</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/app/img/icon/favicon.png" type="image/x-icon">
    <link rel="icon" href="/app/img/icon/favicon.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="/app/css/error.css">
</head>

<body>
    <div class="error">
        <p class="code">ERROR <i class="num"><?php echo "$error_code"; ?></i></p>
        <p class="text"><?php echo "$error_name"; ?></p>
        <a class="return" href="http://192.168.1.20/app/chat">Return to site</a>
    </div>
</body>

</html>