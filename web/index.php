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
        <th>Last Build Duration (seconds)</th>
        <th>Last Build Status</th>
        <th>Last Deploy Duration (seconds)</th>
        <th>Last Deploy Status</th>
        <th>Finished</th>
    </tr>
    <?php

    foreach ($deploys as $deploy) {
        ?>
        <tr>
            <td><?php echo $deploy->appName; ?></td>
            <td><?php echo $deploy->lastBuildDuration; ?></td>
            <td class="<?php echo $deploy->lastBuildStatusClass; ?>"><?php echo $deploy->lastBuildStatus; ?></td>
            <td><?php echo $deploy->lastDeployDuration; ?></td>
            <td class="<?php echo $deploy->lastDeployStatusClass; ?>"><?php echo $deploy->lastDeployStatus; ?></td>
            <td><?php echo $deploy->deployFinishTime; ?></td>
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

    .deploys td.success, .deploys td.passed {
        background-color: #5cb85c;
    }

    .deploys td.started {
        background-color: #f7ecb5;
    }

    .deploys td.failed {
        background-color: #c9302c;
    }
</style>