<?php
require_once('config/config.php');

$user_id = "root" ?? null;
$user_id = "root" ?? null;


$buttons = [
    'Login ',
    'Logout ',
    'Create Record ',
    'Update Record ',
    'Delete Record ',
    'View Record ',
    'Upload File ',
    'Download ',
    'Search ',
    'Generate Report '
];
?>

    <table border="1" cellpadding="11">

        <tr>
            <th>Action</th>
            <th>Test</th>
        </tr>
                <?php foreach($buttons as $button):?>
                <tr>
                        <td><?= htmlspecialchars($button)?></td>
                    <td>
                        <form method="post">
                            <input type = "hidden" name = "action"
                                value = "<?= htmlspecialchars($button)?>"
                            >  
                            <button type = "submit">Test</button>
                        </form>
                     </td>
                </tr>
                    
        <?php endforeach;?>
    </table>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $action = $_POST['action'] ?? "test_activity";
            
            $status = random_int(0,1) === 1? 'sucess ' : 'failed ';
    $sucess = logActivity(
            $pdo,
            $user_id,
            $user_email,
            $action,
            $status
            );



    if ($sucess) {
        echo"<p> Activity: ". htmlspecialchars($action) .
        "Status: " .htmlspecialchars($status) .
        "Log Inserted Sucessfully </p>";
    }else{
        echo "<p>Failed to insert activity log</p>";    
    }
}
?>