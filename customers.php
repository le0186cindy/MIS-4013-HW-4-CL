<?php
    require "header.php";
    require_once "util-db.php";

    if (isset($_POST['actionType'])) {
        switch ($_POST['actionType']) {
            case 'add':
                if (add_customer($_POST['cName'], $_POST['cEmail'])) {
                    echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Successfully added a customer.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                break;
            case 'remove':
                if (remove_customer($_POST['cID'])) {
                    echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Successfully removed.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                break;
            case 'edit':
                if (edit_customer($_POST['cName'], $_POST['cEmail'], $_POST['cID'])) {
                    echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Edited.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            }
        }
    $customers = get_all_customers();
?>
<html>

<body>
    <div class="table-responsive mx-5">
        <h3>Customers</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>E-mail</th><th>#</th>
                </tr>
            </thead>
            <thead>
                    <?php
                        foreach ($customers as $customer) {
                    ?>
                    <tr>
                         <td><?php echo $customer['customer_id']?></td>
                         <td><?php echo $customer['customer_name']?></td>
                         <td><?php echo $customer['customer_email']?></td>
                         <td>
                            <div class="btn-group">
                                <form class="my-0 me-2" method="post" action="">
                                    <input type="hidden" name="cID" value="<?php echo $customer['customer_id']?>">
                                    <input type="hidden" name="actionType" value="remove">
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?');">Delete</button>
                                </form>
                                <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $customer['customer_id']?>">Edit</button>
                            </div>
                            <div class="modal fade" id="editModal<?php echo $customer['customer_id']?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editLabel">Edit customer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <div class="mb-3">
                                        <label for="cName" class="form-label">Customer's Name</label>
                                        <input type="text" id="cName" name="cName" class="form-control" value="<?php echo $customer['customer_name']?>">
                                        </div>
                                        <div class="mb-3">
                                        <label for="cEmail" class="form-label">Customer's Email</label>
                                        <input type="email" id="cEmail" name="cEmail" class="form-control" value="<?php echo $customer['customer_email']?>">
                                        </div>
                                        <input type="hidden" name="cID" value="<?php echo $customer['customer_id']?>">
                                        <input type="hidden" name="actionType" value="edit">
                                        <button type="submit" class="btn btn-primary">Edit customer</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                         </td>
                    </tr>
                    <?php
                        }
                    ?>
            </thead>
        </table>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            Add
        </button>
        
    </div>
</body>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="addLabel">Add a new customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form method="post" action="">
            <div class="mb-3">
            <label for="cName" class="form-label">Customer's Name</label>
            <input type="text" id="cName" name="cName" class="form-control">
            </div>
            <div class="mb-3">
            <label for="cEmail" class="form-label">Customer's Email</label>
            <input type="email" id="cEmail" name="cEmail" class="form-control">
            </div>
            <input type="hidden" name="actionType" value="add">
            <button type="submit" class="btn btn-primary">Add customer</button>
        </form>
    </div>
    </div>
</div>
</div>

</html>