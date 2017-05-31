class Http {

    get(url: string, callback: any) {
        let httpClient = new XMLHttpRequest();

        httpClient.open('GET', url);
        httpClient.send(null);

        httpClient.onreadystatechange = () => {
            this._handleResponse(httpClient, callback);
        };
    }

    private _handleResponse(httpClient: any, callback: any) {
        if (httpClient.readyState === 4) {
            if (httpClient.status === 200) {
                callback(httpClient.responseText);
            } else {
                callback(httpClient.status);
            }
        }
    }
}