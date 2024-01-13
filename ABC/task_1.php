<?php

$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//$sql = 'SELECT click.* FROM click JOIN actions ON click.id = actions.click_id';
//$sql = 'SELECT click.* FROM click LEFT JOIN actions ON click.id = actions.click_id WHERE actions.event_date IS NULL';
//$sql = 'SELECT * FROM click WHERE id IN (SELECT click_id FROM actions)';
//$sql = 'SELECT * FROM click WHERE id NOT IN (SELECT click_id FROM actions)';

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute();
} catch(PDOException $ex) {
    echo $ex->getMessage();
}

foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $x) {
    var_dump($x);
    echo '</br>';
}
