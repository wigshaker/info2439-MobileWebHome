<?php include '..\view\header.php'; ?>

    <div role="main" class="ui-content">

        <ul data-role="listview" data-inset="true">
            <li data-role="list-divider">Motion Times</li>
            <?php 
                try {
                    $motion_array = file('http://192.168.1.16/html/motionLog.txt');
                } catch (Exception $ex) {
                    $motion_array[0] = 'Error connecting to motionLog.txt';
                }
                
                $motion_array_r = array_reverse($motion_array);
            ?>
            <?php for ($i=0; $i<count($motion_array_r); $i++): ?>
                <li><?php echo $motion_array_r[$i]; ?></li>
            <?php endfor; ?>
        </ul>



    </div>

<?php include '..\view\footer.php'; ?>