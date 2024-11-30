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
                    </tr>
                    <?php
                        }
                    ?>
            </thead>
        </table>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            Add
        </button>
        <!-- Modal -->
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
                    <input type="text" id="cName" class="form-control">
                    </div>
                    <div class="mb-3">
                    <label for="cEmail" class="form-label">Customer's Email</label>
                    <input type="email" id="cEmail" class="form-control">
                    </div>
                    <input type="hidden" name="actionType" value="add">
                    <button type="submit" class="btn btn-primary">Add customer</button>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>