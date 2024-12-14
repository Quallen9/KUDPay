<div class="container card_login bg-grey text-black p-5 rounded">
<div class="row">
      <div class="col-lg-6">
        <?php flasher::flashLogin() ?>
      </div>
  </div>
  <h1 class="display1 text-center">Login</h1>
  <form class="login" action="<?= BASEURL; ?>/admin/authenticate" method="post">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Username</label>
      <input
        type="text"
        class="form-control form-control-lg"
        id="ussername"
        name="ussername"
        placeholder="Masukan username"
        autocomplete="off"
        required
      />
    </div>
    <div class="mb-5">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input
        type="password"
        class="form-control form-control-lg"
        id="password"
        name="password"
        placeholder="Password"
        required
      />
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-primary btn-lg">Login</button>
    </div>
  </form>
</div>
