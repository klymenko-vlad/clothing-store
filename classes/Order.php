<?php

namespace Orders;

require_once __DIR__ . '/../db/Database.php';

use Database;
use PDO;

class Order extends Database
{

    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function addProductToOrder(int $userId, int $productId, int $quantity = 1): void
    {
        $stmt = $this->conn->prepare("SELECT idorder FROM orders WHERE user_id = :user_id AND status = 'pending' LIMIT 1");
        $stmt->execute(['user_id' => $userId]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order) {
            $orderId = $order['idorder'];
        } else {
            $stmt = $this->conn->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (:user_id, 0, 'pending')");
            $stmt->execute(['user_id' => $userId]);
            $orderId = $this->conn->lastInsertId();
        }

        $stmt = $this->conn->prepare("SELECT price FROM products WHERE idproduct = :product_id");
        $stmt->execute(['product_id' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            throw new \Exception("Product not found.");
        }

        $priceAtPurchase = $product['price'];
        $subtotal = $priceAtPurchase * $quantity;

        $stmt = $this->conn->prepare("SELECT * FROM order_products WHERE order_id = :order_id AND product_id = :product_id");
        $stmt->execute(['order_id' => $orderId, 'product_id' => $productId]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $stmt = $this->conn->prepare("
                UPDATE order_products 
                SET quantity = quantity + :quantity, 
                    subtotal = subtotal + :subtotal 
                WHERE order_id = :order_id AND product_id = :product_id
            ");
            $stmt->execute([
                'quantity' => $quantity,
                'subtotal' => $subtotal,
                'order_id' => $orderId,
                'product_id' => $productId
            ]);
        } else {
            $stmt = $this->conn->prepare("
                INSERT INTO order_products (order_id, product_id, quantity, price_at_purchase, subtotal)
                VALUES (:order_id, :product_id, :quantity, :price, :subtotal)
            ");
            $stmt->execute([
                'order_id' => $orderId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $priceAtPurchase,
                'subtotal' => $subtotal
            ]);
        }

        $stmt = $this->conn->prepare("
            UPDATE orders 
            SET total_amount = (SELECT SUM(subtotal) FROM order_products WHERE order_id = :order_id)
            WHERE idorder = :order_id
        ");
        $stmt->execute(['order_id' => $orderId]);
    }

    public function getMyOrders(int $userId): array
    {
        $stmt = $this->conn->prepare("
        SELECT o.idorder,o.status,o.created_at,p.idproduct,p.title, p.price,op.quantity,op.subtotal
        FROM orders o
        JOIN order_products op ON o.idorder = op.order_id
        JOIN products p ON op.product_id = p.idproduct
        WHERE o.user_id = :user_id
        ORDER BY o.created_at DESC
    ");
        $stmt->execute(['user_id' => $userId]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($rows as $row) {
            $orderId = $row['idorder'];

            if (!isset($orders[$orderId])) {
                $orders[$orderId] = [
                    'idorder' => $orderId,
                    'status' => $row['status'],
                    'created_at' => $row['created_at'],
                    'products' => []
                ];
            }

            $orders[$orderId]['products'][] = [
                'idproduct' => $row['idproduct'],
                'title' => $row['title'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'subtotal' => $row['subtotal']
            ];
        }

        return array_values($orders);
    }

    public function updateStatus(int $orderId, string $status): bool
    {
        $stmt = $this->conn->prepare("UPDATE `orders` SET status = :status WHERE idorder = :id");
        return $stmt->execute([
            ':status' => $status,
            ':id' => $orderId,
        ]);
    }

}
