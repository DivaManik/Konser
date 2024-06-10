<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php");
            exit;
        } else {
            echo "<script>
                alert('email atau password salah!');
                window.location.href='login.html';
                </script>";
            exit;
        }
    } else {
        echo "<script>
            alert('email atau password salah!');
            window.location.href='login.html';
            </script>";
        exit;
    }

}
$conn->close();
?>
