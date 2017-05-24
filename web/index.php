<?php

use Partham\web\controllers\DashboardController;

require __DIR__ . '/../vendor/autoload.php';

$controller = new DashboardController();
$deploys = $controller->deploys();

?>

<h1>Hello World</h1>
<p>This is an awesome landing page!</p>

<table class="deploys">
    <tr>
        <th>App</th>
        <th>Last Build Duration</th>
        <th>Last Deploy Duration</th>
        <th>Last Deploy Status</th>
    </tr>
    <?php

    foreach ($deploys as $deploy) {
        ?>
        <tr>
            <td><?php echo $deploy->appName; ?></td>
            <td><?php echo $deploy->lastBuildDuration; ?>s</td>
            <td><?php echo $deploy->lastDeployDuration; ?>s</td>
            <td><?php echo $deploy->lastDeployStatus; ?></td>
        </tr>
        <?php
    }

    ?>
</table>

<style>
    .deploys {
        width: 100%;
        border: 1px solid #999;
    }

    .deploys th, .deploys td {
        border: 1px solid #ccc;
        padding: 5px;
    }
</style>