<?php
    require "header.php";
    require_once "util-db.php";

    if (isset($_POST['actionType'])) {
        switch ($_POST['actionType']) {
            case 'add':
                if (add_supplier($_POST['sName'], $_POST['sLocation'])) {
                    echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Added.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                break;
            case 'remove':
                if (remove_supplier($_POST['sD'])) {
                    echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Successfully removed.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                break;
            case 'edit':
                if (edit_supplier($_POST['sName'], $_POST['sLocation'], $_POST['sID'])) {
                    echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Edited.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            }
        }

    $suppliers = get_all_suppliers();
?>
<html>

<body>
    <div class="table-responsive mx-5">
        <h3>Suppliers</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>Location</th>
                </tr>
            </thead>
            <thead>
                    <?php
                        foreach ($suppliers as $supplier) {
                    ?>
                    <tr>
                         <td><?php echo $supplier['supplier_id']?></td>
                         <td><?php echo $supplier['supplier_name']?></td>
                         <td><?php echo $supplier['supplier_location']?></td>
                         <td>
                            <div class="btn-group">
                                <form class="my-0 me-2" method="post" action="">
                                    <input type="hidden" name="sID" value="<?php echo $supplier['supplier_id']?>">
                                    <input type="hidden" name="actionType" value="remove">
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?');">Delete</button>
                                </form>
                                <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $supplier['supplier_id']?>">Edit</button>
                            </div>
                            <div class="modal fade" id="editModal<?php echo $supplier['supplier_id']?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editLabel">Edit supplier</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <div class="mb-3">
                                        <label for="sName" class="form-label">Supplier's Name</label>
                                        <input type="text" id="sName" name="sName" class="form-control" value="<?php echo $supplier['supplier_name']?>">
                                        </div>
                                        <div class="mb-3">
                                        <label for="sLocation" class="form-label">Supplier's Location</label>
                                        <input type="text" id="sLocation" name="sLocation" class="form-control" value="<?php echo $supplier['supplier_location']?>">
                                        </div>
                                        <input type="hidden" name="sID" value="<?php echo $supplier['supplier_id']?>">
                                        <input type="hidden" name="actionType" value="edit">
                                        <button type="submit" class="btn btn-primary">Edit supplier</button>
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
        <h1 class="modal-title fs-5" id="addLabel">Add a new supplier</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form method="post" action="">
            <div class="mb-3">
            <label for="sName" class="form-label">Supplier's Name</label>
            <input type="text" id="sName" name="sName" class="form-control">
            </div>
            <div class="mb-3">
            <label for="sLocation" class="form-label">Supplier's Location</label>
            <input type="text" id="sLocation" name="sLocation" class="form-control">
            </div>
            <input type="hidden" name="actionType" value="add">
            <button type="submit" class="btn btn-primary">Add supplier</button>
        </form>
    </div>
    </div>
</div>
</div>

</html>