/// <reference path="./LogRepository"/>

class LogService {
    private _logRepository: LogRepository;

    constructor() {
        this._logRepository = new LogRepository();
    }

    getLogs(callback: any) {
        return this._logRepository.getLogs(callback);
    }
}