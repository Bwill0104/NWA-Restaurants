<html>
<head>
    <style>
        h1 {
            color: white;
        }

        .content {
            margin: auto;
            max-width: 1000px;
            scroll-behavior: smooth;
        }

        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .nav-bar a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }

        .nav-bar a:hover {
            text-decoration: underline;
        }

        .search-bar input[type="text"] {
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 200px;
        }

        .search-bar input[type="submit"] {
            padding: 5px 12px;
            border-radius: 5px;
            background-color: #555;
            color: white;
            border: none;
            cursor: pointer;
        }

        .search-bar input[type="submit"]:hover {
            background-color: #777;
        }
    </style>
</head>
<body>
    <div class="content">
        
        <div class="nav-bar">
            <div class="links">
                <a href="home.php">Home</a>
                <a href="find.php?type=city">By City</a>
                <a href="find.php?type=rating">By Rating</a>
                <a href="find.php?type=hours">By Hours</a>
            </div>
        <h1>Restaurant Search</h1>

            <div class="search-bar">
                <form action="search.php" method="get">
                    <input type="text" name="q" placeholder="Search...">
                    <input type="submit" value="Go">
                </form>
            </div>
        </div>
    </div>
</body>
</html>