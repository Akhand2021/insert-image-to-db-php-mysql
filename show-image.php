<?php
include "db.php";
$sql = "SELECT image_data, image_type FROM images";
$stmt = $conn->prepare($sql);
$stmt->execute();

$stmt->bind_result($imageData, $imageType);

while ($stmt->fetch()) {
    // Output image data length for debugging
    $imageSizeMB = strlen($imageData) / (1024 * 1024); // Convert from bytes to megabytes

    // Output image data size in MB
    echo "Image Size: " . number_format($imageSizeMB, 2) . " MB<br>";

    // Output the image MIME type for debugging
    echo "Image Type: $imageType<br>";

    // Output a 
    echo '<img src="data:image/png;base64,' . base64_encode($imageData) . '" style="max-width: 300px; max-height: 300px;">';

    // Add a separator between images (optional)
    echo '<hr>';
}

$stmt->close();
?>
