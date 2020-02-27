<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$date1 = New DateTime();
$date2 = date_create($subscription['end_date']);
$diff  = date_diff($date1,$date2);
?>
<!--Content-->
<div class="container-fluid">
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Details du client</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
				class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	</div>
	<div class="row">
		<!-- personnel info-->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-bottom-success shadow  mb-4 ">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

					<h6 class="card-subtitle font-weight-bold text-success">Informations personnel</h6>
					<a href="<?php echo site_url('customer/edit/'.$customer['cust_id']);?>" class="btn btn-primary btn-sm btn-circle">
						<i class="fas fa-user-edit"></i>
					</a>
					<a href="#" data-toggle="modal" data-target="#send" class="btn btn-dark btn-hover btn-sm btn-circle">
						<i class="fas fa-envelope"></i>
					</a>
				</div>
				<div class="card-body justify-content-start">
					<dl class="dl-horizontal ">
						<dt>Identifiant:<em> <?php echo $customer['customer_no'];?> </em> </dt>

						<dt>Noms:<em> <?php echo $customer['first_name'];?> <?php echo $customer['last_name'];?></em>
						</dt>
						<dt>Numero Tel: <em><?php echo $customer['phone_number'];?></em></dt>
						<dt>Adresse: <em><?php echo $customer['address'];?></em></dt>
					</dl>
				</div>

			</div>
		</div>
		<!--end personal info-->
		<!--subscription info-->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-bottom-warning shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="card-subtite font-weight-bold text-warning">Subscription</h6>
					<a href="<?php echo site_url('customer/account_upgrade/'.$customer['cust_id']);?>" class="btn btn-info btn-sm btn-icon-split">
						<span class="icon text-white-50">
							<i class="fas fa-angle-double-up"></i>
						</span>
						<span class="text">Mise à niveau</span>
					</a>
				</div>
				<div class="card-body justify-content-start">
					<dl class="dl-horizontal ">
						<dt>Subscription:<em> <?php echo $subscription['sub_name'];?> </em> </dt>

						<dt>Début:<em> <?php echo $subscription['start_date'];?> </em></dt>
						<dt>Expiration: <em><?php echo $subscription['end_date'];?></em></dt>
						<dt>Jours restant: <em><?php echo $diff->format("%a Jours") ?></em></dt>
						<dt>Status: <?php if ($subscription['sub_status']== '1') {?>
							<text class="text-success">Actif</text>
							<?php }else {?>
							<text class="text-danger">Inactif</text>
							<?php }?></dt>
					</dl>
					<div class="btn-group-sm">
						<a href="<?php echo site_url('customer/account_suspend/'.$customer['cust_id']);?>" class="btn btn-danger btn-sm btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-power-off"></i>
							</span>
							<span class="text">Suspendre</span>
						</a>
						<a href="<?php echo site_url('customer/account_renew/'.$customer['cust_id']);?>" class="btn btn-success btn-sm btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-redo-alt"></i>

							</span>
							<span class="text">Renouveler</span>
						</a>
					</div>
				</div>

			</div>
		</div>
		<!--End of subscription-->
		<div class="col-xl-3 col-md-12 mb-4">
			
			<div class="card shadow mb-4">
			<a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Historique de paiement</h6>
				</a>
				<div class="collapse show" id="collapseCardExample">
                  <div class="card-body">
                    
                  </div>
                </div>
			</div>
		</div>

	</div>
	<div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Envoyer un SMS</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<?php echo form_open('messaging/send_sms');?>
			<div class="modal-body">
			<div class="form-group form-row">
				<label class="col-sm-3 col-form-label">Nom</label>
				<div class="col-sm-7">
					<input type="text" id="name" name="name" class="form-control readonly" readonly="true" value="<?php echo $customer['first_name']; ?> <?php echo $customer['last_name'];?>" />
				</div>
			</div>
			<div class="form-group form-row">
				<label class="col-sm-3 col-form-label">Numero Tel</label>
				<div class="col-sm-7">
					<input type="text" id="pnumber" name="pnumber" class="form-control readonly" readonly="true" value="<?php echo $customer['phone_number']; ?>" />
				</div>
			</div>
			<div class="form-group form-row">
				<label class="col-sm-3 col-form-label">Message</label>
				<div class="col-sm-7">
				
				<textarea name="message" id="message" cols="30" rows="3" class="form-control"></textarea>
			    </div>
			</div>
			
			<div class="modal-footer">
				<button class="btn btn-danger btn-circle" type="button" data-dismiss="modal"><i class="far fa-window-close"></i></button>
				<a class="btn btn-success btn-circle" href="login.html"><i class="fas fa-paper-plane"></i></a>
			</div>
			<?php echo form_close();?>
			
		</div>
	</div>
</div>
</div>
<!--end of content-->
<!--modal-->
