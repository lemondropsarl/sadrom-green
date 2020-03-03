<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Paramètre eneral</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
				class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	</div>
	<div class="card-row">
	<!-- GEneral settings-->
		<div class="col-xl-3 col-md-12 mb-4">
			<?php if ($app ==null) {?>

			<div class="card shadow mb-4">
				<a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
					aria-expanded="true" aria-controls="collapseCardExample">
					<h6 class="m-0 font-weight-bold text-primary">Ajouter les informations de base</h6>
				</a>
				<div class="collapse show" id="collapseCardExample">
					<div class="card-body">
						<?php echo form_open('settings/app_setting_add');?>
						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Nom Application</label>
							<div class="col-sm-6">
								<input type="text" id="app_name" name="app_name" class="form-control" />

							</div>
						</div>
						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label"> Tag</label>
							<div class="col-sm-6">
								<input type="text" id="app_tag" name="app_tag" class="form-control" />

							</div>
						</div>
						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Logo</label>
							<div class="col-sm-6">
								<input type="file" name="logo" id="logo" class="form-control">
							</div>
						</div>
						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Numero contact</label>
							<div class="col-sm-6">
								<input type="text" id="app_sender" name="app_sender" class="form-control" />

							</div>
						</div>
						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Nom Contact</label>
							<div class="col-sm-6">
								<input type="text" id="app_sender_name" name="app_sender_name" class="form-control" />

							</div>
						</div>

						<div class=" wy-btn-group align-items-end">
							<button type="submit" class="btn btn-success"><i class="fas fa fa-save"></i>
								Enregistrer</button>
						</div>
						<?php echo form_open();?>
					</div>

				</div>
			</div>

			<?php }else {?>

			<div class="card shadow mb-4">
				<a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
					aria-expanded="true" aria-controls="collapseCardExample">
					<h6 class="m-0 font-weight-bold text-primary">Parametres general</h6>
				</a>
				<div class="collapse show" id="collapseCardExample">
					<div class="card-body">
						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Nom Application</label>
							<div class="col-sm-6">
								<input type="text" id="app_name" name="app_name" class="form-control" readonly="true"
									value="<?php echo $app['app_name'];?>" />

							</div>
						</div>

						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Tag</label>
							<div class="col-sm-6">
								<input type="text" id="app_tag" name="tag_app" class="form-control" readonly="true"
									value="<?php echo $app['api_tag'];?>" />

							</div>
						</div>
						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Logo</label>
							<div class="col-sm-6">
								<img src="" alt="">

							</div>
						</div>
						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Numero de contact</label>
							<div class="col-sm-6">
								<input type="text" id="app_sender" name="app_sender" class="form-control" readonly="true"
									value="<?php echo $app['api_contact'];?>" />

							</div>
						</div>
                        <div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Nom contact</label>
							<div class="col-sm-6">
								<input type="text" id="app_sender_name" name="app_sender_name" class="form-control" readonly="true"
									value="<?php echo $app['api_contact_name'];?>" />

							</div>
						</div>
						<div class=" wy-btn-group align-items-end">
							<a href="" id="change"
								class="btn btn-primary"><i class="fas fa fa-edit"></i> Changer</a>
						</div>

					</div>

				</div>
			</div>

			<?php } ?>
		</div>
	<!--end General settings-->

	</div>
	<!--modal edit app setting-->
	<div class="modal fade" id="editApp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Changer</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<?php echo form_open('settings/app_setting_edit');?>
				<div class="modal-body">
					<div class="form-group form-row">
						<label class="col-sm-3 col-form-label">Nom Application</label>
						<div class="col-sm-7">
							<input type="text" id="app_name" name="app_name" class="form-control readonly" 
								value="<?php echo $app['app_name']; ?>" />
						</div>
					</div>
					<div class="form-group form-row">
						<label class="col-sm-3 col-form-label">Tag</label>
						<div class="col-sm-7">
							<input type="text" id="pnumber" name="pnumber" class="form-control readonly"
								value="<?php echo $app['app_tag'];?>" />
						</div>
					</div>
					<div class="form-group form-row">
						<label class="col-sm-3 col-form-label">Numero du contact</label>
						<div class="col-sm-7">
							<input type="text" id="app_sender" name="app_sender" class="form-control readonly"
								value="<?php echo $app['app_contact'];?>" />
						</div>
					</div>
					<div class="form-group form-row">
						<label class="col-sm-3 col-form-label">Nom du contact</label>
						<div class="col-sm-7">
							<input type="text" id="app_sender_name" name="app_sender_name" class="form-control readonly"
								value="<?php echo $app['app_contact_name'];?>" />
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger btn-circle" type="button" data-dismiss="modal"><i
								class="far fa-window-close"></i></button>
						<a class="btn btn-success" id="editAppSetting"><i class="fas fa fa-save"></i> enregistrer</a>
					</div>
					<?php echo form_close();?>

				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(function () {
				$("#editAppSetting").click(function (e) { 
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('settings/app_setting_add');?>",
						data: "data",
						dataType: "json",
						success: function (response) {
							$("#editApp").modal('hide');
						}
					});
				});
			});
		</script>
	</div>
	<!--end modal app setting-->
</div>
