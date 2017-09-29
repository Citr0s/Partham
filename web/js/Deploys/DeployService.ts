///<reference path="DeployRepository.ts"/>

class DeployService {
    private _deployRepository: DeployRepository;

    constructor() {
        this._deployRepository = new DeployRepository();
    }

    getUsage() {
        return this._deployRepository.getUsage();
    }

    getDeploys() {
        return this._deployRepository.getDeploys();
    }

    getBuilds() {
        return this._deployRepository.getBuilds();
    }
}