<div class="container card_buatVoucher bg-grey text-black p-5 rounded">
  <div class="row">
    <div class="col-lg-6">
      <?php flasher::flash() ?>
    </div>
  </div>

  
  <h1 class="display1 text-center">Buat Voucher</h1>
  <form class="buatVoucher">
    <div class="mb-3">
      <label for="InputidKartu" class="form-label">ID Kartu</label>
      <input
        type="text"
        class="form-control form-control-lg"
        id="InputidKartu"
        placeholder="Masukan ID Kartu"
      />
    </div>
    <div class="mb-3">
      <label for="InputNama" class="form-label">Nama</label>
      <input
        type="text"
        class="form-control form-control-lg"
        id="InputNama"
        placeholder="Masukan Nama"
      />
    </div>
    <div class="mb-3">
      <label for="InputAlamat" class="form-label">Alamat</label>
      <input
        type="text"
        class="form-control form-control-lg"
        id="InputAlamat"
        placeholder="Alamat Tinggal"
      />
    </div>
    <div class="d-grid mt-5">
      <button type="button" class="btn btn-primary btn-lg" id="openModalButton" disabled>Buat Voucher</button>
      <br>
      <a href="<?php echo BASEURL;?>/Admin" class="btn btn-secondary btn-lg" role="button">Kembali</a>
    </div>
  </form>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="judulModal">Buat Voucher</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo BASEURL;?>/customer/buat_voucher" method="post">
          <div class="mb-3">
            <label for="idKartu" class="form-label">ID Kartu</label>
            <p id="idKartu">1234567</p>
            <input type="hidden" id="hiddenidKartu" name="idKartu" />
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <p id="nama">contoh</p>
            <input type="hidden" id="hiddenNama" name="nama" />
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <p id="alamat">contoh</p>
            <input type="hidden" id="hiddenAlamat" name="alamat" />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">password</label>
            <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" aria-describedby="emailHelp" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Buat Voucher</button>
      </form>
    </div>
  </div>
</div>

// script
<script>
  const namaInput = document.getElementById('InputNama');
  const openModalButton = document.getElementById('openModalButton');

  namaInput.addEventListener('input', function () {
    if (namaInput.value.trim() !== '') {
      openModalButton.removeAttribute('disabled');
    } else {
      openModalButton.setAttribute('disabled', 'true');
    }
  });

  document.getElementById('openModalButton').addEventListener('click', function () {
    // Ambil nilai dari form utama
    const nama = document.getElementById('InputNama').value;
    const alamat = document.getElementById('InputAlamat').value;
    const idKartu = document.getElementById('InputidKartu').value;

    if (nama === '' || alamat === '' || idKartu === '') {
      alert('Id Kartu, Nama dan Alamat harus diisi!');
      return; // Menghentikan eksekusi lebih lanjut jika ada yang belum terisi
    } else {
      // Isi nilai ke dalam modal
      document.getElementById('nama').textContent = nama;
      document.getElementById('alamat').textContent = alamat;
      document.getElementById('idKartu').textContent = idKartu;

      // Masukkan nilai ke input hidden
      document.getElementById('hiddenNama').value = nama;
      document.getElementById('hiddenAlamat').value = alamat;
      document.getElementById('hiddenidKartu').value = idKartu;

      // Buka modal
      const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
      modal.show();
      
    }
  });



</script>
