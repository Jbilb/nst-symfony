let autocomplete;

function initAutocomplete() {
    autocomplete = new GoogleMap.maps.places.Autocomplete(
        document.querySelector('#Restaurant_address'),
        {
            types: ['geocode'],
            componentRestrictions: {'country': ['FR']},
            fields: ['geometry', 'name']
        }
    );

    autocomplete.addListener('place_changed', onPlaceChanged);
}

function onPlaceChanged() {
    var place = autocomplete.getPlace();

    if(!place.geometry) {
        document.querySelector('#Restaurant_address').placeholder = 'Entrez une adresse';
    } else {
        document.querySelector('#Restaurant_lat').value = place.geometry.location.lat();
        document.querySelector('#Restaurant_lng').value = place.geometry.location.lng();
    }
}