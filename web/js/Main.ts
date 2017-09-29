///<reference path="Deploys/DeployService.ts"/>
///<reference path="ServerUsage/ServerUsageService.ts"/>
///<reference path="Builds/BuildService.ts"/>
///<reference path="Builds/BuildFactory.ts"/>
///<reference path="Deploys/DeployFactory.ts"/>
///<reference path="Logs/LogFactory.ts"/>
///<reference path="Menu/MenuService.ts"/>

let Promise: any;

class Main {
    constructor() {
        MenuService.invoke();

        if (window.location.pathname.indexOf('logs') > -1) {
            LogFactory.invoke();
            return;
        }

        if (window.location.pathname.indexOf('builds') > -1) {
            BuildFactory.invoke();
            return;
        }

        ServerUsageService.invoke();
        BuildService.invoke();
        DeployFactory.invoke();

    }
}

new Main();