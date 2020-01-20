<div class="page-header">
    <h1 class="page-title">CRM - REQUEST FOR QUOTATION (RFQ)</h1>
    <br/>
    <ol class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">CRM</a></li>
        <li class="breadcrumb-item active">Request for Quotation</li>
    </ol>
</div>

<?php if($this->session->status != ""):?>
<div class = "alert col-lg-12 alert-dismissible alert-<?php echo $this->session->status;?>">
    <?php echo $this->session->msg;?>
</div>
<?php endif;?>