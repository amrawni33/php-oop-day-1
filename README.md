# Mini E-Commerce Domain (PHP OOP)

## What is this project?
A pure PHP project simulating the core domain logic of an e-commerce ordering system. It covers the complete workflow from creating a user and products, managing order items, calculating totals, processing payments, and updating order status.

---

## What OOP concepts are used?
* **Encapsulation:** Class properties (like `$status`, `$price`, `$email`) are `private` and protected by getters, setters, and strict validation rules.
* **Abstraction & Interfaces:** Using the `PaymentGateway` interface to abstract payment processing from the core service layer.
* **Polymorphism:** Different payment implementations (e.g., `CashPayment`) can be passed wherever `PaymentGateway` is expected.
* **Type Safety & Enums:** Using PHP 8 Enums (`OrderStatus`) and strict type hints across all methods to prevent invalid states.

---

## How does Dependency Injection work here?
Dependencies are passed into classes via constructors or method parameters rather than created internally with `new`. 

**Example:**
In `OrderService::processPayment(Order $order, PaymentGateway $paymentGateway)`, the payment implementation is injected directly into the method. This makes `OrderService` loosely coupled and easy to unit test using mock objects.

---

## Why did I use PaymentGateway?
To follow the **Open/Closed Principle** (SOLID) and implement the **Strategy Pattern**. 

By using an interface (`PaymentGateway`), the core order logic doesn't care *how* a payment is processed. If we need to add Stripe or PayPal later, we just create a new class implementing `PaymentGateway` without modifying a single line in `OrderService`.

---

## What would I change if this became a real application?
1. **Database Integration:** Add a database persistence layer (PDO or an ORM like Eloquent) instead of keeping objects in-memory.
2. **Repository Pattern:** Introduce repositories to separate data retrieval and saving logic from business models.
3. **Database Transactions:** Wrap order creation and payment processing in atomic transactions to prevent data inconsistency.
4. **Error Handling & Logging:** Replace `echo` statements with proper logger implementations (e.g., Monolog) and custom Exception handling.
5. **Framework Adoption:** Migrate the domain logic into a framework like Laravel for routing, queues, security, and request validation.