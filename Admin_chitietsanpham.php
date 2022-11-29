<?php
include "db/connection.php";

if(isset($_POST['id'])){
  if(isset($_POST['delete2'])){
    $query = "UPDATE san_pham SET anh_2 = '' WHERE ID = ? ;";
  
    try {
      $sth = $pdo->prepare($query);
      $sth->execute([
        $_POST['id']
      ]);
    } 
    catch (PDOException $e) {
      $pdo_error = $e->getMessage();
    }

  } 

  if(isset($_POST['delete3'])){
    $query = "UPDATE san_pham SET anh_3 = '' WHERE ID = ? ;";
  
    try {
      $sth = $pdo->prepare($query);
      $sth->execute([
        $_POST['id']
      ]);
    } 
    catch (PDOException $e) {
      $pdo_error = $e->getMessage();
    }

  }

  if(isset($_POST['delete4'])){
    $query = "UPDATE san_pham SET anh_4 = '' WHERE ID = ? ;";
  
    try {
      $sth = $pdo->prepare($query);
      $sth->execute([
        $_POST['id']
      ]);
    } 
    catch (PDOException $e) {
      $pdo_error = $e->getMessage();
    }

  }
  
  if(isset($_POST['submit_luu'])) {
    if(isset($_FILES['hinh1'])) {
      $tmp_name = $_FILES["hinh1"]["tmp_name"];
      $name = $_FILES["hinh1"]["name"];
      echo $name;
      if($name != ""){
        move_uploaded_file($tmp_name, "./img/product/" . $name);
  
        $query = "UPDATE san_pham SET anh_1 = ? WHERE ID = ? ;";
    
        try {
          $sth = $pdo->prepare($query);
          $sth->execute([
            './img/product/'. $name, $_POST['id']
          ]);
        } catch (PDOException $e) {
          $pdo_error = $e->getMessage();
        }
      } 
    }
  
    if(isset($_FILES['hinh2'])) {
      $tmp_name = $_FILES["hinh2"]["tmp_name"];
      $name = $_FILES["hinh2"]["name"];
        echo $name;
        if($name != ""){
          move_uploaded_file($tmp_name, "./img/product/" . $name);
    
          $query = "UPDATE san_pham SET anh_2 = ? WHERE ID = ? ;";
      
          try {
            $sth = $pdo->prepare($query);
            $sth->execute([
              './img/product/'. $name, $_POST['id']
            ]);
          } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
          }
        } 
    }
  
      if(isset($_FILES['hinh3'])) {
        $tmp_name = $_FILES["hinh3"]["tmp_name"];
        $name = $_FILES["hinh3"]["name"];
        echo $name;
        if($name != ""){
          move_uploaded_file($tmp_name, "./img/product/" . $name);
      
          $query = "UPDATE san_pham SET anh_3 = ? WHERE ID = ? ;";
        
          try {
            $sth = $pdo->prepare($query);
            $sth->execute([
              './img/product/'. $name, $_POST['id']
            ]);
          } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
          }
        }
      }
  
      if(isset($_FILES['hinh4'])) {
        $tmp_name = $_FILES["hinh4"]["tmp_name"];
        $name = $_FILES["hinh4"]["name"];
        echo $name;
        if($name != ""){
          move_uploaded_file($tmp_name, "./img/product/" . $name);
        
          $query = "UPDATE san_pham SET anh_4 = ? WHERE ID = ? ;";
          
          try {
            $sth = $pdo->prepare($query);
            $sth->execute([
              './img/product/'. $name, $_POST['id']
            ]);
          } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
          }
        }
      }
  
  
      if(isset($_POST['ten'])) {    
      $query = "UPDATE san_pham SET ten = ? WHERE ID = ? ;";
              
      try {
        $sth = $pdo->prepare($query);
        $sth->execute([
          $_POST['ten'], $_POST['id']]);
      } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
      }
    }
      if(isset($_POST['so_luong'])) {
  
        $query="UPDATE san_pham SET so_luong = ? WHERE id = ?;";
        try {
          $sth = $pdo->prepare($query);
          $sth->execute([
            $_POST['so_luong'], $_POST['id']]);
        } catch (PDOException $e) {
          $pdo_error = $e->getMessage();
        }
  
      } else {
        $query = "SELECT * FROM size WHERE id <> 'S0';";
        try {
          $sth = $pdo->query($query);
          while($row = $sth->fetch()) {
            $query3="CALL listSP_size('" . $_POST['id'] . "','" . $row['id'] . "');";
            $sth3 = $pdo->query($query3);
            if($row3 = $sth3->fetch()) { 
              $query2="UPDATE sp_size SET so_luong = ? WHERE id_size = ? AND id_sp = ?;";

              try {
                $sth2 = $pdo->prepare($query2);
                $sth2->execute([
                  $_POST[$row['id']], $row['id'],$_POST['id']]);
              } catch (PDOException $e) {
                $pdo_error = $e->getMessage();
              }
            } else {
              $query2="INSERT INTO sp_size VALUES (?,?,?);";

              try {
                $sth2 = $pdo->prepare($query2);
                $sth2->execute([
                  $row['id'],$_POST['id'], $_POST[$row['id']]]);
              } catch (PDOException $e) {
                $pdo_error = $e->getMessage();
              }
            }
     
          }
        } catch(PDOException $e) {
          
        } 
      }
      
      
  
      $query = "UPDATE san_pham SET gioi_tinh = ? WHERE id = ?;";
              
      try {
        $sth = $pdo->prepare($query);
        $sth->execute([
          $_POST['gioi_tinh'], $_POST['id']]);
      } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
      }
  
      $query = "UPDATE san_pham SET id_lctsp = ? WHERE id = ?;";
              
      try {
        $sth = $pdo->prepare($query);
        $sth->execute([
          $_POST['loaisanpham'], $_POST['id']]);
      } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
      }
  
      $query = "UPDATE san_pham SET gia = ? WHERE id = ?;";
              
      try {
        $sth = $pdo->prepare($query);
        $sth->execute([
          $_POST['gia'], $_POST['id']]);
      } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
      }
  
  }


    
    if (isset($_POST['submit_themmota'])) {
      $query = "INSERT INTO mo_ta (id, tieu_de, noi_dung, id_sp) VALUES (?, ?, ?, ?)";
      try {
        $sth = $pdo->prepare($query);
        $sth->execute([
          $_POST['idmt'],
          $_POST['tieude'],
          $_POST['noidung'],
          $_POST['id'],
        ]);
      } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
      }
    }
 
    if (isset($_POST['submit_demota'])) {
      $query = "DELETE FROM mo_ta WHERE id = ?;";
      try {
        $sth = $pdo->prepare($query);
        $sth->execute([
          $_POST['ip_demota']
        ]);
      } catch (PDOException $e) {
        $pdo_error = $e->getMessage();
      }
    }


    $query = "SELECT * FROM san_pham WHERE id='" . $_POST['id'] . "'";
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
  } catch(PDOException $e) {

  }
}

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

    $query = "CALL list_CoSize('" .  $id . "')";
    
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
    <link rel="stylesheet" href="./css/Xemchitiet.css">
    <title>Xem chi tiết sản phẩm</title>
    <style>
      .mota {
        background-color: darkgray;
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        margin-bottom: 15px;
        border-radius: 10px;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">  

      <!--Bắt đầu từ đây-->
      <h2 style="margin: 20px 0 10px 0">CHI TIẾT SẢN PHẨM</h2>
      <form action="Admin_chitietsanpham.php" method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $id; ?>" name="id">
      <div class="row">
        <div class="card col-12 col-sm-8 col-md-5 col-lg-4 col-xl-3" style="border: none">
            <img src="<?php echo $anh1; ?>">
              <input type="file" name="hinh1" value="<?php echo $anh1 ;?>">

            <div class="card-body">
            </div>
        </div>

        <div class="col-12 col-sm-4 col-md-2 col-lg-2 col-xl-1" style="border: none" >
            <a class="card" style="height: 30%;">
            <?php 
              if($anh2 != "") {
                echo '<img src="' . $anh2 . '" class="card-img-top" alt="...">';
              }
            ?>
              <input type="file" name="hinh2" value="<?php echo $anh2 ;?>">
            </a>

              <form action="Admin_chitietsanpham.php" class="text-light" method="POST">
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <button type="submit" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" name="delete2" title="Remove item">
                    <i class="fas fa-trash"></i>
                </button>
              </form>
            
            <a  class="card" style="height: 30%;">
            <?php 
              if($anh3 != "") {
                echo '<img src="' . $anh3 . '" class="card-img-top" alt="...">';
              }
            ?>
              <input type="file" name="hinh3" value="<?php echo $anh3 ;?>">
            </a>

            <form action="Admin_chitietsanpham.php" class="text-light" method="POST">
              <input type="hidden" value="<?php echo $id; ?>" name="id">
              <button type="submit" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" name="delete3" title="Remove item">
                <i class="fas fa-trash"></i>
              </button>
            </form>

            </a>
            <a  class="card" style="height: 30%;">
            <?php 
              if($anh4 != "") {
                echo '<img src="' . $anh4 . '" class="card-img-top" alt="...">';
              }
            ?>
              <input type="file" name="hinh4" value="<?php echo $anh4 ;?>">
            </a>

            <form action="Admin_chitietsanpham.php" class="text-light" method="POST">
              <input type="hidden" value="<?php echo $id; ?>" name="id">
              <button type="submit" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" name="delete4" title="Remove item">
                <i class="fas fa-trash"></i>
              </button>
            </form>

          </a>


        </div>

        

        <div class="col-12 col-sm-12 col-md-5 col-lg-6 col-xl-8" style="border: none" >
          <input type="text" class="form-control w-75 form-control-lg" value="<?php echo $ten; ?>" name="ten">

          <div class="mb-3 row">
            <p class="col-sm-2 col-form-label">Giá (VNĐ):</p>
            <div class="mt-2 col-sm-10">
              <input type="text" class="form-control w-25" value="<?php echo $gia; ?>" name="gia">
            </div>
          </div>

          <?php
            if($co_size == 'Y') {
              echo '<div class="mb-3 row">
              <label for="staticEmail" class="col-sm-2 col-form-label">Size:</label>
              <div class="col-sm-10">
                <div class=" mt-1 row">';
                  
                    $query = "SELECT * FROM size";
                    try {
                      $sth = $pdo->query($query);
                      while($row = $sth->fetch()) {
                        if($row['id'] != 'S0') {
                          $query2 = "SELECT so_luong FROM sp_size WHERE id_sp = '" . $id . "' AND id_size = '" . $row['id'] . "'";
                        $sth2 = $pdo->query($query2);
                        $row2 = $sth2->fetch();
                            echo '<div class="pb-2 col-2">
                            <!--<input class="form-check-input" type="radio" name="gioi_tinh" id="inlineRadio1" value="option1">-->
                            <label class="" for="inlineRadio1">' . substr($row['size'], 5) . '</label>
                            <input class="w-50" type="number" name="' . $row['id'] . '" min="0" value="';
                            if(empty($row2['so_luong']) == 1) {
                              echo "0";
                            } else {
                              echo $row2['so_luong'];
                            }
                            echo '">
                          </div>';
                        }
                        
                        
                      }
                    }
                    
                    catch(PDOException $e) {
                    
                    }
                  
                  
            echo "</div></div></div>";
            } else {
              
              echo '<div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Số lượng:</label>
            <div class="col-sm-10">
              <div class=" mt-1">
                  <input class="w-50" type="number" name="so_luong" min="0" value="';
                  $query = "SELECT so_luong FROM san_pham WHERE id='" . $id . "'";
                  try {
                    $sth = $pdo->query($query);
                    if($row = $sth->fetch()) {
                      echo $row['so_luong'];
                    }
                  }
                  
                  catch(PDOException $e) {
                  
                  } 
                  echo '">
              </div>
            </div>
          </div>';
            }
          ?>

          

          
          <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Giới tính:</label>
            <div class="mt-2 col-sm-10">
              <div class="form-check form-check-inline">
                <input class="form-check-input"
                <?php
                    if($gioitinh == "M") {
                      echo "checked";
                    }
                  ?>
                type="radio" name="gioi_tinh" id="inlineRadio1" value="M">
                <label class="form-check-label" for="inlineRadio1">Nam</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input"
                <?php
                    if($gioitinh == "F") {
                      echo "checked";
                    }
                  ?>
                type="radio" name="gioi_tinh" id="inlineRadio2" value="F">
                <label class="form-check-label" for="inlineRadio2">Nữ</label>
              </div>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="staticsanpham" class="col-sm-2 col-form-label">Loại chi tiết sản phẩm:</label>
            <div class="mt-2 col-sm-10">
              <select name="loaisanpham" id="staticsanpham">
                <?php 
                  $query = "SELECT * FROM loai_chi_tiet_san_pham";
                  try {
                    $sth = $pdo->query($query);
                    while($row = $sth->fetch()) {
                      if($loaichitietsanpham == $row['id']){
                        echo "<option selected value='" . $row['id'] . "'>" . $row['ten'] . "</option>";
                      } else {
                        echo "<option value='" . $row['id'] . "'>" . $row['ten'] . "</option>";
                      }
                      
                    }
                  }
                  
                  catch(PDOException $e) {
                  
                  } 
                ?>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-success btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="edit item" name="submit_luu">
            <i class="fa fa-check"></i>
            Lưu
          </button>
        </div>


        
        
        </div>

        <form action="Admin_chitietsanpham.php" method="POST">
          <div class="mota">
            <input type="hidden" value="<?php if(isset($_GET['id'])) {echo $_GET['id'];} else if($_POST['id']) {echo $_POST['id'];}?>" name="id">
            <input type="text" class="mb-3 m-0 form-control w-75 form-control-lg" placeholder="ID mô tả" name="idmt">
            <input type="text" class="m-0 form-control w-75 form-control-lg" placeholder="Thêm tiêu đề" name="tieude">
            <div class="m-0">
              <label class="form-label"></label>
              <textarea class="form-control" rows="3" placeholder="Thêm nội dung" name="noidung"></textarea>
            </div>
            <div class="mt-3 text-center">       
              <button type="submit" class="btn btn-success btn-sm mb-2" name="submit_themmota">
                <i class="fas fa-plus"></i>
                Thêm mô tả
              </button>
            </div>
          </div>

        </form>  
        <?php
          $query = "SELECT * FROM mo_ta WHERE id_sp='" . $id . "'";
          try {
            $sth = $pdo->query($query);
            while($row = $sth->fetch()) {
              echo '<div class="mota">
              <form action="Admin_chitietsanpham.php" method="POST">
              <input type="hidden" name="id" value="';
              if(isset($_POST['id'])){
                echo $_POST['id'];
              } else if(isset($_GET['id'])){
                echo $_GET['id'];
              }
              
              echo '">
              <input type="text" class="mb-3 m-0 form-control w-75 form-control-lg" name="ip_demota" value="' . $row['id'] . '">
              <input type="text" class="m-0 form-control w-75 form-control-lg" value="' . $row['tieu_de'] . '">
              <div class="m-0">
                <label class="form-label"></label>
                <textarea class="form-control"  rows="3">' . $row['noi_dung'] . '</textarea>
              </div>
              <div class="mt-3 text-center">
              

                <button type="submit" class="btn btn-danger btn-sm mb-2" name="submit_demota">
                  <i class="fas fa-trash"></i>
                  Xóa mô tả
                </button>
                </div>
              </form>    
                                  
            </div>';
            }
          }

          catch(PDOException $e) {

          } 
        ?>                   
      </div>
      </form>



      </div>
    </div>
  
    
  </body>
</html>