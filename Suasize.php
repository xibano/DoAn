<?php
include "db/connection.php";

if(isset( $_GET['id'])) {
  $query = "SELECT * FROM size WHERE id='" . $_GET['id'] . "'";
try {
  $sth = $pdo->query($query);
  if($row = $sth->fetch()) {
    $id = $row['id'];
    $ten = $row['size'];
    $mota = $row['mo_ta'];
  }
}

catch(PDOException $e) {

}
} else if(isset($_POST['id'])){
  $id = $_POST['id'];
  $ten = $_POST['ten'];
  $mota = $_POST['mota'];

  $query = "UPDATE size SET size = ?, mo_ta = ? WHERE ID = ? ;";
  
  try {
    $sth = $pdo->prepare($query);
    $sth->execute([
      $ten, $mota, $id
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
        <title>Sửa Size</title>
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
                <a class="mt-2 nav-link text-light" href="Loaisanpham.php">Quản lý loại sản phẩm</a>
                <a class="mt-2 nav-link text-light" href="Loaichitietsanpham.php">Quản lý loại chi tiết sản phẩm</a>
                <a class="mt-2 nav-link text-info" href="Size.php">Quản lý Size</a>
            </nav>
        </div>

        <form action = "Suasize.php" method = "post" class="mx-auto col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10 w-50" style="border: none" >
            <h1 class="mt-5 mb-4 text-center">Sửa Size</h1>

            <div class=" mb-3 row">
              <label class="col-sm-3 col-form-label">ID</label>
              <div class="col-sm-9">
                <input type="text"readonly class=" form-control" name ="id" value="<?php echo $id; ?>">
              </div>
            </div>
            <div class=" mb-3 row">
              <label class="col-sm-3 col-form-label">Tên</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name ="ten" value="<?php echo $ten; ?>">
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-sm-3 col-form-label">Mô tả</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name ="mota" value="<?php echo $mota; ?>">
              </div>
            </div>
              

              

            <div class="text-center">
              <button type="submit" class="btn btn-success btn-sm mb-2">
                <i class="fas fa-check"></i>
                Sửa size
              </button>
            </div>
        </form>
    </div>
  </div>
    
    
</body>
</html>