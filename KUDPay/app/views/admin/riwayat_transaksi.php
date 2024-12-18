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
                <input name="tglAwal" id="tglAwal" type="date" class="form-control" value="<?= isset($data['awalTgl']) ? $data['awalTgl'] : ''; ?>" size="10" /> 
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
    const originalContent = document.body.innerHTML; 
    const printContent = document.getElementById('tableRiwayatTransaksi').outerHTML; 
    
    // Ambil input tanggal
    const tglAwalInput = document.getElementById('tglAwal').value || ''; // Default ke kosong jika tidak ada
    const tglAkhirInput = document.getElementById('tglAkhir').value || ''; 
    
    // Format tanggal dalam format ID
    const formatTanggal = (dateString) => {
        if (!dateString) return null;
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
    };

    // Tentukan periode berdasarkan input
    let periodeTampil = 'Semua Periode';
    if (tglAwalInput && tglAkhirInput) {
        const tglAwalFormatted = formatTanggal(tglAwalInput);
        const tglAkhirFormatted = formatTanggal(tglAkhirInput);
        periodeTampil = `${tglAwalFormatted} - ${tglAkhirFormatted}`;
    }

    // Hitung total nominal
    let totalNominal = 0;
    const rows = document.querySelectorAll('#tableRiwayatTransaksi tbody tr');
    rows.forEach(row => {
        const nominalText = row.cells[4].textContent.replace(/\D/g, ''); // Ambil angka saja
        const nominal = parseFloat(nominalText) || 0;
        totalNominal += nominal;
    });

    // Template cetak
    document.body.innerHTML = `
        <html>
            <head>
                <title>Cetak Riwayat Transaksi</title>
            </head>
            <body>
                <h2>Riwayat Transaksi</h2>
                <p><strong>Periode:</strong> ${periodeTampil}</p>
                ${printContent}
                <p><strong>Total Nominal Transaksi:</strong> Rp ${totalNominal.toLocaleString('id-ID')}</p>
            </body>
        </html>
    `;

    window.print();
    document.body.innerHTML = originalContent; // Kembalikan ke halaman semula
    location.reload();
}

</script>

