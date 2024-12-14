<div class="container">
    <form action="<?php echo BASEURL;?>/Admin/cari_transaksi" method="post">
        <div class="mb-3">
            <label for="keyword" class="form-label fs-6 fw-medium">Cari Transaksi</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari transaksi" name="keyword" id="keyword" autocomplete="off">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
        </div>
        <div class="mb-3">
            <label for="tglAwal" class="form-label fs-6 fw-medium">Periode Transaksi</label>
            <div class="input-group mb-3">
                <input name="tglAwal" id="tglAwal" type="date" class="form-control" value="<?php echo $awalTgl; ?>" size="10" /> 
                <input name="tglAkhir" id="tglAkhir" type="date" class="form-control" value="<?php echo  $akhirTgl; ?>" size="10" />
                <input name="btnTampil" class="btn btn-primary" type="submit" value="Tampilkan" />
            </div>
        </div>
    </form>
    <form action="<?php echo BASEURL;?>/Admin/riwayat_transaksi" method="post">
        <div class="input-group mb-3">
            <button class="btn btn-primary" type="submit" id="Cari">Hapus filter</button>
        </div>
    </form>
</div>

<div class="container p-4">
    <table class="table table-hover" id="tableRiwayatTransaksi">
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
        <?php foreach($data['riwayat_transaksi'] as $riwayat_transaksi) : ?>
        <tr>
        <td><?php echo $riwayat_transaksi['idTransaksi'];?></td>
        <td><?php echo $riwayat_transaksi['customer'];?></td>
        <td><?php echo $riwayat_transaksi['admin'];?></td>
        <td><?php echo $riwayat_transaksi['jenisTransaksi'];?></td>
        <td><?php echo $riwayat_transaksi['nominalTransaksi'];?></td>
        <td><?php echo $riwayat_transaksi['waktuTransaksi'];?></td>
        </tr>
        <?php endforeach?>
    </tbody>
    </table>
    <div class="text-end">
        <button class="btn btn-secondary" onclick="cetakRiwayatTransaksi()">Cetak</button>
    </div>
</div>

<!-- JavaScript untuk fungsi cetak -->
<script>
    function cetakRiwayatTransaksi() {
        const originalContent = document.body.innerHTML; // Simpan konten asli halaman
        const printContent = document.getElementById('tableRiwayatTransaksi').outerHTML; // Ambil tabel transaksi
        const rows = document.querySelectorAll('#tableRiwayatTransaksi tbody tr'); // Ambil semua baris di tabel transaksi
        let totalNominal = 0;
        
        rows.forEach(row => {
            const nominal = parseFloat(row.cells[4].textContent.replace('Rp', '').replace('.', '')); // Mengambil nilai nominal dari setiap baris dan menghilangkan simbol mata uang dan tanda titik
            totalNominal += nominal; // Menambahkan ke total nominal
        });
        
        document.body.innerHTML = `
            <html>
                <head>
                    <title>Cetak Riwayat Transaksi</title>
                    <style>
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        table, th, td {
                            border: 1px solid black;
                        }
                        th, td {
                            padding: 8px;
                            text-align: left;
                        }
                    </style>
                </head>
                <body>
                    <h2>Riwayat Transaksi</h2>
                    ${printContent}
                    <p>Total Nominal Transaksi: Rp ${totalNominal.toLocaleString()}</p> <!-- Menampilkan total nominal transaksi -->
                </body>
            </html>
        `;
        window.print(); // Cetak halaman
        document.body.innerHTML = originalContent; // Kembalikan ke konten asli
        location.reload(); // Reload halaman untuk memastikan script dan event tetap aktif
    }
</script>
