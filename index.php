<?php
    require_once('helpers.inc.php');
    $conn = dbConnect();
    $dates = array();
    foreach($conn->query('SELECT DISTINCT DATE(startdate) as date FROM requests ORDER BY startdate DESC') as $row){
        $dates[] = $row['date'];
    }

    if(isset($_POST['filter']) && isset($_POST['start']) && isset($_POST['end'])){
        if($_POST['end'] < $_POST['start']){
            $enddate = $_POST['start'];
        }else{
            $enddate = $_POST['end'];
        }
        $startdate =  $_POST['start'];
    }else{
        $startdate = date('Y-m-d');
        $enddate = date('Y-m-d');
    }
    $sql = "SELECT id
                ,startdate
                ,enddate
                ,request_time as ping
                ,CASE
                  WHEN result = 1 THEN 'PASS'
                  ELSE 'FAIL'
                 END as status
            FROM requests WHERE startdate >= :start AND enddate <= DATE_ADD(:end, INTERVAL 1 DAY)
            ORDER BY startdate DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':start',$startdate);
    $stmt->bindValue(':end', $enddate);
    $stmt->execute();
    $arr = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8">
        <title>Web service monitoring system</title>
        <link href="assets/css/styles.css" rel="stylesheet" type="text/css">
        <link href="assets/js/DataTables-1.10.5/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h2>Web service monitoring system</h2>
        <form name="filter" method="post">
            <div>
                <label for="start">From</label>
                <select name="start" id="start">
                    <?php foreach($dates as $date): ?>
                        <option value="<?= $date?>" <?php if($date == $startdate){echo " selected";}?>><?= $date?></option>
                    <?php endforeach;?>
                </select>
                <label for="end">to</label>
                <select name="end" id="end">
                    <?php foreach($dates as $date): ?>
                        <option value="<?= $date?>"<?php if($date == $enddate){echo " selected";}?>><?= $date?></option>
                    <?php endforeach;?>
                </select>
                <input type="submit" name="filter" id="filter" value="Filter">
            </div>
        </form>
        <br/>
        <table id="requests" class="hover">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Ping</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arr as $item):?>
                    <tr <?php if($item['status'] == 'FAIL'){echo 'class = "invalid"';}?>>
                        <td><?php
                            $date = new DateTime($item['startdate']);
                            echo $date->format('H:i Y-m-d');
                            ?>
                        </td>
                        <td><?= $item['ping'];?></td>
                        <td <?php if($item['status'] == 'FAIL'){echo 'class = "error"';}else{ echo 'class = "ok"';}?>></td>
                        <td>
                            <?php if($item['status'] == 'FAIL'){?>
                                <form action="details.php" method="post">
                                    <input type="hidden" name="idd" id="idd" value="<?php echo $item['id']?>">
                                    <input type="submit" value="More" name="more" id="more">
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <script type="text/javascript" src="assets/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="assets/js/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="assets/js/script.js"></script>
    </body>
</html>