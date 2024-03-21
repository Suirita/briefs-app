<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BriefSolicode | Admin Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/add.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
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
                    <a href="/briefs app/briefs-app/admin dashboard/index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#main">
                        <span class="icon">
                            <ion-icon name="add-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Add</span>
                    </a>
                </li>

                <li>
                    <a href="/briefs app/briefs-app/admin dashboard/update.php">
                        <span class="icon">
                            <ion-icon name="create-outline"></ion-icon>
                        </span>
                        <span class="title">Update</span>
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

        <!-- ========================= Main ==================== -->
        <main class="main" id="main">
            <section class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </section>
            <section>
                <div class="form_container">
                    <form action="" method="get">
                        <h1 class="adding_brief_title">Add a new brief</h1>
                        <div class="input-div one">
                            <div class="div">
                                <label for="brief_title">Brief Title</label><br>
                                <input type="text" class="input" id="brief_title" name="brief_title">
                            </div>
                        </div>
                        <label for="brief_start_date">Start Date</label>
                        <input type="date" id="brief_start_date" name="brief_start_date">
                        <label for="brief_end_date">End Date</label>
                        <input type="date" id="brief_end_date" name="brief_end_date">
                        <div class="input-div one">
                            <div class="div">
                                <label for=" brief_URL">Brief URL</label><br>
                                <input type="url" class="input" id="brief_URL" name="brief_URL"><br>
                            </div>
                        </div>
                        <input type="submit" class="btn" value="Add Brief" name="submit">
                    </form>
                </div>
            </section>
        </main>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>