<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\User;
use App\Product;
use App\OrderItem;
use App\OrderService;
use App\CashPayment;

try {
    echo "=========================================\n";
    echo "      MINI E-COMMERCE DOMAIN FLOW        \n";
    echo "=========================================\n\n";

    // 1. Create User
    $user = new User(1, "Amr Awni", "amr@example.com");
    echo "[Step 1] User Created: {$user->getName()} ({$user->getEmail()})\n";

    // 2. Create Products
    $laptop = new Product(101, "Dell XPS 15", 1500.00, 1);
    $mouse  = new Product(102, "Logitech MX Master", 100.00, 1);
    echo "[Step 2] Products Created:\n";
    echo "         - ID #{$laptop->getId()}: {$laptop->getName()} ($ {$laptop->getPrice()})\n";
    echo "         - ID #{$mouse->getId()}: {$mouse->getName()} ($ {$mouse->getPrice()})\n";

    // 3. Create OrderItems
    $item1 = new OrderItem($laptop, 1);
    $item2 = new OrderItem($mouse, 2);
    echo "[Step 3] OrderItems Created:\n";
    echo "         - 1x {$laptop->getName()}\n";
    echo "         - 2x {$mouse->getName()}\n";

    // 4. Create Order
    $orderService = new OrderService();
    $order = $orderService->createOrder($user, [$item1, $item2]);
    echo "[Step 4] Order Created (Initial Status: {$order->getStatus()->value})\n";

    // 5. Calculate Total
    $total = $orderService->calculateTotal($order);
    echo "[Step 5] Total Calculated: $" . number_format($total, 2) . "\n";

    // 6. Process Payment
    $paymentGateway = new CashPayment();
    echo "[Step 6] Processing Payment via CashPayment...\n";
    
    // processPayment بتقوم بحساب الإجمالي ومعالجة الدفع ثم استدعاء confirmOrder تلقائياً عند النجاح
    $paymentSuccess = $orderService->processPayment($order, $paymentGateway);

    if ($paymentSuccess) {
        echo "         -> Payment Processed Successfully!\n";
    }

    // 7. Confirm Order
    echo "[Step 7] Order Confirmed!\n";

    // 8. Print final state
    echo "\n=========================================\n";
    echo "           FINAL ORDER STATE             \n";
    echo "=========================================\n";
    echo "Customer Name : " . $order->getUser()->getName() . "\n";
    echo "Total Items   : " . count($order->getItems()) . "\n";
    echo "Total Amount  : $" . number_format($total, 2) . "\n";
    echo "Order Status  : " . strtoupper($order->getStatus()->value) . "\n";
    echo "=========================================\n";

} catch (\Throwable $e) {
    echo "\n[ERROR]: " . $e->getMessage() . "\n";
}