<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman <?php echo $data['judul']; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

</head>
<body>
<?php
// Check if session is started
if (!isset($_SESSION['user'])) {
    header("Location: " . BASEURL . "/login?error=invalid");
    exit;
}

// Retrieve admin data from session
$admin = $_SESSION['user'];
?>
<nav class="navbar navbar-light bg-warning pt-4 pb-3">
    <div class="container">
        <div class="d-flex w-100 justify-content-between align-items-center">
            <h2 class="mb-0">
                Welcome, <?php echo $admin['nama']; ?>
            </h2>
            <div>
                <a href="<?php echo BASEURL; ?>/admin" class="btn btn-secondary btn-md mx-2">Kembali</a>
            </div>
        </div>
    </div>    
</nav>

<div class="container">
    <h4 class="mt-4 mb-4"> Halaman <?php echo $data['judul']; ?></h4>   
</div>

