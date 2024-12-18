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
    <link rel="stylesheet" type="text/css" href="../public/css/styles.css">
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
<nav class="navbar navbar-light pt-3 pb-2 fixed-top">
    <div class="container">
        <div class="d-flex w-100 justify-content-between align-items-center">
            <h2 class="title">KUD Pay</h2>
            <div class="d-flex align-items-center">
                <h4 class="mb-0 me-3">
                    Welcome, <?php echo $admin['nama']; ?>
                </h4>
                <a href="<?php echo BASEURL; ?>/admin/logout" class="btn btn-danger btn-md mx-2">Logout </a>
            </div>
        </div>
    </div>
</nav>

<style>
    @media (min-width: 1400px) {
        .container{
            max-width: 1380px;
        }
    }
    .navbar {
        border-bottom: 1px solid rgba(128, 128, 128, 0.5);
        background:  #F9FAFB;
    }
    .fixed-top {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030; /* Ensure it stays above other content */
    }
    body {
        font-family: "Plus Jakarta Sans";
        background:  #F9FAFB;
        padding-top: 75px;
        color: #374151;
    }
    .title {
        font-weight: 600;
        color:  #FF7C0A;
        font-size: 35px;
    }
    .outline-grey {
        border-radius: 18px; /* Rounded corners */
        padding: 10px; /* Space inside the outline */
        box-shadow: 0px 12px 16px -4px rgba(15, 23, 42, 0.08);
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
    }
    .titleCard {
        color: #111827;
        font-size: 30px;
        font-style: normal;
        font-weight: 600;
        line-height: 40px; /* 160% */
        letter-spacing: -0.5px;
    }
    .btn-primary {
        background-color: rgba(20, 184, 166, 1); /* Change background color to orange */
        border-color: rgba(20, 184, 166, 1); /* Change border color to orange */
        border-radius: 13px;
    }
    .btn-primary:hover {
        background-color: rgba(17, 94, 89, 1); /* Change background color on hover */
        border-color: rgba(17, 94, 89, 1); /* Change border color on hover */
        border-radius: 13px;
    }
    .btn-danger {
        background-color: rgb(122, 5, 0); /* Change background color to orange */
        border-color: rgb(122, 5, 0); /* Change border color to orange */
        border-radius: 13px;
    }
    .btn-primary:hover {
        background-color: rgb(95, 13, 10); /* Change background color on hover */
        border-color: rgb(95, 13, 10); /* Change border color on hover */
        border-radius: 13px;
    }


</style>

