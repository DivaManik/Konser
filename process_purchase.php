<?php
session_start(); // Mulai sesi di awal file

include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}

$user_id = $_SESSION['user_id'];
$konser_id = $_POST['konser_id'];

$pesan_reguler = empty($_POST['reguler']) ? 0 : $_POST['reguler'];
$pesan_vip = empty($_POST['vip']) ? 0 : $_POST['vip'];
$pesan_super_vip = empty($_POST['super_vip']) ? 0 : $_POST['super_vip'];

$query = "SELECT stock_reguler, stock_vip, stock_supervip FROM konser WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $konser_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$reguler_now = $data['stock_reguler'];
$vip_now = $data['stock_vip'];
$super_vip_now = $data['stock_supervip'];

$kurang_reguler = $reguler_now - $pesan_reguler;
$kurang_vip = $vip_now - $pesan_vip;
$kurang_supervip = $super_vip_now - $pesan_super_vip;

$query_update = "UPDATE konser SET stock_reguler = ?, stock_vip = ?, stock_supervip = ? WHERE id = ?";
$stmt_update = $conn->prepare($query_update);
$stmt_update->bind_param("iiii", $kurang_reguler, $kurang_vip, $kurang_supervip, $konser_id);
$stmt_update->execute();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $konser_ids = $_POST['konser_id'];
    $types = $_POST['type'];
    $fnames = $_POST['fname'];
    $lnames = $_POST['lname'];
    $phone_numbers = $_POST['phone_number'];
    $emails = $_POST['email'];

    $valid_ticket_types = ["Reguler", "VIP", "Super VIP"];

    for ($i = 0; $i < count($types); $i++) {
        if (!in_array($types[$i], $valid_ticket_types)) {
            echo "Invalid ticket type.";
            exit();
        }

        $konser_id = $konser_ids[$i];
        $type = $types[$i];
        $fname = $fnames[$i];
        $lname = $lnames[$i];
        $phone_number = $phone_numbers[$i];
        $email = $emails[$i];

        // Insert data pemesanan tiket ke database
        $sql = "INSERT INTO pembelian (user_id, konser_id, type, first_name, last_name, phone_number, email)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error);
        }
        $stmt->bind_param("iisssss", $user_id, $konser_id, $type, $fname, $lname, $phone_number, $email);

        if ($stmt->execute()) {
            // Pemesanan tiket berhasil
        } else {
            echo "Pemesanan tiket gagal: " . $conn->error;
        }
        $stmt->close();
    }

    // Redirect ke halaman list tiket
    header("Location: list_tickets.php");
    exit();
} else {
    echo "Invalid request method.";
}
?>
