// Initialize the map and markers
export function initMap(mapElement) {
  const zoom = 15; // Default zoom level if not set
  console.log("Zoom level:", zoom); // Debugging: Check the zoom level

  const markers = mapElement.querySelectorAll(".marker");

  const map = new google.maps.Map(mapElement, {
    zoom: zoom,
    center: new google.maps.LatLng(0, 0),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDefaultUI: true,
    mapId: "74d2d2826d4b757b26fc4d52",
  });

  const bounds = new google.maps.LatLngBounds();

  markers.forEach(function (markerElement) {
    const lat = parseFloat(markerElement.dataset.lat);
    const lng = parseFloat(markerElement.dataset.lng);
    const position = new google.maps.LatLng(lat, lng);

    // Fallback to google.maps.Marker if AdvancedMarkerElement is not available
    new google.maps.Marker({
      position: position,
      map: map,
      icon: {
        url:
          "data:image/svg+xml;charset=UTF-8," +
          encodeURIComponent(`
				  <svg xmlns="http://www.w3.org/2000/svg" width="68.891" height="88.181" viewBox="0 0 68.891 88.181">
					<defs>
					  <clipPath id="clip-path">
						<rect width="68.891" height="88.181" fill="#ED1849"/>
					  </clipPath>
					</defs>
					<g transform="translate(0 0)">
					  <g>
						<path d="M34.447,0A34.46,34.46,0,0,0,0,34.447C0,56.628,30.284,85.784,31.581,87.024a4.1,4.1,0,0,0,5.706,0c1.292-1.242,31.6-30.4,31.6-52.577A34.475,34.475,0,0,0,34.445,0Zm0,53.734A19.292,19.292,0,1,1,53.738,34.442,19.313,19.313,0,0,1,34.447,53.734Z" fill="#ED1849"/>
					  </g>
					</g>
				  </svg>
				`),
        scaledSize: new google.maps.Size(34, 44), // Ajusta si quieres más pequeño o grande
        anchor: new google.maps.Point(17, 44),
      },
    });

    bounds.extend(position);
  });

  // Adjust the map to fit the bounds
  map.fitBounds(bounds);

  google.maps.event.addListenerOnce(map, "bounds_changed", function () {
    this.setZoom(12.5);
  });
}

// Asynchronous function to load Google Maps API
export async function loadGoogleMaps() {
  return new Promise((resolve, reject) => {
    const script = document.createElement("script");
    script.src =
      "https://maps.googleapis.com/maps/api/js?key=AIzaSyAqlb-_dclBMuv2kyTIqdf9o_1ESReN608&callback=initMaps&libraries=places";
    script.async = true;
    script.defer = true;
    script.onerror = reject;
    document.head.appendChild(script);
    window.initMaps = () => {
      resolve(); // Resolve the promise when the Google Maps API is loaded
    };
  });
}

// Render maps on page load
export async function renderMaps() {
  try {
    await loadGoogleMaps();

    document.querySelectorAll(".acf-map").forEach(function (mapElement) {
      initMap(mapElement);
    });
  } catch (error) {
    console.error("Failed to load Google Maps API:", error);
  }
}
