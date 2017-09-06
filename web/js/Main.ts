///<reference path="deploys/DeployService.ts"/>
///<reference path="ServerUsage/ServerUsageService.ts"/>

class Main {
    constructor() {
        ServerUsageService.invoke();
    }
}

new Main();

let deploys = document.getElementsByClassName('deploys-body')[0];
let deployService = new DeployService();

checkDeploys();
checkBuilds();

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
    document.querySelector('.process-box .user-name').innerHTML = parsedData[0].userName;
    document.querySelector('.process-box .build-time').innerHTML = `${minutesSinceStart}m ${secondsSinceStart}s`;
}

function toShortDate(date) {
    let hours = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
    let minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
    let seconds = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();

    return hours + ':' + minutes + ':' + seconds;
}