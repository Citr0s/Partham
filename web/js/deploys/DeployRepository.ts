/// <reference path="./../http/Http"/>

class DeployRepository {
    private _http: Http;

    constructor() {
        this._http = new Http();
    }

    getUsage(callback: any) {
        return this._http.get('api/usage', (data) => {
            callback(data);
        });
    }

    getDeploys(callback: any) {
        return this._http.get('api/deploys', (data) => {
            callback(data);
        });
    }

    getBuilds(callback: any) {
        return this._http.get('api/builds', (data) => {
            callback(data);
        });
    }
}