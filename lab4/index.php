<?php
require_once  'db_connect.php';

$instance = Database::getInstance();

$db = $instance->getSQLite();
$query = "SELECT * from 'expenses'";
$result = $db->query($query);

if (!$result) {
    die("Database query failed: " . $db->lastErrorMsg());
}
?>
<html lang="en">
    <head>
        <title> All Expenses</title>
    </head>
    <body>
        <div>
            <a href="/create_expense_view.php"> Add Expense </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th> ID </th>
                    <th> Name </th>
                    <th> Amount </th>
                    <th> Date </th>
                    <th> Payment Method </th>
                </tr>
            </thead>
            <tbody>
                <?php if($result) : ?>
                    <?php while($row = $result->fetchArray(SQLITE3_ASSOC)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id'])?></td>
                            <td><?php echo htmlspecialchars($row['name']) ?></td>
                            <td><?php echo htmlspecialchars($row['amount']) ?></td>
                            <td><?php echo htmlspecialchars($row['date']) ?></td>
                            <td><?php echo htmlspecialchars($row['paymentMethod']) ?></td>
                            <td>
                                <form action="delete_expense.php" method="post" style="display:inline">
                                    <input type="hidden" name="id" value="<?php echo $row['id']?>" />
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                            <td>
                                <form action="update_expense_view.php" method="get" style="display:inline">
                                    <input type="hidden" name="id" value="<?php echo $row['id']?>" />
                                    <button type="submit">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </body>
</html>
