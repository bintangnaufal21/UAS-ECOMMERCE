<nav class="navbar">
    <ul>
        <li><a href="{{ route('dashboard') }}">HOME</a></li>
        <li><a href="#" onclick="return mustLogin()">CATEGORIES</a></li>
        <li><a href="#" onclick="return mustLogin()">ORDER HISTORY</a></li>
        <li><a href="#" onclick="return mustLogin()">CART</a></li>
        <li><a href="{{ route('about') }}">ABOUT US</a></li>
    </ul>
</nav>

<script>
function mustLogin() {
    if (confirm("Anda harus login untuk membuka halaman ini.\nKlik OK untuk menuju halaman login.")) {
        window.location.href = "/login";
    }
    return false; // Mencegah link langsung berpindah
}
</script>

