<?php
session_start(); // Mulai sesi di awal file

include 'koneksi.php';

// Periksa apakah user_id ada di sesi
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Mempersiapkan dan menjalankan statement SQL
    $sql = "SELECT name FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $stmt->close();
} else {
    $user = null;
}

$query = "SELECT *, (stock_supervip + stock_vip + stock_reguler) FROM konser ORDER BY (stock_supervip + stock_vip + stock_reguler) DESC LIMIT 3";
$result = mysqli_query($conn, $query);
$tampung = [];
while ($row = mysqli_fetch_assoc($result)) {
    $tampung[] = $row;
}

$kueri = "SELECT * FROM konser";
$result2 = mysqli_query($conn, $kueri);
$temp = [];
while ($row2 = mysqli_fetch_assoc($result2)) {
    $temp[] = $row2;
}

// Proses pencarian
if (isset($_GET['search'])) {
    $search_query = trim($_GET['search']);
    if (!empty($search_query)) {
        header("Location: searchview.php?search=" . urlencode($search_query));
        exit();
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Logo/stock-photo-cartoon-emoji-hand-holding-microphone-and-showing-victory-gesture-isolated-over-purple-background-2175571409.jpg">
    <link rel="stylesheet" href="style.css">
    <title>Local Party Night - Order Now</title>
</head>
<body>
    <div class="container">
        <!-- header -->
        <header>
            <div class="nav">
                <a href="index.php" class="logo">LocalNight</a>
                <!-- Search Bar -->
                <div class="search">
                    <form action="index.php" method="get">
                        <input class="search-box" type="text" name="search" placeholder="Search...">
                    </form>
                    <div class="cone-filter" href="#">
                        <div class="container-cone">
                            <img src="img/icon/bx-filter.svg" alt="">
                            <div class="cone-content">
                                <p class="filter-by">Filter By :</p>
                                <br>
                                <a href="searchview.php?filter=name" class="link-filter" >Name</a>
                                <br>
                                <a href="searchview.php?filter=location" class="link-filter">Location</a>
                                <br>
                                <a href="searchview.php?filter=date" class="link-filter">Date</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Account and Balance -->
                <div class="nav-menu">
                    <a href="list_tickets.php" class="menu-bar cart"><img src="img/icon/bx-cart-alt-white.svg" alt=""></a>
                    <div class="dropdown">
                        <a href="#" class="menu-bar user">
                            <?php
                            if (!isset($_SESSION['user_id'])) {
                                echo "<div class='sign-in-btn'><a class ='sign-in' href='login.html'>Sign In</a></div>";
                            } else {
                                echo "<img src='img/icon/bx-user.svg' alt=''>";
                            }
                            ?>
                        </a>
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            echo "<div class='dropdown-content'>
                                    <p class='sign-in-btn'>Hello, " . htmlspecialchars($user['name']) . "</p>
                                    <a href='logout.php'>Logout</a>
                                  </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content -->
        <main>
            <div class="main container">
                <div class="main-img">
                    <img src="img/asset/konser.jpg" alt="">
                </div>
                <div class="main-topic">
                    <!-- <h1>Enjoy Your Life With <span>Local Night</span></h1> -->
                    <h1>Local Night: Tempat Dimana Musik dan <span>Malam Menyatu!</span></h1>
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam ut porro, nemo ab doloribus voluptatum voluptatem non deleniti temporibus esse repellat totam. Aperiam accusantium eum repudiandae quaerat voluptatibus a vero!</p> -->
                     <p>Temukan pengalaman konser musik terbaik di kotamu hanya di Local Night. Kami hadir untuk membawa artis lokal dan internasional ke panggung, menghadirkan alunan musik yang memukau dan tak terlupakan. Dengan jadwal konser yang selalu up-to-date, Local Night adalah destinasi utama bagi para pencinta musik untuk menikmati penampilan live yang memukau, mulai dari genre rock yang energik hingga jazz yang menenangkan. Mari bergabung dengan kami dan nikmati malam yang penuh dengan harmoni dan ritme di Local Night, di mana setiap momen konser adalah kenangan yang berharga.</p>
                </div>
            </div>

            <div class="recomend">
                <div class="recomend-text">
                    <h2>Recommendation To You</h2>
                </div>
                <div class="recomend-container">
                    <?php foreach ($tampung as $data) { ?>
                        <a class="recomend-card" href="detail.php?id=<?php echo $data['id']?>">
                            <img class="img imgs" src="<?php echo $data["gambar_konser"] ?>" alt="">
                            <div class="detail-card">
                                <div class="location">
                                    <p><img src="img/icon/bxs-map.svg" alt=""> <?php echo $data["lokasi"] ?></p>
                                    <p><img src="img/icon/bx-calendar.svg" alt=""><?php echo $data["waktu_konser"] ?> | <?php echo $data["jam_konser"] ?></p>
                                </div>
                                <h3><?php echo $data["nama_konser"] ?></h3>
                                    <div class="price-status">
                                        <p>Start From : <span>Rp. <?php echo number_format($data["harga_reguler"]) ?></span></p>
                                        <p>Ticket Available</p>
                                    </div>
                            </div>
                        </a>
                    <?php } ?>
                    
                </div>
            </div>
            <!-- Other -->
            <div class="recomend-text other-text"><h2>Another Event Coming Soon</h2></div>
            <div class="recomend other-2">
                <div class="recomend-container other-container">
                    <?php  foreach ($temp as $datas) { ?>
                        <a class="recomend-card other-recomend" href="detail.php?id=<?php echo $datas['id']?>">
                        <img class="img images" src="<?php  echo $datas["gambar_konser"] ?>" alt="">
                        <div class="detail-card other-card">
                            <h3><?php  echo $datas["nama_konser"] ?></h3>
                            <div class="location other-location">
                                <p class="status-available">Available</p>
                                <p><img src="img/icon/bxs-map.svg" alt=""><?php  echo $datas["lokasi"] ?></p>
                                <p><img src="img/icon/bx-calendar.svg" alt=""><?php  echo $datas["waktu_konser"] ?> | <?php  echo $datas["jam_konser"] ?></p>
                            </div>
                            <p class="status other-status"> Start From : <span><?php echo number_format($datas['harga_reguler'])?></span></p>
                        </div>
                    </a>
                    <?php }?>    
                </div>
            </div>

            <!-- View More -->
            <!-- <div class="view-more">
                <h2>View More</h2>
            </div>      -->
        </main>
    </div>
    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <a href="index.php" class="logo-footer"><h2>LocalNight</h2></a>
            <div class="icon-container">
                <img src="img/icon/bxl-facebook-circle.svg" alt="">
                <img src="img/icon/bxl-instagram.svg" alt="">
                <img src="img/icon/bxl-twitter.svg" alt="">
                <img src="img/icon/bxl-linkedin-square.svg" alt="">
            </div>
            <div class="footer-info">
                <ul>
                    <li><h4>About Us</h4></li>
                    <li><h4>Terms & Condition</h4></li>
                    <li><h4>Privacy Policy</h4></li>
                </ul>
            </div>
            <div class="copy-right"><h3>&copy;2024 PT.Local Night. All Right Reserved </h3></div>
        </div>
    </footer>
</body>
</html>
