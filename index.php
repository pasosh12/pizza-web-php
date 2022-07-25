<?php
include('config/db_connect.php');
 
$pizzas = get_data_fetched($conn, "SELECT name, price FROM pizzas");
$sizes = get_data_fetched($conn, "SELECT size, price FROM sizes");
$sauces = get_data_fetched($conn, "SELECT name, price FROM sauces");

function get_data_fetched($conn, $sql)
{
    $result = mysqli_query($conn, $sql);
    $result_fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $result_fetched;
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href='css/styles.css'>
    <title>Restaurant Website</title>
</head>
<body>
    <div class="popup-fade">
        <div class="popup">
            <p>Ваш чек:</p>
            <ul>
                <li>Пицца: <span id="popup-pizza"></span></li>
                <li>Размер: <span id="popup-size"></span></li>
                <li>Соус: <span id="popup-sauce"></span></li>
                <li>Суммарная стоимость: <span id="popup-cost"></span></li>
            </ul>
            <button class="popup-close">Новый заказ</button>
        </div>
    </div>
    <form class="form" id="select_box" method="post" > 
        <label>Пицца</label>
        <select name="pizza" id="product" >
                <?php
                foreach ($pizzas as $pizza) { ?>
                    <option value="<?php echo $pizza['price']?>" title="<?php echo $pizza['price'].'р'?>"> <?php echo $pizza['name'];?> </option>
                <?php
                }
                ?>
        </select>
        <label>Размер</label>
        <select name="size" id="product" >
            <?php
            foreach ($sizes as $size) { ?>
                <option value="<?php echo $size['price']?>" title="<?php echo $size['price'].'р'?>"> <?php echo $size['size']; ?> </option>
            <?php
            }
            ?>     
        </select>
        <label>Соус</label>
        <select name="sauce" id="product" >
            <?php
            foreach ($sauces as $sauce) { ?>
                <option value="<?php echo $sauce['price']?>" title="<?php echo $sauce['price'].'р'?>"> <?php echo $sauce['name']?> </option>
            <?php
            }
            ?>
        </select>
        <input type="submit" name="submit" value="Заказать">
        </form>
        <script type="text/javascript" src="scripts/jquery-1.3.1.min.js"></script>
        <script type="text/javascript" src="scripts/jquery.json-1.3.js"></script>
        <script src="scripts/main.js"></script>
        <script src="scripts/popup.js"></script>
</body>

</html>