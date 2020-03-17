<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid">
    <!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Importation de la liste des clients</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
				class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	</div>
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
        <div class="block alert-success">
            <p>
                <?php if ($added != null) {
                   echo $added;
                } ?>
                clients ont été importés dans la base de données
            </p>
        </div>
            <?php echo form_open('customer/batch_insert');?>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label">Fichier</label>
				<div class="col-sm-6">
					<input type="file" id="exfile" name="file" class="form-control readonly"/>
				</div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-upload"></i>
                    </span>
                    <span class="text">Charger</span>
                </button>
            </div>         
        </div>
        
        <?php echo form_close();?>
    </div>
</div>