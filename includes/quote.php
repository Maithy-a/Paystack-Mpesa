<?php
// API Ninjas configuration
$api_key = "ygdRWi1NwfcIrUB5ko99Rg==L1uoD0BeeqOhFKuY";
$api_url = "https://api.api-ninjas.com/v1/quotes";

// Fetch a new quote on every page load
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-Api-Key: ' . $api_key]);
$response = curl_exec($ch);
curl_close($ch);

// Fallback quote
$fallback_quote = "Money is only a tool. It will take you wherever you wish, but it will not replace you as the driver. - Ayn Rand";

if ($response) {
    $quotes = json_decode($response, true);
    if (!empty($quotes) && isset($quotes[0]['quote'])) {
        $money_quote = $quotes[0]['quote'];
    } else {
        $money_quote = $fallback_quote;
    }
} else {
    $money_quote = $fallback_quote;
}
?>