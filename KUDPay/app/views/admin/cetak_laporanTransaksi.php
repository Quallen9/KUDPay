<?php 

$Sqlperiode = '';
$awalTgl = '';
$akhirTgl = '';
$tglAwal = '';
$tglAkhir = '';
$customerId = ''; // New variable for customer ID

if (isset($_POST['btnTampil'])) {
    $tglAwal = isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "";
    $tglAkhir = isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : "";
    $customerId = isset($_POST['txtCustomerId']) ? $_POST['txtCustomerId'] : ""; // Get customer ID

    // Check if both dates are provided
    if (!empty($tglAwal) && !empty($tglAkhir)) {
        $Sqlperiode = " WHERE waktuTransaksi BETWEEN '".$tglAwal."' AND '".$tglAkhir."'";
    }

    // Check if customer ID is provided
    if (!empty($customerId)) {
        $Sqlperiode .= !empty($Sqlperiode) ? " AND " : " WHERE ";
        $Sqlperiode .= " customer = '".$customerId."'";
    }

    if (empty($tglAwal) && empty($tglAkhir) && empty($customerId)) {
        // If no filters are provided, set to show all data
        $Sqlperiode = ""; // No WHERE clause
        $awalTgl = "01-".date('m-Y');
        $akhirTgl = date('d-m-Y');
    }
} else {
    $awalTgl = "01-".date('m-Y');
    $akhirTgl = date('d-m-Y');
    $Sqlperiode = ""; // No WHERE clause
}

$host = 'localhost'; // Ganti dengan host database Anda
$user = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda
$database = 'KUDPay'; // Ganti dengan nama database Anda

// Membuat koneksi
$mysqli = new mysqli($host, $user, $password, $database);

// Memeriksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$sql = "SELECT * FROM riwayat_transaksi $Sqlperiode";
$myQry = mysqli_query($mysqli, $sql) or die("Query Salah: " . mysqli_error($mysqli));

// Hitung total nominal
?>

<main class="page">
    <div class="container">
        <?php if ($tglAwal) {?>
            <h4>Periode Tanggal <b><?php echo ($tglAwal);?></b> s/d <b><?php echo ($tglAkhir);?></b></h4> 
        <?php } else {?> 
            <h4>Menampilkan Semua Periode Transaksi</h4>
        <?php } ?>
    </div>
    <div class="container">
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" target="sel">
            <div class="mb-3">
                <label for="tglAwal" class="form-label fs-6 fw-medium">Periode Transaksi</label>
                <div class="input-group mb-3">
                    <input type="date" name="txtTglAwal" class="form-control" value="<?php echo $awalTgl;?>" size="10">
                    <input type="date" name="txtTglAkhir" class="form-control" value="<?php echo $akhirTgl;?>" size="10">
                    <input type="text" name="txtCustomerId" class="form-control" placeholder="ID Customer" value="<?php echo $customerId; ?>">
                    <input type="submit" name="btnTampil" class="btn btn-primary" value="Tampilkan">
                </div>
            </div>
            <div class="mb-3">
            <div class="text-end">
                <a class="btn btn-primary" onclick="cetakRiwayatTransaksi()">Cetak</a>
            </div>
            </div>
        </form>
    </div>
    <div class="container p-4">
        <table class="table table-hover" id="dataTable">
        <thead>
            <tr>
            <th scope="col">ID Transaksi</th>
            <th scope="col">Nama Customer</th>
            <th scope="col">Admin</th>
            <th scope="col">Jenis</th>
            <th scope="col">Nominal</th>
            <th scope="col">Waktu Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalNominal = 0; // Inisialisasi total nominal
            while ($myData = mysqli_fetch_array($myQry)) {
                $totalNominal += $myData['nominalTransaksi'];
            ?>
            <tr>
                <td><?php echo $myData['idTransaksi']; ?></td>
                <td><?php echo $myData['customer']; ?></td>
                <td><?php echo $myData['admin']; ?></td>
                <td><?php echo $myData['jenisTransaksi']; ?></td>
                <td><?php echo $myData['nominalTransaksi']; ?></td>
                <td><?php echo $myData['waktuTransaksi']; ?></td>
            </tr> 
            <?php 
            }                   
            ?>  
            </tbody>
        </table>


    </div>
</main>

<script>
    let originalContent = document.body.innerHTML; // Simpan konten asli

    function cetakRiwayatTransaksi(){
        const printContent = document.getElementById('dataTable').outerHTML;
        const totalNominal = <?php echo $totalNominal; ?>; // Ambil total nominal dari PHP
        const periodeTampil = "<?php echo $tglAwal ? $tglAwal . ' s/d ' . $tglAkhir : 'Semua Periode Transaksi'; ?>"; // Definisikan periodeTampil

        document.body.innerHTML = `
            <html>
                <head>
                    <title>Cetak Riwayat Transaksi</title>
                    <style>
                        body {
                            font-size : 12px;
                        }
                        .titlePrint {
                            font-size : 22px;
                        }
                        .periodePrint {
                            font-size:15px;
                        }
                        
                    </style>
                </head>
                <body>
                    <h2 class="titlePrint">Riwayat Transaksi</h2>
                    <p class="periodePrint"><strong>Periode:</strong> ${periodeTampil}</p>
                    ${printContent}
                    <p><strong>Total Nominal Transaksi:</strong> Rp ${totalNominal.toLocaleString('id-ID')}</p>
                </body>
            </html>
        `;

        window.print();
        document.body.innerHTML = originalContent; // Kembalikan ke halaman semula
        location.reload(); // Reload halaman untuk mendapatkan kembali konten asli
    }

</script>

<script>
    /*let originalContent = document.body.innerHTML; // Save original content

    function cetakRiwayatTransaksi() {
        const printContent = document.getElementById('dataTable').outerHTML;
        const totalNominal = <?php echo $totalNominal; ?>; // Get total nominal from PHP
        const periodeTampil = "<?php echo $tglAwal ? $tglAwal . ' s/d ' . $tglAkhir : 'Semua Periode Transaksi'; ?>"; // Define periodeTampil

        // Create a new window for printing
        const printWindow = window.open('', '_blank', 'width=800,height=600');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Cetak Riwayat Transaksi</title>
                </head>
                <body>
                    <h2>Riwayat Transaksi</h2>
                    <p class="fs-1"><strong>Periode:</strong> ${periodeTampil}</p>
                    ${printContent}
                    <p><strong>Total Nominal Transaksi:</strong> Rp ${totalNominal.toLocaleString('id-ID')}</p>
                </body>
            </html>
        `);
        printWindow.document.close(); // Close the document for writing
        printWindow.focus(); // Focus on the new window
        printWindow.print(); // Trigger the print dialog
        printWindow.close(); // Close the print window after printing
    }*/
</script>