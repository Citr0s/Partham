///<reference path="../deploys/DeployService.ts"/>

class BuildService {
    private deploys: Element;
    private deployService: DeployService;

    constructor() {
        this.deploys = document.getElementsByClassName('deploys-body')[0];
        this.deployService = new DeployService();

        this.checkBuilds();
    }

    checkBuilds() {
        this.deployService.getBuilds((data) => {
            this.displayBuilds(data);
            setTimeout(() => {
                this.checkBuilds();
            }, 1000);
        });
    }

    displayBuilds(data) {
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

    static invoke() {
        let instance = null;

        if (instance === null)
            instance = new BuildService();

        return instance;
    }
}