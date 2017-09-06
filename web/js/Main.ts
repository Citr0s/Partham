///<reference path="deploys/DeployService.ts"/>
///<reference path="ServerUsage/ServerUsageService.ts"/>
///<reference path="Builds/BuildService.ts"/>

class Main {
    constructor() {
        ServerUsageService.invoke();
        BuildService.invoke();
    }
}

new Main();

let deploys = document.getElementsByClassName('deploys-body')[0];
let deployService = new DeployService();

checkDeploys();

function checkDeploys() {
    deployService.getDeploys((data) => {
        displayDeploys(data);
        setTimeout(checkDeploys, 5000);
    });
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