///<reference path="../Deploys/DeployService.ts"/>

class DeployFactory {
    private deploys: Element;
    private deployService: DeployService;

    constructor() {
        this.deploys = document.getElementsByClassName('deploys-body')[0];
        this.deployService = new DeployService();

        this.checkDeploys();
    }

    checkDeploys() {
        this.deployService.getDeploys((data) => {
            this.displayDeploys(data);
            setTimeout(() => {
                this.checkDeploys();
            }, 5000);
        });
    }

    displayDeploys(data) {
        let parsedData = JSON.parse(data);
        let htmlString = '';

        for (let i = 0; i < parsedData.length; i++) {
            htmlString += '<tr>';
            htmlString += '<td>' + parsedData[i].appName + '</td>';
            htmlString += '<td class="' + parsedData[i].state + '">' + parsedData[i].state + '</td>';
            htmlString += '<td>' + parsedData[i].startTime + '</td>';
            htmlString += '<td>' + parsedData[i].endTime + '</td>';
            htmlString += '</tr>';
        }

        this.deploys.innerHTML = htmlString;
    }

    static invoke() {
        let instance = null;

        if (instance === null)
            instance = new DeployFactory();

        return instance;
    }
}