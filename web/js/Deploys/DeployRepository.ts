/// <reference path="../Http/HttpClient"/>

class DeployRepository {
    private _http: HttpClient;

    constructor() {
        this._http = new HttpClient();
    }

    getUsage(callback: any) {
        this._http.setParams('', 'get');
        this._http.invoke('api/usage').then((data) => {
            callback(data);
        });
    }

    getDeploys(callback: any) {
        this._http.setParams('', 'get');
        this._http.invoke('api/deploys').then((data) => {
            callback(data);
        });
    }

    getBuilds(callback: any) {
        this._http.setParams('', 'get');
        this._http.invoke('api/builds').then((data) => {
            callback(data);
        });
    }
}