<div class="container-fluid">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo ucfirst($this->uri->segment(1));?>
            </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> <?php echo ucfirst($this->uri->segment(1));?>
                    </li>
                </ol>
        </div>
    </div>
	<div class="row"> 
		<div class="col-lg-12">
			<?php echo $output;?>
		</div>
    </div>
</div>

