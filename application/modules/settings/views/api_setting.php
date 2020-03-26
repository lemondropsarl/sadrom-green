<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">APIs</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
				class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	</div>
	<div class="row">
		<div class="col-xl-3 col-md-12 mb-4">
			<?php if ($apis ==null) {?>

			<div class="card shadow mb-4">
				<a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
					aria-expanded="true" aria-controls="collapseCardExample">
					<h6 class="m-0 font-weight-bold text-primary">Ajouter un API</h6>
				</a>
				<div class="collapse show" id="collapseCardExample">
					<div class="card-body">
						<?php echo form_open('settings/api_add');?>
						<div class="form-group form-row">
							<label class="col-sm-2 col-form-label">Nom API</label>
							<div class="col-sm-6">
								<input type="text" id="name" name="name" class="form-control" />

							</div>
						</div>
						<div class="form-group form-row">
							<label class="col-sm-2 col-form-label">Application ID</label>
							<div class="col-sm-6">
								<input type="text" id="appId" name="appId" class="form-control" />

							</div>
						</div>
						<div class="form-group form-row">
							<label class="col-sm-2 col-form-label">Client ID</label>
							<div class="col-sm-6">
								<input type="text" id="clientId" name="clientId" class="form-control" />

							</div>
						</div>
						<div class="form-group form-row">
							<label class="col-sm-2 col-form-label">Client Secret</label>
							<div class="col-sm-6">
								<input type="text" id="clientsecret" name="clientsecret" class="form-control" />

							</div>
						</div>
						
						<div class=" wy-btn-group align-items-end">
							<button type="submit"class="btn btn-success"><i class="fas fa fa-save"></i></button>
						</div>
						<?php echo form_open();?>
					</div>

				</div>
			</div>

			<?php }else {

                foreach ($apis as $api) {?>

			<div class="card shadow mb-4">
				<a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
					aria-expanded="true" aria-controls="collapseCardExample">
					<h6 class="m-0 font-weight-bold text-primary"><?php echo $api['api_name'];?></h6>
				</a>
				<div class="collapse show" id="collapseCardExample">
					<div class="card-body">
					<div class="form-group form-row">
							<label class="col-sm-2 col-form-label">Application ID</label>
							<div class="col-sm-6">
								<input type="text" id="appId" name="appId" class="form-control" readonly="true"
								value="<?php echo $api['api_appId'];?>" />

							</div>
						</div>
					
						<div class="form-group form-row">
							<label class="col-sm-2 col-form-label">Client ID</label>
							<div class="col-sm-6">
								<input type="text" id="clientId" name="clientId" class="form-control" readonly="true"
									value="<?php echo $api['api_clientId'];?>" />

							</div>
						</div>
						<div class="form-group form-row">
							<label class="col-sm-2 col-form-label">Client Secret</label>
							<div class="col-sm-6">
								<input type="text" id="clientsecret" name="clientsecret" class="form-control"
									readonly="true"value=" <?php echo $api['api_clientSecret'];?>" />

							</div>
						</div>
						<div class="form-group form-row">
							<label class="col-sm-2 col-form-label">Access Token</label>
							<div class="col-sm-6">
								<input type="password" id="token" name="token" class="form-control" readonly="true"
									value="<?php echo $api['api_token'];?>" />

							</div>
						</div>
						<div class=" wy-btn-group align-items-end">
							<a href="<?php echo site_url('settings/api_remove'.$api['api_id']);?>" class="btn btn-danger"><i class="fas fa fa-power-off"></i></a>
							<a href="<?php echo site_url('settings/api_token'.$api['api_id']);?>" class="btn btn-success"><i class="fas fa fa-redo"></i></a>
						</div>
						
					</div>

				</div>
			</div>

			<?php } ?>

			<?php }?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$("#token").submit(function (e) { 
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('settings/api_add');?>",
				dataType: "json",
				success: function (response) {
					
				}
			});
		});
	});
</script>
