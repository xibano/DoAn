<?php
include "db/connection.php";

if(isset($_GET['id'])) {
  $query = "SELECT * FROM don_hang WHERE id='". $_GET['id'] . "'";
  $sth = $pdo->query($query);
  if($row = $sth->fetch()) {
    
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
        <title>Chi tiết đơn hàng</title>
    </head>
    <body>
      <h1 class="mt-5 mb-4 text-center">Quản lý chi tiết đơn hàng</h1>

        <section class="h-100 gradient-custom">
            <div class="container py-5">
              <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                  <div class="card mb-4">
                    <div class="card-header py-3">
                      <h5 class="mb-0">Giỏ hàng - 3 sản phẩm</h5>
                    </div>

                    <?php
                      $query="SELECT sp.id, sp.ten, s.size, sp.anh_1, sl.so_luong, sp.gia  
                      FROM size s JOIN so_luong sl ON s.id = sl.id_size JOIN san_pham sp ON sp.id = sl.id_sp
                      WHERE sl.id_dh = '". $_GET['id']. "';";
                      try {
                        $sth = $pdo->query($query);
                        while($row = $sth->fetch()) {
                          echo'
                            <div class="card-body">
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
                                  
                                  
                                </div>
                  
                                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                  <!-- Số lượng -->
                                  <div class="d-flex mb-4" style="max-width: 300px">
                                    
                  
                                    <div class="form-outline">
                                      <label class="form-label" for="form1">Số lượng:</label>
                                      <input id="form1" min="0" name="quantity" value="' . $row['so_luong'] .'" type="number" class="form-control" disabled />
                                    
                                    </div>
                  
                                    
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
                <div class="col-md-4">
                  <div class="card mb-4">
                    <div class="card-header py-3">
                    <?php
                        $query="SELECT tk.ten, dh.so_dien_thoai, dh.ngay_dat, dh.dia_chi_giao_hang, 
                        dh.tong_tien FROM don_hang dh JOIN tai_khoan tk ON dh.id_tk = tk.id WHERE dh.id = '". $_GET['id'] ."';";
                        try{
                          $sth = $pdo->query($query);
                          while($row = $sth->fetch()) {
                            
                            echo'
                            <h5 class="mb-0">Bản tóm tắt</h5>
                          </div>
                          <div class="card-body">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                  <strong>Tổng tiền(VNĐ)</strong>
                                </div>
                                <span><strong>' . $row['tong_tien'] . '</strong></span>
                              </li>
                            </ul>
                      
                            <div class="mb-3">

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Tên người đặt</span>
                                <input type="text" class="form-control text-center" placeholder="' . $row['ten'] . '" aria-label="Username" aria-describedby="basic-addon1" disabled>
                            </div>
  
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Số điện thoại</span>
                                <input type="text" class="form-control text-center" placeholder="'. $row['so_dien_thoai'] .'" aria-label="Username" aria-describedby="basic-addon1" disabled>
                            </div>
  
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Ngày đặt hàng</span>
                                <input type="text" class="form-control text-center" placeholder="'. $row['ngay_dat'] .'" aria-label="Username" aria-describedby="basic-addon1" disabled>
                              </div>
  
                            <label for="address" class="form-label">Địa chỉ giao hàng</label>
                            <textarea class="form-control" id="address" rows="3">'. $row['dia_chi_giao_hang'] .'</textarea>
                          </div>';
                          }
                        } catch(PDOException $e) {
                   
                        }
                        
                      ?>
                      <form action="Admin_shoppingcart.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <input type="hidden" name="trangthai" value="Đã xác nhận">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                          Xác nhận đơn hàng
                        </button>
                      </form>
                      
                      <form action="Admin_shoppingcart.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <input type="hidden" name="trangthai" value="Đã hủy đơn">
                        <button type="hidden" class="btn btn-danger btn-lg btn-block">
                          Hủy đơn hàng
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        
        
    </body>
</html>