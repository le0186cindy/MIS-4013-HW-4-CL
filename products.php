<?php
    require "header.php";
    require_once "util-db.php";

    if (isset($_POST['actionType'])) {
        switch ($_POST['actionType']) {
            case 'add':
                if (add_product($_POST['pName'], $_POST['pManufacturer'], $_POST['pSupplier'])) {
                    echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Added.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                break;
            case 'remove':
                if (remove_product($_POST['pID'])) {
                    echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Successfully removed.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
                break;
            case 'edit':
                if (edit_product($_POST['pName'], $_POST['pManufacturer'], $_POST['pSupplier'], $_POST['pID'])) {
                    echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Edited.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                }
            }
        }

    $products = get_all_products();
    $manufacturers = get_all_manufacturers();
    $suppliers = get_all_suppliers();
?>
<html>

<body>
    <div class="table-responsive mx-5">
        <h3>Products</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>Manufacturer</th><th>Supplier</th><th>#</th>
                </tr>
            </thead>
            <thead>
                    <?php
                        foreach ($products as $product) {
                    ?>
                    <tr>
                         <td><?php echo $product['product_id']?></td>
                         <td><?php echo $product['product_name']?></td>
                         <td><?php echo get_manufacturer($product['manufacturer_id'])?></td>
                         <td><?php echo get_supplier($product['supplier_id'])?></td>
                         <td>
                            <div class="btn-group">
                                <form class="my-0 me-2" method="post" action="">
                                    <input type="hidden" name="pID" value="<?php echo $product['product_id']?>">
                                    <input type="hidden" name="actionType" value="remove">
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?');">Delete</button>
                                </form>
                                <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $product['product_id']?>">Edit</button>
                            </div>
                            <div class="modal fade" id="editModal<?php echo $product['product_id']?>" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="editLabel">Edit product</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <div class="mb-3">
                                        <label for="pName" class="form-label">Product's Name</label>
                                        <input type="text" id="pName" name="pName" class="form-control" value="<?php echo $product['product_name']?>">
                                        </div>
                                        <div class="mb-3">
                                        <label for="pManufacturer" class="form-label">Manufacturer</label>
                                        <select name="pManufacturer" id="pManufacturer">
                                            <?php
                                                foreach ($manufacturers as $manufacturer) {
                                            ?>
                                                <option value="<?php echo $manufacturer['manufacturer_id']?>"<?php if ($manufacturer['manufacturer_id'] == $product['manufacturer_id']) { echo ' selected '; }?>><?php echo $manufacturer['manufacturer_name']?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        <div class="mb-3">
                                        <label for="pSupplier" class="form-label">Supplier</label>
                                        <select name="pSupplier" id="pSupplier">
                                            <?php
                                                foreach ($suppliers as $supplier) {
                                            ?>
                                                <option value="<?php echo $supplier['supplier_id']?>"<?php if ($supplier['supplier_id'] == $product['supplier_id']) { echo ' selected '; }?>><?php echo $supplier['supplier_name']?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                        </div>
                                        </div>
                                        <input type="hidden" name="pID" value="<?php echo $product['product_id']?>">
                                        <input type="hidden" name="actionType" value="edit">
                                        <button type="submit" class="btn btn-primary">Edit product</button>
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
        <h1 class="modal-title fs-5" id="addLabel">Add new product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form method="post" action="">
            <div class="mb-3">
            <label for="pName" class="form-label">Product's Name</label>
            <input type="text" id="pName" name="pName" class="form-control" required>
            </div>
            <div class="mb-3">
            <label for="pManufacturer" class="form-label">Manufacturer</label>
            <select name="pManufacturer" id="pManufacturer" required>
                <option value="" selected disabled hidden>Choose here</option>
                <?php
                    foreach ($manufacturers as $manufacturer) {
                ?>
                    <option value="<?php echo $manufacturer['manufacturer_id']?>"><?php echo $manufacturer['manufacturer_name']?></option>
                <?php
                    }
                ?>
            </select>
            <div class="mb-3">
            <label for="pSupplier" class="form-label">Supplier</label>
            <select name="pSupplier" id="pSupplier" required>
                <option value="" selected disabled hidden>Choose here</option>
                <?php
                    foreach ($suppliers as $supplier) {
                ?>
                    <option value="<?php echo $supplier['supplier_id']?>"><?php echo $supplier['supplier_name']?></option>
                <?php
                    }
                ?>
            </select>
            </div>
            </div>
            <input type="hidden" name="pID" value="<?php echo $product['product_id']?>">
            <input type="hidden" name="actionType" value="add">
            <button type="submit" class="btn btn-primary">Add product</button>
        </form>
    </div>
    </div>
</div>
</div>

</html>