<?php
if (sizeof($_SESSION) > 0 and $_SESSION['user']['role'] == 1 and explode('/',$_SERVER["REQUEST_URI"])[3] != 'cart_controller.php') {
    echo '<header>
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse">
                <div class="position-sticky h-100">
                    <div class="sidebar-head mb-0 d-flex">
                        <i class="fas fa-chart-area fa-fw me-3"></i>
                        <h2 class=" ">Admin DashBoard</h2>
                    </div>
                    <div class="list-group list-group-flush ">
                        <a href="http://localhost/Cafe_php_project/Views/register/adminHomePage.php" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true">
                            <i class="fa-solid fa-house"></i>
                            <span>Home</span>
                        </a>
                        <a href="http://localhost/Cafe_php_project/Views/Admin/users/listAllUsers.php" class="list-group-item list-group-item-action py-2 ripple ">
                            <i class="fa-solid fa-users"></i>
                            <span>List Users</span>
                        </a>
                        <a href="http://localhost/Cafe_php_project/Views/categories.php" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fa-sharp fa-solid fa-tags"></i>
                            <span>Categories</span>
                        </a>
                        <a href="http://localhost/Cafe_php_project/Views/products/DisplayProductsAdmin.php" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            <span>Products</span>
                        </a>
                        
                        <a href="http://localhost/Cafe_php_project/Views/Admin/CheckOrders/ChecksView.php" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Check Order</span>
                        </a>

                        <a href="http://localhost/Cafe_php_project/Views/adminorders.php" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>All Order</span>
                    </a>
                    </div>
                </div>
            </nav>
            <!-- Sidebar -->
        </header>';
}
