<?php
$tahun = date("Y");
?>
<div class="page">
    <div class="page-content">
        <!-- Panel -->
        <div class="panel">
            <div class="panel-body container-fluid">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card p-30 flex-row justify-content-between">
                            <div class="white">
                                <i class="icon icon-circle icon-2x wb-order bg-green-600" aria-hidden="true"></i>
                            </div>
                            <div class="counter counter-md counter text-right">
                                <div class="counter-number-group">
                                    <span class="counter-number" style = "font-size:18px"><?php echo number_format($cashflow_balance[0]["cashflow"],2); ?></span><br/>
                                    <span class="counter-number-related text-capitalize">Cash Balance</span>
                                </div>
                                <div class="counter-label text-capitalize font-size-16"><?php echo date("M")."/".date("Y");?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card p-30 flex-row justify-content-between">
                            <div class="white">
                                <i class="icon icon-circle icon-2x wb-clipboard bg-purple-600" aria-hidden="true"></i>
                            </div>
                            <div class="counter counter-md counter text-right">
                                <div class="counter-number-group">
                                    <span class="counter-number" style = "font-size:18px"><?php echo number_format($margin_overview,2);?>%</span><br/>
                                    <span class="counter-number-related text-capitalize">Margin</span>
                                </div>
                                <div class="counter-label text-capitalize font-size-16"><?php echo date("M")."/".date("Y");?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card p-30 flex-row justify-content-between">
                            <div class="white">
                                <i class="icon icon-circle icon-2x wb-dropdown bg-red-600" aria-hidden="true"></i>
                            </div>
                            <div class="counter counter-md counter text-right">
                                <div class="counter-number-group">
                                    <span class="counter-number" style = "font-size:18px"><?php echo number_format($pengeluaran[0]["cashflow"],2);?></span><br/>
                                    <span class="counter-number-related text-capitalize">Pengeluaran</span>
                                </div>
                                <div class="counter-label text-capitalize font-size-16"><?php echo date("M")."/".date("Y");?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card p-30 flex-row justify-content-between">
                            <div class="white">
                                <i class="icon icon-circle icon-2x wb-dropup bg-blue-600" aria-hidden="true"></i>
                            </div>
                            <div class="counter counter-md counter text-right">
                                <div class="counter-number-group">
                                    <span class="counter-number" style = "font-size:18px"><?php echo number_format($pemasukan[0]["cashflow"],2);?></span><br/>
                                    <span class="counter-number-related text-capitalize">Pemasukan</span>
                                </div>
                                <div class="counter-label text-capitalize font-size-16"><?php echo date("M")."/".date("Y");?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-lg">
                    <div class="col-lg-12 col-xl-12">
                    <!-- Example Bar -->
                        <div class="example-wrap">
                            <h4 class="example-title">CASHFLOW <?php echo date("Y");?></h4>
                            <div class="example text-center">
                                <canvas id="exampleChartjsBar" style = "width:100%"></canvas>
                            </div>
                        </div>
                    <!-- End Example Bar -->
                    </div>

                    <div class="col-lg-12 col-xl-12">
                    <!-- Example Bar -->
                        <div class="example-wrap">
                            <h4 class="example-title">MARGIN <?php echo $tahun-0;?>-<?php echo $tahun-1;?>-<?php echo $tahun-2;?></h4>
                            <div class="example text-center">
                                <canvas id="exampleChartjsBar2" style = "width:100%"></canvas>
                            </div>
                        </div>
                    <!-- End Example Bar -->
                    </div>
                </div>
                <div class="row row-lg">
                    <div class="col-lg-12 col-xl-12">
                    <!-- Example Bar -->
                        <div class="example-wrap">
                            <h4 class="example-title">Invoice Customer Mendekati Jatuh Tempo</h4>
                            <table class = "table table-striped table-hover table-bordered" data-plugin = "DataTable">
                                <thead>
                                    <th>Test1</th>
                                    <th>Test2</th>
                                    <th>Test3</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Item1</td>
                                        <td>Item2</td>
                                        <td>Item3</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <!-- End Example Bar -->
                    </div>

                    <div class="col-lg-12 col-xl-12">
                    <!-- Example Bar -->
                        <div class="example-wrap">
                            <h4 class="example-title">Tagihan Vendor Mendekati Jatuh Tempo</h4>
                            <table class = "table table-striped table-hover table-bordered" data-plugin = "DataTable">
                                <thead>
                                    <th>Test1</th>
                                    <th>Test2</th>
                                    <th>Test3</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Item1</td>
                                        <td>Item2</td>
                                        <td>Item3</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <!-- End Example Bar -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Panel -->
    </div>
</div>