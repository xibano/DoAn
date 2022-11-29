<?php
include "db/connection.php";
session_start();

if(isset($_SESSION['user'])) {
  $query = "SELECT * FROM gio_hang WHERE id='". $_SESSION['user'] . "'";
  $sth = $pdo->query($query);
  if($row = $sth->fetch()) {
    
  }

  $query="SELECT id FROM gio_hang WHERE id_tk ='" . $_SESSION['user'] . "';";
  $sth = $pdo->query($query);
  if($row = $sth->fetch()) {
    $idgh = $row['id'];
  }

  if(isset($_POST['idsp'])){
    if(isset($_POST['size'])) {
      $idsize = $_POST['size'];
    } else {
      $idsize = 'S0';
    }
    $query="INSERT INTO so_luong_gio_hang VALUES (?,?,?,?);";
    try {
      $sth = $pdo->prepare($query);
      $sth->execute([
        $_POST['sl'],
        $idsize,
        $_POST['idsp'],
        $idgh
      
      ]);
    } catch (PDOException $e) {
      $pdo_error = $e->getMessage();
    }

    $query = "UPDATE gio_hang SET tong_tien = tong_tien + ? WHERE id = ?;";
    try {
      $sth = $pdo->prepare($query);
      $sth->execute([
        ($_POST['gia'] * $_POST['sl']), $idgh
      ]);
    } catch (PDOException $e) {
      $pdo_error = $e->getMessage();
    }

  }

  if(isset($_POST['delete_sp'])){
    $query = "DELETE FROM so_luong_gio_hang WHERE id_sp = ?";
    try {
      $sth = $pdo->prepare($query);
      $sth->execute([
        $_POST['id']
      ]);
    } catch (PDOException $e) {
      $pdo_error = $e->getMessage();
    }

    $query = "UPDATE gio_hang SET tong_tien = tong_tien - ? WHERE id = ?;";
    try {
      $sth = $pdo->prepare($query);
      $sth->execute([
        ($_POST['gsp'] * $_POST['slsp']), $idgh
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

        <section class="h-100 gradient-custom">
            <div class="container py-5">
              <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                  <div class="card mb-4">
                    <div class="card-header py-3">
                      <h5 class="mb-0">Giỏ hàng</h5>
                    </div>

                    <?php
                      $query="CALL listSPGH('". $_SESSION['user'] ."');";

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
                              </div>';
                
                              echo'<div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                <!-- Chi tiết sản phẩm -->
                                <p><strong>'. $row['ten'] .'</strong></p>
                                <p>Size: '. substr($row['size'], 5) .'</p>
                                <form action="Giohang.php" method="POST">
                                  <input type="hidden" name="slsp" value="' . $row['so_luong'] . '" />
                                  <input type="hidden" name="gsp" value="' . $row['gia'] . '" />
                                  <input type="hidden" name="id" value="' . $row['id'] . '" />
                                  
                                  <button type="submit" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                                    title="Remove item" name="delete_sp">
                                    <i class="fas fa-trash"></i>
                                  </button>
                                </form>
                              </div>';

                              if($row['so_luong'] > 10) {

                                echo '<div class=" d-flex mb-4 alert alert-primary" role="alert" style="max-width: 150px">
                                  Lỗi không đủ số lượng
                                </div>';
                              } else {
                                echo '<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                <!-- Số lượng -->
                                <div class="d-flex mb-4" style="max-width: 300px">
                                  
                
                                  <div class="form-outline">
                                    <label class="form-label" for="form1">Số lượng:</label>
                                    <input id="form1" min="0" name="quantity" value="' . $row['so_luong'] .'" type="number" class="form-control" />
                                  
                                  </div>
                
                                  
                                </div>';
                              
                              }
                
                              echo '
                
                                <!-- Giá -->
                                <p class="text-start text-md-center">
                                  <strong>' . $row['gia'] .' VNĐ/SP</strong>
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
                  WHERE gh.id_tk ='". $_SESSION['user'] ."';";
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
                              <form action="Danhsachdonhang.php" method="POST">
                              <input type="hidden" class="form-control" id="giohang" rows="3" name="idgh" value="' . $idgh . '">
                                <div class="mb-3">
                                  <label for="sdt" class="form-label">Số điện thoại</label>
                                  <input class="form-control" id="sdt" rows="3" name="sdt">
                                </div>

                                <div class="mb-3">
                                  <label for="address" class="form-label">Địa chỉ giao hàng</label>
                                  <textarea class="form-control" id="address" rows="3" name="dcgh"></textarea>
                                </div>
                                
                                <button type="submit" name="submit_dh" class="btn btn-primary btn-lg btn-block">
                                  Đặt hàng
                                </button>
                              </form>
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