<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Ajouter nouveau client</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
				class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	</div>
	<div class="card border-left-primary shadow h-100 py-2">

		<div class="card-body">
			<?php echo form_open('customer/insert'); ?>

			<div class="form-group form-row">
				<label class="col-sm-2 col-form-label">No Client</label>
				<div class="col-sm-6">
					<input type="text" id="custno" name="custno" class="form-control readonly" readonly="true" value="<?php echo $customer_no; ?>" />
				</div>
			</div>
			<div class="form-group form-row">
				<label class="col-sm-2 col-form-label">Nom</label>
				<div class="col-sm-6">
					<input type="text" id="lname" name="lname" placeholder="Nom..." class="form-control">
				</div>

			</div>
			<div class="form-group form-row">
				<label class="col-sm-2 col-form-label">Prenom</label>
				<div class="col-sm-6">
					<input type="text" name="fname" id="fname" placeholder="Prenom..." class="form-control">
				</div>
				<div>

				</div>
			</div>
			<div class="form-group form-row">
				<label class="col-sm-2 col-form-label">Adresse</label>
				<div class="col-sm-6">
					<input type="text" name="address" id="address" placeholder="Adresse..." class="form-control">					
				</div>
			</div>
			<div class="form-group form-row">
				<label for="area" class="col-sm-2 col-form-label">Commune</label>
				<div class="col-sm-6">
				<select name="darea" id="darea" class="form-control">
						<?php foreach ($field_options as $option) {?>
							
							<option value="<?php echo $option['area_id'];?>"><?php echo $option['area_name'];?></option>
						<?php }?>
					</select>
				</div>
			</div>
			<div class="form-group form-row">
				<label class="col-sm-2 col-form-label">Numero Tel</label>
				<div class="col-sm-6">
					<input type="text" name="pnumber" id="pnumber" placeholder="Tel: 243-xxxx" class="form-control">
				</div>
			</div>
			<div class="form-group form-row">
				<label for="subscription" class="col-sm-2 col-form-label">Subscription</label>
				<div class="col-sm-6">
				<select name="dsub" id="dsub" class="form-control">
							<option value="" selected="true" >-----Sélectionner la subscription-----</option>
						<?php foreach ($sub_options as $option) {?>
							<option value="<?php echo $option['id'];?>"><?php echo $option['sub_name'];?> (<?php echo $option['sub_price'];?> USD)</option>
						<?php }?>
					</select>
				</div>
			</div>
			<div class="align-content-end">
			
					<button type="submit" class="btn btn-success btn-circle ">
						<span class="fas fa-check"></span>
					</button>
			
			</div>
			<?php echo  form_close();?>
		</div>

	</div>


</div>
<!-----End of page------->
