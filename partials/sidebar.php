<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php" style="color: #fff;background: #fff;">
        <div class="sidebar-brand-text mx-3"> <img src="img/logopng.png" alt="" width="150px" height="60px"> </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-info-circle"></i>
            <span>About</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-table"></i>
            <span>Probabilistic Methods</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Methods:</h6>
                <a class="collapse-item" href="expectedvalue.php">Expected Value</a>
                <a class="collapse-item" href="expectRegreat.php">Expected Regreat</a>
                <a class="collapse-item" href="sensitivity_analisis.php">Sensibility Analysis</a>
            </div>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-table"></i>
            <span>Non-Probabilistic Methods</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Metodos:</h6>
                <a class="collapse-item" href="maximax.php">MaxiMax</a>
                <a class="collapse-item" href="maximin.php">MaxiMin</a>
                <a class="collapse-item" href="minimaxregreat.php">MiniMax Regreat</a>
              
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>