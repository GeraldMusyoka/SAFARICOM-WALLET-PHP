<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler px-0">
                    <span class="d-none d-md-inline-block text-muted">
                        Welcome <?= $_SESSION['user']['name'] ?? 'Guest' ?>
                        <button class="btn btn-primary">
                            WALLET: KES <?= wallet($_SESSION['user']['id']) ?>
                        </button>
                    </span>
                </a>
            </div>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="bx bx-user me-2"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">
                                        <?= $_SESSION['user']['name'] ?? 'Guest' ?>
                                    </span>
                                    <small class="text-muted">
                                        <?= $_SESSION['user']['email'] ?? 'Guest' ?>
                                    </small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form action="/logout" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="dropdown-item" href="#" target="_blank">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            <li>
                <form action="/logout" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="dropdown-item" href="#" target="_blank">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                    </button>
                </form>
            </li>
            <!--/ User -->


        </ul>
    </div>

</nav>

<!-- / Navbar -->