<?php
include '../db_info.php';
include '../validations.php';

$state = filter_input(INPUT_POST, "state");
$id_country = filter_input(INPUT_POST, "id_country");

$query = "SELECT id_city, name FROM cities WHERE id_country = " . parseString($id_country) . "AND district = " . parseString($state) . " ORDER BY name;" or die("Error " . mysqli_error($link));
echo $query;
$cities = $link->query($query);
?>
<option value="null">---</option>
<?php
while ($city = mysqli_fetch_array($cities)) {
    ?>
    <option <?php echo $city['id_city'] ?>>
        <?php echo $city['name'] ?>
    </option>
    <?php
}