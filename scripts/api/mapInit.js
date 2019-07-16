function mapInit(){
    var mainMap = new ymaps.Map("map", {
        center: [55.76, 37.64],
        zoom: 7,
        type: 'yandex#map'
    });

    mainCollection = new ymaps.GeoObjectCollection({},{
        preset: 'islands#redIcon'
    });

    mainMap.geoObjects.add(mainCollection);

    ymaps.behavior.storage.add('behavior', behavior);
    mainMap.behaviors.enable('behavior');
}