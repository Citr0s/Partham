/// <reference path="../Http/HttpClient"/>

class LogRepository {
    private _http: HttpClient;

    constructor() {
        this._http = new HttpClient();
    }

    getLogs(callback: any) {
        this._http.setParams('', 'get');
        this._http.invoke('api/logs').then((data) => {
            callback(data);
        });
    }
}