<?php   
        session_start();
        if(!isset($_SESSION['islogged'])){
            header("location:http://localhost/food/signIn.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #fdf2e9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
        }

        #card-element {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #card-errors {
            color: #e74c3c;
            margin-top: 10px;
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: orange;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1>Starter<b style="color:purple"> Rs.499</b></h1>
        <br><br>
        <form id="payment-form" action='./success.php' method='POST'>        
            <div class="form-group">
                <label for="card-element">Credit or debit card number</label>
                <input style="width : 90%" type='text' id='card-element'>
                <br><br>
                <label for="card-expiry">Expiration Date (MM/YY)</label>
                <input style="width : 90%" id="card-expiry" type='text' placeholder='MM/YY' required>
                <br><br>
                <label for="cvv">CVV</label>
                <input style="width : 90%" id="cvv" type='text' placeholder='CVV' required>
            </div>
            <div class="form-group">
                <button style="width : 96%" onclick="return fn()" type="submit"><b>Submit Payment</b></button>
            </div>
        </form>
    </div>

    <script>
        function fn() {
            let x = document.getElementById("cvv").value; 
            let p = document.getElementById("card-element").value; 
            let flag = true;
            if (p.length != 16) {
                alert('Invalid Card Number');
                flag= false;
            }

            let v = document.getElementById("card-expiry").value;
            if (v.length > 5) {
                alert("Invalid Entry");
                flag= false;
            }

            if (v[2] !== '/') {
                alert('Invalid format. Use MM/YY');
                flag= false;
            }

            let month = v.substring(0, 2);
            let year = v.substring(3, 5);

            if (!/^\d{2}$/.test(month) || !/^\d{2}$/.test(year)) {
                alert('Invalid format. Use MM/YY');
                flag= false;
            }

            month = parseInt(month);
            year = parseInt(year);

            if (month < 1 || month > 12) {
                alert('Invalid Month');
                flag= false;
            }
            if (year < 24) {
                alert('Expired Card');
                flag= false;
            }
            if (x.length != 3) {
                alert('Enter A Valid CVV');
                flag= false;
            }
            if(!flag)return false;

            if(confirm("Press OK to confirm the payment of Rs.499 ")){
                return true;
            }
            return false;
        }
    </script>
</body>
</html>
