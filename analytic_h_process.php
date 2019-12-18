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
                        <h1 class="h3 mb-0 text-gray-800">The Analytic Hierarchy Process</h1>
                    </div>

                    <div>

                        <div>

                            <p style="font-size: 1.2em;" class="text-gray-700">1. Crear la matriz pareada de comparación.</p>
                            <div class="col-md-9 offset-md-1">
                                <!-- Default Card Example -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        Pairwise Comparisons
                                    </div>
                                    <div class="card-body">
                                        <form action="controllers/analytic_h_processController.php" method="POST" id="form_pairwise_comp_matrix">
                                            <input type="hidden" name="funcion" value="pairwiseComparisonMatrix">

                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: 7px">
                                                    <label for="explain_var" class="float-right">Explain Variable 1:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" placeholder="Enter Text" class="form-control" name="explain_var" id="explain_var" required>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-top: 30px">
                                                <div class="col-md-4" style="margin-top: 6px;">
                                                    <label for="num_criters1" class="float-right">Número de criterios:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number" min="2" max="4" placeholder="Enter a Number" class="form-control" name="num_criters1" id="num_criters1" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: 10px">
                                                </div>
                                                <div class="col-md-8" style="margin-top: 10px">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="customized_criterion" id="customized_criterion">
                                                        <label class="form-check-label" for="customized_criterion" style="margin-bottom: 10px">Customize criterion</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="div-name-alternatives1">
                                            </div>
                                            <!--- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --->
                                            <hr class="sidebar-divider" style="margin-top: 20px; margin-bottom: 20px;">
                                            <div class="row" style="margin-top: 20px">
                                                <div class="col-md-4" style="margin-top: 7px">
                                                    <label for="explain_var2" class="float-right">Explain Variable 2:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" placeholder="Enter Text" class="form-control" name="explain_var2" id="explain_var2" required>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="margin-top: 30px">
                                                <div class="col-md-4" style="margin-top: 6px;">
                                                    <label for="num_criters2" class="float-right">Número de criterios:</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="number" min="2" max="4" placeholder="Enter a Number" class="form-control" name="num_criters2" id="num_criters2" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="margin-top: 10px">
                                                </div>
                                                <div class="col-md-8" style="margin-top: 10px">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="customized_criterion2" id="customized_criterion2">
                                                        <label class="form-check-label" for="customized_alternatives" style="margin-bottom: 10px">Customize criterion2</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <input type="hidden" value="2" placeholder="Enter a number" class="form-control" name="num_uncerts" id="num_uncerts" required> -->

                                            <div id="div-name-alternatives2">
                                            </div>
                                            <div class="form-group row" style="margin-top: 30px">
                                                <div class="col-md-12 text-center">
                                                    <input type="submit" placeholder="Ingrese un número" class="btn btn-primary" value="Generate Matrix">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: 1.2em;" class="text-gray-700">1. Crear la matriz pareada de comparación.</p>
                            <div class="col-md-12" id="payoff_matrix_container">
                                <!-- Default Card Example -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary">Ponderación Variables Principales</h6>
                                    </div>
                                    <div class="card-body" id="card_pair_waise_main_matrix">

                                    </div>
                                </div>
                            </div>
                            <div id="pair_waise_all_matrix_criterions">

                            </div>

                            <div class="col-md-12">
                                <!-- Default Card Example -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="m-0 font-weight-bold text-primary">Sensibility Analysis</h6>
                                    </div>
                                    <h5 class="font-weight-bold text-primary text-center" style="margin-top: 15px; text-decoration: underline;">Graph</h5>
                                    <div class="card-body" id="matrix_emv">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <div id="myDiv">
                                                    <!-- Plotly chart will be drawn inside this DIV -->
                                                </div>
                                            </div>
                                        </div>
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
                                        <h5 class="text-info">Stability Metric</h4>
                                            <p>If you want to make a stable decision, the best alternative (s) is (are): </p>
                                            <span id="balanced_analisys"></span>
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
                <script src="js/analytic_h_process.js"></script>

</body>

</html>