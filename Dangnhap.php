<?php
include "db/connection.php";
session_start();


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
    <link rel="stylesheet" href="./css/Dangnhap.css">
    <title>Đăng nhập</title>
  </head>
  <body>
        <!--Thanh menu phía trên-->
        <nav class="navbar navbar-expand-lg bg-light" id="navbar">
          <div class="container-fluid">
            <a class="navbar-brand" href="Trangchu.php"><img src="./img/logo/logo.jpg" style="width: 25%" ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                  $query="SELECT loai_san_pham.ten FROM loai_san_pham;";
                  try {
                    $sth = $pdo->query($query);
                    while($row = $sth->fetch()) {
                      echo'
                        <li class="nav-item">
                          <a class="nav-link" href="Ao.php?lsp=' . $row['ten'] . '">'. $row['ten'] .'</a>
                        </li>';
                    }
                  } catch(PDOException $e) {
                        
                    }
                ?>

                <?php
                  if(isset($_SESSION['user'])) {
                    echo'
                    <li class="nav-item">
                      <a class="nav-link" href="Danhsachdonhang.php">Xem đơn hàng</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="Dangxuat.php">Đăng xuất</a>
                    </li>';
                  } else {
                    echo'
                    <li class="nav-item">
                      <a class="nav-link" href="Dangnhap.php">Đăng nhập</a>
                    </li>
            
                    <li class="nav-item">
                      <a class="nav-link" href="Dangky.php">Đăng ký</a>
                    </li>';
                  }
                  
                ?>
              </ul>

              <form class="d-flex" role="search" action="Ao.php" method="POST">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
    
              <?php
                  if(isset($_SESSION['user'])) {
                    echo'
                    <a href="Giohang.php" class="d-flex" role="search">
                      <button class="btn btn-outline-success" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>  
                    </a>';
                  } 
                ?>
    
            </div>
          </div>
        </nav>

    <!--Bắt đầu từ đây-->

    <div class="container">
        <div class="row">
          <div class="col-lg-10 col-xl-9 mx-auto">
            <div class="card card-signin flex-row my-5">
              <div class="card-img-left d-none d-md-flex">
              </div>
              <div class="card-body">
                <h5 class="card-title text-center">Đăng nhập</h5>
                <form class="form-signin" action="Trangchu.php" method="POST">
                  <div class="form-label-group">
                    <input type="text" id="inputUserame" class="form-control" placeholder="Email" required autofocus name="email">
                    <label for="inputUserame">Email</label>
                  </div>
    
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="matkhau">
                    <label for="inputPassword">Mật khẩu</label>
                  </div>
                  
                  <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit_dn">Đăng nhập</button>
                  <a class="d-block text-center mt-2 small" href="Dangky.php">Đăng ký</a>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    <!--footer-->
    <div class="card text-center">
        <div class="card-footer text-muted">
          <p>Công ty Cổ phần với số kinh doanh 1234567890 </br>
            Địa chỉ đăng ký: Đường 3/2, P.Xuân Khánh, Q.Ninh Kiều, TP.Cần Thơ, Việt Nam - 0123 456 7890 </br>
            Đặt hàng online: <b>0123 456 7890</b>
            Hà Gia Huy - B1910381
          </p>
        </div>
      </div>
    </body>
</html>
