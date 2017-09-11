/// <reference path="../Http/Http"/>

class LogRepository {
    private _http: Http;

    constructor() {
        this._http = new Http();
    }

    getLogs(callback: any) {
        return this._http.get('api/logs', (data) => {
            callback(data);
        });
    }
}