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
					<a href="<?php echo site_url('message/send/'.$customer['cust_id']);?>" class="btn btn-dark btn-hover btn-sm btn-circle">
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
</div>
<!--end of content-->
