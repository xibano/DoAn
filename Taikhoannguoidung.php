<?php
include "db/connection.php";

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
    <link rel="stylesheet" href="./css/Admin.css">
    <title>Admin</title>
  </head>
  <body>

    <!--Bắt đầu từ đây-->
    <div class="row">
        <div class="card col-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" style=" background-color: darkslateblue; height: 100vh;">
            <nav class="nav flex-column">
                <a class="mt-2 nav-link text-danger" href="Trangchu.php"><img src="./img/logo/logo.jpg"></a>
                <a class="mt-2 nav-link text-info" href="Admin.php">Quản lý sản phẩm</a>
                <a class="mt-2 nav-link text-light" href="Admin_user.php">Quản lý tài khoản</a>
                <a class="mt-2 nav-link text-light" href="Admin_shoppingcart.php">Quản lý đơn hàng</a>
                <a class="mt-2 nav-link text-light" href="Loaisanpham.php">Quản lý loại sản phẩm</a>
                <a class="mt-2 nav-link text-light" href="Size.php">Quản lý Size</a>
            </nav>
        </div>
        

        <div class="col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10" style="border: none" >
        
          <h1 class="mt-5 mb-4 text-center">Tài khoản người dùng</h1>
          <div class="mx-auto" style="width: 85%">
            
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tên người dùng</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Hà Gia Huy" disabled>
              </div>

              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Số điện thoại</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Huy@gmail.com" disabled>
              </div>

              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email người dùng</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Huy@gmail.com" disabled>
              </div>

              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Mật khẩu</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="123456789" disabled>
              </div>

              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Địa chỉ người dùng</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="302/9, Khu vực Tràng Thọ 1, phường Thốt Nốt, quận Thốt Nốt, Thành phố Cần Thơ" disabled></textarea>
              </div>
        </div>

    </div>
  </body>
</html>