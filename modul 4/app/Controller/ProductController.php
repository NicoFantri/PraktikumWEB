<?php

namespace app\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/Product.php";

use app\Models\Product;
use app\Traits\ApiResponseFormatter;

class ProductController {
    use ApiResponseFormatter;

    public function index() {
        $productModel = new Product();
        $response = $productModel->findAll();
        return $this->apiResponse(200, "Sukses mengambil data produk", $response);
    }

    public function getById($id) {
        $productModel = new Product();
        $response = $productModel->findById($id);
        
        if (empty($response)) {
            return $this->apiResponse(404, "Produk tidak ditemukan", null);
        }
        
        return $this->apiResponse(200, "Sukses mengambil detail produk", $response);
    }

    public function insert() {
        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);
        
        if (json_last_error()) {
            return $this->apiResponse(400, "Input tidak valid", null);
        }

        // Validasi input
        if (!isset($inputData["product_name"])) {
            return $this->apiResponse(400, "Nama produk harus diisi", null);
        }

        $productModel = new Product();
        $productModel->create([
            "product_name" => $inputData["product_name"],
            "price" => $inputData["price"] ?? 0,
            "description" => $inputData["description"] ?? '',
            "category" => $inputData["category"] ?? '',
            "image_url" => $inputData["image_url"] ?? ''
        ]);

        return $this->apiResponse(201, "Produk berhasil ditambahkan", null);
    }

    public function update($id) {
        $jsonInput = file_get_contents("php://input");
        $inputData = json_decode($jsonInput, true);
        
        if (json_last_error()) {
            return $this->apiResponse(400, "Input tidak valid", null);
        }

        $productModel = new Product();
        $productModel->update([
            "product_name" => $inputData["product_name"],
            "price" => $inputData["price"] ?? 0,
            "description" => $inputData["description"] ?? '',
            "category" => $inputData["category"] ?? '',
            "image_url" => $inputData["image_url"] ?? ''
        ], $id);

        return $this->apiResponse(200, "Produk berhasil diupdate", null);
    }

    public function delete($id) {
        $productModel = new Product();
        $productModel->delete($id);
        return $this->apiResponse(200, "Produk berhasil dihapus", null);
    }
}