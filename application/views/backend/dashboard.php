<div id="page-title">
   <div class="" style="margin-bottom:50px;">
   System Percentage:-
   <br>
   <br>
    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/updatesystempercentage");?>' enctype='multipart/form-data'>
    <input style="width:100px;" type="text" id="normal-field" class="form-control" name="value" value='<?php echo set_value(' value ',$systempercent->value);?>'>
    <br>
    <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>
   

   <div class="well" style="text-align:center;">
       System Accounts
   </div>
<div class="row">
    <div class="col-md-3">
        <div class="row state-overview">
            <div class="col-lg-12 col-sm-12">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="icon-user"></i>
                    </div>
                    <div class="value">
                        <p>Total Money Receiver</p>
                        <h1><?php echo $payment->moneyreceived;?></h1>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row state-overview">
            <div class="col-lg-12 col-sm-12">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="icon-user"></i>
                    </div>
                    <div class="value">
                        <p>Total Money Paid</p>
                        <h1><?php echo $payment->moneypaid;?></h1>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row state-overview">
            <div class="col-lg-12 col-sm-12">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="icon-user"></i>
                    </div>
                    <div class="value">
                        <p>Total Balance Money</p>
                        <h1><?php echo $payment->moneybalance;?></h1>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row state-overview">
            <div class="col-lg-12 col-sm-12">
                <section class="panel">
                    <div class="symbol terques">
                        <i class="icon-user"></i>
                    </div>
                    <div class="value">
                        <p>Total Admin Money</p>
                        <h1><?php echo $payment->adminmoney;?></h1>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>