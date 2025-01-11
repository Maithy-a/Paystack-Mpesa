<?php
session_start();
include 'configs.php';
include 'includes/head.php';
include 'includes/db.php'; // Include the database connection file

if (isset($_GET['reference'])) {
    $referenceId = $_GET['reference'];
    if (empty($referenceId)) {
        $_SESSION['error_message'] = "Transaction reference is missing.";
        header("Location: index.php");
        exit();
    } else {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$referenceId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $SecretKey",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            $_SESSION['error_message'] = "cURL Error: $err";
            header("Location: home.php");
            exit();
        } else {
            $data = json_decode($response);

            if ($data->status) {
                // Extract relevant data
                $status = $data->data->status ?? '';
                $reference = $data->data->reference ?? '';
                $amount = $data->data->amount / 100; // Convert to decimal
                $bank = $data->data->authorization->bank ?? '';
                $transaction_date = $data->data->transaction_date ?? '';
                $transaction_date = convertToMySQLDateTime($transaction_date);

                $transaction_type = 'Deposit'; // Default transaction type
                $description = "Paystack transaction for reference $reference";

                // Retrieve the account_id from the account table
                $customer_id = $_SESSION['customer_id'];
                $stmt = $conn->prepare("SELECT account_id FROM account WHERE customer_id = ?");
                $stmt->bind_param("i", $customer_id);
                $stmt->execute();
                $stmt->bind_result($account_id);
                $stmt->fetch();
                $stmt->close();

                if (empty($account_id)) {
                    $_SESSION['error_message'] = "No account found for the customer.";
                    header("Location: home.php");
                    exit();
                }

                // Insert into the transaction table
                $stmt = $conn->prepare(
                    "INSERT INTO `transaction` 
                    (account_id, transaction_type, status, reference, bank, amount, transaction_date, description) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
                );

                $stmt->bind_param(
                    "issssdss",
                    $account_id,
                    $transaction_type,
                    $status,
                    $reference,
                    $bank,
                    $amount,
                    $transaction_date,
                    $description
                );

                if ($stmt->execute()) {
                    // Update wallet balance
                    $updateStmt = $conn->prepare("UPDATE account SET balance = balance + ? WHERE account_id = ?");
                    $updateStmt->bind_param("di", $amount, $account_id);
                    $updateStmt->execute();
                    $updateStmt->close();

                    // Set success message
                    $_SESSION['success_message'] = "Balance successfully updated!";
                } else {
                    $_SESSION['error_message'] = "Error saving transaction: " . $stmt->error;
                }

                $stmt->close();
                header("Location: home.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Transaction failed: " . $data->message;
                header("Location: home.php");

                exit();
            }

        }
    }
} else {
    $_SESSION['error_message'] = "Transaction reference is missing.";
    header("Location: index.php");
    exit();
}

// Function to convert Paystack datetime to MySQL DATETIME format
function convertToMySQLDateTime($dateTimeString)
{
    $dateTime = new DateTime($dateTimeString);
    return $dateTime->format('Y-m-d H:i:s');
}
?>