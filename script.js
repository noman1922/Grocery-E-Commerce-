let categories = [];
let products = [];
let cart = [];

// Fetch categories and products from JSON file
fetch('products.json')
  .then(response => response.json())
  .then(data => {
    categories = data.categories;
    displayCategories();
  });

function displayCategories() {
  const categoriesContainer = document.getElementById('categories');
  categoriesContainer.innerHTML = categories.map(category => `
    <div class="category-item" onclick="displayProducts('${category.name}')">
      <img src="${category.image}" alt="${category.name}">
      <h2>${category.name}</h2>
    </div>
  `).join('');
}

function displayProducts(categoryName) {
  const category = categories.find(cat => cat.name === categoryName);
  products = category.products;

  const productsContainer = document.getElementById('products');
  productsContainer.innerHTML = products.map(product => `
    <div class="product-item">
      <img src="${product.image}" alt="${product.name}">
      <h3>${product.name}</h3>
      <p>$${product.price.toFixed(2)}</p>
      <button onclick="addToCart(${product.id})">Add to Cart</button>
      <button onclick="showProductDetails(${product.id})">View Details</button>
    </div>
  `).join('');

  document.getElementById('categories').style.display = 'none';
  productsContainer.style.display = 'grid';
}

function showProductDetails(productId) {
  const product = products.find(p => p.id === productId);
  const detailsContainer = document.getElementById('product-details');
  detailsContainer.innerHTML = `
    <h2>${product.name}</h2>
    <img src="${product.image}" alt="${product.name}">
    <p>${product.description}</p>
    <p>Price: $${product.price.toFixed(2)}</p>
    <button onclick="addToCart(${product.id})">Add to Cart</button>
    <button onclick="displayProducts('${categories.find(cat => cat.products.includes(product)).name}')">Back to Products</button>
  `;

  document.getElementById('products').style.display = 'none';
  detailsContainer.style.display = 'block';
}

function addToCart(productId) {
  const product = products.find(p => p.id === productId);
  cartHandler.addToCart(product.name, product.price);
}

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
  // Initialize cart handler
  cartHandler.init();

  // Set up event listeners
  document.getElementById('home-link')?.addEventListener('click', (e) => {
    e.preventDefault();
    document.getElementById('categories').style.display = 'grid';
    document.getElementById('products').style.display = 'none';
    document.getElementById('product-details').style.display = 'none';
    document.getElementById('cart').style.display = 'none';
  });

  document.getElementById('cart-link')?.addEventListener('click', (e) => {
    e.preventDefault();
    cartHandler.showCartModal();
  });

  // Convert all cart buttons to use cartHandler
  document.querySelectorAll('.cart-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const productBox = e.target.closest('.product-box');
      const name = productBox.querySelector('strong').textContent;
      const price = parseInt(productBox.querySelector('.price').textContent.replace('৳', '').trim());
      cartHandler.addToCart(name, price);
    });
  });
});