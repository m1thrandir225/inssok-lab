<?php
require_once  'db_connect.php';

$instance = Database::getInstance();

$db = $instance->getSQLite();
$query = "SELECT * from 'expenses' where id = '{$_GET['id']}'";
$result = $db->query($query);

if (!$result) {
    die("Database query failed: " . $db->lastErrorMsg());
}
?>
<html lang="en">
<head>
    <title> Update Expense </title>
</head>
<body>
<?php if ($result) : ?>
    <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)) : ?>
        <form action="update_expense.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <?php foreach($row as $key => $value) : ?>
                <?php if($key == 'id') : continue; endif; ?>
                <?php if($key == 'paymentMethod'): ?>
                    <label for="paymentMethod"> Payment Method: </label>
                    <select name="paymentMethod">
                        <option value="cash"> Cash </option>
                        <option value="card"> Card </option>
                    </select>
                <?php else: ?>
                    <div>
                        <label for="<?php echo $key; ?>"> <?php echo ucfirst($key); ?> </label>
                        <input name="<?php echo $key?>" type="text" value="<?php echo $value ?>">
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit"> Submit </button>
        </form>
    <?php endwhile; ?>
<?php endif; ?>
</body>
</html>