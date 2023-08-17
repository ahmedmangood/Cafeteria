<link rel="stylesheet" href="../../../layout/CSS/orders.css">

<?php
include '../../../connection_credits.php';
include '../../../connection.php';
include "../../../Models/AdminOrder.php";
include "../../../Controllers/AdminController.php";
include "../../../layout/head.php";
include "../../../Validation/adminChecksValidation.php";
include "../../../MiddleWares/auth.php";
include "../../../MiddleWares/admin.php";


$users = getAllUser();
if (!empty($_GET['orders'])) {
  $orders =   filter($_GET['orders']);
}

if (!empty($_GET['details'])) {
  $orderdetails =  getDetalisOfOrder($_GET['details'], $_GET['user']);
}

if (!empty($_POST)) {
  $orders = filterOrderByUserAndDate($_POST);
  // var_dump($orders);
}
?>
<main style="width:80%;margin-left:auto " class="p-50">
  <div class="container">
    <div class="row mt-5 ">
      <div class="col-12 my-auto checktext">
        <h2 class="Checks_Orders title_admin ">Checks Orders</h2>
      </div>
      <div class="col-10 container_check_order mx-auto">
        <form method="post">
          <div class="d-flex align-items-center">
            <div class="form-group w-25">
              <label for="start_date">Start Date</label>
              <input class="form-control " id="start_date" name="start_date" placeholder="Date From" type="date" value="<?= $_POST['start_date'] ?? "" ?>" />

            </div>
            <div class="form-group w-25">
              <label for="start_date">End Date</label>
              <input class="form-control" id="end_date" name="end_date" placeholder="Date To" type="date" value="<?= $_POST['end_date'] ?? "" ?>" />
            </div>
            <div class="form-group w-50 ">
              <label for="user">Choose User</label>

              <select class="form-control" name="user" placeholder="select user">
                <option></option>
                <?php foreach ($users as $user) { ?>
                  <option value="<?= $user['id'] ?>" <?php
                                                      if (isset($_POST['user'])) {
                                                        if ($user['id'] == $_POST['user'])
                                                          echo "selected";
                                                      }
                                                      ?>> <?= $user['username'] ?></option>
                <?php } ?>
              </select>
            </div>


          </div>


          <div class="form-group text-right"> <!-- Submit button -->
            <button class="colorbtn btn_product" name="submit" type="submit">Search <i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>

    </div>
    <button onclick="goBack()" class="colorbtn"><i class="fa fa-arrow-left"></i></button>

    <?php if (empty($_POST)) { ?>

      <div class="row mt-3">
        <?php if (empty($_GET['orders']) && empty($GET['user']) && empty($_GET['details'])) { ?>
          <table class="table table-striped  border-dark table-hover text-center table-bordered ">
            <tr>
              <th>show orders
              <th>User Name</th>
              <th>Total Amount</th>
            </tr>
            <?php foreach ($users as $user) { ?>
              <tr>
                <td>

                  <form>
                    <button class="colorbtn" name="orders" value="<?= $user['id'] ?>"><i class="fa fa-eye"></i></button>
                  </form>
                </td>
                <td><?= $user['username'] ?></td>
                <td><?= totalAmount($user['id']) ?></td>
              </tr>
            <?php } ?>
          </table>
        <?php } else if (empty($GET['user']) && empty($_GET['details'])) {
          include "./checkordertable.php";
        }
        if (!empty($_GET['details'])) {
          include "./orderdetails.php"
        ?>

        <?php } ?>
      </div>
    <?php } else { ?>


      <div class="row mt-5">
        <?php include "./checkordertable.php";
        ?>

      </div>

    <?php } ?>


  </div>
</main>
<script>
  function goBack() {
  window.history.back();
}
</script>
<?php
include "../../../layout/footer.php";
?>