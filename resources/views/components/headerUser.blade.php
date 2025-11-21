  <!-- Top Banner -->
  <div class="top-banner">
    <p>Free Shipping on all orders over $49. T&Cs apply. Ends Monday 13th October 2025.</p>
  </div>

<header class="user-header">
    <div class="header-container">

        <div class="logo">
            <h1>Booktopia</h1>
            <span>Home of Books</span>
        </div>

        <div class="search-logout">
            <div class="search-bar">
                <input type="text" placeholder="Search Title...">
                <button>Search</button>
            </div>

            <div id="user-area">

    <style>
        /* Avatar Button */
        .profile-btn {
            width: 40px;
            height: 40px;
            background: #4CAF50;
            border: none;
            border-radius: 50%;
            color: white;
            font-weight: bold;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        /* Wrapper */
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Card */
        .profile-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            margin-top: 12px;
            background-color: #c84b6f;
            border-radius: 18px;
            min-width: 160px;
            padding: 8px 0;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.25);
            z-index: 100;
        }

        .dropdown-item {
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            font-size: 15px;
        }

        .dropdown-item:hover {
            background-color: #a83758;
        }

        .dropdown-item button {
            background: none;
            border: none;
            color: white;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-size: 15px;
            padding: 0;
        }
    </style>

    @php
        $name = Auth::user()->name ?? 'User';
        $initial = strtoupper(substr($name, 0, 1));
    @endphp

    <div class="profile-dropdown">
        <button class="profile-btn">{{ $initial }}</button>

        <div class="profile-dropdown-content" id="dropMenu">
            <a href="{{ route('users.profile.edit') }}" class="dropdown-item">
                <span>👤</span> Profile
            </a>

            <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                @csrf
                <button type="submit">
                    <span>📚</span> Logout
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("click", function (e) {
            const dropdown = document.querySelector(".profile-dropdown");
            const menu = document.getElementById("dropMenu");
            const btn = document.querySelector(".profile-btn");

            if (btn.contains(e.target)) {
                menu.style.display = menu.style.display === "block" ? "none" : "block";
            } else if (!dropdown.contains(e.target)) {
                menu.style.display = "none";
            }
        });
    </script>

</div>
        </div>
    </div>
</header>


