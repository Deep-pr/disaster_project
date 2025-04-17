# disaster_project
Real-Time Disaster Alert System – Project Description
Our Real-Time Disaster Alert System is a web-based platform designed to provide instant disaster warnings, AI-driven severity analysis, crowdsourced incident reporting, and rescue team coordination. Built with modern web technologies (HTML, Bootstrap, JavaScript, PHP, MySQL, and AI integration), the system ensures rapid response and public safety during emergencies. Below is a detailed breakdown of its key features:

1. Real-Time Alert Dashboard (Fetching Disaster Data via Mock API)
The dashboard displays live disaster alerts (floods, earthquakes, storms, etc.) fetched from a mock API (simulating real-world data sources like government agencies).

Data includes disaster type, location, intensity, and time of occurrence.


Visualization: Interactive maps (using Leaflet.js or Google Maps API) and color-coded alerts (red for high risk, yellow for moderate).

. User Location Detection & Pop-up Alert on Website Load
When a user visits the website, the system automatically detects their location using:

GPS (for mobile devices with permission).

IP geolocation (as a fallback for desktops).
2. If a disaster is reported near the user’s location (within a 50 km radius), a pop-up alert appears with critical details:

Type of disaster (e.g., "Flood Alert!").

Recommended actions (e.g., "Evacuate to higher ground").

A link to nearby rescue centers.
3. AI Module for Disaster Severity Classification
The system uses an AI model (Python/ML integrated via PHP API) to classify disaster severity based on live inputs:

Floods: Water level, rainfall data, river overflow thresholds.

Storms: Wind speed, precipitation, historical impact data.

Output:

Low (Green): Minor disruption (e.g., 20 km/h winds).

Medium (Yellow): Significant risk (e.g., flooding in residential areas).

High (Red): Life-threatening (e.g., hurricanes or flash floods).

The AI’s prediction is stored in MySQL and displayed on the dashboard.

4. Crowdsourced Reporting Feature (Media Uploads via Cloudinary)
Users can report local incidents (e.g., collapsed buildings, blocked roads) via a form.

Features:

Image/Video Uploads: Media is stored in Cloudinary (cloud-based storage) to avoid server overload.

Geotagging: Auto-attaches location coordinates to reports.

Moderation: Admin verifies reports before public display to prevent misinformation.

Impact: Authorities and other users see real-time ground-level updates.

5. Nearby Rescue Team Suggestion (Within 50 km)
The system identifies the nearest rescue teams (hospitals, NGOs, fire stations) using:

Database: Pre-registered rescue centers (MySQL).

Distance Calculation: Haversine formula (lat/long-based).

User View:

A list of rescue teams (name, contact, distance).

Interactive Map: Highlights safe routes and shelters.
