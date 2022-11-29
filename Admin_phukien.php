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
    <link rel="stylesheet" href="./css/Admin_phukien.css">
    <title>Quản lý phụ kiện</title>
  </head>
  <body>

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
        
          <h1 class="mt-5 mb-4 text-center">Quản lý phụ kiện</h1>
          <div class="mx-auto" style="width: 85%">
            <form class="mb-3 mt-3 d-flex" role="search">
              <button class="btn btn-outline-success" type="submit">Thêm</button>
              &nbsp; &nbsp;
              <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: darkslateblue; border: none; font-size: 18px;">
                  Loại sản phẩm
                </a>
              
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Tất cả'">Tất cả</a></li>
                  <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Kính râm'">Kính râm</a></li>
                  <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Cà vạt'">Cà vạt</a></li>
                  <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Thắt lưng'">Thắt lưng</a></li>
                  <li><a class="dropdown-item" href="#" onClick="document.getElementById('menu-value-loaisanpham').innerHTML='Vớ'">Vớ</a></li>
                </ul>
                &nbsp; &nbsp;
                <span id="menu-value-loaisanpham" class="mt-2 fs-6">Tất cả</span>
            
              </div>
                <input class="mx-auto form-control me-2 w-50" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">ID</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Loại sản phẩm</th>
                    <th scope="col">Điều chỉnh</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>PK1</td>
                    <td><a href="Admin_chitietsanpham.php" class="text-dark" style="text-decoration: none">Kính râm nam 1</a></td>
                    <td>Kính râm</td>
                    <td>
                        <a href="Ao.php" class="text-light">
                            <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="edit item">
                                <i class="fas fa-cog"></i>
                            </button>
                        </a>

                        <a href="Trangchu.php" class="text-light">
                            <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                <i class="fas fa-trash"></i>
                            </button>
                        </a>

                    </td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>PK2</td>
                    <td><a href="" class="text-dark" style="text-decoration: none">Thắt lưng 1</a></td>
                    <td>Thắt lưng</td>
                    <td>
                        <a href="Ao.php" class="text-light">
                            <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="edit item">
                                <i class="fas fa-cog"></i>
                            </button>
                        </a>

                        <a href="Trangchu.php" class="text-light">
                            <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                <i class="fas fa-trash"></i>
                            </button>
                        </a>

                    </td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>PK3</td>
                    <td><a href="" class="text-dark" style="text-decoration: none">Thắt lưng nữ 1</a></td>
                    <td>Thắt lưng</td>
                    <td>
                        <a href="Ao.php" class="text-light">
                            <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="edit item">
                                <i class="fas fa-cog"></i>
                            </button>
                        </a>

                        <a href="Trangchu.php" class="text-light">
                            <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                <i class="fas fa-trash"></i>
                            </button>
                        </a>

                    </td>
                  </tr>

                  <tr>
                    <th scope="row">4</th>
                    <td>PK4</td>
                    <td><a href="" class="text-dark" style="text-decoration: none">Cà vạt 4</a></td>
                    <td>Cà vạt</td>
                    <td>
                        <a href="Ao.php" class="text-light">
                            <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="edit item">
                                <i class="fas fa-cog"></i>
                            </button>
                        </a>

                        <a href="Trangchu.php" class="text-light">
                            <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                <i class="fas fa-trash"></i>
                            </button>
                        </a>

                    </td>
                  </tr>

                  <tr>
                    <th scope="row">5</th>
                    <td>PK5</td>
                    <td><a href="" class="text-dark" style="text-decoration: none">Vớ</a></td>
                    <td>Vớ</td>
                    <td>
                        <a href="Ao.php" class="text-light">
                            <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="edit item">
                                <i class="fas fa-cog"></i>
                            </button>
                        </a>

                        <a href="Trangchu.php" class="text-light">
                            <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                                <i class="fas fa-trash"></i>
                            </button>
                        </a>

                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
        
        </div>

    </div>
  </body>
</html>