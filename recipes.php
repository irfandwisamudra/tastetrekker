<?php
$title = "Daftar Resep - TasteTrekker";

require_once "./includes/main_start.php";

if (isset($_SESSION["login"]) && $_SESSION["login"] == true && $_SESSION["level"] == 1) {
  header("Location: ./admin/index.php");
  exit;
}

if (!isset($_GET["recipe_id"])) {
  $recipes = getAllRecipesWithNameMenu();
} else {
  $recipe_id = $_GET["recipe_id"];
  $recipe = getRecipesWithMenusByRecipeId($recipe_id);
  $ingredients = getAllIngredientsByRecipeId($recipe_id);
  $methods = getAllMethodsByRecipeId($recipe_id);
}
?>

<?php if (!isset($_GET["recipe_id"])) : ?>
  <section class="menu-section py-5">
    <div class="container py-3">
      <h2 class="text-center title fw-bold">DAFTAR RESEP</h2>
      <div class="underline mx-auto"></div>

      <?php if ($recipes !== NULL) : ?>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center mt-4">
          <?php foreach ($recipes as $recipe) : ?>
            <div class="col">
              <div class="card h-100">
                <!-- Menu image-->
                <img class="card-img-top" src="<?= BASEURL ?>/assets/img/recipe/<?= $recipe["image_recipe"]; ?>" class="card-img-top" alt="<?= ucwords($recipe["name_menu"]); ?>" />
                <!-- Menu details-->
                <div class="card-body p-4">
                  <div class="text-center">
                    <!-- Recipe title-->
                    <h5 class="fw-bolder"><?= $recipe["title"]; ?></h5>
                    <!-- Recipe serving-->
                    <p class="card-text mb-0">Porsi: <?= $recipe["serving"]; ?></p>
                    <!-- Recipe timing-->
                    <p class="card-text mb-0">Waktu: <?= $recipe["timing"]; ?></p>
                  </div>
                </div>
                <!-- Menu actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                  <div class="d-flex justify-content-center">
                    <a href="recipes.php?recipe_id=<?= $recipe["recipe_id"]; ?>" class="btn btn-outline-danger">
                      <i class="fas fa-book-open"></i> Lihat Resep
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else : ?>
        <h4 class="text-center title fw-bold mt-4">Tidak ada resep yang tersedia.</h4>
      <?php endif; ?>
    </div>
  </section>
<?php else : ?>
  <section class="recipe py-5">
    <div class="container py-3">
      <div class="row">
        <!-- Title -->
        <div class="col-12">
          <h2 class="my-4"><?= $recipe["title"]; ?></h2>
        </div>
      </div>
      <div class="row">
        <!-- Picture -->
        <div class="col-md-6">
          <img src="<?= BASEURL ?>/assets/img/recipe/<?= $recipe["image_recipe"]; ?>" alt="<?= ucwords($recipe["name_menu"]); ?>" class="recipe-picture shadow rounded mb-3" />
        </div>
        <!-- Info -->
        <div class="col-md-6">
          <div class="recipe-info">
            <h3 class="my-4">Info</h3>
            <!-- Description -->
            <div class="row border-bottom border-danger border-1 shadow rounded mx-0 my-2 py-2">
              <div class="col-2 text-center">
                <i class="fa fa-book-open text-danger" aria-hidden="true"></i>
              </div>
              <div class="col-10"><?= $recipe["desc_recipe"]; ?></div>
            </div>
            <!-- Timing -->
            <div class="row border-bottom border-danger border-1 shadow rounded mx-0 my-2 py-2">
              <div class="col-2 text-center">
                <i class="fa fa-clock text-danger" aria-hidden="true"></i>
              </div>
              <div class="col-6">Waktu</div>
              <div class="col-4"><?= $recipe["timing"]; ?></div>
            </div>
            <!-- Serving -->
            <div class="row border-bottom border-danger border-1 shadow rounded mx-0 my-2 py-2">
              <div class="col-2 text-center">
                <i class="fa fa-users text-danger" aria-hidden="true"></i>
              </div>
              <div class="col-6">Porsi</div>
              <div class="col-4"><?= $recipe["serving"]; ?></div>
            </div>
          </div>
        </div>
      </div>
      <!-- Ingredients -->
      <div class="row">
        <div class="col-12">
          <div class="recipe-ingredients">
            <h3 class="my-3">Bahan-bahan</h3>
            <dl class="ingredients-list">
              <?php
              foreach ($ingredients as $ingredient) :
                preg_match_all('/(\d+)\s+(.+)/', $ingredient["ing_name"], $matches);
              ?>
                <dt class="border-bottom border-danger border-1 px-3 py-2 mb-2"><?= $matches[1][0]; ?></dt>
                <dd class="border-bottom border-danger border-1 px-3 py-2 mb-2 bg-danger"><?= $matches[2][0]; ?></dd>
              <?php endforeach; ?>
            </dl>
          </div>
        </div>
      </div>
      <!-- Directions -->
      <div class="row">
        <div class="col-12">
          <div class="recipe-directions">
            <h3 class="my-3">Cara Pembuatan</h3>
            <ol class="p-0">
              <?php foreach ($methods as $method) : ?>
                <li class="border-bottom border-danger border-1 rounded"><?= $method["name_method"]; ?></li>
              <?php endforeach; ?>
            </ol>
          </div>
        </div>
      </div>
      <!-- Back to recipes -->
      <div class="row">
        <div class="col-12 text-center mt-4">
          <a href="./recipes.php" class="btn btn-outline-danger me-2 mb-2">
            <i class="fa fa-backward" aria-hidden="true"></i> Kembali ke Daftar Resep
          </a>
          <button class="btn btn-danger mb-2" onclick="addToCart()">
            <i class="fas fa-cart-plus"></i> Tambahkan ke Keranjang
          </button>
        </div>
      </div>
    </div>
  </section>

<?php endif; ?>

<?php require_once "./includes/main_end.php"; ?>