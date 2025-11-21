<footer class="footer">
    <div class="footer-container">

        <div class="footer-section">
            <h3>Booktopia</h3>
            <p>Australia's home of books. Temukan buku terbaik dari berbagai kategori.</p>
        </div>

        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="#" onclick="return mustLogin()">Categories</a></li>
                <li><a href="#" onclick="return mustLogin()">Order History</a></li>
                <li><a href="#" onclick="return mustLogin()">Cart</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Support</h4>
            <ul>
                <li><a href="#">Help & FAQ</a></li>
                <li><a href="#">Shipping Info</a></li>
                <li><a href="#">Return Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Contact</h4>
            <p>Email: support@booktopia.com</p>
            <p>Phone: +61 123 456 789</p>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} Booktopia. All rights reserved.</p>
    </div>
</footer>

<style>
    .footer {
        background: #1b1b1b;
        color: #eee;
        padding: 40px 20px 20px;
        margin-top: 50px;
    }

    .footer-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: auto;
    }

    .footer-section h3,
    .footer-section h4 {
        margin-bottom: 12px;
        color: #ffffff;
    }

    .footer-section p {
        color: #ccc;
        line-height: 1.5;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-section ul li {
        margin-bottom: 8px;
    }

    .footer-section ul li a {
        color: #ccc;
        text-decoration: none;
    }

    .footer-section ul li a:hover {
        color: #ffffff;
    }

    .footer-bottom {
        text-align: center;
        border-top: 1px solid #333;
        padding-top: 15px;
        margin-top: 25px;
        color: #bbb;
        font-size: 14px;
    }
</style>
