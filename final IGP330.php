<?php

// Define classes for User, Product, Order, OrderItem, and Purchase

class User {
    public $id;
    public $name;
    public $email;
    public $address;
    public $creditInfo;
}

class Product {
    public $id;
    public $name;
    public $category;
    public $price;
    public $description;
}

class Order {
    public $id;
    public $userId;
    public $items = [];

    public function addItem($itemId, $quantity) {
        $this->items[] = new OrderItem($itemId, $quantity);
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $product = getProductById($item->productId);
            $total += $product->price * $item->quantity;
        }
        return $total;
    }
}

class OrderItem {
    public $productId;
    public $quantity;

    public function __construct($productId, $quantity) {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }
}

class Purchase {
    public $userId;
    public $orderId;
    public $date;
    public $total;
}

// Define functions for interacting with data

function getUsers() {
    // Retrieve list of users from database or other data source
}

function getUserById($id) {
    // Retrieve user with specified ID from database or other data source
}

function getProducts() {
    // Retrieve list of products from database or other data source
}

function getProductById($id) {
    // Retrieve product with specified ID from database or other data source
}

function getOrdersByUserId($userId) {
    // Retrieve list of orders for user with specified ID from database or other data source
}

function getOrderById($id) {
    // Retrieve order with specified ID from database or other data source
}

function createOrder($userId, $items) {
    // Create new order in database or other data source, and return its ID
}

function createPurchase($userId, $orderId, $total) {
    // Create new purchase in database or other data source, and return its ID
}

// Example usage

// Customer browsing products
$products = getProducts();
foreach ($products as $product) {
    echo $product->name . ' - ' . $product->price . '<br>';
}

// Customer creating order
$user = getUserById(1);
$order = new Order();
$order->addItem(1, 2);
$order->addItem(2, 1);
$total = $order->getTotal();
$orderId = createOrder($user->id, $order->items);
$purchaseId = createPurchase($user->id, $orderId, $total);

// Shop owner managing inventory
$orders = getOrdersByUserId(2);
foreach ($orders as $order) {
    echo 'Order ID: ' . $order->id . '<br>';
    foreach ($order->items as $item) {
        $product = getProductById($item->productId);
        echo $product->name . ' - ' . $item->quantity . '<br>';
    }
    echo 'Total: ' . $order->getTotal() . '<br>';
}