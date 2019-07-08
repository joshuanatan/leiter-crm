<div class="site-menubar">
    <div class="site-menubar-header">
        <div class="cover overlay">
            <img class="cover-image" src="<?php echo base_url();?>assets/examples/images/dashboard-header.jpg" alt="...">
            <div class="overlay-panel vertical-align overlay-background">
                <div class="vertical-align-middle">
                    <a class="avatar avatar-lg" href="javascript:void(0)">
                        <img src="<?php echo base_url();?>global/portraits/1.jpg" alt="">
                    </a>
                    <div class="site-menubar-info">
                        <h5 class="site-menubar-user"><?php echo $this->session->nama_user;?></h5>
                        <p class="site-menubar-email"><?php echo $this->session->email_user;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-library" aria-hidden="true"></i>
                            <span class="site-menu-title">Master Data</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>master/product/">
                                    <span class="site-menu-title">Product</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>master/customer/">
                                    <span class="site-menu-title">Customer</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>master/uom/">
                                    <span class="site-menu-title">Unit of Measures</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>master/expanses/">
                                    <span class="site-menu-title">Expanses Type</span>
                                </a>
                            </li>
                            
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <span class="site-menu-title">Vendor</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                            <a class="animsition-link" href="<?php echo base_url();?>master/vendor/product">
                                            <span class="site-menu-title">Product</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                            <a class="animsition-link" href="<?php echo base_url();?>master/vendor/shipping">
                                            <span class="site-menu-title">Shipping</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <span class="site-menu-title">User</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                            <a class="animsition-link" href="<?php echo base_url();?>master/user/employee">
                                            <span class="site-menu-title">Employee</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-extension" aria-hidden="true"></i>
                            <span class="site-menu-title">CRM</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                        <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>crm/request">
                                <span class="site-menu-title">RFQ</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>crm/vendor">
                                <span class="site-menu-title">Vendor Price</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>crm/quotation">
                                <span class="site-menu-title">Quotation</span>
                                </a>
                            </li>
                            
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>crm/oc">
                                <span class="site-menu-title">Order Confirmation</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>crm/po">
                                <span class="site-menu-title">Purchase Order</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>crm/od">
                                <span class="site-menu-title">Order Delivery</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-globe" aria-hidden="true"></i>
                            <span class="site-menu-title">Finance</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>finance/receivable">
                                <span class="site-menu-title">Receivable</span>
                                </a>
                            </li><li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>finance/payable">
                                <span class="site-menu-title">Payable</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>finance/reimburse">
                                <span class="site-menu-title">Reimburse</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>finance/margin">
                                <span class="site-menu-title">Margin Calculation</span>
                                </a>
                            </li>
                            <li class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <span class="site-menu-title">Tax</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?php echo base_url();?>finance/tax/ppn">
                                            <span class="site-menu-title">PPN</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?php echo base_url();?>finance/tax/pph23">
                                            <span class="site-menu-title">PPH 23</span>
                                        </a>
                                    </li>
                                    <li class="site-menu-item">
                                        <a class="animsition-link" href="<?php echo base_url();?>finance/tax/pib">
                                            <span class="site-menu-title">PIB</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>finance/petty">
                                <span class="site-menu-title">Petty Cash</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-briefcase" aria-hidden="true"></i>
                            <span class="site-menu-title">Report</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>report/kpi">
                                <span class="site-menu-title">KPI</span>
                                </a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" href="<?php echo base_url();?>report/main">
                                <span class="site-menu-title">Report</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul> 
            </div>
        </div>
    </div>
</div>