<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disaster Alert Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General Styling */
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #013a6b;
            --accent-color: #ffcc00;
            --danger-color: #e74c3c;
            --success-color: #2ecc71;
            --light-color: #f4f4f9;
            --dark-color: #333;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: var(--light-color);
            color: var(--dark-color);
            overflow-x: hidden;
        }
        
        /* Header Styling */
        header {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: #fff;
            padding: 15px 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
            animation: headerSlideDown 0.8s ease-out;
        }
        
        @keyframes headerSlideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            padding: 0;
            flex-wrap: wrap;
        }
        
        nav ul li {
            margin: 0 15px;
            position: relative;
        }
        
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            padding: 5px 10px;
            border-radius: 4px;
            display: flex;
            align-items: center;
        }
        
        nav ul li a i {
            margin-right: 8px;
        }
        
        nav ul li a:hover {
            color: var(--accent-color);
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        nav ul li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--accent-color);
            transition: width 0.3s ease;
        }
        
        nav ul li a:hover::after {
            width: 100%;
        }
        
        /* Hero Section */
        #home {
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1518593929011-2d260d1e0429?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 0 20px;
            position: relative;
            overflow: hidden;
        }
        
        #home {
    position: relative;
    overflow: hidden;
}

#home::before, #home::after, #home .bg-extra {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    z-index: -1;
}

/* Main background with sliding animation */
#home::before {
    background-image: url('one1.png');
    animation: slideIn 8s infinite;
}

/* Secondary background with crossfade */
#home::after {
    background-image: url('two2.png');
    opacity: 0;
    animation: crossfade 8s infinite;
}

/* Optional third background */
#home .bg-extra {
    background-image: url('three.png');
    opacity: 0;
    animation: crossfade 8s infinite 7.5s;
     /* Add this if using the third image */
}

