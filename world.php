<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);
$context = filter_input(INPUT_GET, "context", FILTER_SANITIZE_STRING);


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if (empty($context)) {
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
} else {
    $stmt = $conn->query("SELECT ct.name, ct.district, ct.population FROM countries "
            . " JOIN cities ct ON countries.code=ct.country_code WHERE countries.name LIKE '%$country%';");
}
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="<?=(empty($context)?"country":"city") ?>">
    <tr>

        <?php
        if (empty($context)) {
            echo "<th>Country Name</th>
                    <th>Continent</th>
                    <th>Independence Year</th>
                    <th>Head of State</th>";
        } else {
            echo "<th>Name</th>
                    <th>District</th>
                    <th>Population</th>";
        }
        ?>

    </tr>

    <?php foreach ($results as $row): ?>
        <tr>
            <td><?= $row['name']; ?></td>
            <?php if (empty($context)) { ?>
                <td><?= $row['continent']; ?></td>
                <td><?= $row['independence_year']; ?></td>
                <td><?= $row['head_of_state']; ?></td>
            <?php } else { ?>
                <td><?= $row['district']; ?></td>
                <td><?= $row['population']; ?></td>
            <?php } ?>

        </tr>
    <?php endforeach; ?>

</table>

