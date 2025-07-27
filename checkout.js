async function processCheckout() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }

    try {
        const orderData = {
            items: cart.map(item => ({
                product_id: item.id || 1, // Fallback ID since we're not using real IDs
                quantity: item.quantity,
                price: item.price
            })),
            total_price: cartHandler.calculateTotal()
        };

        const response = await fetch('http://localhost:3000/api/orders', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': localStorage.getItem('token')
            },
            body: JSON.stringify(orderData)
        });

        const data = await response.json();
        if (data.orderId) {
            cartHandler.clearCart();
            window.location.href = 'order-success.html';
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to process order. Please try again.');
    }
}
