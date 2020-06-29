<?php 

if(!empty($_POST['creaL']) && !empty($_POST['creaP'])){
    //var_dump($_POST);

    $dbh = new PDO(
        'mysql:host=localhost;dbname=blog;charset=utf8',
        'root',
        '',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    $query = 'INSERT INTO users(userLog, userKey) VALUES (:logL, :logK)';
    $sth = $dbh->prepare($query);
    $sth->bindValue(':logL', trim($_POST['creaL']), PDO::PARAM_STR);
    $sth->bindValue(':logK', password_hash(trim($_POST['creaP']), PASSWORD_BCRYPT), PDO::PARAM_STR);
    $sth->execute();

    session_start();
    $_SESSION['logged'] = true;
}

header('Location:create.php');
exit;
?>