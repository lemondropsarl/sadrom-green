<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Modification informations</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
				class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	</div>
	<div class="card border-left-primary shadow h-100 py-2">

		<div class="card-body">
			<?php echo form_open('customer/edit'); ?>
			<input type="hidden" name="hid" id="hid" value="<?php echo $id;?>">
			<div class="form-group form-row">
				<label class="col-sm-2 col-form-label">No Client</label>
				<div class="col-sm-6">
					<label class="col-form-label"><?php echo $customer['customer_no']; ?></lqbel>
				</div>
			</div>
			<div class="form-group form-row">
				<label class="col-sm-2 col-form-label">Nom</label>
				<div class="col-sm-6">
					<input type="text" id="lname" name="lname" class="form-control" value="<?php echo $customer['last_name'];?>">
				</div>

			</div>
			<div class="form-group form-row">
				<label class="col-sm-2 col-form-label">Prenom</label>
				<div class="col-sm-6">
					<input type="text" name="fname" id="fname"  class="form-control" value="<?php echo $customer['first_name']; ?>">
				</div>
				<div>

				</div>
			</div>
			<div class="form-group form-row">
				<label class="col-sm-2 col-form-label">Adresse</label>
				<div class="col-sm-6">
					<input type="text" name="address" id="address" class="form-control" value="<?php echo $customer['address'];?>">					
				</div>
			</div>
			<div class="form-group form-row">
				<label for="area" class="col-sm-2 col-form-label">Commune</label>
				<div class="col-sm-6">
				<select name="darea" id="darea" class="form-control">
						<?php foreach ($field_options as $option) {?>
							
							<option value="<?php echo $option['area_id'];?>" <?php if ($option['area_name']==$customer['commune']) {echo "selected";}?>>
							<?php echo $option['area_name'];?></option>
						<?php }?>
					</select>
				</div>
			</div>
			<div class="form-group form-row">
				<label class="col-sm-2 col-form-label">Numero Tel</label>
				<div class="col-sm-6">
					<input type="text" name="pnumber" id="pnumber"  class="form-control" value="<?php echo $customer['phone_number'];?>">
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
