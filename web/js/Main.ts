///<reference path="Deploys/DeployService.ts"/>
///<reference path="ServerUsage/ServerUsageService.ts"/>
///<reference path="Builds/BuildService.ts"/>
///<reference path="Deploys/DeployFactory.ts"/>

class Main {
    constructor() {
        ServerUsageService.invoke();
        BuildService.invoke();
        DeployFactory.invoke();
    }
}

new Main();