<div class="panel-body col-lg-12">
    <form action = "<?php echo base_url();?>finance/tax/ppn/detail">
        <div class="row">
            <div class = "col-lg-5">
                <div class = "form-group">
                    <h5>MONTH</h5>
                    <select class = "form-control">
                        <?php for($a= 1; $a<=12; $a++):?>
                        <?php endfor;?>
                    </select>
                </div>
            </div>
            <div class = "col-lg-5">
                <div class = "form-group">
                    <h5>YEAR</h5>
                    <select class = "form-control">
                        
                    </select>
                </div>
            </div>
            <div class  = "col-lg-2">
                <div class = "form-group">
                    <h5>Go</h5>
                    <button type = "submit" class = "btn btn-primary btn-outline">CHECK PPN STATS</button>
                </div>
            </div>
        </div>
    </form>
</div>