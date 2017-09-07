///<reference path="../Deploys/DeployService.ts"/>

class BuildService {
    private deployService: DeployService;

    constructor() {
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

        if (parsedData[0].state === 'passed') {
            document.querySelector('.process-box').setAttribute('style', 'border: 1px solid #2ecc71;');
            document.querySelector('.process-box').setAttribute('style', 'display:none;');
            return;
        }

        if (parsedData[0].state === 'failed') {
            document.querySelector('.process-box').setAttribute('style', 'border: 1px solid #e74c3c;');
            return;
        }

        document.querySelector('.process-box').setAttribute('style', 'border: 1px solid #026266;');
        document.querySelector('.process-box').setAttribute('style', 'display:block;');

        if (parsedData[0].state === null || parsedData[0].state === 'started') {
            document.querySelector('.process-box .build-time').setAttribute('style', 'display:none;');
            document.querySelector('.process-box .message').innerHTML = `<span style="font-weight:bold;">${parsedData[0].appName}</span> is queued for build.`;
            return;
        }

        document.querySelector('.process-box .build-time').setAttribute('style', 'display:block;');

        let secondsSinceStart = Math.floor((new Date().getTime()) / 1000 - parsedData[0].startTime);
        let minutesSinceStart = Math.floor(secondsSinceStart / 60);

        secondsSinceStart -= minutesSinceStart * 60;

        document.querySelector('.process-box .message').innerHTML = `<span style="font-weight:bold;">${parsedData[0].userName}</span> is currently brewing <span style="font-weight:bold;">${parsedData[0].appName}</span>.`;
        document.querySelector('.process-box .build-time').innerHTML = `${minutesSinceStart}m ${secondsSinceStart}s`;
    }

    static invoke() {
        let instance = null;

        if (instance === null)
            instance = new BuildService();

        return instance;
    }
}