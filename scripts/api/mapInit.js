// MAIN API file

function mapWeatherInit(){
    // creating yandex map, center - Moscow

    var weatherMap = new ymaps.Map("map-weather", {
        center: [55.76, 37.64],
        zoom: 7,
        type: 'yandex#map'
    });

    // creating mark collection

    weatherCollection = new ymaps.GeoObjectCollection({},{
        preset: 'islands#redIcon'
    });

    weatherMap.geoObjects.add(weatherCollection); // adding collection into geoObjects

    // there is one more api file - weatherBehavior.js(class); i use it for tracking map events

    ymaps.behavior.storage.add('behavior', weatherBehavior); // adding behavior into storage
    weatherMap.behaviors.enable('behavior');
}