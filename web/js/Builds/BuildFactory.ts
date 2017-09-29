///<reference path="BuildService.ts"/>

class BuildFactory {
    private builds: Element;
    private buildService: BuildService;

    constructor() {
        this.builds = document.getElementsByClassName('builds-body')[0];
        this.buildService = new BuildService();

        this.checkBuilds();
    }

    checkBuilds() {
        this.buildService.getBuilds().then((data) => {
            this.displayBuilds(data);
            /*setTimeout(() => {
                this.checkBuilds();
            }, 5000);*/
        });
    }

    displayBuilds(data) {
        let parsedData = JSON.parse(data);
        let htmlString = '';

        for (let i = 0; i < parsedData.length; i++) {
            htmlString += '<tr>';
            htmlString += '<td>' + parsedData[i].appName + '</td>';
            htmlString += '<td><a target="_blank" href="' + parsedData[i].buildUrl + '"><div class="state-box ' + parsedData[i].state + '">' + parsedData[i].state + '</div></a></td>';
            htmlString += '<td>' + this.timestampToString(parsedData[i].startTime) + '</td>';
            htmlString += '<td>' + this.timestampToString(parsedData[i].endTime) + '</td>';
            htmlString += '</tr>';
        }

        this.builds.innerHTML = htmlString;
    }

    private timestampToString(timestamp) {
        let date = new Date(timestamp * 1000);
        let hours = date.getHours();
        let minutes = "0" + date.getMinutes();
        let seconds = "0" + date.getSeconds();
        let days = "0" + date.getDate();
        let months = "0" + date.getMonth();
        let years = date.getFullYear();

        return `${years}-${months}-${days} ${hours}:${minutes.substr(-2)}:${seconds.substr(-2)}`;
    }

    static invoke() {
        let instance = null;

        if (instance === null)
            instance = new BuildFactory();

        return instance;
    }
}