<nav class="navbar w-100">
    <div class="container w-100">
        <a class="nav-link navbar-main-item" href="home.php">Home</a>
        <div class="float-r navbar-menu">
            <ul class="navbar-items">
                <li class="navbar-item">
                    <?php 
                        require_once("templates/globals.php");                        
                        if(Utils::isLoggedIn()) {
                            echo "Hello, " . Utils::getUsername();
                        }
                    ?>
                </li>
                <li class="navbar-item">
                <form action="logout.php" method="POST">
                    <button type="submit" class="btn nav-btn">Logout</button>
                </form>
                </li>
            </ul>
        </div>
    </div>
</nav>