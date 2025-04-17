// Real-Time Alert Dashboard (Mock Data)
const alertsList = document.getElementById("alerts-list");
const mockAlerts = [
  { type: "Flood", description: "Evacuate low-lying areas immediately." },
  { type: "Cyclone", description: "Secure loose objects and stay indoors." },
  { type: "Earthquake", description: "Find cover and stay away from windows." }
];

// Display alerts
mockAlerts.forEach(alert => {
  const listItem = document.createElement("li");
  listItem.textContent = `${alert.type}: ${alert.description}`;
  alertsList.appendChild(listItem);
});

// User Location Detection
const detectLocationButton = document.getElementById("detect-location");
const locationOutput = document.getElementById("location-output");

detectLocationButton.addEventListener("click", () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      position => {
        const { latitude, longitude } = position.coords;
        locationOutput.textContent = `Latitude: ${latitude}, Longitude: ${longitude}`;
      },
      () => {
        locationOutput.textContent = "Unable to retrieve location.";
      }
    );
  } else {
    locationOutput.textContent = "Geolocation is not supported by your browser.";
  }
});

// AI-Powered Alert Simulation
const generateAlertButton = document.getElementById("generate-alert");
const aiOutput = document.getElementById("ai-output");

generateAlertButton.addEventListener("click", () => {
  const disasterTypes = ["Flood", "Cyclone", "Earthquake"];
  const severities = ["Low", "Moderate", "High"];
  const randomDisaster = disasterTypes[Math.floor(Math.random() * disasterTypes.length)];
  const randomSeverity = severities[Math.floor(Math.random() * severities.length)];
  aiOutput.textContent = `Disaster: ${randomDisaster}, Severity: ${randomSeverity}`;
});
