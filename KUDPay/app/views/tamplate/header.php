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

<nav class="navbar navbar-light bg-warning pt-4 pb-3">
    <div class="container d-flex justify-content-between align-items-center">
      <h1>KUD Pay</h1>
        <form class="d-flex">
            <a href="<?php echo BASEURL;?>/Login" class="btn btn-primary me-2" role="button">Login</a>
            <a href="<?php echo BASEURL; ?>/customer" class="btn btn-primary me-2" role="button">Layanan Customer</a>
        </form>
    </div>
</nav>