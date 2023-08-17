<!--<h4> orders by --><?php // if(isset($orders)){ echo getUserName($orders[0]['user_id'])['username']; } 
                      ?><!--</h4>-->

<div class="p-50 w-100">
  <table class="table table-striped border-dark table-hover text-center table-bordered p-3">
    <tr>
      <th> Detalis</th>
      <th>Order Id</th>
      <th>User Name</th>
      <th>Date</th>
    </tr>

    <?php
    if (isset($orders)) {
      foreach ($orders as $order) { ?>
        <tr>
          <td>
            <a class="colorbtn" href="/Cafe_php_project/Views/Admin/CheckOrders/ChecksView.php?details=<?= $order['id'] ?>&&user=<?= $order['user_id'] ?>"><i class="fa fa-eye"></i></a>
          </td>
          <td><?= $order['id'] ?></td>
          <td><?=getUserName($order['user_id'])['username'] ?></td>
          <td><?= $order['created_at'] ?></td>
        </tr>
    <?php }
    } ?>
  </table>
</div>