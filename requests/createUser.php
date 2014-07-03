<?php
include '../db_info.php';
include '../validations.php';

$name = filter_input(INPUT_POST, "name");
$parent_name = filter_input(INPUT_POST, "parent_name");
$maternal_name = filter_input(INPUT_POST, "maternal_name");
$genre = filter_input(INPUT_POST, "genre");
$born = filter_input(INPUT_POST, "born");
$scholarity = filter_input(INPUT_POST, "scholarity");
$contacts = filter_input(INPUT_POST, "contacts", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
$id_country = filter_input(INPUT_POST, "id_country");
$id_city = filter_input(INPUT_POST, "id_city");
$id_hq = filter_input(INPUT_POST, "id_hq");
$email = filter_input(INPUT_POST, "email");
$id_modality = filter_input(INPUT_POST, "id_modality");
$id_publicity = filter_input(INPUT_POST, "id_publicity");
$hosted = filter_input(INPUT_POST, "hosted");
$assistance = filter_input(INPUT_POST, "assistance");
$price = filter_input(INPUT_POST, "price");

$query = "INSERT INTO `IYF`.`users`
(`names`,`parent_names`,`genre`,`born`,`email`,`scolarship`,`assistance`,
`id_group`,`usrnm`,`id_usertype`,`id_modality`,`notes`,`registered`,`country`,`psswrd`,
`id_headquarters`,`id_city`,`id_publicity`,`hosted`,`pays`,`maternal_name`)
VALUES
".parseString($name).",
".parseString($parent_name).",
".parseString(genre).",,
".parseString($born).",,
<{email: }>,
<{scolarship: }>,
<{assistance: N}>,
<{id_group: }>,
<{usrnm: }>,
<{id_usertype: }>,
<{id_modality: }>,
<{notes: }>,
<{registered: }>,
<{country: 1}>,
<{psswrd: }>,
<{id_headquarters: }>,
<{id_city: }>,
<{id_publicity: }>,
<{hosted: Y}>,
<{pays: }>,
<{maternal_name: }>);";
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