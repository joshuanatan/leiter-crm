<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <button data-target="#exampleAccrodionModal" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button">
                <i class="icon wb-plus" aria-hidden="true"></i> Add Customer
            </button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th>Company ID</th>
                <th>CP Name</th>
                <th>Company Name</th>
                <th>Company Field</th>
                <th>Company Address</th>
                <th>Company Line</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($perusahaan->result() as $a){ ?> 
            <tr class="gradeA">
                <td><?php echo $a->id_perusahaan;?></td>
                <td><?php echo $a->nama_cp;?></td>
                <td><?php echo $a->nama_perusahaan;?></td>
                <td><?php echo $a->jenis_perusahaan;?></td>
                <td><?php echo $a->alamat_perusahaan;?></td>
                <td><?php echo $a->notelp_perusahaan;?></td>
                <td class="actions">
                    
                    <button data-target="#editModal" data-toggle="modal" type="button" class="btn btn-outline btn-primary" type="button"><i class="icon wb-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-outline btn-danger"
                    data-toggle="tooltip"><i class="icon wb-trash" aria-hidden="true"></i></button>
                    
                    <button class="btn btn-outline btn-success"
                    data-toggle="tooltip"><i class="icon wb-eye" aria-hidden="true"></i></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
