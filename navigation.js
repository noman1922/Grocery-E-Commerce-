function checkAuthStatus() {
    const token = localStorage.getItem('token');
    const loginLinks = document.querySelectorAll('.login-link');
    const logoutLinks = document.querySelectorAll('.logout-link');
    const userMenus = document.querySelectorAll('.user-menu');

    if (token) {
        loginLinks.forEach(link => link.style.display = 'none');
        logoutLinks.forEach(link => link.style.display = 'block');
        userMenus.forEach(menu => menu.style.display = 'block');
    } else {
        loginLinks.forEach(link => link.style.display = 'block');
        logoutLinks.forEach(link => link.style.display = 'none');
        userMenus.forEach(menu => menu.style.display = 'none');
    }
}

function handleLogout() {
    localStorage.removeItem('token');
    window.location.href = 'index.html';
}

// Add to all HTML files that need navigation
document.addEventListener('DOMContentLoaded', () => {
    checkAuthStatus();
});
