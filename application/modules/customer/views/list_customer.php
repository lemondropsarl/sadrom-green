<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Listes de clients</h1>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered small"  id="dataTable" width="100%"  cellspacing="0">
                    <thead>
                        <tr>
                            <th>Numero ID</th>
                            <th>Nom </th>
                            <th>Prenom</th>
                            <th>Adresse </th>
                            <th>Numero Tel</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clients as $item) {?>
                        <tr>
                            <th><?php echo $item['customer_no'];?></th>
                            <th><?php echo $item['last_name'];?></th>
                            <th><?php echo $item['first_name'];?></th>
                            <th><?php echo $item['address'];?> </th>
                            <th><?php echo $item['phone_number'];?></th>
                            <th>
                                <a href="<?php echo site_url('customer/details/'.$item['cust_id']);?>" class="btn btn-circle btn-primary btn-sm">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </th>
                        </tr>
                       <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>