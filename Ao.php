<?php
include "db/connection.php";
session_start();

if(isset($_POST['search'])) {
  
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
        <link rel="stylesheet" href="Ao.css">
        <title>Sản phẩm</title>
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

        <!--Sản phẩm áo trở về sau-->
        <h2 style="margin: 20px 0 10px 0">Sản Phẩm <?php 
        if(isset($_GET['lsp'])) {
          echo $_GET['lsp']; 
        } 
        if(isset($_POST['search'])) {
          echo $_POST['search'];
        }
        
        ?></h2>

        <!-- Example single danger button -->
        <div class="container-fluid">
          <form method="POST">
          <div class="row">
            <?php
              $query="SELECT sp.id, sp.ten, sp.gia, sp.anh_1 FROM san_pham sp JOIN loai_chi_tiet_san_pham lctsp ON sp.id_lctsp = lctsp.id
              JOIN loai_san_pham lsp ON lctsp.id_lsp = lsp.id ";  
              if(isset($_GET["lsp"])) {
                $query .= " WHERE lsp.ten = '" . $_GET['lsp'] . "'";
              } else if(isset($_POST["search"])) {
                $query .= " WHERE sp.ten LIKE '%" . $_POST['search']. "%'";
              }
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
          </form>
        </div>
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