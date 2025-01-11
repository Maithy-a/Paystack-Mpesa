<?php
include("includes/auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<body data-bs-theme="light">
    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/nav.php'; ?>

    <div class="page-wrapper">
        <div class="page-body">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-tittle text-muted">Transactions History</h2>
                        </div>
                    </div>
                    <?php

                    // Fetch account ID
                    $stmt = $conn->prepare("SELECT account_id FROM account WHERE customer_id = ?");
                    $stmt->bind_param("i", $customer_id);
                    $stmt->execute();
                    $stmt->bind_result($account_id);
                    $stmt->fetch();
                    $stmt->close();

                    if (!empty($account_id)) {
                        // Fetch transactions for the logged-in user
                        $query = "SELECT transaction_id, transaction_type, status, reference, bank, amount, transaction_date, description 
                  FROM transaction WHERE account_id = ? ORDER BY transaction_date DESC";

                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $account_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Calculate totals
                        $totalTransactions = $result->num_rows;
                        $totalAmount = 0;
                        while ($row = $result->fetch_assoc()) {
                            $totalAmount += $row['amount'];
                        }

                        // Reset result pointer for displaying the table
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            // Display transactions in a table
                            echo '
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">History</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-active">
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Reference</th>
                                    <th>Bank</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>';

                            $index = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td>{$index}</td>
                                    <td>{$row['transaction_type']}</td>
                                    <td style='color:#7bd235;'>{$row['status']}</td>
                                    <td>{$row['reference']}</td>
                                    <td>{$row['bank']}</td>
                                    <td>KES " . number_format($row['amount'], 2) . "</td>
                                    <td>{$row['transaction_date']}</td>
                                    <td>{$row['description']}</td>
                                </tr>";
                                $index++;
                            }
                            echo '
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>';
                        } else {
                            echo '<p class="text-muted">No transactions found.</p>';
                        }

                        $stmt->close();
                    } else {
                        echo '<p class="text-muted">No account found for the customer.</p>';
                    }

                    // Display totals
                    echo '
                    <div class="mt-4">
                        <h3>Total Number of Transactions:</h3>
                        <p class="text-info">≈ ' . $totalTransactions . '</p>
                        <h3>Total Amount Deposited:</h3>
                        <p class="text-info">≈ KES ' . number_format($totalAmount, 2) . '</p>
                    </div>';
                    ?>

                    <script>
                        $(document).ready(function () {
                            $('#myTable').DataTable({
                                responsive: true
                            });
                        });
                    </script>
                </div>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>
    </div>
</body>

</html>