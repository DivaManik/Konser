<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email or name already exists
    $sql_check = "SELECT * FROM users WHERE email = ? OR name = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $email, $name);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $row = $result_check->fetch_assoc();
        if ($row['email'] === $email) {
            $error_message = "Email sudah dipakai!";
        } else if ($row['name'] === $name) {
            $error_message = "Nama sudah dipakai!";
        }
        echo "<script>
            alert('$error_message');
            window.location.href='login.html';
            </script>";
        exit;
    }

    // If no duplicates, proceed with the insertion
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt_check->close();
    $stmt->close();
}
$conn->close();
?>
