///<reference path="LogService.ts"/>

class LogFactory {
    private logs: Element;
    private logService: LogService;

    constructor() {
        this.logs = document.getElementsByClassName('logs-body')[0];
        this.logService = new LogService();

        this.checkLogs();
    }

    checkLogs() {
        this.logService.getLogs((data) => {
            this.displayLogs(data);
            /*setTimeout(() => {
                this.checkLogs();
            }, 5000);*/
        });
    }

    displayLogs(data) {
        let parsedData = JSON.parse(data);
        let htmlString = '';

        for (let i = 0; i < parsedData.length; i++) {
            htmlString += '<tr>';
            htmlString += '<td>' + parsedData[i].appName + '</td>';
            htmlString += '<td>' + parsedData[i].severity + '</td>';
            htmlString += '<td>' + parsedData[i].message + '</td>';
            htmlString += '<td>' + parsedData[i].exception + '</td>';
            htmlString += '<td>' + parsedData[i].loggedAt + '</td>';
            htmlString += '</tr>';
        }

        this.logs.innerHTML = htmlString;
    }

    static invoke() {
        let instance = null;

        if (instance === null)
            instance = new LogFactory();

        return instance;
    }
}