@keyframes slideIn {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes crossfade {
    0%, 45% {
        opacity: 0;
        transform: scale(1.1);
    }
    50%, 95% {
        opacity: 1;
        transform: scale(1);
    }
    100% {
        opacity: 0;
        transform: scale(1.1);
    }
}

/* For HTML - add this div inside your #home element if using the third image:
<div class="bg-extra"></div>
*/
        
        #home h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1s ease-out;
        }
        
        #home p {
            font-size: 1.5rem;
            margin-bottom: 30px;
            max-width: 800px;
            animation: fadeInUp 1s ease-out 0.2s forwards;
            opacity: 0;
        }
        
        .cta-button {
            display: inline-block;
            background: var(--accent-color);
            color: var(--secondary-color);
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease-out 0.4s forwards;
            opacity: 0;
        }
        
        .cta-button:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            background: #ffd633;
        }
        
        .emergency-button {
            position: fixed;
            bottom: 50px;
            right: 40px;
            background: var(--danger-color);
            color: white;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4);
            cursor: pointer;
            z-index: 999;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }
        
        .emergency-button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.6);
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(231, 76, 60, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(231, 76, 60, 0);
            }
        }
        
        /* Section Styling */
        section {
            padding: 80px 20px;
            text-align: center;
        }
        
        section h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: var(--secondary-color);
            position: relative;
            display: inline-block;
        }
        
        section h2::after {
            content: '';
            position: absolute;
            width: 50%;
            height: 4px;
            bottom: -10px;
            left: 25%;
            background: var(--primary-color);
            border-radius: 2px;
        }
        
        section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Alerts Section */
        #alerts {
            background-color: #fff;
        }
        
        #alerts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .alert {
            background: #fff;
            border: none;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            text-align: left;
        }
        
        .alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .alert:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        
        .alert:hover::before {
            width: 8px;
            background: var(--accent-color);
        }
        
        .alert h3 {
            font-size: 1.5rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .alert h3 i {
            margin-right: 10px;
            color: var(--primary-color);
        }
        
        .alert p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
            text-align: left;
        }
        
        .alert .alert-meta {
            display: flex;
            justify-content: space-between;
            color: #777;
            font-size: 0.9rem;
        }
        
        .alert.emergency {
            background: linear-gradient(135deg, #fff, #ffeceb);
        }
        
        .alert.emergency h3 {
            color: var(--danger-color);
        }
        
        .alert.emergency h3 i {
            color: var(--danger-color);
        }
        
        .alert.emergency::before {
            background: var(--danger-color);
        }
        
        /* Resources Section */
        #resources {
            background: linear-gradient(45deg, #f4f4f9, #e6f0fa);
        }
        
        .resources-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .resource-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .resource-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .resource-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .resource-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }
        
        .resource-card p {
            font-size: 1rem;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .resource-link {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-top: auto;
        }
        
        .resource-link:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        
        /* Weather Detection Section */
        #weather-detection {
            background: white;
        }
        
        .weather-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
        }
        
        .weather-card {
            background: linear-gradient(135deg, #4a90e2, #013a6b);
            color: white;
            border-radius: 15px;
            padding: 30px;
            width: 300px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .weather-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
            transition: all 0.5s ease;
        }
        
        .weather-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }
        
        .weather-card:hover::before {
            transform: rotate(60deg);
        }
        
        .weather-card h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .weather-card .temp {
            font-size: 3rem;
            font-weight: bold;
            margin: 20px 0;
        }
        
        .weather-card .details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        
        .weather-card .detail {
            text-align: center;
        }
        
        .weather-card .detail i {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }
        
        /* Contact Section */
        #contact {
            background: linear-gradient(45deg, #013a6b, #4a90e2);
            color: white;
        }
        
        #contact h2 {
            color: white;
        }
        
        #contact h2::after {
            background: var(--accent-color);
        }
        
        .contact-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
            margin-top: 40px;
        }
        
        .contact-info {
            flex: 1;
            min-width: 300px;
            text-align: left;
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            backdrop-filter: blur(5px);
        }
        
        .contact-info h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--accent-color);
        }
        
        .contact-info p {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .contact-info i {
            margin-right: 15px;
            font-size: 1.2rem;
            color: var(--accent-color);
        }
        
        .contact-form {
            flex: 1;
            min-width: 300px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: var(--secondary-color);
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.3);
            outline: none;
        }
        
        .submit-btn {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }
        
        .submit-btn:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        /* Footer Styling */
        footer {
            text-align: center;
            background: var(--secondary-color);
            color: #fff;
            padding: 30px 0;
        }
        
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .footer-section {
            flex: 1;
            min-width: 250px;
            margin-bottom: 20px;
        }
        
        .footer-section h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--accent-color);
        }
        
        .footer-section p, .footer-section a {
            color: #ddd;
            margin-bottom: 10px;
            display: block;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-section a:hover {
            color: var(--accent-color);
        }
        
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            color: var(--accent-color);
            transform: translateY(-5px);
        }
        
        .footer-bottom {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate {
            opacity: 0;
            animation: fadeInUp 1s ease-out forwards;
        }
        
        .delay-1 {
            animation-delay: 0.2s;
        }
        
        .delay-2 {
            animation-delay: 0.4s;
        }
        
        .delay-3 {
            animation-delay: 0.6s;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            nav ul li {
                margin: 0 10px;
            }
            
            #home h1 {
                font-size: 2.5rem;
            }
            
            #home p {
                font-size: 1.2rem;
            }
            
            section h2 {
                font-size: 2rem;
            }
            
            .weather-card {
                width: 100%;
                max-width: 350px;
            }
        }
        
        @media (max-width: 480px) {
            nav ul {
                flex-direction: column;
                align-items: center;
            }
            
            nav ul li {
                margin: 5px 0;
            }
            
            #home h1 {
                font-size: 2rem;
            }
            
            .cta-button {
                padding: 10px 20px;
                font-size: 1rem;
            }
        }
    
    </style> 
