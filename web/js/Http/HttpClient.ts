class HttpClient {
    private _httpClient: XMLHttpRequest;
    private _url: string;
    private _requestType: string;

    constructor() {
        this._httpClient = new XMLHttpRequest();
    }

    setParams(url: string, requestType: string) {
        this._url = `${window.location.origin}/${url}`;
        this._requestType = requestType;
    }

    invoke(resource: string) {
        return new Promise((resolve, reject) => {
            this._httpClient.open(this._requestType, `${this._url}/${resource}`);
            this._httpClient.send(null);

            this._httpClient.onreadystatechange = () => {
                if (this._httpClient.readyState === 4) {
                    if (this._httpClient.status === 200)
                        resolve(this._httpClient.response);
                    else
                        reject(`Could not fetch data, server has returned '${this._httpClient.status}'`);
                }
            };
        });
    }
}