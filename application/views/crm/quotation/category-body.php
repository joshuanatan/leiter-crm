<div class="panel-body col-lg-12">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-15">
            <a href = "<?php echo base_url();?>crm/quotation/create" class="btn btn-outline btn-primary">
                <i class="icon wb-plus" aria-hidden="true"></i> Create Quotation
            </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped w-full" cellspacing="0" data-plugin = "dataTable">
        <thead>
            <tr>
                <th style = "width:12%">No Quotation</th>
                <th style = "width:2%">Ver</th>
                <th style = "width:10%">Customer Firm</th>
                <th style = "width:10%">Customer Name</th>
                <th style = "width:10%">Status Quotation</th>
                <th style = "width:15%">Create Date</th>
                <th style = "width:8%">Jumlah Item</th>
                <th style = "width:10%">Harga Quotation</th>
                <th style = "width:10%">Detail Quotation</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php for($a = 0 ; $a<count($quotation);$a++){ ?> 
            <tr class="gradeA">
                <td><?php echo $quotation[$a]["no_quotation"];?></td>
                <td><?php echo $quotation[$a]["versi_quotation"];?></td>
                <td><?php echo $quotation[$a]["nama_perusahaan"];?></td>
                <td><?php echo $quotation[$a]["nama_cp"];?></td>
                <td>
                    <?php if($quotation[$a]["status_quotation"] == 0){ ?> 
                    <button class = "btn btn-sm btn-primary btn-outline">ON GOING</button>
                    <?php } ?>
                    <?php if($quotation[$a]["status_quotation"] == 1){ ?> 
                    <button class = "btn btn-sm btn-warning btn-outline">LOSS</button>
                    <?php } ?>
                    <?php if($quotation[$a]["status_quotation"] == 2){ ?> 
                    <button class = "btn btn-sm btn-success btn-outline">WIN</button>
                    <?php } ?>
                    <?php if($quotation[$a]["status_quotation"] == 3){ echo "&nbsp"; } ?> 
                </td>
                <td><?php echo $quotation[$a]["date_quotation_add"];?></td>
				<td><?php echo $quotation[$a]["jumlah_quotation_item"];?> Items</td>
				<td><?php echo number_format($quotation[$a]["total_quotation_price"]);?></td>
				<td>
					<button type = "button" class = "btn btn-primary btn-outline btn-sm col-lg-12" data-toggle = "modal" data-target = "#detailQuotation<?php echo $a;?>">DETAIL QUOTATION</button>

					<button type = "button" class = "btn btn-primary btn-outline btn-sm col-lg-12" data-toggle = "modal" data-target = "#detailItem<?php echo $a;?>">DETAIL ITEM</button>

					<button type = "button" class = "btn btn-primary btn-outline btn-sm col-lg-12" data-toggle = "modal" data-target = "#detailPembayaran<?php echo $a;?>">DETAIL PAYMENT</button>
				</td>
                <td class="actions">
                    
                    <a href = "<?php echo base_url();?>crm/quotation/edit/<?php echo $quotation[$a]["id_submit_quotation"];?>" class="btn btn-outline btn-primary"><i class="icon wb-edit" aria-hidden="true"></i></a>
                    <a href = "<?php echo base_url();?>crm/quotation/revision/<?php echo $quotation[$a]["id_submit_quotation"];?>" class="btn btn-outline btn-success" data-content="Do Revision Here" data-trigger="hover" data-toggle="popover"><i class="icon wb-eye" aria-hidden="true"></i></a>

                    <a href = "<?php echo base_url();?>crm/quotation/loss/<?php echo $quotation[$a]["id_submit_quotation"];?>" class="btn btn-outline btn-danger" data-content="Quotation Loss" data-trigger="hover" data-toggle="popover"><i class="icon wb-trash" aria-hidden="true"></i></a> 
                    
                    <a href = "<?php echo base_url();?>crm/quotation/accepted/<?php echo $quotation[$a]["id_submit_quotation"];?>" class="btn btn-outline btn-success" data-content="Proceed to Order Confirmation" data-trigger="hover" data-toggle="popover"><i class="icon fa fa-check" aria-hidden="true"></i></a>
                </td>
				
				
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php for($a = 0 ; $a<count($quotation);$a++){ ?> 
<div class = "modal fade" id = "detailQuotation<?php echo $a;?>">
	<div class = "modal-dialog modal-lg">
		<div class = "modal-content">
			<div class = "modal-header">
				<h4 class = "modal-title">DETAIL QUOTATION ITEM NO <?php echo $quotation[$a]["no_quotation"];?></h4>
			</div>
			<div class = "modal-body">
				<div class = "form-group">
					<h5 style = "opacity:0.5">No Quotation</h5>
					<input type = "text" class = "form-control" readonly value = "<?php echo $quotation[$a]["no_quotation"];?>">
				</div>
				<div class = "form-group">
					<h5 style = "opacity:0.5">Perihal</h5>
					<input type = "text" class = "form-control" readonly value = "<?php echo $quotation[$a]["hal_quotation"];?>">
				</div>
				<div class = "form-group">
					<h5 style = "opacity:0.5">UP</h5>
					<input type = "text" class = "form-control" readonly value = "<?php echo $quotation[$a]["up_cp"];?>">
				</div>
				<div class = "form-group">
					<h5 style = "opacity:0.5">Quotation Price</h5>
					<input type = "text" class = "form-control" readonly value = "<?php echo number_format($quotation[$a]["total_quotation_price"]);?>">
				</div>
				<div class = "form-group">
					<h5 style = "opacity:0.5">Durasi Pengiriman</h5>
					<input type = "text" class = "form-control" readonly value = "<?php echo $quotation[$a]["durasi_pengiriman"];?> Minggu setelah PO dikonfirmasi">
				</div>
				<div class = "form-group">
					<h5 style = "opacity:0.5">Alamat Perusahaan</h5>
					<textarea class = "form-control" rows = "5" readonly><?php echo $quotation[$a]["alamat_perusahaan"];?></textarea>
				</div>
			</div>
		</div>
	</div>
</div>
<div class = "modal fade" id = "detailItem<?php echo $a;?>">
	<div class = "modal-dialog modal-lg">
		<div class = "modal-content">
			<div class = "modal-header">
				<h4 class = "modal-title">DETAIL QUOTATION ITEM NO <?php echo $quotation[$a]["no_quotation"];?></h4>
			</div>
			<div class = "modal-body">
				<table class = "table table-bordered table-stripped" data-plugin = "dataTable">
					<thead>
						<tr>
							<th>Nama Item Quotation</th>
							<th>Attachment</th>
							<th>Item Amount</th>
							<th>Supplier</th>
							<th>Shipper</th>
							<th>Courier</th>
							<th>Selling Price</th>
							<th>Margin Price</th>
						</tr>
					</thead>
					<tbody>
						<?php for($items = 0; $items<count($quotation[$a]["quotation_item"]); $items++):?>
						<tr>
							<td><?php echo $quotation[$a]["quotation_item"][$items]["nama_produk_leiter"];?></td>
							<td><a href = "<?php echo base_url();?>assets/dokumen/quotation/<?php echo $quotation[$a]["quotation_item"][$items]["product_image"];?>" target = "_blank" class = "btn btn-primary btn-sm">IMAGE</a></td>
							<td><?php echo $quotation[$a]["quotation_item"][$items]["item_amount"]." ".$quotation[$a]["quotation_item"][$items]["satuan_produk"];?></td>
							<td><?php echo $quotation[$a]["quotation_item"][$items]["nama_supplier"];?></td>
							<td><?php echo $quotation[$a]["quotation_item"][$items]["nama_shipper"];?></td>
							<td><?php echo $quotation[$a]["quotation_item"][$items]["nama_courier"];?></td>
							<td><?php echo number_format($quotation[$a]["quotation_item"][$items]["selling_price"]);?></td>
							<td><?php echo $quotation[$a]["quotation_item"][$items]["margin_price"];?>%</td>
						</tr>
						<?php endfor;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>		
<div class = "modal fade" id = "detailPembayaran<?php echo $a;?>">
	<div class = "modal-dialog modal-lg">
		<div class = "modal-content">
			<div class = "modal-header">
				<h4 class = "modal-title">DETAIL QUOTATION ITEM NO <?php echo $quotation[$a]["no_quotation"];?></h4>
			</div>
			<div class = "modal-body">
				<?php if($quotation[$a]["metode_pembayaran"]["is_ada_transaksi"] == 0):?>
				<div class = "row">
					<div class = "form-group col-lg-4 col-sm-12">
						<h5 style = "opacity:0.5">DP</h5>
						<input type = "text" class = "form-control" readonly value = "<?php echo $quotation[$a]["metode_pembayaran"]["persentase_pembayaran"];?>">
					</div>
					<div class = "form-group col-lg-4 col-sm-12">
						<h5 style = "opacity:0.5">DP Amount</h5>
						<input type = "text" class = "form-control" readonly value = "<?php echo number_format($quotation[$a]["metode_pembayaran"]["nominal_pembayaran"]);?>">
					</div>
					<div class = "form-group col-lg-4 col-sm-12">
						<h5 style = "opacity:0.5">DP Trigger</h5>
						<input type = "text" class = "form-control" readonly value = "<?php echo $quotation[$a]["metode_pembayaran"]["trigger_pembayaran"];?>">
					</div>
				</div>
				<?php endif;?>
				<?php if($quotation[$a]["metode_pembayaran"]["is_ada_transaksi2"] == 0):?>
				<div class = "row">
					<div class = "form-group col-lg-4 col-sm-12">
						<h5 style = "opacity:0.5">Pelunasan (%)</h5>
						<input type = "text" class = "form-control" readonly value = "<?php echo $quotation[$a]["metode_pembayaran"]["persentase_pembayaran2"];?>%">
					</div>
					<div class = "form-group col-lg-4 col-sm-12">
						<h5 style = "opacity:0.5">Pelunasan Amount</h5>
						<input type = "text" class = "form-control" readonly value = "<?php echo number_format($quotation[$a]["metode_pembayaran"]["nominal_pembayaran2"]);?>">
					</div>
					<div class = "form-group col-lg-4 col-sm-12">
						<h5 style = "opacity:0.5">Pelunasan Trigger</h5>
						<input type = "text" class = "form-control" readonly value = "<?php echo $quotation[$a]["metode_pembayaran"]["trigger_pembayaran2"];?>">
					</div>
				</div>
				<?php endif;?>
				<div class = "row">
					<div class = "form-group col-lg-12">
						<h5 style = "opacity:0.5">Currency</h5>
						<input type = "text" value = "<?php echo $quotation[$a]["metode_pembayaran"]["kurs"];?>" readonly class = "form-control">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		

<?php } ?>