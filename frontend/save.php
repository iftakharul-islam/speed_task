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
                <form action="#" id="form" method="post">

                    <div>
                        <label for="buyer_email">Buyer Email <span class="mandatory">*</span> </label>
                        <input type="email" id="buyer_email" required name="buyer_email" />
                    </div>
                    <div>
                        <label for="phone">Phone <span class="mandatory">*</span> </label>
                        <input type="text" id="phone" required name="phone" />
                    </div>
                    <div>
                        <label for="amount">Amount <span class="mandatory">*</span></label>
                        <input type="text" id="amount" required name="amount" />
                    </div>
                    <div>
                        <label for="buyer">Buyer <span class="mandatory">*</span></label>
                        <input type="text" id="buyer" required name="buyer" maxlength="20" />
                    </div>
                    <div>
                        <label for="items">Items <span class="mandatory">*</span></label>
                        <input type="text" id="items" required name="items" />
                    </div>
                    <div>
                        <label for="receipt_id">Receipt ID <span class="mandatory">*</span></label>
                        <input type="text" id="receipt_id" required name="receipt_id" />
                    </div>
                    <div>
                        <label for="city">City <span class="mandatory">*</span></label>
                        <input type="text" id="city" required name="city" />
                    </div>
                    <div>
                    <label for="city">Entry By <span class="mandatory">*</span></label>
                    <select type="text" id="entry_by" class="options" required name="entry_by" ></select>
                </div>
                    <div>

                        <label for="note">Note <span class="mandatory">*</span></label>
                        <textarea name="note" id="note" required cols="20" rows="5"></textarea>

                    </div>

                    <div>
                        <input type="hidden" name="submit" value="save">
                        <button type="submit" id="submit" class="button button-green" onclick="saveData()" value="save"> Save</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <div id="message-alert"></div>
    <footer>

    </footer>
    <script src="js/jquery.js"></script>
    <script src="js/app.js"></script>
    <script>

    </script>
</body>

</html>