<?php
include "db/connection.php";

if(isset($_GET['id'])) {
  $query = "DELETE FROM san_pham WHERE id= ? ";
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
    <title>Admin</title>
  </head>
  <body>
    <div class="container-fluid">
      <!--Bắt đầu từ đây-->
      <div class="row">
          <div class="card col-12 col-sm-2 col-md-2 col-lg-2 col-xl-2" style=" background-color: darkslateblue; height: 100vh;">
              <nav class="nav flex-column">
                <a class="mt-2 nav-link text-danger" href="Trangchu.php"><img src="./img/logo/logo.jpg"></a>
                  <a class="mt-2 nav-link text-info" href="Admin.php">Quản lý sản phẩm</a>
                  <a class="mt-2 nav-link text-light" href="Admin_user.php">Quản lý tài khoản</a>
                  <a class="mt-2 nav-link text-light" href="Admin_shoppingcart.php">Quản lý đơn hàng</a>
                  <a class="mt-2 nav-link text-light" href="Loaisanpham.php">Quản lý loại sản phẩm</a>
                  <a class="mt-2 nav-link text-light" href="Loaichitietsanpham.php">Quản lý loại chi tiết sản phẩm</a>
                  <a class="mt-2 nav-link text-light" href="Size.php">Quản lý Size</a>
              </nav>
          </div>
          

          <div class="col-12 col-sm-10 col-md-10 col-lg-10 col-xl-10" style="border: none" >
          
            <h1 class="mt-5 mb-4 text-center">Quản lý sản phẩm</h1>
            <div class="mx-auto" style="width: 85%">
              <div>
              <form class="d-inline float-end w-50" action="Admin.php">
                  <input class="mx-auto form-control me-2 w-75 d-inline" type="search" placeholder="Search" aria-label="Search" name="search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              <a href="Themsanpham.php"><button class="btn btn-outline-success" type="button">Thêm</button></a>
                &nbsp; &nbsp;
                <div class="dropdown d-inline">
                  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: darkslateblue; border: none; font-size: 18px;">
                    Loại sản phẩm
                  </a>
                  <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="./Admin.php" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Tất cả'">Tất cả</a></li>
                  <?php
                      $query= "SELECT ten FROM loai_chi_tiet_san_pham;";

                      $sth = $pdo->query($query);
                      while($row = $sth->fetch()) {
                        echo "<li><a class='dropdown-item' href='./Admin.php?lctsp=" . $row['ten'] . "' onClick='document.getElementById(`menu-value-loaisanpham`).innerHTML=`" . $row['ten'] . "`'>" . $row['ten'] . "</a></li>";
                      }
                  ?>
                  
                    
                    
                  </ul>
                  &nbsp; &nbsp;
                  <span id="menu-value-loaisanpham" class="mt-2 fs-6"><?php 
                  if(isset($_GET['lctsp'])){
                    echo $_GET['lctsp'];
                  } else {
                    echo 'Tất cả';
                  }
                  
                  ?> </span>
              
                </div>
              </div>
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">STT</th>
                      <th scope="col">ID</th>
                      <th scope="col">Tên sản phẩm</th>
                      <th scope="col">Loại chi tiết sản phẩm</th>
                      <th scope="col">Điều chỉnh</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 

                      $stt = 1;
                      $query = "SELECT san_pham.id, san_pham.ten, loai_chi_tiet_san_pham.ten Ten_lctsp FROM san_pham JOIN loai_chi_tiet_san_pham ON san_pham.id_lctsp = loai_chi_tiet_san_pham.id";
                      if(isset($_GET["lctsp"])) {
                        $query .= " WHERE loai_chi_tiet_san_pham.ten = '" . $_GET["lctsp"] . "' ";
                      } else if(isset($_GET["search"])) {
                        $query .= " WHERE san_pham.ten LIKE '%" . $_GET['search']. "%'";
                      }
                      $query .= " ORDER BY cast(substr(san_pham.id, 3, 3) as unsigned)";

                      try {
                        $sth = $pdo->query($query);
                        while($row = $sth->fetch()) {
                          echo '<tr>
                          <th scope="row">' . $stt .'</th>
                          <td>' . $row['id'] . '</td>
                          <td><a href="" class="text-dark" style="text-decoration: none">' . $row['ten'] . '</a></td>
                          <td>' . $row['Ten_lctsp'] . '</td>
                          <td>
                              <a href="Admin_chitietsanpham.php?id=' . $row['id'] . '" class="text-light">
                                  <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="edit item">
                                      <i class="fas fa-cog"></i>
                                  </button>
                              </a>
      
                              <form action="Admin.php" class="text-light d-inline" method="GET">
                                <input type="hidden" name="id" value="' . $row['id'] . '">
                                  <button type="sumbit" onClick="return confirm(\'Ban co muon xoa ' . $row['id'] . '\');"
                                  class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                      <i class="fas fa-trash"></i>
                                  </button>
                              </form>
      
                          </td>
                        </tr>';

                        $stt++;

                        }
                      }

                      catch(PDOException $e) {

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