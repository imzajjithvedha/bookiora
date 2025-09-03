let map;
let marker;
let infoWindow;
let center = { lat: 8, lng: 81.5 };

async function initMap() {
    const [{ Map }, { AdvancedMarkerElement }] = await Promise.all([
        google.maps.importLibrary("marker"),
        google.maps.importLibrary("places")
    ]);

    map = new google.maps.Map(document.getElementById('map'), {
        center,
        zoom: 7,
        mapId: '4504f8b37365c3d0',
        mapTypeControl: false,
    });

    const placeAutocomplete = new google.maps.places.PlaceAutocompleteElement();
    placeAutocomplete.id = 'place-autocomplete-input';
    placeAutocomplete.locationBias = center;
    const card = document.getElementById('place-autocomplete-card');

    card.appendChild(placeAutocomplete);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

    marker = new google.maps.marker.AdvancedMarkerElement({
        map,
    });
    infoWindow = new google.maps.InfoWindow({});

    // #region: Get the marker on the edit page //
        const existingLat = parseFloat($('#latitude').val());
        const existingLng = parseFloat($('#longitude').val());

        if(existingLat && existingLng) {
            const location = { lat: existingLat, lng: existingLng };
            map.setCenter(location);
            map.setZoom(17);
            marker.position = location;

            const name = $('#name').val();
            const address = $('#address').val();

            const content = `
                <div id="info-window-content" class="info-window-content">
                    <span id="place-displayname" class="title">${name}</span>
                    <span id="place-address" class="address">${address}</span>
                </div>
            `;

            updateInfoWindow(content, location);
        }
    // #endregion //

    placeAutocomplete.addEventListener('gmp-select', async ({ placePrediction }) => {
        const place = placePrediction.toPlace();
        await place.fetchFields({ fields: ['displayName', 'formattedAddress', 'location', 'addressComponents'] });

        if(place.viewport) {
            map.fitBounds(place.viewport);
        }
        else {
            map.setCenter(place.location);
            map.setZoom(17);
        }

        let content = `
            <div id="info-window-content" class="info-window-content">
                <span id="place-displayname" class="title">${place.displayName}</span>
                <span id="place-address" class="address">
                    ${place.formattedAddress}
                </span>
            </div>
        `;

        updateInfoWindow(content, place.location);
        marker.position = place.location;

        populateFields(place);
    });
}

function updateInfoWindow(content, center) {
    infoWindow.setContent(content);
    infoWindow.setPosition(center);
    infoWindow.open({
        map,
        anchor: marker,
        shouldFocus: false,
    });
}

function populateFields(place) {
    const addressComponents = place.addressComponents || [];

    const getAddressComponent = (type, short = false) => {
        const component = addressComponents.find(c => c.types.includes(type));
        if(!component) return '';
        return short ? (component.shortText || component.short_name || '') : (component.longText || component.long_name || '');
    };

    const addressLine = [getAddressComponent('street_number'), getAddressComponent('route')].filter(Boolean).join(' ').trim() || place.formattedAddress || '';
    const city = getAddressComponent('locality') || getAddressComponent('postal_town') || getAddressComponent('sublocality') || '';
    const state = getAddressComponent('administrative_area_level_1', true) || getAddressComponent('administrative_area_level_1');
    const postalCode = getAddressComponent('postal_code') || '';
    const country = getAddressComponent('country') || '';
    const latitude = typeof place.location.lat === 'function' ? place.location.lat() : place.location.lat;
    const longitude = typeof place.location.lng === 'function' ? place.location.lng() : place.location.lng;

    $('#address').val(addressLine);
    $('#city').val(city);
    $('#post_code').val(postalCode);
    $('#country').val(country).trigger('change');
    $('#latitude').val(latitude);
    $('#longitude').val(longitude);
}

initMap();