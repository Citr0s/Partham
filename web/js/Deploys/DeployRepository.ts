class DeployRepository {
    private _http: HttpClient;

    constructor() {
        this._http = new HttpClient();
    }

    getUsage() {
        this._http.setParams('', 'get');
        return this._http.invoke('api/usage');
    }

    getDeploys() {
        this._http.setParams('', 'get');
        return this._http.invoke('api/deploys');
    }

    getBuilds() {
        this._http.setParams('', 'get');
        return this._http.invoke('api/builds');
    }
}