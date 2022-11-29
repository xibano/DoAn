<?php
include "db/connection.php";

if(isset( $_GET['id'])) {
  $query = "SELECT * FROM loai_san_pham WHERE id='" . $_GET['id'] . "'";
try {
  $sth = $pdo->query($query);
  if($row = $sth->fetch()) {
    $id = $row['id'];
    $ten = $row['ten'];
    $size = $row['co_size'];
  }
}

catch(PDOException $e) {

} 
} else if(isset($_POST['id'])){
  $id = $_POST['id'];
  $ten = $_POST['ten'];
  $size = $_POST['flexRadioDefault'];


  $query = "UPDATE loai_san_pham SET ten = ?, co_size = ? WHERE ID = ? ;";
  
  try {
    $sth = $pdo->prepare($query);
    $sth->execute([
      $ten, $size,  $id
    ]);
  } catch (PDOException $e) {
    $pdo_error = $e->getMessage();
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
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
        <title>Sửa loại sản phẩm</title>
      </head>
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
                <a class="mt-2 nav-link text-info" href="Loaisanpham.php">Quản lý loại sản phẩm</a>
                <a class="mt-2 nav-link text-light" href="Loaichitietsanpham.php">Quản lý loại chi tiết sản phẩm</a>
                <a class="mt-2 nav-link text-light" href="Size.php">Quản lý Size</a>
            </nav>
        </div>

        <form action = "Sualoaisanpham.php" method = "post" class="mx-auto col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10 w-50" style="border: none" >
            <h1 class="mt-5 mb-4 text-center">Sửa loại sản phẩm</h1>

            <div class=" mb-3 row">
              <label class="col-sm-3 col-form-label">ID</label>
              <div class="col-sm-9">
                <input type="text" readonly class=" form-control" name ="id" value="<?php echo $id; ?>">
              </div>
            </div>
            <div class=" mb-3 row">
              <label class="col-sm-3 col-form-label">Loại sản phẩm</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name ="ten" value="<?php echo $ten ; ?>">
              </div>
            </div>
              
              <div class="form-check">
                <input class="form-check-input" 
                <?php
                  if($size == "Y") {
                    echo "checked";
                  }
                ?>
                type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Y">
                <label class="form-check-label" for="flexRadioDefault1">
                  Có Size
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input"
                <?php
                  if($size == "N") {
                    echo "checked";
                  }
                ?>
                type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="N">
                <label class="form-check-label" for="flexRadioDefault2">
                  Không Size
                </label>
              </div>
              

              <div class="text-center">
                <button type="submit" class="btn btn-success btn-sm mb-2">
                  <i class="fas fa-check"></i>
                  Sửa loại sản phẩm
                </button>
              </div>
        </form>
    
    </div>
  </div>
    
    
</body>
</html>