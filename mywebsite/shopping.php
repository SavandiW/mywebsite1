<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="shopping.css">
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&family=Anek+Odia:wght@100..800&family=Merienda:wght@300..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f1f1;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #d63384;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .cart-item img {
            width: 80px;
            height: 80px;
            border-radius: 10px;
        }
        .cart-item .details {
            flex: 1;
            margin-left: 20px;
        }
        .cart-item .price {
            font-weight: bold;
            color: #d63384;
        }
        .cart-item .quantity {
            display: flex;
            align-items: center;
        }
        .cart-item .quantity button {
            padding: 5px 10px;
            background-color: #d63384;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .cart-item .quantity input {
            width: 40px;
            text-align: center;
            margin: 0 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .cart-item .remove {
            color: red;
            cursor: pointer;
        }
        .total {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
            font-weight: bold;
        }
        .checkout-btn {
            display: block;
            width: 30%;
            padding: 15px 30px;
            background-color: #d63384;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 10px;
            font-size: 1.2em;
            cursor: pointer;
            margin: auto;

            
        }
        .checkout-btn:hover {
            background-color: #b52e6e;
        }
    </style>
</head>
<body>
<header>
        <div class="logo">
            <img src="logo.png" alt="Twisted Cakes Logo">
            <span>Twisted Cakes<br><small>by Savandi </small></span>
        </div>
        <nav>
            <a href="index.php">Home</a>
            <a href="gallery.php">Gallery</a>
            <a href="shop.php">Shop</a>
            <a href="aboutus.php">About Us</a>
            <a href="signIn.php" class="icon"><i class="fas fa-user"></i></a>
            <a href="#cart" class="icon"><i class="fas fa-shopping-cart"></i></a>
        </nav>
    </header>

    <div class="container">
        <h2>Shopping Cart</h2>
        <div id="cart-items">
            <!-- Cart items will be dynamically inserted here -->
        </div>
        <div class="total" id="cart-total">Total: Rs. 0.00</div>
        <button class="checkout-btn">Proceed to Checkout</button>
    </div>
    <script>
        // Retrieve cart from localStorage or initialize an empty array
        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Function to render cart items dynamically
        function renderCart() {
            const cartItemsContainer = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');

            cartItemsContainer.innerHTML = ''; // Clear existing items
            let total = 0;

            cart.forEach((item, index) => {
                const itemDiv = document.createElement('div');
                itemDiv.classList.add('cart-item');

                itemDiv.innerHTML = `
                    <img src="${item.img}" alt="${item.name}">
                    <div class="details">
                        <h4>${item.name}</h4>
                        <p class="price">Rs. ${item.price}</p>
                    </div>
                    <div class="quantity">
                        <button onclick="decreaseQuantity(${index})">-</button>
                        <input type="number" value="${item.quantity}" readonly>
                        <button onclick="increaseQuantity(${index})">+</button>
                    </div>
                    <span class="remove" onclick="removeItem(${index})">Remove</span>
                `;

                cartItemsContainer.appendChild(itemDiv);
                total += item.price * item.quantity;
            });

            cartTotal.textContent = `Total: Rs. ${total.toFixed(2)}`;
            localStorage.setItem('cart', JSON.stringify(cart)); // Update localStorage
        }

        // Increase quantity of an item
        function increaseQuantity(index) {
            cart[index].quantity++;
            renderCart();
        }

        // Decrease quantity of an item
        function decreaseQuantity(index) {
            if (cart[index].quantity > 1) {
                cart[index].quantity--;
                renderCart();
            }
        }

        // Remove an item from the cart
        function removeItem(index) {
            cart.splice(index, 1);
            renderCart();
        }

        // Handle checkout button
        document.querySelector('.checkout-btn').addEventListener('click', () => {
            if (cart.length === 0) {
                alert('Your cart is empty. Please add items to proceed.');
                return;
            }

            alert('Proceeding to checkout!');
            // Redirect to payment or order confirmation page if necessary
        });

        // Render the cart on page load
        renderCart();
    </script>
   
</body>
</html>