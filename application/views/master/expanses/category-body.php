<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button data-target="#addItem" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                <i class="icon wb-plus" aria-hidden="true"></i> Add Finance Report Category
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>ID Type</th>
                <th>Variable Type</th> <!-- income / expanses -->
                <th>Usage in Report</th> <!-- bank / cash -->
                <th>Type Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($finance_type); $a++): ?>
            <tr class="gradeA">
                <td><?php echo $finance_type[$a]["id_type"];?></td>
                <td><?php echo $finance_type[$a]["variable_type"];?></td>
                <td><?php echo $finance_type[$a]["usage_type"];?></td>
                <td><?php echo $finance_type[$a]["name_type"];?></td>
                <td class="actions">
                    
                    <button data-target="#editModal<?php echo $finance_type[$a]["id_type"];?>"data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" aria-hidden="true"></i></button>

                    <div class="modal fade" id="editModal<?php echo $finance_type[$a]["id_type"];?>"aria-hidden="true" aria-labelledby="AddCatalog" role="dialog" tabindex="-1">
                        <div class="modal-dialog modal-simple modal-center">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title">Edit Finance Report Category Data</h4>
                                </div>
                                <form action = "<?php echo base_url();?>master/expanses/edit/<?php echo $finance_type[$a]["id_type"];?>" method="post">
                                    <div class="modal-body">
                                        <div class = "form-group">
                                            <h5>Variable Type</h5>
                                            <select class = "form-control" name = "variable_type">
                                                <option value = "INCOME">INCOME</option>
                                                <option value = "EXPANSE" <?php if($finance_type[$a]["variable_type"] == "EXPANSE") echo "selected";?>>EXPANSE</option>
                                            </select>
                                        </div>
                                        <div class = "form-group">
                                            <h5>Usage in Report</h5>
                                            <select class = "form-control" name = "usage_type">
                                                <option value = "BANK">BANK</option>
                                                <option value = "CASH">CASH <?php if($finance_type[$a]["usage_type"] == "cash") echo "selected";?></option>
                                            </select>
                                        </div>
                                        <div class = "form-group">
                                            <h5>Type Name</h5>
                                            <input type = "text" class = "form-control" name = "name_type" value = "<?php echo $finance_type[$a]["name_type"];?>">
                                        </div>
                                        <div class = "form-group">
                                            <button type = "submit" class = "btn btn-primary btn-outline">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <a href = "<?php echo base_url();?>master/expanses/delete/<?php echo $finance_type[$a]["id_type"];?>" class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></a>
                    
                </td>
            </tr>
                <?php endfor;?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="addItem" aria-hidden="true" aria-labelledby="AddCatalog" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Add Finance Report Category Data</h4>
            </div>
            <form action = "<?php echo base_url();?>master/expanses/insert" method="post">
                <div class="modal-body">
                    <div class = "form-group">
                        <h5>Variable Type</h5>
                        <select class = "form-control" name = "variable_type">
                            <option value = "INCOME">INCOME</option>
                            <option value = "EXPANSE">EXPANSE</option>
                        </select>
                    </div>
                    <div class = "form-group">
                        <h5>Usage in Report</h5>
                        <select class = "form-control" name = "usage_type">
                            <option value = "BANK">BANK</option>
                            <option value = "CASH">CASH</option>
                        </select>
                    </div>
                    <div class = "form-group">
                        <h5>Type Name</h5>
                        <input type = "text" class = "form-control" name = "name_type">
                    </div>
                    <div class = "form-group">
                        <button type = "submit" class = "btn btn-primary btn-outline">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
