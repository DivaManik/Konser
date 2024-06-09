<?php
session_start();
include 'koneksi.php';

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

$sql = "SELECT * FROM konser WHERE 
        nama_konser LIKE '%$search_query%' OR 
        lokasi LIKE '%$search_query%' OR 
        waktu_konser LIKE '%$search_query%'";
$result = mysqli_query($conn, $sql);

$temp = [];
while ($row = mysqli_fetch_assoc($result)) {
    $temp[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Search Results</title>
</head>
<body>
    <div class="container">
        <header>
            <div class="nav">
                <a href="index.php" class="logo">LocalNight</a>
                <!-- Search Bar -->
                <div class="search">
                    <form id="search-form" method="GET" action="searchview.php">
                        <input class="search-box" type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search_query); ?>">
                    </form>
                    <a class="cone-filter" href="#">
                        <div class="container-cone">
                            <img src="img/icon/bx-filter.svg" alt="">
                            <div class="cone-content">
                                <p>Filter By :</p>
                                <a href="#">Name</a>
                                <a href="#">Location</a>
                                <a href="#">Date</a>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- <div class="filter">
                    <div class="dropdown">
                        <a href="#" class="event-link">Genre</a>
                        <div class="dropdown-content">
                            <a href="#"><h3>Rap</h3></a>
                            <a href="#"><h3>RnB</h3></a>
                            <a href="#"><h3>Pop</h3></a>
                            <a href="#"><h3>Rock</h3></a>
                            <a href="#"><h3>EDM</h3></a>
                        </div>
                    </div>
                </div> -->
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
        <main class="search-view">
            <!-- Other -->
            <div class="recomend-text other-text"><h2>Filtered Event</h2></div>
            <div class="recomend other-2">
                <div class="recomend-container other-container">
                    <?php if (count($temp) > 0) {
                        foreach ($temp as $datas) { ?>
                            <a class="recomend-card other-recomend" href="detail.php?id=<?php echo $datas['id']?>">
                                <img class="img images" src="<?php echo $datas["gambar_konser"]; ?>" alt="">
                                <div class="detail-card other-card">
                                    <h3><?php echo $datas["nama_konser"]; ?></h3>
                                    <div class="location other-location">
                                        <p class="status-available">Available</p>
                                        <p><img src="img/icon/bxs-map.svg" alt=""><?php echo $datas["lokasi"]; ?></p>
                                        <p><img src="img/icon/bx-calendar.svg" alt=""><?php echo $datas["waktu_konser"]; ?> | <?php echo $datas["jam_konser"]; ?></p>
                                    </div>
                                    <p class="status other-status"> Start From : <span>Rp <?php echo $datas["harga_reguler"]; ?></span></p>
                                </div>
                            </a>
                        <?php } 
                    } else { 
                        echo "<p>No items to display</p>"; 
                    } ?>
                </div>
            </div>

            <!-- View More -->
            <div class="view-more">
                <a href="index.php" ><h2>Back To Home</h2></a>
            </div>     
        </main>
    </div>
    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <a href="index.html" class="logo-footer"><h2>LocalNight</h2></a>
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
