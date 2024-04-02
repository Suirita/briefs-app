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
                      
                        <div class="top">
                            <div class="title">
                                <h2>Title</h2>
                            </div>
                            <div class="genre">TEST</div>
                        </div>
                        <div class="brief">
                            
                            <div class="movie-description">
                                <div></div>
                                <h2>About the Brief</h2>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae veritatis sunt expedita, minima quos fugiat eos reiciendis unde aspernatur aperiam ab, rerum perspiciatis cum magni! Illo animi nemo asperiores alias.</p>
                                <div class="competences">
                                    <h3>Competences</h3>
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
                                <div class="actions">
                                    <a href="#" class="download">Download Attachment</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </section>
        </main>




     



        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>