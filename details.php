<?php
    require_once('helpers.inc.php');
    $conn = dbConnect();
    if(isset($_POST['more']) && $_POST['more'] == 'More'){
        $id = $_POST['idd'];
    }else{
        header("Location: http://localhost/altarix_test/index.php");
        exit;
    }
    $sql = "SELECT id
                ,startdate
                ,enddate
                ,request_time as ping
                ,CASE
                  WHEN result = 1 THEN 'PASS'
                  ELSE 'FAIL'
                 END as status
                ,body
                ,header
            FROM requests WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->execute();
    $arr = $stmt->fetchAll();
    $item = $arr[0];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8">
        <title>Request details</title>
        <link href="assets/css/styles.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h2>Response details</h2>
        <a href="index.php">Back</a>
        <table>
            <tr>
                <th>Request date</th>
                <td><?= $item['startdate'];?></td>
            </tr>
            <tr>
                <th>Response date</th>
                <td><?= $item['enddate'];?></td>
            </tr>
            <tr>
                <th>Timing</th>
                <td><?= $item['ping'];?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= $item['status'];?></td>
            </tr>
            <tr>
                <th>Response body</th>
                <td><?= htmlentities($item['body']);?></td>
            </tr>
            <tr>
                <th>Response header</th>
                <td><?= $item['header'];?></td>
            </tr>
        </table>
    </body>
</html>
