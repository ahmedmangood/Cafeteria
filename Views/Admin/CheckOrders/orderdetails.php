<h4> Details order by <?= getUserName($_GET['user'])['username'] ?></h4>

<table class="table table-striped border-dark table-hover text-center table-bordered">
  <tr>
    <!-- <th> Detalis</th> -->
    <th>Order Id</th>
    <th>Date</th>
    <th>Notes</th>
    <th>Product Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Total</th>
    <!-- <th>Total Amount</th> -->
  </tr>

  <?php

  if (isset($orderdetails)) {
    foreach ($orderdetails as $order) { ?>
      <tr>
        <td><?= $order['order_id'] ?></td>
        <td><?= $order['created_at'] ?></td>
        <td><?= $order['notes'] ?></td>
        <td><?= $order['product_name'] ?></td>
        <td><?= $order['product_quantity'] ?></td>
        <td><?= $order['product_price'] ?></td>
        <td><?= $order['total'] ?></td>
      </tr>

  <?php }
  } ?>
</table>