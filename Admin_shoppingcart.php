<?php
include "db/connection.php";

if(isset($_POST['id'])) {
  $query="UPDATE don_hang  SET trang_thai = ? WHERE id = ?;";
  try {
    $sth = $pdo->prepare($query);
    $sth->execute([
      $_POST['trangthai'],
      $_POST['id']
    ]);
  }
  catch (PDOException $e) {
    $pdo_error = $e->getMessage();
  }

 
} 
if(isset($_GET['id'])) {
  $query = "DELETE FROM don_hang WHERE id= ? ";
 

  try {
    $sth = $pdo->prepare($query);
    $sth->execute([
      $_GET['id']
    ]);
  } catch (PDOException $e) {
    $pdo_error = $e->getMessage();
  }
}

?>

<!DOCTYPE html>
<html lang-="en">
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
    <link rel="stylesheet" href="./css/Admin_shoppingcart.css">
    <title>Quản lý đơn hàng</title>
  </head>
  <body>
    <div class="container-fluid">
      <!--Bắt đầu từ đây-->
      <div class="row">
          <div class="card col-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" style=" background-color: darkslateblue; height: 100vh;">
              <nav class="nav flex-column">
                  <a class="mt-2 nav-link text-danger" href="Trangchu.php"><img src="./img/logo/logo.jpg"></a>
                  <a class="mt-2 nav-link text-light" href="Admin.php">Quản lý sản phẩm</a>
                  <a class="mt-2 nav-link text-light" href="Admin_user.php">Quản lý tài khoản</a>
                  <a class="mt-2 nav-link text-info" href="Admin_shoppingcart.php">Quản lý đơn hàng</a>
                  <a class="mt-2 nav-link text-light" href="Loaisanpham.php">Quản lý loại sản phẩm</a>
                  <a class="mt-2 nav-link text-light" href="Loaichitietsanpham.php">Quản lý loại chi tiết sản phẩm</a>
                  <a class="mt-2 nav-link text-light" href="Size.php">Quản lý Size</a>
              </nav>
          </div>
          

          <div class="col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10" style="border: none" >
          
            <h1 class="mt-5 mb-4 text-center">Quản lý đơn hàng</h1>
            <div class="mx-auto" style="width: 85%">
              <form class="mb-3 mt-3 d-flex" action="Admin_shoppingcart.php" role="search">
                
                &nbsp; &nbsp;
                <!--<div class="dropdown">
                  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: darkslateblue; border: none; font-size: 18px;">
                    Loại sản phẩm
                  </a>
                
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Tất cả'">Tất cả</a></li>
                    <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Áo thun'">Áo thun</a></li>
                    <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Áo sơ mi'">Áo sơ mi</a></li>
                    <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Áo polo'">Áo polo</a></li>
                    <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Quần jeans'">Quần jeans</a></li>
                    <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Quần tây'">Quần tây</a></li>
                    <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Quần short'">Quần short</a></li>
                    <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Quần ống loe'">Quần ống loe</a></li>
                    <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Đồ nguyên set'">Đồ nguyên set</a></li>
                    <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Phụ kiện'">Phụ kiện</a></li>
                  </ul>
                  &nbsp; &nbsp;
                  <span id="menu-value-loaisanpham" class="mt-2 fs-6">Tất cả</span>
              
                </div>-->
                  <input class="mx-auto form-control me-2 w-50" type="search" placeholder="Search" aria-label="Search" name="search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">STT</th>
                      <th scope="cok">ID</th>
                      <th scope="col">ID tài khoản</th>
                      <th scope="col">Ngày đặt</th>
                      <th scope="col">Tổng tiền</th>
                      <th scope="col">Trạng thái</th>
                      <th scope="col">Điều chỉnh</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $stt = 1;
                      $query = "CALL listDH()";
                      if(isset($_GET["search"])) {
                        $query .= " WHERE don_hang.id LIKE '%" . $_GET['search']. "%'";
                      }
                      try {
                        $sth = $pdo->query($query);
                        while($row = $sth->fetch()) {

                          echo '<tr>
                          <th scope="row">' . $stt . '</th>
                          <td>' . $row['id'] . '</td>
                          <td><a href="" class="text-dark" style="text-decoration: none">' . $row['id_tk'] . '</a></td>
                          <td>' . $row['ngay_dat'] . '</td>
                          <td>' . $row['tong_tien'] . '</td>
                          <td>' . $row['trang_thai'] . '</td>
                          <td>
                              <a href="Admin_chitietdonhang.php?id=' . $row['id'] . '" class="text-light">
                                  <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="edit item">
                                      <i class="fas fa-cog"></i>
                                  </button>
                              </a>
      
                              <a href="Admin_shoppingcart.php?id=' . $row['id'] . '" class="text-light">
                                  <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                      <i class="fas fa-trash"></i>
                                  </button>
                              </a>
      
                          </td>
                        </tr>';
                        }
                      }
                      catch(PDOException $e) {

                      }

                    ?>

                  </tbody>
                </table>
              </div>
          
          </div>
      </div>
    </div>
  </body>
</html>