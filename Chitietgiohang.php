<?php
include "db/connection.php";
session_start();


if(isset($_GET['id'])) {
  $query = "SELECT * FROM gio_hang WHERE id='". $_GET['id'] . "'";
  $sth = $pdo->query($query);
  if($row = $sth->fetch()) {
    
  }

  if(isset($_POST['submit_sp'])){
    echo 'a';
    $query = "INSERT INTO gio_hang WHERE id='". $_GET['id'] . "'";
    try {
        $sth = $pdo->prepare($query);
        $sth->execute([
          $_POST['gia'],
        
        ]);
      } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
      }
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
        <link rel="stylesheet" href="Giohang.css">
        <title>Đơn hàng</title>
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


                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

                    <form class="d-flex" role="search" action="Giohang.php"  method="POST">
                      <button class="btn btn-outline-success" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>  
                    </form>
                </div>
            </div>
        </nav>

        <section class="h-100 gradient-custom">
            <div class="container py-5">
              <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                  <div class="card mb-4">
                    <div class="card-header py-3">
                      <h5 class="mb-0">Giỏ hàng - 3 sản phẩm</h5>
                    </div>

                    <?php
                      $query="SELECT tk.id, sp.id, sp.ten, s.size, sp.anh_1, sl.so_luong , sp.gia  
                      FROM size s JOIN so_luong_gio_hang sl ON s.id = sl.id_size JOIN san_pham sp ON sp.id = sl.id_sp
                      JOIN gio_hang gh ON gh.id = sl.id_gh JOIN tai_khoan tk ON tk.id = gh.id_tk
                      WHERE gh.id_tk ='". $_GET['id'] ."';";

                      try {
                        $sth = $pdo->query($query);
                        while($row = $sth->fetch()) {
                            echo'<div class="card-body">
                            <!-- Sản phẩm đơn -->
                            <div class="row">
                              <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                <!-- Ảnh -->
                                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                  <img src="' . $row['anh_1'] . '"
                                    class="w-100" alt="" />
                                  <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                  </a>
                                </div>
                                <!-- Ảnh -->
                              </div>
                
                              <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                <!-- Chi tiết sản phẩm -->
                                <p><strong>'. $row['ten'] .'</strong></p>
                                <p>Size: '. substr($row['size'], 5) .'</p>
                                <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                                  title="Remove item">
                                  <i class="fas fa-trash"></i>
                                </button>
                              </div>
                
                              <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                <!-- Số lượng -->
                                <div class="d-flex mb-4" style="max-width: 300px">
                                  <button class="btn btn-primary px-3 me-2"
                                    onclick="this.parentNode.querySelector(\'input[type=number]\').stepDown()">
                                    <i class="fas fa-minus"></i>
                                  </button>
                
                                  <div class="form-outline">
                                    <label class="form-label" for="form1">Số lượng:</label>
                                    <input id="form1" min="0" name="quantity" value="' . $row['so_luong'] .'" type="number" class="form-control" />
                                  
                                  </div>
                
                                  <button class="btn btn-primary px-3 ms-2"
                                    onclick="this.parentNode.querySelector(\'input[type=number]\').stepUp()">
                                    <i class="fas fa-plus"></i>
                                  </button>
                                </div>
                                <!-- Số lượng -->
                
                                <!-- Giá -->
                                <p class="text-start text-md-center">
                                  <strong>' . $row['gia'] .' VNĐ</strong>
                                </p>
                                <!-- Giá -->
                              </div>
                            </div>
                            <!-- 1 sản phẩm -->
    
                          </div>';
                          
                        }
                      } catch(PDOException $e) {

                      } 
                    ?>
                  </div>
                  
                </div>
                <?php
                  $query="SELECT tk.id,gh.tong_tien FROM gio_hang gh JOIN tai_khoan tk ON tk.id = gh.id_tk 
                  WHERE gh.id_tk ='". $_GET['id'] ."';";
                  try {
                    $sth = $pdo->query($query);
                      while($row = $sth->fetch()) {
                        echo'<div class="col-md-4">
                          <div class="card mb-4">
                            <div class="card-header py-3">
                              <h5 class="mb-0">Bản tóm tắt</h5>
                            </div>
                            <div class="card-body">
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                  Giá tổng sản phẩm
                                  <span>' . $row['tong_tien'] .' VNĐ</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                  <div>
                                    <strong>Tổng tiền</strong>
                                  </div>
                                  <span><strong>' . $row['tong_tien'] .' VNĐ </strong></span> 
                                </li>
                              
                              </ul>

                              <!--<div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ giao hàng</label>
                                <textarea class="form-control" id="address" rows="3"></textarea>
                              </div>-->
                              
                              <!--<button type="button" class="btn btn-primary btn-lg btn-block">
                                Thanh toán
                              </button>-->
                            </div>
                          </div>
                        </div>';
                    }
                  }catch(PDOException $e) {

                  } 
                ?>         
              </div>
            </div>
          </section>
        
        
    </body>
</html>