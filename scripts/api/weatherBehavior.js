// BEHAVIOR file

class weatherBehavior{
    constructor(){
        // connecting yandex maps managers
        this.options = new ymaps.option.Manager();
        this.events = new ymaps.event.Manager();
    }

    enable() {
        this._parent.getMap().events.add('click', this._onClick, this); // enabling click event
    }

    disable() {
        this._parent.getMap().events.remove('click', this._onClick, this); // disabling click event
    }

    setParent(parent) { 
        this._parent = parent;
    }

    getParent() { 
        return this._parent;
    }
    
    _onClick(e) {
        const pos = e.get('coords'); // getting click position

        weatherCollection.removeAll(); // removing all marks from the collection
        weatherCollection.add(new ymaps.Placemark(pos)); // adding new mark into the collection
        app.createAjax(pos); // AJAX request to .php file
    }
};