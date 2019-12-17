<?php require('partials/head.php'); ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require('partials/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require('partials/topbar.php'); ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Information and credits</h1>
                    </div>
                    <div class="card col-md-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="margin-bottom: 30px;">
                                Operations researchs</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Faculty of Engineering and Mathematics Konrad Lorenz</h6>
                            <p class="card-text">
                                This software was made by:</p>
                            <p class="card-text">Sebastián Andrés Huérfano Rodríguez</p>
                            <p class="card-text">Daniela Cepeda Holguín</p>
                            <p class="card-text">Angie Dayana Camargo Moreras</p>
                        </div>
                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; Your Website 2019</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="login.html">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php require('partials/scripts.php'); ?>
</body>

</html>