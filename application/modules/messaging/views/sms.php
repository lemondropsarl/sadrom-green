<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Messagerie</h1>
		<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
				class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
	</div>
	<div class="row">
		<div class="col-xl-3 col-md-12 mb-4">
            <div class="col-md-12">
                <div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Envoi SMS</h6>
				</div>
				<?php echo form_open('messaging/send');?>
				<div class="card-body">
					<div class="form-group">
						<label class="col-sm-4 col-form-label">Nom du recipient:</label>
						<div class="col-sm-6">
							<input type="text" id="dname" name="dname" class="form-control" value="" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 col-form-label">Numero Tel:</label>
						<div class="col-sm-6">
							<input type="text" id="dphone" name="dphone" class="form-control" readonly="true" value=""/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-4 col-form-label">Message:</label>
						<div class="col-sm-6">
							<textarea name="smstxt" id="smstxt" cols="30" rows="5" class="form-control">

                            </textarea>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" href="<?php echo site_url('messaging/send');?>"
						class="btn btn-success btn-icon-split">
						<span class="icon text-white-50">
							<i class="fas  fa-paper-plane"></i>
						</span>
						<span class="text">Envoyer</span>
					</button>
				</div>
				<?php echo form_close();?>
			</div>
            </div>
            <div class="col-md-6">
                <div class="row">

                </div>
            </div>

			
		</div>
	</div>
</div>
<script type="text/javascript">

	$(function () {
		var data = [];
		var mySource = <?php echo json_encode($customers);?>;
		for (let i = 0; i < mySource.length; i++) {
			data[i] = mySource[i].name;
			
		}
		$("#dname").autocomplete( { 
			source: data,
			select: showNumber
		});
		function showNumber(event, ui){
			var text = ui.item.label;
			var phone = "";
			for (let i = 0; i < mySource.length; i++) {
				if (mySource[i].name == text) {
					phone = mySource[i].phone;
				}
				
			}
			$("#dphone").val(phone);
		}
		
	});
</script>



