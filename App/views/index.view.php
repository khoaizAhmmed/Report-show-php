
<?php include 'partials/header.php' ?>

<form action="/" method="post">
  <button class="button" type="submit">Generate Report</button>
</form>

<div class="container">
  <h2>Order Report</h2>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-2">Product Name</div>
      <div class="col col-2">Customer Name</div>
      <div class="col col-3">Quantity</div>
      <div class="col col-3">Price</div>
      <div class="col col-3">Total</div>
    </li>
    <?php if($data):?>
    
   <?php foreach($data['info'] as $info): ;?> 

    <li class="table-row">
      <div class="col col-2" ><?= $info['product_name'] ?></div>
      <div class="col col-2"> <?= $info['customer_name'] ?> </div>
      <div class="col col-3" ><?= $info['purchase_quantity'] ?></div>
      <div class="col col-3" ><?= $info['product_price'] ?></div>
      <div class="col col-3" ><?= $info['total_price'] ?></div>
    </li>
      <?php endforeach ?>

      <li class="table-row last-row">
      <div class="col col-2" ></div>
      <div class="col col-2" >Gross Total:</div>
      <?php foreach($data['sum'] as $sum): ;?> 
      <div class="col col-3" ><?=$sum['sum_quantity'] ?></div>
      <div class="col col-3" ><?=$sum['sum_price'] ?></div>
      <div class="col col-3" ><?=$sum['sum_total_price'] ?></div>
      <?php endforeach ?>
    </li>
   <?php else:?>

       <li class="table-row ">
          <div>No data</div>
       </li>

   <?php endif?>
  </ul>
</div>

<?php include 'partials/footer.php' ?>