declare let Chart: any;

class ServerUsageService {
    private chartData: any;
    private myChart: any;
    private usages: HTMLCollectionOf<Element>;
    private deployService: DeployService;

    constructor() {
        this.usages = document.getElementsByClassName('progress-bar');
        let canvas = <HTMLCanvasElement>document.getElementById("myChart");
        let ctx = canvas.getContext('2d');

        this.chartData = {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: 'CPU Usage',
                        data: [],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Memory Usage',
                        data: [],
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 100,
                            maxTicksLimit: 5
                        }
                    }]
                }
            }
        };

        this.myChart = new Chart(ctx, this.chartData);
        this.deployService = new DeployService();
        this.checkUsage();
    }

    checkUsage() {
        this.deployService.getUsage((data) => {
            this.displayUsage(data);
            setTimeout(() => {
                this.checkUsage();
            }, 5000);
        });
    }

    displayUsage(data) {
        let parsedData = JSON.parse(data);

        if (this.chartData.data.labels.length > 10) {
            this.chartData.data.labels.shift();
            this.chartData.data.datasets[0].data.shift();
            this.chartData.data.datasets[1].data.shift();
        }

        this.chartData.data.labels.push(this.toShortDate(new Date()));
        this.chartData.data.datasets[0].data.push(parsedData.cpu);
        this.chartData.data.datasets[1].data.push(parsedData.memory);
        this.myChart.update();

        this.usages[0].setAttribute('data-usage', parsedData.cpu);
        this.usages[0].setAttribute('style', 'height:' + parsedData.cpu + '%');

        this.usages[1].setAttribute('data-usage', parsedData.memory);
        this.usages[1].setAttribute('style', 'height:' + parsedData.memory + '%');

        for (let i = 0; i < this.usages.length; i++) {
            if (parseFloat(this.usages[i].getAttribute('data-usage')) > 90)
                this.usages[i].classList.add('danger');
            else if (parseFloat(this.usages[i].getAttribute('data-usage')) > 70)
                this.usages[i].classList.add('warn');
            else {
                this.usages[i].classList.remove('warn');
                this.usages[i].classList.remove('danger');
            }
        }
    }

    toShortDate(date) {
        let hours = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
        let minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
        let seconds = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();

        return hours + ':' + minutes + ':' + seconds;
    }

    static invoke() {
        let instance = null;

        if (instance === null)
            instance = new ServerUsageService();

        return instance;
    }
}