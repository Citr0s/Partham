class MenuService {
    private menu: Element;

    constructor() {
        this.menu = document.querySelector('.menu');

        this.displayUsage();
    }

    displayUsage() {
        let menu = "";

        menu += '<li><a href="/">Home</a></li>';
        menu += '<li><a href="/builds">Builds</a></li>';
        menu += '<li><a href="/logs">Logs</a></li>';

        this.menu.innerHTML = menu;
    }

    static invoke() {
        let instance = null;

        if (instance === null)
            instance = new MenuService();

        return instance;
    }
}