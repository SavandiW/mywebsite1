document.addEventListener("DOMContentLoaded", () => {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];

    // Add to Cart functionality
    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", event => {
            const product = event.target.closest(".product");
            const productName = product.querySelector("h3").textContent;
            const productPrice = parseFloat(product.querySelector("p").textContent.replace("Rs.", ""));
            const productImage = product.querySelector("img").src;

            const existingItem = cart.find(item => item.name === productName);

            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    quantity: 1
                });
            }

            localStorage.setItem("cart", JSON.stringify(cart));
            alert("Added to cart: " + productName);
        });
    });

    // Buy Now functionality
    document.querySelectorAll(".buy-now").forEach(button => {
        button.addEventListener("click", event => {
            const product = event.target.closest(".product");
            const productName = product.querySelector("h3").textContent;
            alert("Buying Now: " + productName);
        });
    });

    // Display cart items dynamically
    const cartContainer = document.querySelector(".container");

    if (cartContainer) {
        renderCartItems();
    }

    function renderCartItems() {
        cartContainer.innerHTML = "<h2>Shopping Cart</h2>";

        if (cart.length === 0) {
            cartContainer.innerHTML += "<p>Your cart is empty!</p>";
            return;
        }

        cart.forEach((item, index) => {
            const cartItem = document.createElement("div");
            cartItem.className = "cart-item";

            cartItem.innerHTML = `
                <img src="${item.image}" alt="${item.name}">
                <div class="details">
                    <h3>${item.name}</h3>
                    <p class="price">Rs. ${item.price}</p>
                </div>
                <div class="quantity">
                    <button onclick="decreaseQuantity(${index})">-</button>
                    <input type="text" value="${item.quantity}" readonly>
                    <button onclick="increaseQuantity(${index})">+</button>
                </div>
                <button class="remove" onclick="removeItem(${index})">Remove</button>
            `;

            cartContainer.appendChild(cartItem);
        });

        updateTotal();

        const totalElement = document.createElement("div");
        totalElement.className = "total";
        cartContainer.appendChild(totalElement);

        const checkoutButton = document.createElement("button");
        checkoutButton.className = "checkout-btn";
        checkoutButton.textContent = "Proceed to Checkout";
        checkoutButton.addEventListener("click", () => {
            alert("Proceeding to checkout!");
        });
        cartContainer.appendChild(checkoutButton);

        updateTotal();
    }

    window.increaseQuantity = index => {
        cart[index].quantity++;
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCartItems();
    };

    window.decreaseQuantity = index => {
        if (cart[index].quantity > 1) {
            cart[index].quantity--;
        } else {
            cart.splice(index, 1);
        }
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCartItems();
    };

    window.removeItem = index => {
        cart.splice(index, 1);
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCartItems();
    };

    function updateTotal() {
        const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
        const totalElement = document.querySelector(".total");

        if (totalElement) {
            totalElement.textContent = `Total: Rs. ${total.toFixed(2)}`;
        }
    }
});