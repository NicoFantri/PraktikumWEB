document.addEventListener('DOMContentLoaded', () => {
    fetchProducts();
    setupCategoryFilters();
});

let cart = [];

function fetchProducts() {
    fetch('/codelab/index.php/api/product')
        .then(response => response.json())
        .then(result => {
            const productsContainer = document.getElementById('products');
            productsContainer.innerHTML = '';

            result.data.forEach(product => {
                const productCard = createProductCard(product);
                productsContainer.appendChild(productCard);
            });
        })
        .catch(error => {
            console.error('Kesalahan mengambil produk:', error);
        });
}

function createProductCard(product) {
    const card = document.createElement('div');
    card.classList.add('product-card');
    card.dataset.category = product.category || 'Lainnya';

    const img = document.createElement('img');
    img.src = product.image_url || `https://via.placeholder.com/150?text=${encodeURIComponent(product.product_name)}`;
    img.alt = product.product_name;

    const name = document.createElement('h3');
    name.textContent = product.product_name;

    const price = document.createElement('p');
    price.classList.add('price');
    price.textContent = `Rp ${parseFloat(product.price || 0).toLocaleString()}`;

    const cartIcon = document.createElement('i');
    cartIcon.classList.add('fas', 'fa-shopping-cart', 'cart-icon');
    cartIcon.addEventListener('click', () => addToCart(product));

    card.appendChild(img);
    card.appendChild(name);
    card.appendChild(price);
    card.appendChild(cartIcon);

    return card;
}

function setupCategoryFilters() {
    const categories = document.querySelectorAll('.category');
    categories.forEach(category => {
        category.addEventListener('click', function() {
            categories.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            filterProductsByCategory(this.textContent);
        });
    });
}

function filterProductsByCategory(category) {
    const products = document.querySelectorAll('.product-card');
    products.forEach(product => {
        if (category === 'All' || product.dataset.category === category) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}

function addToCart(product) {
    const existingProduct = cart.find(item => item.id === product.id);
    
    if (existingProduct) {
        existingProduct.quantity++;
    } else {
        cart.push({
            ...product,
            quantity: 1
        });
    }

    updateCartDisplay();
}

function updateCartDisplay() {
    const orderSummary = document.getElementById('order-summary');
    const orderItemsContainer = orderSummary.querySelector('.order-items') || createOrderItemsContainer(orderSummary);
    
    orderItemsContainer.innerHTML = '';
    let subtotal = 0;

    cart.forEach(item => {
        const orderItem = createOrderItem(item);
        orderItemsContainer.appendChild(orderItem);
        subtotal += item.price * item.quantity;
    });

    updateTotals(subtotal);
}

function createOrderItemsContainer(orderSummary) {
    const container = document.createElement('div');
    container.classList.add('order-items');
    orderSummary.insertBefore(container, orderSummary.querySelector('.totals'));
    return container;
}

function createOrderItem(item) {
    const orderItem = document.createElement('div');
    orderItem.classList.add('order-item');
    orderItem.innerHTML = `
        <img src="${item.image_url || `https://via.placeholder.com/50?text=${encodeURIComponent(item.product_name)}`}" alt="${item.product_name}">
        <div class="details">
            <h3>${item.product_name}</h3>
            <p class="price">Rp ${parseFloat(item.price).toLocaleString()}</p>
        </div>
        <div class="quantity">
            <i class="fas fa-minus" onclick="changeQuantity(${item.id}, -1)"></i>
            <span>${item.quantity}</span>
            <i class="fas fa-plus" onclick="changeQuantity(${item.id}, 1)"></i>
        </div>
    `;
    return orderItem;
}

function changeQuantity(productId, change) {
    const product = cart.find(item => item.id === productId);
    
    if (product) {
        product.quantity += change;
        
        if (product.quantity <= 0) {
            cart = cart.filter(item => item.id !== productId);
        }
        
        updateCartDisplay();
    }
}

function updateTotals(subtotal) {
    const subtotalEl = document.getElementById('subtotal');
    const discountEl = document.getElementById('discount');
    const taxEl = document.getElementById('tax');
    const totalEl = document.getElementById('total');

    const discount = subtotal * 0.1;  // Contoh diskon 10%
    const tax = subtotal * 0.11;  // Contoh pajak 11%
    const total = subtotal - discount + tax;

    subtotalEl.textContent = `Rp ${subtotal.toLocaleString()}`;
    discountEl.textContent = `- Rp ${discount.toLocaleString()}`;
    taxEl.textContent = `Rp ${tax.toLocaleString()}`;
    totalEl.textContent = `Rp ${total.toLocaleString()}`;
}