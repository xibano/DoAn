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
        <link rel="stylesheet" href="Ao.css">
        <title>Quần</title>
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

                    <li class="nav-item">
                      <a class="nav-link" href="Dangnhap.php">Đăng nhập</a>
                    </li>
        
                    <li class="nav-item">
                      <a class="nav-link" href="Dangky.php">Đăng ký</a>
                    </li>
                  </ul>
                <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
      
                <form class="d-flex" role="search" action="Giohang.php">
                  <button class="btn btn-outline-success" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>  
                </form>
      
              </div>
            </div>
          </nav>

        <!--Sản phẩm áo trở về sau-->
        <h2 style="margin: 20px 0 10px 0">SẢN PHẨM QUẦN</h2>

        <!-- Example single danger button -->
<div class="mb-3">
<div class="btn-group">
    
    <button type="button" class="btn btn-secondary dropdown-toggle fs-6" data-bs-toggle="dropdown" aria-expanded="false">
      Quần dành cho
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-gioitinh').innerHTML='Tất cả'">Tất cả</a></li>
      <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-gioitinh').innerHTML='Nam'">Nam</a></li>
      <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-gioitinh').innerHTML='Nữ'">Nữ</a></li>
    </ul>
    &nbsp; &nbsp;
    <span id="menu-value-gioitinh" class="mt-2 fs-6">Tất cả</span>

  </div>

  <div class="btn-group">
    &emsp; &emsp; 
    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      Size
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-size').innerHTML='Tất cả'">Tất cả</a></li>
        <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-size').innerHTML='S'">S</a></li>
        <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-size').innerHTML='M'">M</a></li>
        <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-size').innerHTML='XL'">XL</a></li>
        <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-size').innerHTML='XXL'">XXL</a></li>
    </ul>

    &nbsp; &nbsp;
    <span id="menu-value-size" class="mt-2 fs-6"> Tất cả</span>
  </div>

  <div class="btn-group">
    &emsp; &emsp; 
    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      Loại quần
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Tất cả'">Tất cả</a></li>
        <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Quần Jeans'">Quần Jeans</a></li>
        <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Quần tây'">Quần tây</a></li>
    </ul>
    &nbsp; &nbsp;
    <span id="menu-value-loaisanpham" class="mt-2 fs-6"> Tất cả</span>
  </div>
</div>
        <div class="container-fluid">
          <div class="row">
            <?php
              $query="SELECT sp.id, sp.ten, sp.gia, sp.anh_1 FROM san_pham sp JOIN loai_chi_tiet_san_pham lctsp ON sp.id_lctsp = lctsp.id
              JOIN loai_san_pham lsp ON lctsp.id_lsp = lsp.id WHERE  lsp.id = 'LSP2';";

              try {
                $sth = $pdo->query($query);
                while($row = $sth->fetch()) {
                  echo '
                  
                    <div class="card col-12 col-sm-6 col-md-4 col-lg-3" style="border: none">
                      <a href="Chitietsanpham.php?id=' . $row['id'] . '"><img src=" '. $row['anh_1'] .' "class="card-img-top" alt="..."></a>
                      <div class="card-body">
                        <p class="card-text text-center mb-2 fs-4">' . $row['ten'] . '</p>
                        <p class="card-text text-center">' . $row['gia'] . '</p>
                      </div>
                    </div>';
                }
              } catch(PDOException $e) {
                    
              }
            ?>
          </div>
        </div>
        <div class="card text-center">
            <div class="card-footer text-muted">
                <p>Công ty Cổ phần với số kinh doanh 1234567890 </br>
                    Địa chỉ đăng ký: Đường 3/2, P.Xuân Khánh, Q.Ninh Kiều, TP.Cần Thơ, Việt Nam - 0123 456 7890 </br>
                    Đặt hàng online: <b>0123 456 7890</b>
                    Niên luận cơ sở - Hà Gia Huy - B1910381
                </p>
              </div>
        </div>
    </body>
</html>