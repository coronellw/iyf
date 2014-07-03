<?php
include '../db_info.php';
include '../validations.php';
$id_country = filter_input(INPUT_POST, "id_country");

$query = "SELECT district FROM cities WHERE id_country = " . parseString($id_country) . " GROUP BY district ORDER BY district;" or die("Error " . mysqli_error($link));
$states = $link->query($query);
?>
<option value="null">---</option>
<?php
while ($state = mysqli_fetch_array($states)) {
    ?>
    <option id="<?php $state['district'] ?>" >
        <?php echo $state['district'] ?>
    </option>
    <?php
}