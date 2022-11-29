<?php
include "db/connection.php";
session_start();
if(isset($_SESSION['user'])) {
    $query = "SELECT cast(substring(id, 3, 1) as unsigned) iddh FROM don_hang ORDER BY id DESC LIMIT 1;";
    $sth = $pdo->query($query);
    if($row = $sth->fetch()) {
      $iddh = 'DH' . ($row['iddh'] + 1);
      
    } else {
        $iddh = 'DH0';
    }

    if(isset($_POST['sdt'])) {
        $sdt =  $_POST['sdt'];
        $dc  = $_POST['dcgh'];
        $date = getdate();
        
        $ngay = $date['year'] .  '-' . $date['mon'] . '-' . $date['mday'];
        $idgh =  $_POST['idgh'];



        $query = "SELECT tong_tien FROM gio_hang WHERE id = '$idgh';";
        $sth = $pdo->query($query);
        if($row = $sth->fetch()) {
        $tong_tien =  $row['tong_tien'];
        
        }

        $query = "INSERT INTO don_hang VALUES (?,?,?,?,?,?,?);";
        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $iddh, $sdt, $dc,  $ngay, $tong_tien, 'Chờ xác nhận' , $_SESSION['user'] ]);
        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }

        $query = "SELECT id_size, id_sp, so_luong FROM so_luong_gio_hang WHERE id_gh = '$idgh';";
        $sth = $pdo->query($query);
        while($row = $sth->fetch()) {
        $query2 = "INSERT INTO so_luong VALUES (?,?,?,?);";
        try {
            $sth2 = $pdo->prepare($query2);
            $sth2->execute([
              $row['so_luong'],$row['id_size'], $row['id_sp'], $iddh]);
        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }
        
    }

        $query = "DELETE FROM so_luong_gio_hang WHERE id_gh = ?;";
        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $idgh ]);
        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }

        $query = "UPDATE gio_hang SET tong_tien = 0 WHERE id = ?;";
        try {
            $sth = $pdo->prepare($query);
            $sth->execute([
                $idgh ]);
        } catch (PDOException $e) {
            $pdo_error = $e->getMessage();
        }

        

    }
   

    

    $query = "SELECT * FROM don_hang dh WHERE dh.id_tk ='". $_SESSION['user'] . "'";
    $sth = $pdo->query($query);
    if($row = $sth->fetch()) {
    }

    if(isset($_POST['submit_dh'])) {
        $query="SELECT cast(substring(id, 3, 1) as unsigned) iddh FROM don_hang ORDER BY id DESC LIMIT 1;";
        $sth = $pdo->query($query);
        if($row = $sth->fetch()) {
            $iddh = "DH" . ($row['iddh'] + 1);
        }

        $dcgh = $_POST['dcgh'];
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
        <link rel="stylesheet" href="Ao.css">
        <title>Danh sách đơn hàng</title>
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
      
                    <form class="d-flex" role="search" action="Giohang.php">
                    <button class="btn btn-outline-success" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>  
                    </form>
      
                </div>
            </div>
        </nav>

        <table class="table text-center col-12 col-sm-6 col-md-4 col-lg-3">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="cok">ID Đơn Hàng</th>
                    <th scope="col">Ngày đặt</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Xem chi tiết</th>     
                </tr>
            </thead>

            <tbody>
                <?php
                    $stt = 1;
                    $query = "SELECT dh.id, dh.ngay_dat, dh.tong_tien FROM don_hang dh JOIN tai_khoan tk ON tk.id = dh.id_tk WHERE dh.id_tk ='". $_SESSION['user'] . "'";

                    try {
                      $sth = $pdo->query($query);
                    //   echo $query;
                      while($row = $sth->fetch()) {

                        echo '
                        <tr>
                            <th scope="row">' . $stt++ . '</th>
                                <td>' . $row['id'] . '</td>
                                <td>' . $row['ngay_dat'] . '</td>
                                <td>' . $row['tong_tien'] . '</td>
                                <td>
                                    <a href="User_chitietdonhang.php?id=' . $row['id'] . '" class="text-light">
                                        <button type="button" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="edit item">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                    </a>
                                </td>
                        </tr>';
                      }
                    }
                    catch(PDOException $e) {

                    }
                ?>
            </tbody>

        </table>


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