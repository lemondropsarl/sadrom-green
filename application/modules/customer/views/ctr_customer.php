<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Gestion des contrat</h1>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered small"  id="dataTable" width="100%"  cellspacing="0">
                    <thead>
                        <tr>                           
                            <th>Nom </th>
                            <th>Soubscription</th>
                            <th>Expiration </th>
                            <th>Actions</th>                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contracts as $item) {?>
                            <?php 
                            $color="";                           
                            $date1 = New DateTime();
                            $date2 = date_create($item['exp_date']);
                            $diff = date_diff($date1,$date2);                           
                            $remaining = intval($diff->format("%a"));
                            if ($remaining <=14 || $item['sub_status'] == '0') {
                                //color goes red
                                $color = "red";                               
                            }elseif ($remaining > 14 && $remaining <30) {
                                //color goes orangish
                                $color ="orange";                               
                            }                           
                        ?>
                        <tr style="background-color:<?php echo $color;?>" >
                       
                            <th><?php echo $item['first_name'];?> <?php echo $item['last_name'];?></th>
                            <th><?php echo $item['sub_name'];?></th>
                            <th><?php echo $item['exp_date'];?></th>
                            <th>
                                <a href="<?php echo site_url('message/send/'.$item['cust_id'])?>" class="btn btn-circle btn-dark btn-sm">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="<?php echo site_url('customer/account_renew/'.$item['cust_id'])?>" class="btn btn-circle btn-success btn-sm">
                                    <i class="fas fa-redo-alt"></i>
                                </a>
                                <a href="<?php echo site_url('customer/details/'.$item['cust_id'])?>" class="btn btn-circle btn-primary btn-sm">
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