
<?php

include "db/connection.php";
  if(isset($_POST['id'])){
    $query="INSERT INTO san_pham VALUES (?,?,?,?,?,?,?,?,?,?);";

  try {
    $sth = $pdo->prepare($query);
    $sth->execute([
      $_POST['id'],
      '',
      '',
      '',
      '',
      $_POST['ten'],
      $_POST['gia'],
      $_POST['soluong'],
      $_POST['gioitinh'],
      $_POST['lctsp']
    ]);
  } catch (PDOException $e) {
    $pdo_error = $e->getMessage();
  }

  if(isset($_FILES['hinh1'])) {
    $tmp_name = $_FILES["hinh1"]["tmp_name"];
    $name = $_FILES["hinh1"]["name"];
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
    <title>Thêm sản phẩm</title>
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


    <!--Bắt đầu từ đây-->
    <h2 style="margin: 20px 0 10px 0">CHI TIẾT SẢN PHẨM</h2>
    <form action="Themsanpham.php" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="card col-12 col-sm-8 col-md-5 col-lg-4 col-xl-3" style="border: none">
        
          <input type="file" name="hinh1">
        
          <div class="card-body">
        </div>
      </div>

      <div class="col-12 col-sm-4 col-md-2 col-lg-2 col-xl-1" style="border: none" >
         
         


      </div>
      

      <div class="col-12 col-sm-12 col-md-5 col-lg-6 col-xl-8" style="border: none" >
        <input type="text" class="mb-3 form-control w-75 form-control-lg" value="" placeholder="ID sản phẩm" name="id">
        <input type="text" class="form-control w-75 form-control-lg" value="" placeholder="Tên sản phẩm" name="ten">

        <div class="mb-3 row">
          <p class="col-sm-2 col-form-label">Giá (VNĐ):</p>
          <div class="mt-2 col-sm-10">
            <input type="text" class="form-control w-25" value="" name="gia">
          </div>
        </div>

        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Size:</label>
          <div class="col-sm-10">
            <div class=" mt-1 row">
              <?php
                $query = "SELECT * FROM size";
                      try {
                        $sth = $pdo->query($query);
                        while($row = $sth->fetch()) {
                              echo '<div class="pb-2 col-2">
                              <label class="" for="inlineRadio1">' . substr($row['size'], 5) . '</label>
                              <input class="w-50" type="number" min="0" value="0" name="' . substr($row['size'], 5) .'">
                            </div>';
                        }
                      } catch(PDOException $e) {
                    
                      }
              ?>
            </div>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Số lượng:</label>
          <div class="col-sm-10">
            <div class=" mt-1">
              
                <!--<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">-->
                
                <input class="w-50" type="number" min="0" value="0" name="soluong">
            </div>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Giới tính:</label>
          <div class="mt-2 col-sm-10">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gioitinh" id="inlineRadio1" value="M">
              <label class="form-check-label" for="inlineRadio1">Nam</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gioitinh" id="inlineRadio2" value="F">
              <label class="form-check-label" for="inlineRadio2">Nữ</label>
            </div>
          </div>
        </div>

        <div class="mb-3 row">
        <label for="staticsanpham" class="col-sm-2 col-form-label">Loại chi tiết sản phẩm:</label>
            <div class="mt-2 col-sm-10">
              <select name="lctsp" id="staticsanpham">
                <?php 
                  $query = "SELECT * FROM loai_chi_tiet_san_pham";
                  try {
                    $sth = $pdo->query($query);
                    while($row = $sth->fetch()) {
                      echo "<option value='" . $row['id'] . "'>" . $row['ten'] . "</option>";
                    }
                  }
                  
                  catch(PDOException $e) {
                  
                  } 
                ?>
              </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="edit item">
          <i class="fa fa-check"></i>
          Lưu
        </button>
      </div>


       
      
      </div>


      <div class="mota">
        <input type="text" class="m-0 form-control w-75 form-control-lg" placeholder="Thêm tiêu đề">
        <div class="m-0">
          <label class="form-label"></label>
          <textarea class="form-control" rows="3" placeholder="Thêm nội dung"></textarea>
        </div>
        <div class="mt-3 text-center">
        <button type="button" class="btn btn-success btn-sm mb-2">
          <i class="fas fa-plus"></i>
          Thêm mô tả
        </button>
        </div>
      </div>






                        
              
    </div>
    </form>


  </div>
        
    
  </body>
</html>