</head>
<body>

    <?php include('navbar.php'); ?>

    <header>
        <nav>
            <ul>
                <!-- <li><a href="#home"><i class="fas fa-home"></i> Home</a></li> -->
                <li><a href="#alerts"><i class="fas fa-bell"></i> Alerts</a></li>
                <li><a href="#resources"><i class="fas fa-book"></i> <b>Emergency Resources</b></a></li>
                <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSc50XD9QCwqzvXmZGmWTo58cT3bEuKAEmvCKxiIUZr5IRPNtw/viewform" target="_blank"><i class="fas fa-envelope"></i> Report Us</a></li>
            </ul>
        </nav>
    </header>

    <section id="home">
        <h1>Disaster Alert System</h1>
        <p>Real-time alerts and critical information to keep you safe during emergencies</p>
        <a href="#alerts" class="cta-button">View Current Alerts</a>
    </section>

    <section id="alerts" class="animate">
        <h2>Latest Alerts</h2>
        <p>Stay informed about potential hazards in your area</p>
        <div id="alerts-container">
            <div class="alert animate delay-1">
                <h3><i class="fas fa-exclamation-triangle"></i><a href="Wet-DECT.html"> Flood & Earthquacke Info </a></h3>
                <p>Flood: Move to higher ground immediately and avoid walking or driving through floodwaters.
                    <br>
                    Earthquake: Drop, cover, and hold on under sturdy furniture until shaking stops.
                    
                    .</p>
                <div class="alert-meta">
                    <span><i class="far fa-clock"></i> 2 hours ago</span>
                    <span><i class="fas fa-map-marker-alt"></i> Coastal Regions</span>
                </div>
            </div>
            <div class="alert emergency animate delay-2">
                <h3><i class="fas fa-skull-crossbones"></i> <a href="Ai.html"> AI Disaster Severity Classifier</a> </h3>
                <p>An AI disaster severity classifier uses machine learning models to analyze incidents and assign severity ratings based on predefined risk taxonomies and harm scales. It helps streamline incident management and policy-making by providing structured data insights. .</p>
                <div class="alert-meta">
                    <span><i class="far fa-clock"></i> 5 hours ago</span>
                    <span><i class="fas fa-map-marker-alt"></i> Southern Districts</span>
                </div>
            </div>
            <div class="alert animate delay-3">
                <h3><i class="fas fa-wind"></i><a href="Rescue.html">Rescue Team location</a> </h3>
                <p>Highly trained professionals equipped to handle emergencies, providing swift response during disasters. They perform search-and-rescue operations, medical aid, and evacuation to save lives and ensure public safety in critical situations..</p>
                <div class="alert-meta">
                    <span><i class="far fa-clock"></i> 1 day ago</span>
                    <span><i class="fas fa-map-marker-alt"></i> Eastern Seaboard</span>
                </div>
            </div>
        </div>
    </section>

    <section id="resources" class="animate">
        <h2>Emergency Resources</h2>
        <p>Essential information and tools to help you prepare and respond</p>
        <div class="resources-grid">
            <div class="resource-card animate delay-3">
                <div class="resource-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3>Weather Detection</h3>
                <p>Know the weather report of your surrounding area.</p>
                <a href="Weather.html" class="resource-link" target="_blank">View Weather</a>
            </div>
            <div class="resource-card animate delay-1">
                <div class="resource-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Safety Guidelines</h3>
                <p>Learn how to protect yourself and your family during different types of disasters.</p>
                <a href="safety.html" class="resource-link">View Guidelines</a>
            </div>
            <div class="resource-card animate delay-2">
                <div class="resource-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3>Emergency Contacts</h3>
                <p>Important phone numbers and contacts for immediate assistance during crises.</p>
                <a href="emergency.html" class="resource-link">View Contacts</a>
            </div>
           
        </div>
    </section>

   

    <section id="contact" class="animate">
        
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Providing real-time disaster alerts and emergency information to keep communities safe since 2010.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <a href="#home">Home</a>
                <a href="#alerts">Alerts</a>
                <a href="#resources">Resources</a>
                
                <a href="#contact">Contact</a>
            </div>
            <div class="footer-section">
                <h3>Subscribe</h3>
                <p>Get email alerts for emergencies in your area.</p>
                <form>
                    <input type="email" placeholder="Your Email" style="padding: 8px; width: 100%; margin-bottom: 10px; border-radius: 4px; border: none;">
                    <button type="submit" class="submit-btn" style="padding: 8px;">Subscribe</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Disaster Alert System. All rights reserved.</p>
        </div>
    </footer>

    <div class="emergency-button" id="emergencyButton">
        <i class="fas fa-exclamation"></i>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Animate elements when they come into view
            const animateOnScroll = () => {
                const elements = document.querySelectorAll('.animate');
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    
                    if (elementPosition < windowHeight - 100) {
                        element.style.opacity = 1;
                    }
                });
            };
            
            // Initial check
            animateOnScroll();
            
            // Check on scroll
            window.addEventListener('scroll', animateOnScroll);
            
            // Emergency button functionality
            const emergencyButton = document.getElementById('emergencyButton');
            emergencyButton.addEventListener('click', () => {
                window.location.href = 'tel:911';
            });
            
            // Form submission
            const contactForm = document.getElementById('contact-form');
            contactForm.addEventListener('submit', (e) => {
                e.preventDefault();
                alert('Thank you for your message! Our team will respond as soon as possible.');
                contactForm.reset();
            });
            
            // Simulate real-time alert updates
            setInterval(() => {
                const alerts = [
                    { 
                        title: "Wildfire Alert", 
                        description: "Wildfire detected within 20 miles of Pine Valley. Evacuation orders for affected areas.", 
                        type: "emergency",
                        time: "Just now",
                        location: "Pine Valley"
                    },
                    { 
                        title: "Tornado Watch", 
                        description: "Conditions favorable for tornado formation in the region. Stay alert for warnings.", 
                        type: "alert",
                        time: "30 mins ago",
                        location: "Central Plains"
                    },
                    { 
                        title: "Flash Flood Warning", 
                        description: "Heavy rains causing flash flooding in low-lying areas. Avoid travel if possible.", 
                        type: "emergency",
                        time: "1 hour ago",
                        location: "River Basin"
                    }
                ];
                
                const randomAlert = alerts[Math.floor(Math.random() * alerts.length)];
                const alertContainer = document.getElementById('alerts-container');
                
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert ${randomAlert.type === 'emergency' ? 'emergency' : ''}`;
                alertDiv.innerHTML = `
                    <h3><i class="fas ${randomAlert.type === 'emergency' ? 'fa-skull-crossbones' : 'fa-exclamation-triangle'}"></i> ${randomAlert.title}</h3>
                    <p>${randomAlert.description}</p>
                    <div class="alert-meta">
                        <span><i class="far fa-clock"></i> ${randomAlert.time}</span>
                        <span><i class="fas fa-map-marker-alt"></i> ${randomAlert.location}</span>
                    </div>
                `;
                
                alertContainer.insertBefore(alertDiv, alertContainer.firstChild);
                
                // Remove oldest alert if more than 5
                if (alertContainer.children.length > 5) {
                    alertContainer.removeChild(alertContainer.lastChild);
                }
                
                // Add animation to new alert
                setTimeout(() => {
                    alertDiv.style.animation = 'fadeInUp 0.5s ease-out';
                    alertDiv.style.opacity = 1;
                }, 100);
                
            }, 30000); // Update every 30 seconds
            
            // Update weather data periodically
            setInterval(() => {
                const temps = document.querySelectorAll('.temp');
                temps.forEach(temp => {
                    const currentTemp = parseInt(temp.textContent);
                    const change = Math.floor(Math.random() * 3) - 1; // -1, 0, or 1
                    const newTemp = currentTemp + change;
                    temp.textContent = `${newTemp}°F`;
                    
                    // Add animation
                    temp.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        temp.style.transform = 'scale(1)';
                    }, 300);
                });
            }, 60000); // Update every minute
        });
    </script>
</body>
</html>
