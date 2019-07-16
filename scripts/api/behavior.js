class behavior{
    constructor(){
        this.options = new ymaps.option.Manager();
        this.events = new ymaps.event.Manager();
    }

    enable() {
        this._parent.getMap().events.add('click', this._onClick, this);
    }

    disable() {
        this._parent.getMap().events.remove('click', this._onClick, this);
    }

    setParent(parent) { 
        this._parent = parent;
    }

    getParent() { 
        return this._parent;
    }
    
    _onClick(e) {
        const pos = e.get('coords');

        mainCollection.removeAll();
        mainCollection.add(new ymaps.Placemark(pos));
        app.createAjax(pos);
    }
};