<?php

namespace app\Models;

include "app/Config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class Product extends DatabaseConfig {
    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database_name, $this->port);
        
        if (!$this->conn) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    // Ambil semua produk
    public function findAll() {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        $data = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        $this->conn->close();
        return $data;
    }

    // Ambil produk berdasarkan ID
    public function findById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        $this->conn->close();
        return $data;
    }

    // Tambah produk baru
    public function create($data) {
        $productName = $data['product_name'];
        $price = $data['price'] ?? 0;
        $description = $data['description'] ?? '';
        $category = $data['category'] ?? '';
        $imageUrl = $data['image_url'] ?? '';

        $query = "INSERT INTO products (product_name, price, description, category, image_url) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdsss", $productName, $price, $description, $category, $imageUrl);
        $stmt->execute();
        $this->conn->close();
    }

    // Update produk
    public function update($data, $id) {
        $productName = $data['product_name'];
        $price = $data['price'] ?? 0;
        $description = $data['description'] ?? '';
        $category = $data['category'] ?? '';
        $imageUrl = $data['image_url'] ?? '';

        $query = "UPDATE products SET product_name = ?, price = ?, description = ?, category = ?, image_url = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sdsssi", $productName, $price, $description, $category, $imageUrl, $id);
        $stmt->execute();
        $this->conn->close();
    }

    // Hapus produk
    public function delete($id) {
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    }
}