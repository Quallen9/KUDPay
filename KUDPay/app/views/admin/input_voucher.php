<div class="container card_topUp bg-grey text-grey p-5 rounded">
  <div class="row">
    <div class="col-lg-6">
      <?php flasher::flash() ?>
    </div>
  </div>
  <form class="inputVoucher" action="<?php echo BASEURL;?>/Admin/input_voucher" method="post">
    <div class="mb-3 mt-3">
      <label for="InputNoRek" class="form-label">Nomer Rekening</label>
      <input
        type="text"
        class="form-control form-control-lg"
        id="InputNoRek"
        name="InputNoRek"
        placeholder="Masukkan Nomer Rekening"
        autocomplete="off"
      />
    </div>
    <div class="d-grid mt-5">
      <button type="submit" class="btn btn-primary btn-lg" id="tombolCari" disabled>Input Voucher</button>
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
        <form action="<?php echo BASEURL;?>/Customer/input_voucher" method="post">
          <div class="mb-3">
            <label for="idKartu" class="form-label">Nomer Rekening</label>
            <p id="idKartu"><?php echo $data['customer']['noRekening']?></p>
            <input type="hidden" id="noRekening" name="noRekening" value="<?php echo $data['customer']['noRekening']?>" />
          </div>
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
            <label for="nominal" class="form-label">Nominal</label>
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
  const InputNoRek = document.getElementById('InputNoRek');
  const tombolCari = document.getElementById('tombolCari');


  const expectedLengthForID = 8;

  InputNoRek.addEventListener('input', function () {
    if (InputNoRek.value.trim() !== '' && InputNoRek.value.length === expectedLengthForID) {
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
