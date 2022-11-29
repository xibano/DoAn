<?php
include "db/connection.php";
session_start();

if(isset($_POST['submit_dn'])){
  // echo $_POST['email'];
  // echo $_POST['matkhau'];

  $query ="SELECT id FROM tai_khoan WHERE email ='" . $_POST['email'] . "' AND mat_khau = '" . $_POST['matkhau'] . "';";
  try {
    $sth = $pdo->query($query);
    if($row = $sth->fetch()) {
      $_SESSION['user'] = $row['id'] ;
    } else {
      echo 'Đăng nhập thất bại !';
    }
  } catch(PDOException $e) {
        
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
  <link rel="stylesheet" href="Trangchu.css">
  <title>Trang chủ</title>
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

    <!--Slide-->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./img/product/slider1.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="./img/product/slider2.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="./img/product/slider3.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!--Từ hàng mới về về sau-->
    <h2 style="margin: 20px 0 10px 0">HÀNG MỚI VỀ</h2>
    
    <div class="row">
        <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none">
          <a href="Chitietsanpham.php?id=SP8"><img src="./img/product/ao8.jpg" class="card-img-top" alt="..."></a>
          <div class="card-body">
            <p class="card-text text-center mb-2 fs-4">ÁO THUN</p>
            <p class="card-text text-center">300.000 VNĐ</p>
          </div>
        </div>

        <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none" >
            <a href="Chitietsanpham.php?id=SP33"><img src="./img/product/polo9.jpg" class="card-img-top" alt="..."></a>
            <div class="card-body">
                <p class="card-text text-center mb-2 fs-4">ÁO POLO SỌC XANH</p>
                <p class="card-text text-center">400.000 VNĐ</p>
            </div>
        </div>

        <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none" >
            <a href="Chitietsanpham.php?id=SP13"><img src="./img/product/somi1.jpg" class="card-img-top" alt="..."></a>
            <div class="card-body">
                <p class="card-text text-center mb-2 fs-4">ÁO SƠ MI XANH SKY</p>
                <p class="card-text text-center">350.000 VNĐ</p>
            </div>
        </div>

        <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none" >
            <a href="Chitietsanpham.php?id=SP37"><img src="./img/product/quan1.jpg" class="card-img-top" alt="..."></a>
            <div class="card-body">
                <p class="card-text text-center mb-2 fs-4">QUẦN JEANS XANH</p>
                <p class="card-text text-center">360.000 VNĐ</p>
            </div>
        </div>

        <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none" >
            <a href="Chitietsanpham.php?id=SP73"><img src="./img/product/minu1.jpg" class="card-img-top" alt="..."></a>
            <div class="card-body">
                <p class="card-text text-center mb-2 fs-4">SET SƠ MI VÁY CARO XANH</p>
                <p class="card-text text-center">500.000 VNĐ</p>
            </div>
        </div>

        <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none" >
            <a href="Chitietsanpham.php?id=SP100"><img src="./img/product/q4.jpg" class="card-img-top" alt="..."></a>
            <div class="card-body">
                <p class="card-text text-center mb-2 fs-4">QUẦN ỐNG LOE </p>
                <p class="card-text text-center">250.000 VNĐ</p>
            </div>
        </div>

        <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none" >
            <a href="Chitietsanpham.php?id=SP83"><img src="./img/product/minu11.jpg" class="card-img-top" alt="..."></a>
            <div class="card-body">
                <p class="card-text text-center mb-2 fs-4">SET SƠ MI QUẦN SHORT</p>
                <p class="card-text text-center">400.000 VNĐ</p>
            </div>
        </div>

        <div href="Chitietsanpham.php" class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none" >
            <a href="Chitietsanpham.php?id=SP136"><img src="./img/product/pkn10.jpg" class="card-img-top" alt="..."></a>
            <div class="card-body">
                <p class="card-text text-center mb-2 fs-4">THẮT LƯNG</p>
                <p class="card-text text-center">250.000 VNĐ</p>
            </div>
        </div>

        <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none" >
            <a href="Chitietsanpham.php?id=SP123"><img src="./img/product/pkn1.jpg" class="card-img-top" alt="..."></a>
            <div class="card-body">
                <p class="card-text text-center mb-2 fs-4">KÍNH RÂM</p>
                <p class="card-text text-center">360.000 VNĐ</p>
            </div>
        </div>

        <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none" >
            <a href="Chitietsanpham.php?id=SP124"><img src="./img/product/pkn2.jpg" class="card-img-top" alt="..."></a>
            <div class="card-body">
                <p class="card-text text-center mb-2 fs-4">KÍNH RÂM</p>
                <p class="card-text text-center">360.000 VNĐ</p>
            </div>
        </div>

        <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none" >
            <a href="Chitietsanpham.php?id=SP129"><img src="./img/product/pk1.jpg" class="card-img-top" alt="..."></a>
            <div class="card-body">
                <p class="card-text text-center mb-2 fs-4">Thắt lưng nam</p>
                <p class="card-text text-center">360.000 VNĐ</p>
            </div>
        </div>

        <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none" >
            <a href="Chitietsanpham.php?id=SP130"><img src="./img/product/pk2.jpg" class="card-img-top" alt="..."></a>
            <div class="card-body">
                <p class="card-text text-center mb-2 fs-4">Thắt lưng nam</p>
                <p class="card-text text-center">360.000 VNĐ</p>
            </div>
        </div>

    </div>

    <div class="card text-center">
        <div class="card-footer text-muted">
            <p>Công ty Cổ phần với số kinh doanh 1234567890 </br>
                Địa chỉ đăng ký: Đường 3/2, P.Xuân Khánh, Q.Ninh Kiều, TP.Cần Thơ, Việt Nam - 0123 456 7890 </br>
                Đặt hàng online: <b>0123 456 7890</b>
            </p>
          </div>
    </div>
  </body>
</html>