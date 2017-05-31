/// <reference path="./DeployRepository"/>

class DeployService {
    private _deployRepository: DeployRepository;

    constructor() {
        this._deployRepository = new DeployRepository();
    }

    getUsage(callback: any) {
        return this._deployRepository.getUsage(callback);
    }

    getDeploys(callback: any) {
        return this._deployRepository.getDeploys(callback);
    }
}