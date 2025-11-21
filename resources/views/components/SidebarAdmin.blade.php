<aside id="sidebar">
    <div class="header">
        <h1>Admin Panel</h1>
    </div>
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span>📊</span> Dashboard
        </a>
        <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
            <span>📚</span> Books
        </a>
        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <span>📁</span> Categories
        </a>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <span>📦</span> Orders
        </a>
        <a href="{{ route('admin.homepages.index') }}" class="{{request()->routeIs('admin.homepages.*') ? 'active' : '' }}">
            <span>🏠</span> Homepage
        </a>
        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <span>👥</span> Users
        </a>
    </nav>
</aside>

<div id="sidebar-overlay"></div>
