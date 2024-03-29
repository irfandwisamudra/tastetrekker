<?php
$title = "Login - TasteTrekker";

require_once "./includes/main_start.php";

if (isset($_SESSION["login"]) && $_SESSION["login"] == true && $_SESSION["level"] == 1) {
  header("Location: ./admin/index.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (validateEmail($_POST)) {
    if (validatePassword($_POST)) {
      $_SESSION["email"] = $_POST["email"];
      $_SESSION["level"] = getLevelByEmail($_POST["email"]);
      $_SESSION["login"] = true;
      if (isset($_POST['remember'])) {
        $userData = getUsersDataHighlight($_POST['email']);
        setcookie('email', $_POST['email'], time() + 60 * 60 * 24);
        setcookie('key', password_hash($userData['username'], PASSWORD_BCRYPT));
      }
      unset($_POST);
      if ($_SESSION["level"] != 1) {
        header("Location: " . BASEURL . "/index.php");
        exit;
      } else {
        header("Location: " . BASEURL . "/admin/index.php");
        exit;
      }
    } else {
      $error = "Password Anda salah!";
    }
  } else {
    $error = "Email tidak tersedia!";
  }
}
?>

<section class="register-section min-vh-100 py-5">
  <div class="container h-100 py-3">
    <div class="row justify-content-sm-center h-100">
      <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
        <div class="card shadow-lg">
          <div class="card-body p-5">
            <div class="text-center mb-4">
              <img src="<?= BASEURL ?>/assets/img/logo/TasteTrekker-square.svg" alt="TasteTrekker-logo" class="img-fluid">
            </div>
            <h1 class="fs-4 card-title fw-bold mb-4 text-center">Login</h1>

            <?php if (isset($_SESSION["registerSuccess"])) : ?>
              <div class="alert alert-success"><?= $_SESSION["registerSuccess"]; ?></div>
              <?php unset($_SESSION["registerSuccess"]); ?>
            <?php elseif (isset($error)) : ?>
              <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>

            <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
              <div class="mb-3">
                <label class="form-label mb-2" for="email">E-Mail Address</label>
                <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                <div class="invalid-feedback">
                  Email tidak valid
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label mb-2" for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
                <div class="invalid-feedback">
                  Password harus diisi
                </div>
              </div>

              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                  <input type="checkbox" name="remember" id="remember" class="form-check-input">
                  <label for="remember" class="form-check-label">Remember Me</label>
                </div>
                <a href="forgot.php" class="float-end">
                  Lupa Password?
                </a>
              </div>
              <button type="submit" class="btn btn-primary ms-auto">
                <i class="fas fa-sign-in-alt"></i> Login
              </button>
            </form>
          </div>
          <div class="card-footer py-3 border-0">
            <div class="text-center">
              Belum punya akun? <a href="signup.php">Sign Up</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="./assets/js/register.js"></script>

<?php require_once "./includes/main_end.php"; ?>