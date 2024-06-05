<?php

/*******w******** 
    
    Name: Pravleen Kaur
    Date: 27-05-2024
    Description: php

******************/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Start by capturing the form inputs
$fullName = filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
$province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
$postalCode = filter_input(INPUT_POST, 'postalCode', FILTER_SANITIZE_STRING);
$creditCardNumber = filter_input(INPUT_POST, 'creditCardNumber', FILTER_SANITIZE_NUMBER_INT);
$creditCardMonth = filter_input(INPUT_POST, 'creditCardMonth', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 12]]);
$creditCardYear = filter_input(INPUT_POST, 'creditCardYear', FILTER_VALIDATE_INT, ['options' => ['min_range' => date('Y'), 'max_range' => date('Y') + 5]]);
$creditCardType = isset($_POST['creditCardType']) ? $_POST['creditCardType'] : '';
$cardName = filter_input(INPUT_POST, 'cardName', FILTER_SANITIZE_STRING);

// Validate postal code using regex
$postalCodePattern = '/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/';
$isPostalCodeValid = preg_match($postalCodePattern, $postalCode);

// Validate quantities 
$quantities = $_POST['quantities']; // Example: ['iMac' => 2, 'WD HDD' => 2, 'Drums' => 3]
$validQuantities = true;
foreach ($quantities as $quantity) {
    if ($quantity !== '' && !filter_var($quantity, FILTER_VALIDATE_INT)) {
        $validQuantities = false;
        break;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Thanks for your order!</title>
    <style>
        body
{
    margin:10px auto;
    width:700px;
    font-family: 'Carrois Gothic';
    border-radius: 10px;
}

h1,h2
{
    padding:2px;
}

h1
{
    font-size:22px;

}

table
{
    font-size:14px;
    border:2px solid #000;
    width:580px;
    margin:0px auto 1em auto;
    border-radius: 10px;
}

td
{
    border: 1px solid #000;
    padding: 2px;
    margin: 3px;
}

#rollingrick
{
    margin:10px auto;
    width:650px;
}

.alignright
{
    text-align:right;
}

.bold
{
    font-weight:bold;
}

.invoice
{
    border:#000 solid 2px;
    padding:5px;
    width:660px;
    margin:0px auto 0px;
    color:#000;
    border-radius: 10px;
    padding-bottom: 25px;
}
</style>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <form action="thankyou.php" method="POST">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required><br>

        <label for="province">Province:</label>
        <input type="text" id="province" name="province" required><br>

        <label for="postalCode">Postal Code:</label>
        <input type="text" id="postalCode" name="postalCode" required><br>

        <label for="creditCardNumber">Credit Card Number:</label>
        <input type="text" id="creditCardNumber" name="creditCardNumber" required><br>

        <label for="creditCardMonth">Credit Card Expiry Month:</label>
        <input type="number" id="creditCardMonth" name="creditCardMonth" min="1" max="12" required><br>

        <label for="creditCardYear">Credit Card Expiry Year:</label>
        <input type="number" id="creditCardYear" name="creditCardYear" min="<?php echo date('Y'); ?>" max="<?php echo date('Y') + 5; ?>" required><br>

        <label for="creditCardType">Credit Card Type:</label>
        <input type="checkbox" id="creditCardType" name="creditCardType" required> Visa<br>

        <label for="cardName">Name on Card:</label>
        <input type="text" id="cardName" name="cardName" required><br>

        <h3>Order Items:</h3>
        <label for="quantity1">iMac:</label>
        <input type="number" id="quantity1" name="quantities[iMac]" min="0"><br>

        <label for="quantity2">WD HDD:</label>
        <input type="number" id="quantity2" name="quantities[WD HDD]" min="0"><br>

        <label for="quantity3">Drums:</label>
        <input type="number" id="quantity3" name="quantities[Drums]" min="0"><br>

        <input type="submit" value="Submit Order">
    </form>
</body>
</html>