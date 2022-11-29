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
    <title>Loại sản phẩm áo thun</title>
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
                <a class="mt-2 nav-link text-light" href="Loaichitietsanpham.php">Quản lý loại chi tiết sản phẩm</a>
                <a class="mt-2 nav-link text-light" href="Size.php">Quản lý Size</a>
            </nav>
        </div>
        

        <div class="col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10" style="border: none" >
        
            <h1 class="mt-5 mb-4 text-center">Quản lý size S</h1>
            <form class="mx-auto mb-3 mt-3 w-75">
                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option selected>Loại sản phẩm có size S</option>
                    <option value="1">Áo thun</option>
                    <option value="2">Áo sơ mi</option>
                    <option value="3">Áo polo</option>
                    <option value="4">Quần jeans</option>
                    <option value="5">Quần tây</option>
                    <option value="6">Quần short</option>
                    <option value="7">Quần ống loe</option>
                    <option value="8">Đồ nguyên set</option>
                </select>

                <div class="mt-3 input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Số lượng sản phẩm chọn ở trên</span>
                    <input type="text" class="form-control" placeholder="12" aria-label="soluong" aria-describedby="addon-wrapping">
                </div>

                
            </form>
    
        </div>

    </div>
  </body>
</html>