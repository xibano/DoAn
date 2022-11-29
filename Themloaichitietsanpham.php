<?php
include "db/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1147679ae7.js"></script>
    <link rel="stylesheet" href="css\style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/Admin.css">
    <title>Thêm loại chi tiết sản phẩm</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="card col-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" style=" background-color: darkslateblue; height: 100vh;">
          <nav class="nav flex-column">
            <a class="mt-2 nav-link text-danger" href="Trangchu.php"><img src="./img/logo/logo.jpg"></a>
            <a class="mt-2 nav-link text-light" href="Admin.php">Quản lý sản phẩm</a>
            <a class="mt-2 nav-link text-light" href="Admin_user.php">Quản lý tài khoản</a>
            <a class="mt-2 nav-link text-light" href="Admin_shoppingcart.php">Quản lý đơn hàng</a>
            <a class="mt-2 nav-link text-light" href="Loaisanpham.php">Quản lý loại sản phẩm</a>
            <a class="mt-2 nav-link text-info" href="Loaichitietsanpham.php">Quản lý loại chi tiết sản phẩm</a>
            <a class="mt-2 nav-link text-light" href="Size.php">Quản lý Size</a>
          </nav>
        </div>

        <form action="./Loaichitietsanpham.php" method ="post" class="mx-auto col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10 w-50" style="border: none" >
          <h1 class="mt-5 mb-4 text-center">Thêm loại chi tiết sản phẩm</h1>

          <div class=" mb-3 row">
            <label class="col-sm-4 col-form-label">ID</label>
            <div class="col-sm-8">
              <input type="text"  class=" form-control" name="id">
            </div>
          </div>

            <div class=" mb-3 row">
              <label class="col-sm-4 col-form-label">Loại chi tiết sản phẩm</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="loai_ctsp">
                </div>
            </div>

            <div class=" mb-3 row">
              <label class="col-sm-4 col-form-label">Loại sản phẩm</label>
              <div class="col-sm-8">
              <select name="lsp">
              <?php
                      $query= "SELECT id, ten FROM loai_san_pham;";

                      $sth = $pdo->query($query);
                      while($row = $sth->fetch()) {
                        echo "<option value='" . $row['id']  . "'>" . $row['ten'] . "</option>";
                      }
                  ?>
                

              </select>
              </div>

              

            </div>
                  
            <div class="text-center">
              <button type="submit" class="btn btn-success btn-sm mb-2">
                <i class="fas fa-check"></i>
                Thêm loại chi tiết sản phẩm
              </button>
            </div>
  
        </form>
      </div>
    </div>
      
      
  </body>
</html>