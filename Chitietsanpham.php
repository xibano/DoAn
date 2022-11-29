<?php
include "db/connection.php";
session_start();


  if(isset($_GET['id'])) {
    $query = "SELECT * FROM san_pham WHERE id='" . $_GET['id'] . "'";
    try {
      $sth = $pdo->query($query);
      if($row = $sth->fetch()) {
        $id = $row['id'];
        $anh1 = $row['anh_1'];
        $anh2 = $row['anh_2'];
        $anh3 = $row['anh_3'];
        $anh4 = $row['anh_4'];
        $ten = $row['ten'];
        $gia = $row['gia'];
        $gioitinh = $row['gioi_tinh'];
        $loaichitietsanpham = $row['id_lctsp'];

        $query = "SELECT sp.id, sp.ten, lsp.co_size FROM san_pham sp JOIN loai_chi_tiet_san_pham lctsp ON sp.id_lctsp = lctsp.id
        JOIN loai_san_pham lsp ON lctsp.id_lsp = lsp.id WHERE sp.id = '" .  $id . "';";
        
        $sth = $pdo->query($query);
        if($row2 = $sth->fetch()) {
          $co_size = $row2['co_size'];
        }
      }
    }

    catch(PDOException $e) {

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
    <link rel="stylesheet" href="./css/Chitietsanpham.css">
    <title>Chi tiết sản phẩm</title>
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
    <h2 style="margin: 20px 0 10px 0">CHI TIẾT SẢN PHẨM</h2>
    <div class="row">
      <div class="card col-12 col-sm-8 col-md-5 col-lg-4 col-xl-3" style="border: none">
          <a><img src="<?php echo $anh1; ?>" class="card-img-top" alt="..."></a>
          <div class="card-body">
          </div>
      </div>

      <div class="card col-12 col-sm-4 col-md-2 col-lg-2 col-xl-1" style="border: none" >
          <a style="height: 25%;"><img src="<?php echo $anh2; ?>" class="card-img-top" alt="..."></a>
          <a style="height: 25%;"><img src="<?php echo $anh3; ?>" class="card-img-top" alt="..."></a>
          <a style="height: 25%;"><img src="<?php echo $anh4; ?>" class="card-img-top" alt="..."></a>
      </div>
      
      <div class="col-12 col-sm-12 col-md-5 col-lg-6 col-xl-8" style="border: none" >
      <form action="Giohang.php" method="POST">
        <input type="hidden" name="idsp" value="<?php echo $_GET['id'];?>">
        <p class="fs-3 fw-bolder"><?php echo $ten; ?></p>
        <div class="mb-3 row">
          <input type="hidden" name="gia" value="<?php echo $gia; ?>">
          <p class="col-sm-2 col-form-label">Giá(VNĐ):</p>
          <div class="mt-2 col-sm-10">
            <?php echo $gia; ?>
          </div>
        </div>

        <!--<div class="mb-3 row">
          <p class="col-sm-2 col-form-label">Màu sắc:</p>
          <div class="mt-2 col-sm-10">
           Xanh lá
          </div>
        </div>-->
    
          <div class="mb-3 row">
            
            <?php
              $query1="SELECT lsp.co_size FROM san_pham sp JOIN loai_chi_tiet_san_pham lctsp ON sp.id_lctsp = lctsp.id JOIN loai_san_pham lsp ON lsp.id = lctsp.id_lsp
              WHERE sp.id='". $_GET['id'] . "';";
              try{
                $sth1 = $pdo->query($query1);
                if($row1 = $sth1->fetch()){
                  if($row1['co_size'] == 'Y'){
                    echo'<label for="staticEmail" class="col-sm-2 col-form-label">Size:</label>
                    <div class="mt-2 col-sm-10">';

                    $query="SELECT * FROM size";
                      try{
                        $sth = $pdo->query($query);
                        while($row = $sth->fetch()){
                          if($row['id'] != 'S0') {
                            echo'
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="size" id="inlineRadio1" value="' . $row['id'] . '">
                                <label class="form-check-label" for="inlineRadio1">'. substr($row['size'], 5) .'</label>
                              </div>
                            ';
                          } 
                        }
                      } catch(PDOException $e) {
                            
                      }

                      echo '</div>';
                  }
                }
              } catch(PDOException $e) {
                    
              }


              
            ?>
          </div>
        <div class="mb-3 row">
          <label for="inputnumber" class="col-sm-2 col-form-label">Số lượng:</label>
          <div class="col-sm-10">
            <input type="number" class="form-control w-50" id="inputnumber" value="1" min="0" name="sl">
          </div>
        </div>

        
        
          <button type="submit" class="btn btn-outline-secondary" name="submit_sp"><i class="fa fa-shopping-cart"></i> Đặt hàng</button>
        </form>
      </div>

      <!--<div>
        <h2>Chi tiết</h2>
        
                          <p>Áo thun nam cổ tròn, tay ngắn. Trang trí hình và chữ sinh động mặt trước. Dáng áo suông cơ bản.</p> <br>

                          <p>Chất liệu thun cao cấp cùng thiết kế bắt mắt, mang đến cho bạn nam sự trẻ trung, năng động nhưng cũng không kém phần hiện đại. Bên cạnh đó, sản phẩm với gam màu trung tính, 
                          giúp bạn nam dễ phối cùng các phụ kiện khác làm tăng thêm sự sành điệu trong phong cách thời trang của mình. <br></p>
                          
                          <p>Màu sắc: Cam - Xanh Lơ - Xanh Cổ Vịt Nhạt </p>
      </div>

      <div>
        <h2 style="margin-top: 30px">Cách bảo quản</h2>         

                          <p>* Vải dệt kim : sau khi giặt sản phẩm phải được phơi ngang tránh bai dãn. <br> </p>
                          
                          <p>* Vải voan , lụa , chiffon nên giặt bằng tay. <br></p>
                          
                          <p>* Vải thô , tuytsy , kaki không có phối hay trang trí đá cườm thì có thể giặt máy. <br></p>
                          
                          <p>* Vải thô , tuytsy, kaki có phối màu tường phản hay trang trí voan , lụa , đá cườm thì cần giặt tay. <br></p>
                          
                          <p>* Đồ Jeans nên hạn chế giặt bằng máy giặt vì sẽ làm phai màu jeans.Nếu giặt thì nên lộn trái sản phẩm khi giặt , đóng khuy , kéo khóa, không nên giặt chung cùng đồ sáng màu , tránh dính màu vào các sản phẩm khác. <br></p>
                          
                          <p>* Các sản phẩm cần được giặt ngay không ngâm tránh bị loang màu , phân biệt màu và loại vải để tránh trường hợp vải phai. Không nên giặt sản phẩm với xà phòng có chất tẩy mạnh , nên giặt cùng xà phòng pha loãng. <br></p>
                          
                          <p>* Các sản phẩm có thể giặt bằng máy thì chỉ nên để chế độ giặt nhẹ , vắt mức trung bình và nên phân các loại sản phẩm cùng màu và cùng loại vải khi giặt. <br></p>
                          
                          <p>* Nên phơi sản phẩm tại chỗ thoáng mát , tránh ánh nắng trực tiếp sẽ dễ bị phai bạc màu , nên làm khô quần áo bằng cách phơi ở những điểm gió sẽ giữ màu vải tốt hơn. <br></p>
                          
                          <p>* Những chất vải 100% cotton , không nên phơi sản phẩm bằng mắc áo mà nên vắt ngang sản phẩm lên dây phơi để tránh tình trạng rạn vải. <br></p>
                          
                          <p>* Khi ủi sản phẩm bằng bàn là và sử dụng chế độ hơi nước sẽ làm cho sản phẩm dễ ủi phẳng , mát và không bị cháy , giữ màu sản phẩm được đẹp và bền lâu hơn. Nhiệt độ của bàn là tùy theo từng loại vải. <br></p>
      </div>  -->


      <?php
$query = "SELECT * FROM mo_ta WHERE id_sp='" . $id . "'";
try {
  $sth = $pdo->query($query);
  while($row = $sth->fetch()) {
    echo '
    <div class="mota">
      <p>' . $row['tieu_de'] . '</p>
      <div class="m-0">
        <label class="form-label"></label>
        <p>' . $row['noi_dung'] . '</p>
      </div>                   
    </div>';
  }
}

catch(PDOException $e) {

} 
      ?>
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