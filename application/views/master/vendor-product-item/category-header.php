<div class="page-header">
    <?php foreach($perusahaan->result() as $a){ ?> 
    <h1 class="page-title"><?php echo strtoupper($a->nama_perusahaan);?> CATALOG DATA</h1>
    <?php } ?>
    <br/>
    <ol class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Master</a></li>
        <li class="breadcrumb-item active">Product Catalog</li>
    </ol>
</div>