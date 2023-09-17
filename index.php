<?php
include "db.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // File upload handling
    $file_name = $_FILES["image"]["name"];
    $file_tmp = $_FILES["image"]["tmp_name"];
    $file_type = $_FILES["image"]["type"];

    $image_data = file_get_contents($file_tmp); // Read the image file into binary data

    // SQL query to insert the image into the database
    $sql = "INSERT INTO images (image_name, image_data, image_type) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $file_name, $image_data, $file_type);

    if ($stmt->execute()) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Image Upload</title>
    <!-- Include Bootstrap CSS via CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS styles */
        body {
            padding: 20px;
        }

        .container {
            max-width: 800px;

        }
        .card{
            display: flex;
            align-items: center;
        }
        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Upload an Image | ALgocodersmind</h2>
        <div class="card p-4">
                    <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Select an Image: </label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
            <a href="show-image.php" class="btn btn-secondary">Show Images</a>
        </form>
        </div>

    </div>

    <!-- Include Bootstrap JS and jQuery via CDN (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
