/// <reference path="./deploys/DeployService"/>

let usages = document.getElementsByClassName('progress-bar');
let deploys = document.getElementsByClassName('deploys-body')[0];

let chartData = {
    type: 'line',
    data: {
        labels: [],
        datasets: [
            {
                label: 'CPU Usage',
                data: [],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Memory Usage',
                data: [],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    max: 100,
                    maxTicksLimit: 5
                }
            }]
        }
    }
};

let ctx = document.getElementById("myChart").getContext('2d');
let myChart = new Chart(ctx, chartData);

let deployService = new DeployService();

checkUsage();
checkDeploys();
checkBuilds();

function checkUsage() {
    deployService.getUsage((data) => {
        displayUsage(data);
        setTimeout(checkUsage, 5000);
    });
}

function checkDeploys() {
    deployService.getDeploys((data) => {
        displayDeploys(data);
        setTimeout(checkDeploys, 5000);
    });
}

function checkBuilds() {
    deployService.getBuilds((data) => {
        displayBuilds(data);
        setTimeout(checkBuilds, 1000);
    });
}

function displayUsage(data) {
    let parsedData = JSON.parse(data);

    if (chartData.data.labels.length > 10) {
        chartData.data.labels.shift();
        chartData.data.datasets[0].data.shift();
        chartData.data.datasets[1].data.shift();
    }

    chartData.data.labels.push(toShortDate(new Date()));
    chartData.data.datasets[0].data.push(parsedData.cpu);
    chartData.data.datasets[1].data.push(parsedData.memory);
    myChart.update();

    usages[0].setAttribute('data-usage', parsedData.cpu);
    usages[0].setAttribute('style', 'height:' + parsedData.cpu + '%');

    usages[1].setAttribute('data-usage', parsedData.memory);
    usages[1].setAttribute('style', 'height:' + parsedData.memory + '%');

    for (let i = 0; i < usages.length; i++) {
        if (parseFloat(usages[i].getAttribute('data-usage')) > 90)
            usages[i].classList.add('danger');
        else if (parseFloat(usages[i].getAttribute('data-usage')) > 70)
            usages[i].classList.add('warn');
        else {
            usages[i].classList.remove('warn');
            usages[i].classList.remove('danger');
        }
    }
}

function displayDeploys(data) {
    let parsedData = JSON.parse(data);
    let htmlString = '';

    for (let i = 0; i < parsedData.length; i++) {
        htmlString += '<tr>';
        htmlString += '<td>' + parsedData[i].appName + '</td>';
        htmlString += '<td>' + parsedData[i].lastBuildDuration + '</td>';
        htmlString += '<td class="' + parsedData[i].lastBuildStatusClass + '" >' + parsedData[i].lastBuildStatus + '</td>';
        htmlString += '<td>' + parsedData[i].lastDeployDuration + '</td>';
        htmlString += '<td class="' + parsedData[i].lastDeployStatusClass + '">' + parsedData[i].lastDeployStatus + '</td>';
        htmlString += '<td>' + parsedData[i].deployFinishTime + '</td>';
        htmlString += '</tr>';
    }

    deploys.innerHTML = htmlString;
}

function displayBuilds(data) {
    let parsedData = JSON.parse(data);

    if (parsedData[0].endTime) {
        document.querySelector('.process-box').setAttribute('style', 'display:none;');
        return;
    }

    document.querySelector('.process-box').setAttribute('style', 'display:block;');

    let secondsSinceStart = Math.floor((new Date().getTime()) / 1000 - parsedData[0].startTime);
    let minutesSinceStart = Math.floor(secondsSinceStart / 60);
    secondsSinceStart -= minutesSinceStart * 60;

    document.querySelector('.process-box .app-name').innerHTML = parsedData[0].appName;
    document.querySelector('.process-box .build-time').innerHTML = `${minutesSinceStart}m ${secondsSinceStart}s`;
}

function toShortDate(date) {
    let hours = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
    let minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
    let seconds = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();

    return hours + ':' + minutes + ':' + seconds;
}