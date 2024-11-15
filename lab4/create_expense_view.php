<?php
?>
<html lang="en">
<head>
    <title> Create Expense </title>
</head>
<body>
        <form action="create_expense.php" method="post">
                <div>
                    <label for="name"> Name: </label>
                    <input type="text" name="name" />
                </div>
                <div>
                    <label for="amount"> Amount: </label>
                    <input type="number" name="amount" />
                </div>
                <div>
                    <label for="date"> Date: </label>
                    <input type="datetime-local" name="date" />
                </div>
                <div>
                    <label for="paymentMethod"> Payment Method: </label>
                    <select name="paymentMethod">
                        <option value="cash"> Cash </option>
                        <option value="card"> Card </option>
                    </select>

                </div>
            <button type="submit"> Submit </button>
        </form>
</body>
</html>