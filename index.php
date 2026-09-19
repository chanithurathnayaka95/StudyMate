<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StudyMate | Peer Learning Platform</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">

        <div class="container">

            <a class="navbar-brand" href="index.php">

                <i class="bi bi-mortarboard-fill"></i>

                <span>StudyMate</span>

            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">

                        <a class="nav-link active" href="index.php">
                            Home
                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="login.php">
                            Resources
                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="login.php">
                            Study Groups
                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="login.php">
                            Q&A
                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#about">
                            About
                        </a>

                    </li>

                </ul>

                <div class="d-flex align-items-center">

                    <button
                        id="theme-toggle"
                        class="btn btn-outline-secondary me-2">

                        <i class="bi bi-moon-fill"></i>

                    </button>

                    <a
                        href="login.php"
                        class="btn btn-outline-primary me-2">

                        Login

                    </a>

                    <a
                        href="register.php"
                        class="btn btn-primary">

                        Register

                    </a>

                </div>

            </div>

        </div>

    </nav>


    <section class="hero py-5">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <span class="badge bg-success mb-3 px-3 py-2">
                        Welcome to StudyMate
                    </span>

                    <h1 class="display-4 fw-bold mb-3">

                        Learn Together.

                        <span class="text-primary">
                            Achieve More.
                        </span>

                    </h1>

                    <p class="lead text-secondary mb-4">

                        StudyMate is a collaborative learning platform where university students
                        can share notes, join study groups, ask questions, and stay organized
                        throughout their academic journey.

                    </p>

                    <a
                        href="register.php"
                        class="btn btn-primary btn-lg me-3">

                        Get Started

                    </a>

                    <a
                        href="#about"
                        class="btn btn-outline-primary btn-lg">

                        Learn More

                    </a>

                </div>

                <div class="col-lg-6 text-center">

                    <img
                        src="assets/images/student-teamwork.svg"
                        class="img-fluid hero-image"
                        alt="StudyMate Teamwork Illustration">

                </div>

            </div>

        </div>

    </section>


    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">

                    Everything You Need to

                    <span class="text-primary">
                        Study Smarter
                    </span>

                </h2>

                <p class="text-secondary">

                    Discover the tools that help students collaborate, learn,
                    and achieve academic success.

                </p>

            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-4">

                    <div class="feature-card text-center">

                        <i class="bi bi-journal-bookmark-fill feature-icon"></i>

                        <h4 class="mt-3">
                            Study Resources
                        </h4>

                        <p>

                            Upload, download and organize lecture notes,
                            tutorials and study materials.

                        </p>

                    </div>

                </div>


                <div class="col-md-6 col-lg-4">

                    <div class="feature-card text-center">

                        <i class="bi bi-people-fill feature-icon"></i>

                        <h4 class="mt-3">
                            Study Groups
                        </h4>

                        <p>

                            Collaborate with classmates and create productive
                            learning communities.

                        </p>

                    </div>

                </div>


                <div class="col-md-6 col-lg-4">

                    <div class="feature-card text-center">

                        <i class="bi bi-chat-dots-fill feature-icon"></i>

                        <h4 class="mt-3">
                            Q&A Forum
                        </h4>

                        <p>

                            Ask questions, share answers and learn from
                            fellow students.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <section class="py-5 bg-light">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">

                    Explore

                    <span class="text-primary">
                        Resources by Faculty
                    </span>

                </h2>

                <p class="text-secondary">

                    Access lecture notes, tutorials, past papers, and study materials
                    from different faculties across the university.

                </p>

            </div>


            <div class="row g-4">

                <div class="col-lg-3 col-md-6">

                    <div class="card h-100 shadow-sm border-0">

                        <div class="card-body text-center">

                            <i class="bi bi-laptop display-4 text-primary"></i>

                            <h4 class="mt-3">
                                Faculty of Computing
                            </h4>

                            <span class="badge bg-primary mb-3">
                                Computing
                            </span>

                            <ul class="list-unstyled text-start">

                                <li>✔ Programming</li>
                                <li>✔ Data Structures</li>
                                <li>✔ Algorithms</li>
                                <li>✔ Databases</li>

                            </ul>

                            <a
                                href="login.php"
                                class="btn btn-primary mt-3">

                                Browse Resources

                            </a>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="card h-100 shadow-sm border-0">

                        <div class="card-body text-center">

                            <i class="bi bi-briefcase display-4 text-primary"></i>

                            <h4 class="mt-3">
                                Faculty of Business
                            </h4>

                            <span class="badge bg-primary mb-3">
                                Business
                            </span>

                            <ul class="list-unstyled text-start">

                                <li>✔ Marketing</li>
                                <li>✔ Finance</li>
                                <li>✔ Management</li>
                                <li>✔ Economics</li>

                            </ul>

                            <a
                                href="login.php"
                                class="btn btn-primary mt-3">

                                Browse Resources

                            </a>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="card h-100 shadow-sm border-0">

                        <div class="card-body text-center">

                            <i class="bi bi-tools display-4 text-primary"></i>

                            <h4 class="mt-3">
                                Faculty of Engineering
                            </h4>

                            <span class="badge bg-primary mb-3">
                                Engineering
                            </span>

                            <ul class="list-unstyled text-start">

                                <li>✔ Civil Engineering</li>
                                <li>✔ Mechanical Engineering</li>
                                <li>✔ Electrical Engineering</li>
                                <li>✔ Computer Engineering</li>

                            </ul>

                            <a
                                href="login.php"
                                class="btn btn-primary mt-3">

                                Browse Resources

                            </a>

                        </div>

                    </div>

                </div>


                <div class="col-lg-3 col-md-6">

                    <div class="card h-100 shadow-sm border-0">

                        <div class="card-body text-center">

                            <i class="bi bi-flask display-4 text-primary"></i>

                            <h4 class="mt-3">
                                Faculty of Science
                            </h4>

                            <span class="badge bg-primary mb-3">
                                Science
                            </span>

                            <ul class="list-unstyled text-start">

                                <li>✔ Biology</li>
                                <li>✔ Chemistry</li>
                                <li>✔ Physics</li>
                                <li>✔ Mathematics</li>

                            </ul>

                            <a
                                href="login.php"
                                class="btn btn-primary mt-3">

                                Browse Resources

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <section id="testimonials" class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">
                    What Our Students Say
                </h2>

                <p class="text-secondary">
                    Hear from students who have benefited from StudyMate.
                </p>

            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 shadow-sm border-0">

                        <div class="card-body text-center">

                            <img
                                src="assets/images/student1.jpg"
                                alt="Student 1"
                                class="rounded-circle mb-3"
                                width="80"
                                height="80">

                            <h5 class="card-title">
                                Kasun Perera
                            </h5>

                            <p class="card-text text-secondary">

                                "StudyMate has transformed the way I study.
                                The resources and study groups have been invaluable."

                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 shadow-sm border-0">

                        <div class="card-body text-center">

                            <img
                                src="assets/images/student2.jpg"
                                alt="Student 2"
                                class="rounded-circle mb-3"
                                width="80"
                                height="80">

                            <h5 class="card-title">
                                Sahan Fernando
                            </h5>

                            <p class="card-text text-secondary">

                                "The Q&A forum is a lifesaver!
                                I can get help from peers and share my knowledge too."

                            </p>

                        </div>

                    </div>

                </div>


                <div class="col-md-6 col-lg-4">

                    <div class="card h-100 shadow-sm border-0">

                        <div class="card-body text-center">

                            <img
                                src="assets/images/student3.jpg"
                                alt="Student 3"
                                class="rounded-circle mb-3"
                                width="80"
                                height="80">

                            <h5 class="card-title">
                                Nethmi Silva
                            </h5>

                            <p class="card-text text-secondary">

                                "I love how organized everything is.
                                StudyMate makes collaboration easier."

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <section id="faq" class="py-5 bg-light">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">
                    Frequently Asked Questions
                </h2>

                <p class="text-secondary">
                    Find answers to common questions about StudyMate.
                </p>

            </div>

            <div class="accordion" id="faqAccordion">

                <div class="accordion-item">

                    <h2 class="accordion-header" id="faqHeading1">

                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse1">

                            What is StudyMate?

                        </button>

                    </h2>

                    <div
                        id="faqCollapse1"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            StudyMate is a peer learning platform that allows university
                            students to share resources, join study groups, ask questions,
                            and collaborate with fellow students.

                        </div>

                    </div>

                </div>


                <div class="accordion-item">

                    <h2 class="accordion-header" id="faqHeading2">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse2">

                            How do I join a study group?

                        </button>

                    </h2>

                    <div
                        id="faqCollapse2"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            You can browse available study groups in your faculty
                            and join a group that interests you. Once you join,
                            you can participate in group discussions and collaborate
                            with other members.

                        </div>

                    </div>

                </div>


                <div class="accordion-item">

                    <h2 class="accordion-header" id="faqHeading3">

                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faqCollapse3">

                            Is StudyMate free to use?

                        </button>

                    </h2>

                    <div
                        id="faqCollapse3"
                        class="accordion-collapse collapse"
                        data-bs-parent="#faqAccordion">

                        <div class="accordion-body">

                            Yes, StudyMate is completely free for all registered
                            university students.

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <footer id="about" class="footer mt-5">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6">

                    <h3 class="footer-logo">

                        <i class="bi bi-mortarboard-fill"></i>
                        StudyMate

                    </h3>

                    <p>

                        StudyMate is a platform designed to help university students
                        access study resources, collaborate with classmates, and
                        improve their academic success.

                    </p>

                </div>


                <div class="col-lg-2 col-md-6">

                    <h5>
                        Quick Links
                    </h5>

                    <ul class="footer-links">

                        <li>
                            <a href="index.php">
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="login.php">
                                Resources
                            </a>
                        </li>

                        <li>
                            <a href="login.php">
                                Study Groups
                            </a>
                        </li>

                        <li>
                            <a href="login.php">
                                Q&A
                            </a>
                        </li>

                        <li>
                            <a href="#about">
                                About
                            </a>
                        </li>

                    </ul>

                </div>


                <div class="col-lg-3 col-md-6">

                    <h5>
                        Faculties
                    </h5>

                    <ul class="footer-links">

                        <li>Faculty of Computing</li>
                        <li>Faculty of Business</li>
                        <li>Faculty of Engineering</li>
                        <li>Faculty of Science</li>

                    </ul>

                </div>


                <div class="col-lg-3 col-md-6">

                    <h5>
                        Contact Us
                    </h5>

                    <p>

                        <i class="bi bi-envelope-fill"></i>
                        support@studymate.com

                    </p>

                    <p>

                        <i class="bi bi-telephone-fill"></i>
                        +94 71 234 5678

                    </p>

                    <p>

                        <i class="bi bi-geo-alt-fill"></i>
                        NSBM Green University

                    </p>

                    <div class="social-icons">

                        <a href="#">
                            <i class="bi bi-facebook"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-instagram"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-linkedin"></i>
                        </a>

                        <a href="#">
                            <i class="bi bi-github"></i>
                        </a>

                    </div>

                </div>

            </div>

            <hr>

            <div class="text-center copyright">

                ©️ 2026 StudyMate. All Rights Reserved.

            </div>

        </div>

    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>

    <script>

        const toggleButton = document.getElementById("theme-toggle");

        if (localStorage.getItem("theme") === "dark") {

            document.body.classList.add("dark-mode");

            toggleButton.innerHTML =
                '<i class="bi bi-sun-fill"></i>';

        }

        toggleButton.addEventListener("click", function() {

            document.body.classList.toggle("dark-mode");

            if (document.body.classList.contains("dark-mode")) {

                localStorage.setItem("theme", "dark");

                toggleButton.innerHTML =
                    '<i class="bi bi-sun-fill"></i>';

            } else {

                localStorage.setItem("theme", "light");

                toggleButton.innerHTML =
                    '<i class="bi bi-moon-fill"></i>';

            }

        });

    </script>

</body>

</html>