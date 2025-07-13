<?php
session_start();
$filename = $_SESSION['f'];
$contenuto = $_SESSION['c'];

// Function to get MIME type
function getMimeType($filename) {
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $mimeTypes = [
        'txt' => 'text/plain',
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'xls' => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'zip' => 'application/zip',
        'mp4' => 'video/mp4',
        'mp3' => 'audio/mpeg',
        // Add more MIME types as needed
    ];

    return isset($mimeTypes[$ext]) ? $mimeTypes[$ext] : 'application/octet-stream';
}

// Set headers for file download
header("Pragma: public");
header("Pragma: no-cache");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Expires: 0");

// Set the correct content type based on file extension
$mimeType = getMimeType($filename);
header("Content-Type: " . $mimeType);
header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
header("Content-Length: " . strlen($contenuto));

// Output the decrypted content
echo $contenuto;
die();
?>
