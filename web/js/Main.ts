///<reference path="Deploys/DeployService.ts"/>
///<reference path="ServerUsage/ServerUsageService.ts"/>
///<reference path="Builds/BuildService.ts"/>
///<reference path="Deploys/DeployFactory.ts"/>
///<reference path="Logs/LogFactory.ts"/>

class Main {
    constructor() {
        if (window.location.pathname.indexOf('logs') > -1) {
            LogFactory.invoke();
        }
        else {
            ServerUsageService.invoke();
            BuildService.invoke();
            DeployFactory.invoke();
        }

    }
}

new Main();