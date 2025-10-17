<header class="admin-header">
    <div class="header-left">
        <div class="logo">
            <span class="logo-icon">TV</span>
            <span class="logo-text">TechVision Admin</span>
        </div>
    </div>
    <div class="header-right">
        <div class="user-menu">
            <span><?php echo htmlspecialchars($_SESSION['admin_name']); ?></span>
            <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </div>
</header>
