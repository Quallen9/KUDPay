<div class="container mt-5">
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">ID Kartu</th>
        <th scope="col">Nama</th>
        <th scope="col">Alamat</th>
        <th scope="col">Voucher</th>
        <th scope="col">Saldo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data['customer'] as $customer) : ?>
        <tr>
        <td><?php echo $customer['idKartu'];?></td>
        <td><?php echo $customer['nama'];?></td>
        <td><?php echo $customer['alamat'];?></td>
        <td><?php echo $customer['voucher'];?></td>
        <td><?php echo $customer['saldo'];?></td>
        </tr>
        <?php endforeach?>
    </tbody>
    </table>
</div>