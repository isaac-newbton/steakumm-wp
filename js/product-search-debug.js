function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    let regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

const products = [
    {
        upc: "Steakumm",
        img: "/wp-content/uploads/2020/05/sliced-steak-300x206.png",
        title: "100% Beef Sandwich Steaks"
    },
    {
        upc: "7254507001",
        img: "/wp-content/uploads/2020/05/chicken-steak-300x204.png",
        title: "Chicken Breast Sandwich Steaks"
    },
    {
        upc:  "7254506270",
        img: "/wp-content/uploads/2020/05/angus-steak-300x204.png",
        title: "100% Angus Beef Sandwich Steaks"
    }
]

function loadMap(product, zip, distance) {
    document.getElementById('map').classList.remove('hidden');
    const req = `customer=quaker&item=${product}&zip=${zip}&radius=${distance}&count=10`;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", '/wp-content/themes/steak-umm/storefinder/', true);
    xhr.responseType = 'json';
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send(req);

    xhr.onload = () => {
        let data = xhr.response;
        if (data.numStoresFound > 0) {
            const map = new google.maps.Map(document.getElementById('map'));
            const bounds = new google.maps.LatLngBounds();
            const stores = data.nearbyStores;
            let storeList = "";
            const windows = [];
            const currMarkers = [];

            stores.forEach((store) => {
                let marker = new google.maps.Marker({
                    position: {lat: store.latitude, lng: store.longitude},
                    map: map
                });
                currMarkers.push(marker);
                const infowindow = new google.maps.InfoWindow({
                    content: '<p><strong>' + store.name + '</strong><br>' + store.address + '<br>' +
                        store.city + ', ' + store.state + ' ' + store.zip + '<br>' +
                        store.phone + '<br>' + store.distance + " Miles" + '<br>' +
                        "<a target='_blank' href='https://maps.google.com?saddr=Current+Location&daddr=" + store.latitude + "," + store.longitude + "'>Get Directions</a></td></tr>"
                });
                windows.push(infowindow);

                // open map marker on click
                marker.addListener('click', function () {
                    for (let wind = 0; windows[wind]; wind++) {
                        windows[wind].close();
                    }
                    infowindow.open(map, marker);
                });

                // add store row
                let storeListRow = "<tr><td><strong>" + store.name + "</strong><br>";
                storeListRow += store.address + "<br>";
                storeListRow += store.city + ", " + store.state + " " + store.zip + "<br>";
                storeListRow += store.phone + "<br></td>";
                storeListRow += "<td>" + store.distance + " MILES<br>";
                storeListRow += "<a target='_blank' href='https://maps.google.com?saddr=Current+Location&daddr=" + store.latitude + "," + store.longitude + "'>Get Directions</a></td></tr>";
                storeList += storeListRow;

                //extend the bounds to include each marker's position
                bounds.extend(marker.position);
            });

            // set zoom and boundaries to fit all markers
            map.fitBounds(bounds);
            map.setZoom(13);

            // populate store table
            let prodHeader = "";
            for (let p = 0; p < products.length; p++) {
                if (data.item === products[p].upc) {
                    prodHeader = `<img src="${products[p].img}" alt="${products[p].title}">`
                    p = products.length;
                }
            }
            const storeHeader = `<tr><th id='product-thumb'>${prodHeader}</th><th>LOCATIONS NEAR YOU</th></tr><tr class="subheader"><td>STORES</td><td>DISTANCE</td></tr>`;
            document.querySelector(".store-list > table > tbody").innerHTML = storeHeader + storeList;
        } else {
            document.querySelector(".store-list > table > tbody").innerHTML = "<tr><td><strong>Sorry, no results were found!</strong></td></tr>"
        }
    };
}

document.addEventListener('DOMContentLoaded', () => {
    // load map data on form submit
    document.querySelector('form.locator-form').addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        loadMap(formData.get('upc'), formData.get('zip'), formData.get('distance'));
    });

    const product = getParameterByName('upc');
    const zip = getParameterByName('zip');
    const distance = getParameterByName('distance');

    // load map based on search parameters first, otherwise attempt geolocation
    if (zip) {
        document.querySelectorAll('.locator-form .upc').forEach((el) => {
           el.value = product;
        });
        document.querySelectorAll('.locator-form .zipcode').forEach((el) => {
            el.value = zip;
        });
        document.querySelectorAll('.locator-form .distance').forEach((el) => {
            el.value = distance;
        });
        loadMap(product, zip, distance);
    } else if (navigator.geolocation) {
        const geocoder = new google.maps.Geocoder();
        const options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        }

        function success(pos) {
            const latlng = {
                lat: pos.coords.latitude,
                lng: pos.coords.longitude
            }
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        document.querySelector('#zipcode-field').value = results[0].address_components[6].long_name;
                        document.querySelector('#product-search > button[type="submit"]').click();
                    } else {
                        console.warn('No geocode results found');
                    }
                } else {
                    console.warn('Geocoder failed due to: ' + status);
                }
            });
        }

        function error(err) {
            console.warn(err.message);
        }

        navigator.geolocation.getCurrentPosition(success, error, options);
    }
});