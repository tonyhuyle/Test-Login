<?php
    require(__DIR__ .'/../PhpFiles/FuelQuoteModule.php');
    require(__DIR__ .'/../PhpFiles/FuelQuoteValidation.php');
    use PhpFiles\FuelQuoteModule;
    use PhpFiles\FuelQuoteValidation;
    $errors = array();

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $validate = new FuelQuoteValidation($_POST);
        $errors = $validate->is_valid();
        if(empty($validate->errors()))
        {
            $module = new FuelQuoteModule($_POST);
        }
        else
        {
            $errors = $validate->errors();
        }
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FuelQuote</title>
    <link rel="stylesheet" href="output.css">
</head>

<!--Account Management Form-->
<body class="bg-cover bg-center flex items-center justify-center h-screen" background=images/Refinery.jpg>

    <div class="container mx-auto my-36 p-6 bg-white max-w-6xl rounded shadow-md" style = "height: 66.666667%">
        <div class="navbar">
			<ul>
			<li class="font-semibold text-gray-800 mb-4"><a href="profile/profile.html" class="button-left">My Profile</a></li>
			<li class="font-semibold text-gray-800 mb-4"><a class="active">New Quote</a></li>
			<li class="font-semibold text-gray-800 mb-4"><a href="history.html">View Quotes</a></li>
			</ul>
		</div>
        <div class ="p-2 text-2xl text-center"> Fuel Quote Form
        </div>
            <div class="m-2">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <h2 class="font-semibold">Gallons of Oil to request</h2>
                    <input class = "h-10 box-border border-2" type="number" required name = "gallons" min="0" value="0" step="0.01" style="width:750px;"><br>
                    <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST" and !empty($errors) and array_key_exists("gallons", $errors))
                    {
                        $message = $errors["gallons"];
                        echo "<Br><p style=\"color:red\"><strong>Error with input! Message: $message </strong></p>";
                    }?>
<!-- PUT CHECKBOX HERE FOR ADDRESS! -->
                    <label class="font-semibold" for="address1">Street Address</label>
				    <input type="text" id="address1" class="w-full p-2 border border-gray-300 rounded-md">
                    <h2 class = "mt-10 font-semibold">Delivery Date</h2>
                    <input class = "h-10 box-border border-2" type="date" name = "date">
                    <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST" and !empty($errors) and array_key_exists("date", $errors) )
                    {
                        $message = $errors["date"];
                        echo "<Br><p style=\"color:red\"><strong>Error with input! Message: $message </strong></p>";
                    }?>
                    <h2 class="mt-10 font-semibold">Suggested Price Per Gallon</h2>
                    <input class = "h-10 box-border border-2" placeholder="Sample Price: 3.02" type="text" style="width:750px" readonly>
                    <h2 class="mt-10 font-semibold">Total Price</h2>
                    <input class = "h-10 box-border border-2" placeholder="Sample Price: 3.02" type="text" style="width:750px" readonly>
                    <input type = "submit" value="submit" name="submit" class="rounded shadow-md block p-3">
                    <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST" and empty($errors))
                    {
                        echo "<Br><p><strong>Form submitted successfully! All input fields sucessfully validated.</strong></p>";
                    }?>
                </form>
            </div>
    </div>
</body>
