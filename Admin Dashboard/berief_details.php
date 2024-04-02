<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/briefDetails.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <nav class="navigation">
            <ul>
                <li>
                    <a href="#main">
                        <span class="icon">
                            <ion-icon name="code-slash-outline"></ion-icon>
                        </span>
                        <span class="title">BriefSolicode</span>
                    </a>
                </li>

                <li>
                    <a href="#main">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="./add.php">
                        <span class="icon">
                            <ion-icon name="add-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Add</span>
                    </a>
                </li>

                <li>
                    <a href="./edit.php">
                        <span class="icon">
                            <ion-icon name="create-outline"></ion-icon>
                        </span>
                        <span class="title">Edit</span>
                    </a>
                </li>

                <li>
                    <a href="../login/index.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </nav>
        <main class="main" id="main">
            <section class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

              
            </section>
            <section>
                <div class="form_container">
                    <form method="post">
                        <div class="adding_brief_title_container">
                            <h1 class="adding_brief_title">Add a new brief</h1>
                        </div>
                        <div class="container">
                            <div class="top">
                                <div class="title">
                                    <h1>Title</h1>
                                    <p><span>10</span></p>
                                </div>
                                <div class="genre">TEST</div>
                            </div>
                            <div class="brief">
                                <div class="movie-description">
                                    <h2>About the brief</h2>
                                    <div class="movie-description">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae veritatis sunt expedita, minima quos fugiat eos reiciendis unde aspernatur aperiam ab, rerum perspiciatis cum magni! Illo animi nemo asperiores alias.</p>
                                        <div class="competences">
                                            <div class="comp">
                                                <h2>competences</h2>
                                                <ul>
                                                    <li>TEST TEST TEST TES</li>
                                                    <li>TEST TEST TEST TES</li>
                                                    <li>TEST TEST TEST TES</li>
                                                    <li>TEST TEST TEST TES</li>
                                                    <li>TEST TEST TEST TES</li>
                                                    <li>TEST TEST TEST TES</li>
                                                    <li>TEST TEST TEST TES</li>
                                                    <li>TEST TEST TEST TES</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <a href="">More</a>
                                        <a href="">Downlaod att</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </section>
        </main>




        <div class="container">
            <div class="top">
                <div class="title">
                    <h1>Title</h1>
                    <p><span>10</span></p>
                </div>
                <div class="genre">TEST</div>
            </div>
            <div class="brief">
                <div class="movie-description">
                    <h2>About the brief</h2>
                    <div class="movie-description">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae veritatis sunt expedita, minima quos fugiat eos reiciendis unde aspernatur aperiam ab, rerum perspiciatis cum magni! Illo animi nemo asperiores alias.</p>
                        <div class="competences">
                            <div class="comp">
                                <h2>competences</h2>
                                <ul>
                                    <li>TEST TEST TEST TES</li>
                                    <li>TEST TEST TEST TES</li>
                                    <li>TEST TEST TEST TES</li>
                                    <li>TEST TEST TEST TES</li>
                                    <li>TEST TEST TEST TES</li>
                                    <li>TEST TEST TEST TES</li>
                                    <li>TEST TEST TEST TES</li>
                                    <li>TEST TEST TEST TES</li>
                                </ul>
                            </div>
                        </div>
                        <a href="">More</a>
                        <a href="">Downlaod att</a>
                    </div>
                </div>
            </div>
        </div>




        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>