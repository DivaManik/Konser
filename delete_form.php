<?php
session_start();
include "koneksi.php";

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in.";
    exit();
}

// Dapatkan ID tiket dari parameter URL
if (isset($_GET['id'])) {
    $ticket_id = $_GET['id'];

    // Ambil data tiket yang akan dihapus
    $query = "SELECT pembelian.*, konser.stock_reguler, konser.stock_vip, konser.stock_supervip 
              FROM pembelian 
              JOIN konser ON pembelian.konser_id = konser.id 
              WHERE pembelian.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $ticket = $result->fetch_assoc();
        
        // Update stok berdasarkan tipe tiket
        if ($ticket['type'] == 'Reguler') {
            $ticket['stock_reguler'] += 1;
            $update_stock_query = "UPDATE konser SET stock_reguler = ? WHERE id = ?";
        } elseif ($ticket['type'] == 'VIP') {
            $ticket['stock_vip'] += 1;
            $update_stock_query = "UPDATE konser SET stock_vip = ? WHERE id = ?";
        } elseif ($ticket['type'] == 'Super VIP') {
            $ticket['stock_supervip'] += 1;
            $update_stock_query = "UPDATE konser SET stock_supervip = ? WHERE id = ?";
        }

        $stmt_update_stock = $conn->prepare($update_stock_query);
        $stmt_update_stock->bind_param("ii", $ticket['stock_reguler'], $ticket['konser_id']);
        $stmt_update_stock->execute();

        // Hapus tiket dari database
        $delete_query = "DELETE FROM pembelian WHERE id = ?";
        $stmt_delete = $conn->prepare($delete_query);
        $stmt_delete->bind_param("i", $ticket_id);
        if ($stmt_delete->execute()) {
            header("Location: list_tickets.php");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Ticket not found.";
        exit();
    }
} else {
    echo "No ticket ID provided.";
    exit();
}
?>
