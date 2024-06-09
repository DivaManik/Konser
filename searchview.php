<?php
session_start();
include 'koneksi.php';

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

$filter = "name"; // Default filter
if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
}

$sql = "SELECT * FROM konser";

if (!empty($search_query)) {
    $sql .= " WHERE nama_konser LIKE '%$search_query%' OR lokasi LIKE '%$search_query%' OR waktu_konser LIKE '%$search_query%'";
}

switch ($filter) {
    case "location":
        $sql .= " ORDER BY lokasi ASC";
        break;
    case "date":
        $sql .= " ORDER BY waktu_konser DESC";
        break;
    default:
        $sql .= " ORDER BY nama_konser ASC";
        break;
}

$result = mysqli_query($conn, $sql);

$temp = [];
while ($row = mysqli_fetch_assoc($result)) {
    $temp[] = $row;
}

$user = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query_user = "SELECT name FROM users WHERE id = $user_id";
    $result_user = mysqli_query($conn, $query_user);

    if ($result_user) {
        $user = mysqli_fetch_assoc($result_user);
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
    <title>Search Results</title>
</head>
<body>
    <div class="container">
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
                        if (isset($user)) {
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
            <div class="recomend-text other-text"><h2>Search Results</h2></div>
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
                                    <p class="status other-status"> Start From : <span>Rp <?php echo number_format($datas["harga_reguler"]); ?></span></p>
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
                    <li><h4>About Us</li>
                    <li><h4>Terms & Condition</li>
                    <li><h4>Privacy Policy</li>
                </ul>
            </div>
            <div class="copy-right"><h3>&copy;2024 PT.Local Night. All Right Reserved </h3></div>
        </div>
    </footer>
</body>
</html>
