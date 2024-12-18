<div class="container px-4 py-5" id="hanging-icons">
  <div class="row">
    <div class="col-lg-6">
      <?php flasher::flash() ?>
    </div>
  </div>
  <h1>Top Up Saldo</h1>
  <form class="topUp" action="<?php echo BASEURL;?>/Admin/topUp_saldo" method="post">
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
      <button type="submit" class="btn btn-primary btn-lg" id="tombolCari" disabled>Top Up</button>
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
        <h1 class="modal-title fs-5" id="judulModal">Top Up Saldo Voucher</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo BASEURL;?>/customer/topUp_saldo" method="post">
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
            <label for="jumlahVoucher" class="form-label">Jumlah Voucher</label>
            <p id="jumlahVoucher"><?php echo $data['customer']['voucher']?>
            (<?php echo terbilang($data['customer']['voucher'])?>)</p>
            
          </div>
          <div class="mb-3">
            <label for="jumlahSaldo" class="form-label">Jumlah Saldo</label>
            <p id="jumlahSaldo">Rp. <?php echo $data['customer']['saldo']?> 
            (<?php echo terbilang($data['customer']['saldo'])?>)</p>
            
          </div>
          <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <p id="jumlah">Rp. <?php echo ($data['customer']['saldo']+$data['customer']['voucher'])?>
            (<?php echo terbilang($data['customer']['saldo']+$data['customer']['voucher'])?>)</p>
            
          </div>
          <div class="mb-3">
            <label for="nominal" class="form-label">Nominal Top Up</label>
            <input type="number" class="form-control" id="nominal" name="nominal" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Top Up</button>
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
      var modal = new bootstrap.Modal(document.getElementById("confirmModal"));
      modal.show();
    <?php endif;?>
  });
  </script>

<!--PHP Function--->
<?php
  function terbilang($data){
    $abil=array("","Satu","Dua","Tiga","Empat","Lima","Enam","Tujuh","Delapan","Sembilan","Sepuluh","Sebelas");
    
    if ($data<12) return " ".$abil[$data];
    elseif ($data<20) return terbilang($data-10)." Belas";
    elseif ($data<100) return terbilang($data/10)." Puluh".terbilang($data%10);
    elseif ($data<200) return " Seratus".terbilang($data-100);
    elseif ($data<1000) return terbilang($data/100)." Ratus".terbilang($data%100);
    elseif ($data<2000) return " Seribu".terbilang($data-1000);
    elseif ($data<1000000) return terbilang($data/1000)." Ribu".terbilang($data%1000);
    elseif ($data<1000000000) return terbilang($data/1000000)." Juta".terbilang($data%1000000);
  }
  ?>
