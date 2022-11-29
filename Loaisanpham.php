<?php
include "db/connection.php";

if (!empty($_POST['id']) && !empty($_POST['loai_sp'])) {
  $query = "INSERT INTO loai_san_pham (id,ten,co_size) VALUES (?,?, ?)";

  try {
    $sth = $pdo->prepare($query);
    $sth->execute([
      $_POST['id'],
      $_POST['loai_sp'],
      $_POST['flexRadioDefault']
    ]);
  } 
  catch (PDOException $e) {
    $pdo_error = $e->getMessage();
  }
} else if(isset($_GET['id'])) {
  $query = "DELETE FROM loai_san_pham WHERE id= ? ";

  try {
    $sth = $pdo->prepare($query);
    $sth->execute([
      $_GET['id']
    ]);
  } catch (PDOException $e) {
    $pdo_error = $e->getMessage();
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
    <link rel="stylesheet" href="./css/Admin.css">
    <title>Quản lý loại sản phẩm</title>
  </head>
  <body>
    <div class="container-fluid"> 
      <!--Bắt đầu từ đây-->
      <div class="row">
          <div class="card col-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" style=" background-color: darkslateblue; height: 100vh;">
              <nav class="nav flex-column">
                  <a class="mt-2 nav-link text-danger" href="Trangchu.php"><img src="./img/logo/logo.jpg"></a>
                  <a class="mt-2 nav-link text-light" href="Admin.php">Quản lý sản phẩm</a>
                  <a class="mt-2 nav-link text-light" href="Admin_user.php">Quản lý tài khoản</a>
                  <a class="mt-2 nav-link text-light" href="Admin_shoppingcart.php">Quản lý đơn hàng</a>
                  <a class="mt-2 nav-link text-info" href="Loaisanpham.php">Quản lý loại sản phẩm</a>
                  <a class="mt-2 nav-link text-light" href="Loaichitietsanpham.php">Quản lý loại chi tiết sản phẩm</a>
                  <a class="mt-2 nav-link text-light" href="Size.php">Quản lý Size</a>
              </nav>
          </div>
          

          <div class="col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10" style="border: none" >
          
            <h1 class="mt-5 mb-4 text-center">Quản lý loại sản phẩm</h1>
            <div class="mx-auto" style="width: 85%">
              <form class="mb-3 mt-3 d-inline" role="search">
                <a href="Themloaisanpham.php"><button class="btn btn-outline-success" type="button">Thêm</button></a>
                &nbsp; &nbsp;
              </form>

              <form class="d-inline float-end w-50" action="Loaisanpham.php">
                <input class="mx-auto form-control me-2 w-75 d-inline" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>

              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">STT</th>
                      <th scope="col">ID</th>
                      <th scope="col">Loại Sản phẩm</th>
                      <th scope="col">Size</th>
                      <th scope="col">Điều chỉnh</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $stt = 1;
                      $query = 'CALL listLSP()';
                      if(isset($_GET["search"])) {
                        $query .= " WHERE loai_san_pham.ten LIKE '%" . $_GET['search']. "%'";
                      }
                      try {
                          $sth = $pdo->query($query);
                          while ($row = $sth->fetch()) {
                            echo '<tr>
                            <th scope="row">' . $stt . '</th>
                            <td>' . $row["id"] . '</td>
                            <td>' . $row["ten"] . '</td>
                            <td>'. $row["co_size"] . '</td>
                            <td>
                              <a href="Sualoaisanpham.php?id=' . $row['id'] . '" class="text-light">
                                <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="edit item">
                                  <i class="fas fa-cog"></i>
        
                                </button>
                              </a>
      
                              <a href="Loaisanpham.php?id=' . $row['id'] . '" class="text-light">
                                <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                  <i class="fas fa-trash"></i>
                                </button>
                              </a>
      
                            </td>
                            
                          </tr>';

                          $stt++;
                          }
                      }

                      catch (PDOException $e) {
                          
                      }
                    
                    
                    ?>
                  </tbody>
                </table>
              </div>
          
          </div>
      </div>
    </div>
  </body>
</html>