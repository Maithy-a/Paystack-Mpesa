<?php
include("includes/auth.php");
?>

<!DOCTYPE html>
<html lang="en">

<body data-bs-theme="light">
    <?php include 'includes/sidebar.php'; ?>
    <?php include 'includes/nav.php'; ?>

    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title text-muted">Transactions History</h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-report">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Statement
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Php for the table -->
        <?php
        // Fetch account ID
        $stmt = $conn->prepare("SELECT account_id FROM account WHERE customer_id = ?");
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $stmt->bind_result($account_id);
        $stmt->fetch();
        $stmt->close();

        $transactions = [];
        $totalTransactions = 0;
        $totalAmount = 0;

        if (!empty($account_id)) {
            $query = "SELECT transaction_id, transaction_type, status, reference, bank, amount, transaction_date, description 
              FROM transaction WHERE account_id = ? ORDER BY transaction_date DESC";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $account_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $totalTransactions = $result->num_rows;

            while ($row = $result->fetch_assoc()) {
                $transactions[] = $row; // Store each transaction in an array
                $totalAmount += $row['amount'];
            }
            $stmt->close();
        }
        ?>
        <!-- Table structure -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">History</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-secondary">
                                Show
                                <div class="mx-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" value="8" size="3"
                                        aria-label="Invoices count">
                                </div>
                                entries
                            </div>
                            <div class="ms-auto text-secondary">
                                Search:
                                <div class="ms-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="myTable" class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
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
                                <tbody>
                                    <?php if (!empty($transactions)): ?>
                                        <?php foreach ($transactions as $index => $transaction): ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= htmlspecialchars($transaction['transaction_type']); ?></td>
                                                <td>
                                                    <span class="badge bg-success me-1"></span>
                                                    <?= htmlspecialchars($transaction['status']); ?>
                                                </td>
                                                <td class="text-secondary"><?= htmlspecialchars($transaction['reference']); ?>
                                                </td>
                                                <td><?= htmlspecialchars($transaction['bank']); ?></td>
                                                <td>KES <?= number_format($transaction['amount'], 2); ?></td>
                                                <td><?= htmlspecialchars($transaction['transaction_date']); ?></td>
                                                <td><?= htmlspecialchars($transaction['description']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-muted">No transactions found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-secondary">Showing <span>1</span> to <span>8</span> of
                            <span>16</span> entries
                        </p>
                        <ul class="pagination m-0 ms-auto">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M15 6l-6 6l6 6" />
                                    </svg>
                                    prev
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">
                                    next
                                    <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 6l6 6l-6 6" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-4">
                    <table class="table table-responsive card-table table-vcenter">
                        <thead>
                            <tr>
                                <th>Total number of transaction</th>
                                <th>Total Amount Deposited (KES)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-info"><?= $totalTransactions; ?></td>
                                <td class="text-info"> <?= number_format($totalAmount, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>
    </div>
</body>

</html>