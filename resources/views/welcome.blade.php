<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cybersecurity Awareness Platform</title>
    <meta name="description" content="A platform to educate small business owners about cybersecurity.">
    <meta name="keywords" content="cybersecurity, awareness, small business, education, training, data protection, online safety">
    <meta name="author" content="cyber security awareness">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .nav-link {
            font-weight: 500;
        }
        .nav-link:hover {
            color: #007bff !important;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }
        .btn-outline-primary:hover {
            background-color: #e0f7fa;
            border-color: #e0f7fa;
            color: #007bff;
        }

    </style>
</head>
<body id="page-top" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="72">

    <nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#page-top">
                <i class="fas fa-shield-alt fa-2x me-2 text-primary"></i>
                <span class="fw-bold text-dark">CyberAware</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#founders">Founders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#carousel">Training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary rounded-pill px-3" href="/login">Sign In </a>
                         <a class="nav-link btn btn-outline-primary rounded-pill px-3" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header id="hero" class="bg-light py-5 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold text-dark">Protect Your Business with Cybersecurity Awareness</h1>
                    <p class="lead text-muted my-4">Empowering small business owners with the knowledge and tools to defend against cyber threats.</p>
                    <a href="/login" class="btn btn-primary rounded-pill px-4 py-2">Get Started</a>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('cyber.jpg') }}" alt="Cybersecurity Awareness" class="img-fluid rounded-pill shadow-lg">
                </div>
            </div>
        </div>
    </header>

    <section id="about" class="bg-white py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-4 fw-bold text-dark mb-3">About Us</h2>
                    <p class="lead text-muted">CyberAware is dedicated to providing accessible cybersecurity education and resources to small business owners.  We understand the challenges you face and are here to help you build a stronger security posture.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="founders" class="bg-light py-5">
        <div class="container">
            <h2 class="display-4 fw-bold text-dark text-center mb-5">Our Founders</h2>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card shadow-sm rounded-pill">
                        <div class="card-body d-flex align-items-center">
                            <img src="https://placehold.co/150x150/EEE/31343C" alt="Founder 1" class="rounded-circle me-4">
                            <div>
                                <h3 class="card-title fw-semibold text-dark">Jane Doe</h3>
                                <p class="card-text text-muted">Cybersecurity Expert & Educator</p>
                                <p class="text-muted">Jane has over 15 years of experience in cybersecurity, working with businesses of all sizes. She is passionate about making cybersecurity accessible to everyone.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow-sm rounded-pill">
                        <div class="card-body d-flex align-items-center">
                            <img src="https://placehold.co/150x150/EEE/31343C" alt="Founder 2" class="rounded-circle me-4">
                            <div>
                                <h3 class="card-title fw-semibold text-dark">John Smith</h3>
                                <p class="card-text text-muted">Small Business Advocate & Entrepreneur</p>
                                <p class="text-muted">John has founded and run several successful small businesses. He understands the unique challenges small businesses face in protecting themselves from cyber threats.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="carousel" class="bg-white py-5">
        <div class="container">
            <h2 class="display-4 fw-bold text-dark text-center mb-5">Training Programs</h2>
            <div id="trainingCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner rounded-pill">
                    <div class="carousel-item active">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title fw-semibold text-dark">Online Courses</h3>
                                <p class="card-text text-muted">Flexible, self-paced courses covering essential cybersecurity topics.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title fw-semibold text-dark">Workshops</h3>
                                <p class="card-text text-muted">Interactive sessions with industry experts.</p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                 <h3 class="card-title fw-semibold text-dark">Webinars</h3>
                                <p class="card-text text-muted">Live presentations on the latest cybersecurity threats and best practices.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#trainingCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#trainingCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <section id="contact" class="bg-light py-5">
        <div class="container">
            <h2 class="display-4 fw-bold text-dark text-center mb-5">Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-dark">Your Name</label>
                            <input type="text" class="form-control rounded-pill" id="name" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-dark">Email Address</label>
                            <input type="email" class="form-control rounded-pill" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label fw-semibold text-dark">Message</label>
                            <textarea class="form-control rounded-pill" id="message" rows="5" placeholder="Enter your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 CyberAware. All rights reserved.</p>
            <a href="#" class="text-white text-decoration-none">Privacy Policy</a> | <a href="#" class="text-white text-decoration-none">Terms of Service</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        const scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#navbar',
            offset: 72,
        })
    </script>
</body>
</html>


