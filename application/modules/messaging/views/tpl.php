<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">SMS Template</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
				class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	</div>
	<div class="card-row">
		<div class="col-xl-3 col-md-12 mb-4">
			<div class="card border-left-primary shadow  mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Models SMS</h6>
					<a href="#" data-toggle="modal" data-target="#add" class="btn  btn-primary btn-circle btn-outline-light">
						<i class="fas fa-plus-circle"></i>
					</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered small" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Modele</th>
									<th>Description </th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if ($tpls == null) {?>
								</tr>
								<p> Aucun SMS template configuré</p>
								<tr>

									<?php }else {
                                    # code...
                                foreach ($tpls as $tpl) {?>
								<tr>
									<th><?php echo $tpl['sms_name'];?></th>
									<th><?php echo $tpl['sms_description'];?></th>
									<th>
										<a href="#" class="btn btn-circle btn-primary btn-sm" data-toggle="modal" data-target="#edit">
											<i class="fas fa-edit"></i>
										</a>
									</th>
								</tr>
                                <!--modal edit-->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Nouveau Template</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<?php echo form_open('messaging/editpl');?>
					<div class="modal-body">
                    <input type="hidden" name="sms_id" id="sms_id" value="<?php echo $tpl['sms_id'];?>">
						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Modele</label>
							<div class="col-sm-7">
								<input type="text" id="sms_name" name="sms_name"  class="form-control" 
                                 value="<?php echo $tpl['sms_name'];?>"/>
							</div>
						</div>

						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Description</label>
							<div class="col-sm-7">
								<textarea name="sms_desc" id="sms_desc" cols="30" rows="3"
								 class="form-control">
                                 <?php echo $tpl['sms_description'];?>
                                 </textarea>
							</div>
						</div>

						<div class="modal-footer">
							<button class="btn btn-danger btn-circle" type="button" data-dismiss="modal"><i
									class="far fa-window-close"></i></button>
							<button type="submit" class="btn btn-success btn-circle" id="editsms" href="<?php echo site_url('messaging/editpl');?>"><i
									class="fas fa-save"></i></button>
						</div>
						<?php echo form_close();?>

					</div>
				</div>
			</div>
		</div>
								<?php }
                                }?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!--modal add template-->
		<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Nouveau Template</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<?php echo form_open('messaging/addtpl');?>
					<div class="modal-body">
						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Modele</label>
							<div class="col-sm-7">
								<input type="text" id="sms_name" name="sms_name" class="form-control" />
							</div>
						</div>

						<div class="form-group form-row">
							<label class="col-sm-3 col-form-label">Description</label>
							<div class="col-sm-7">
								<textarea name="sms_desc" id="sms_desc" cols="30" rows="3"
									class="form-control"></textarea>
							</div>
						</div>

						<div class="modal-footer">
							<button class="btn btn-danger btn-circle" type="button" data-dismiss="modal"><i
									class="far fa-window-close"></i></button>
							<button type="submit" class="btn btn-success btn-circle" id="addsms" href="<?php echo site_url('messaging/addtpl');?>"><i
									class="fas fa-save"></i></button>
						</div>
						<?php echo form_close();?>

					</div>
				</div>
			</div>
		</div>
        
    </div>
    <script type="text/javascript">
        $(function () {
            $("#addsms").submit(function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('messaging/addtpl');?>",                   
                    dataType: "json",
                    success: function (response) {
                        $("#add").hide();
                        
                    }
                });
            });
        });
    </script>
</div>
