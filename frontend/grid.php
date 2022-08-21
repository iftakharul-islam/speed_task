<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h2>A Simple Form Submit Task</h2>
        <nav>
            <ul>
                <li><a href="save.php">Home Page</a></li>
                <li><a href="grid.php">Grid Page</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <div>
                <div>
                    <form action="#" id="search_form">
                        <label for="">Search Field</label>
                        <select name="search_filed" id="search_field">
                            <option value="id">ID</option>
                            <option value="phone">Phone</option>
                            <option value="buyer_email">Buyer Email</option>
                            <option value="receipt_id">Receipt ID</option>
                            <option value="entry_by">Entry By</option>
                        </select>
                        <label for="">Value </label>
                        <input type="text" name="value" id="search_value">
                        <input type="button" name="search" class="button button-blue" value="search" id="search" onclick="SearchGrid()">
                    </form>

                </div>
                <br>
                <div style="overflow-x:auto;">
                <table  border="1">
                    <thead>
                        <td>Id</td>
                        <td>Receipt Id</td>
                        <td>Items</td>
                        <td>Phone</td>
                        <td>Amount</td>
                        <td>Buyer</td>
                        <td>Buyer Email</td>
                        <td>City</td>
                        <td>Username</td>
                        <td>Entry at</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </thead>
                    <tbody id="grid-data">

                    </tbody>
                </table>
                </div>
            </div>
        </section>

        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="form-content"></div>
            </div>

        </div>

        </div>


    </main>
    <div id="message-alert"></div>
    <footer>

    </footer>
    <script src="js/jquery.js"></script>
    <script src="js/app.js"></script>
    <script>
        

      

        loadGrid();
    </script>
</body>

</html>