<?php

use Partham\web\controllers\DashboardController;

require __DIR__ . '/../vendor/autoload.php';

$controller = new DashboardController();
$deploys = $controller->deploys();
$server = $controller->server();

?>

<div class="row">
    <div class="col-md-6">
        <h1>Hello World</h1>
        <p>This is an awesome landing page!</p>
    </div>
    <div class="col-md-6">
        <div class="progress-bar-wrapper">
            <div class="progress-bar" style="width:<?php echo $server['cpu']; ?>%;"
                 data-usage="<?php echo $server['cpu']; ?>"><?php echo $server['cpu']; ?>%
            </div>
        </div>
        <div class="progress-bar-wrapper">
            <div class="progress-bar" style="width:<?php echo $server['memory']; ?>%;"
                 data-usage="<?php echo $server['memory']; ?>"><?php echo $server['memory']; ?>%
            </div>
        </div>
    </div>
</div>

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
        text-align: center;
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

    .row {

    }

    .row:after {
        clear: both;
    }

    .col-md-6 {
        position: relative;
        float: left;
        width: 50%;
    }

    @media (max-width: 900px) {
        .col-md-6 {
            width: 100%;
        }
    }

    .progress-bar-wrapper {
        border: 1px solid #ccc;
        width: 100%;
        margin-bottom: 5px;
    }

    .progress-bar {
        width: 0;
        background-color: #27ae60;
        padding: 5px;
    }

    .progress-bar.warn {
        background-color: #f1c40f;
    }

    .progress-bar.danger {
        background-color: #e74c3c;
    }
</style>

<script>
    var usages = document.getElementsByClassName('progress-bar');

    for (var i = 0; i < usages.length; i++) {
        if (usages[i].getAttribute('data-usage') > 90)
            usages[i].classList.add('danger');
        else if (usages[i].getAttribute('data-usage') > 70)
            usages[i].classList.add('warn');
        else {
            usages[i].classList.remove('warn');
            usages[i].classList.remove('danger');
        }
    }
</script>