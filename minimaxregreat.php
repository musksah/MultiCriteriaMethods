<?php require('partials/head.php'); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require('partials/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require('partials/topbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">MiniMax Repentance Decision Rule</h1>
                    </div>

                    <div>
                        <div>
                            <div class="col-md-9 offset-md-1">
                                <!-- Default Card Example -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        Payoff Matrix Generator
                                    </div>
                                    <div class="card-body">
                                        <form action="controllers/maximaxcontroller.php" method="POST" id="form_matrix_generator">
                                            <input type="hidden" name="funcion" value="PayOffMatrix">

                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: 10px">
                                                    <label for="num_alterns" class="float-right">Number of alternatives:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number" min="2" max="10" placeholder="Enter the text" class="form-control" name="num_alterns" id="num_alterns" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: 10px">
                                                </div>
                                                <div class="col-md-8" style="margin-top: 10px">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="customized_alternatives" id="customized_alternatives">
                                                        <label class="form-check-label" for="customized_alternatives" style="margin-bottom: 10px">Customize alternatives</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <input type="hidden" value="2" placeholder="Ingrese un número" class="form-control" name="num_uncerts" id="num_uncerts" required> -->
                                            <div class="form-group row" style="margin-top: 30px">
                                                <div class="col-md-4">
                                                    <label for="num_uncerts" class="float-right">Uncertainty Cases:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number" min="2" max="10" placeholder="Enter the text" class="form-control" name="num_uncerts" id="num_uncerts" required>
                                                </div>
                                            </div>
                                            <div id="div-name-alternatives">
                                            </div>
                                            <div class="form-group row" style="margin-top: 30px">
                                                <div class="col-md-12 text-center">
                                                    <input type="submit" placeholder="Enter the text" class="btn btn-primary" value="Generate Matrix">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" id="payoff_matrix_container">
                                <!-- Default Card Example -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary">PayOff Matrix</h6>
                                    </div>
                                    <div class="card-body" id="card-body-payoff-matrix">

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <!-- Default Card Example -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary">Minimax Regreat</h6>
                                    </div>
                                    <div class="card-body" id="matrix_minmaxregreat">
                                        
                                    </div>
                                </div>
                            </div>


                            <!-- /.container-fluid -->


                            <div class="col-md-12">
                                <!-- Default Card Example -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary">Analysis</h6>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="text-info">Alternatives</h4>
                                        <p>According to this method, the best alternative (s) is (are): </p>
                                        <span id="alternatives_regreat"></span>
                                    </div>
                                </div>
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
                <script src="js/minimaxregreat.js"></script>

</body>

</html>