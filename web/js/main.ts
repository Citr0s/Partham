/// <reference path="./deploys/DeployService"/>

let usages = document.getElementsByClassName('progress-bar');
let deploys = document.getElementsByClassName('deploys-body')[0];

let deployService = new DeployService();

checkUsage();
checkDeploys();

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

function displayUsage(data) {
    let parsedData = JSON.parse(data);

    usages[0].setAttribute('data-usage', parsedData.cpu);
    usages[0].setAttribute('style', 'width:' + parsedData.cpu + '%');
    usages[0].innerHTML = parsedData.cpu + '%';

    usages[1].setAttribute('data-usage', parsedData.memory);
    usages[1].setAttribute('style', 'width:' + parsedData.memory + '%');
    usages[1].innerHTML = parsedData.memory + '%';

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