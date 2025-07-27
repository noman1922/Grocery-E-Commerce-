function insertCommonNav() {
    const nav = document.createElement('nav');
    nav.className = 'site-header';
    nav.innerHTML = `
        <div class="nav-container">
            <div class="nav-left">
                <a href="index.html">Home</a>
                <a href="#" class="cart-link">Cart (<span>0</span>)</a>
            </div>
            <div class="nav-right">
                <a href="login_signup.html" class="login-link">Login</a>
                <a href="#" class="logout-link" style="display: none" onclick="handleLogout()">Logout</a>
            </div>
        </div>
    `;
    document.body.insertBefore(nav, document.body.firstChild);
}

function checkAuthStatus() {
    const token = localStorage.getItem('token');
    const loginLinks = document.querySelectorAll('.login-link');
    const logoutLinks = document.querySelectorAll('.logout-link');

    if (token) {
        loginLinks.forEach(link => link.style.display = 'none');
        logoutLinks.forEach(link => link.style.display = 'block');
    } else {
        loginLinks.forEach(link => link.style.display = 'block');
        logoutLinks.forEach(link => link.style.display = 'none');
    }
}

function handleLogout() {
    localStorage.removeItem('token');
    window.location.href = 'index.html';
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    insertCommonNav();
    checkAuthStatus();
});
