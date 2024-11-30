<?php
    require_once('db-info.php');

    function get_all_customers() {
        $conn = get_db_connection();
        try {
            $conn = get_db_connection();
            return mysqli_query($conn, "SELECT * FROM customers");
        } catch (Exception $e) {
            $conn->close();
            throw $e;
        }
    }

    function get_all_products() {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            return mysqli_query($conn, "SELECT * FROM products");
        } catch (Exception $e) {
            $conn->close();
            throw $e;
        }
    }

    function get_all_manufacturers() {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            return mysqli_query($conn, "SELECT * FROM manufacturers");
        } catch (Exception $e) {
            $conn->close();
            throw $e;
        }
    }

    function get_all_suppliers() {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            return mysqli_query($conn, "SELECT * FROM suppliers");
        } catch (Exception $e) {
            $conn->close();
            throw $e;
        }
    }

    function add_customer($customerName, $customerEmail) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("INSERT INTO customers (customer_name, customer_email) VALUES (?, ?)");
            $stmt->bind_param("ss", $customerName, $customerEmail);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    function remove_customer($customerID) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("DELETE FROM customers WHERE customer_id = ?");
            $stmt->bind_param("s", $customerID);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    function edit_customer($customerName, $customerEmail, $customerID) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("UPDATE customers SET customer_name = ?, customer_email = ? WHERE customer_id = ?");
            $stmt->bind_param("sss", $customerName, $customerEmail, $customerID);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    function add_product($productName, $productManufacturer, $productSupplier) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("INSERT INTO products (product_name, manufacturer_id, supplier_id) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $productName, $productManufacturer, $productSupplier);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    function get_manufacturer($manufacturerID) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("SELECT manufacturer_name FROM manufacturers WHERE manufacturer_id = ?");
            $stmt->bind_param("s", $manufacturerID);
            $stmt->execute();
            $stmt->bind_result($manufacturerName);
            $stmt->fetch();
            $conn ->close();
            return $manufacturerName;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    function get_supplier($supplierID) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("SELECT supplier_name FROM suppliers WHERE supplier_id = ?");
            $stmt->bind_param("s", $supplierID);
            $stmt->execute();
            $stmt->bind_result($supplierName);
            $stmt->fetch();
            $conn ->close();
            return $supplierName;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    function remove_product($productID) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
            $stmt->bind_param("s", $productID);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    function edit_product($productName, $productManufacturer, $productSupplier, $productID) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("UPDATE products SET product_name = ?, manufacturer_id = ?, supplier_id = ? WHERE product_id = ?");
            $stmt->bind_param("ssss", $productName, $productManufacturer, $productSupplier, $productID);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    // functions for manufacturers
    function add_manufacturer($manufacturerName, $manufacturerLocation) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("INSERT INTO manufacturers (manufacturer_name, manufacturer_location) VALUES (?, ?)");
            $stmt->bind_param("ss", $manufacturerName, $manufacturerLocation);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    function remove_manufacturer($manufacturerID) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("DELETE FROM manufacturers WHERE manufacturer_id = ?");
            $stmt->bind_param("s", $manufacturerID);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    function edit_manufacturer($manufacturerName, $manufacturerLocation, $manufacturerID) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("UPDATE manufacturers SET manufacturer_name = ?, manufacturer_location = ? WHERE manufacturer_id = ?");
            $stmt->bind_param("sss", $manufacturerName, $manufacturerLocation, $manufacturerID);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    //functions for suppliers
    function add_supplier($supplierName, $supplierLocation) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("INSERT INTO suppliers (supplier_name, supplier_location) VALUES (?, ?)");
            $stmt->bind_param("ss", $supplierName, $supplierLocation);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    function remove_supplier($supplierID) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("DELETE FROM supplier WHERE supplier_id = ?");
            $stmt->bind_param("s", $supplierID);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }

    function edit_supplier($supplierName, $supplierLocation, $supplierID) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("UPDATE suppliers SET supplier_name = ?, supplier_location = ? WHERE supplier_id = ?");
            $stmt->bind_param("sss", $supplierName, $supplierLocation, $supplierID);
            $success = $stmt->execute();
            $conn ->close();
            return $success;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
        }
    }
?>