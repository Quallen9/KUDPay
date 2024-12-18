<div class="container card_topUp bg-grey text-grey p-5 rounded">
  <h1>Cek Saldo</h1>
  <form class="cekSaldo" action="<?php echo BASEURL;?>/Customer/cek_saldo" method="post">
    <div class="mb-3 mt-3">
      <label for="InputIDKartu" class="form-label">ID Kartu</label>
      <input
        type="text"
        class="form-control form-control-lg"
        id="InputIDKartu"
        name="InputIDKartu"
        placeholder="Masukkan ID Kartu"
        autocomplete="off"
      />
    </div>
    <div class="d-grid mt-5">
      <button type="submit" class="btn btn-primary btn-lg" id="tombolCari" disabled>Cek Saldo</button>
      <br>
      <a href="<?php echo BASEURL;?>/Customer" class="btn btn-secondary btn-lg" role="button">Kembali</a>
    </div>
  </form>
</div>

<!-- Modal -->
<div class="modal fade" id="cekSaldoModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="judulModal">Saldo KUD Pay</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="mb-3">
            <label for="idKartu" class="form-label">ID Kartu</label>
            <p id="idKartu"><?php echo $data['customer']['idKartu']?></p>
            <input type="hidden" id="idKartu" name="idKartu" value="<?php echo $data['customer']['idKartu']?>" />
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <p id="nama"><?php echo $data['customer']['nama']?></p>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <p id="alamat"><?php echo $data['customer']['alamat']?></p>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Jumlah Voucher</label>
            <p id="alamat"><?php echo $data['customer']['voucher']?></p>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Jumlah Saldo</label>
            <p id="alamat"><?php echo $data['customer']['saldo']?></p>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Jumlah</label>
            <p id="alamat"><?php echo ($data['customer']['saldo']+($data['customer']['voucher']))?></p>
          </div>
      </div>
      <div class="modal-footer">
        <a href="<?php echo BASEURL;?>/Customer" class="btn btn-secondary" role="button">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</div>

<!--script-->

<script>
  const inputIDKartu = document.getElementById('InputIDKartu');
  const tombolCari = document.getElementById('tombolCari');


  const expectedLengthForID = 15;

  inputIDKartu.addEventListener('input', function () {
    if (inputIDKartu.value.trim() !== '' && inputIDKartu.value.length === expectedLengthForID) {
      tombolCari.removeAttribute('disabled');
    } else {
      tombolCari.setAttribute('disabled', 'true');
    }
  });

  document.addEventListener("DOMContentLoaded", function () {
    // Cek apakah data customer tersedia
    <?php if (isset($data['customer'])) : ?>
      var modal = new bootstrap.Modal(document.getElementById("cekSaldoModal"));
      modal.show();
    <?php endif;?>
  });
  </script>
