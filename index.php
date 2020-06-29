<?php 
$cssOn = [];
$cssOn[] = './css/articles.css';
$dbh = new PDO(
    'mysql:host=localhost;dbname=blog;charset=utf8',
    'root',
    '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

$query = 'SELECT articles.id, articles.titre, articles.contenu, articles.date, articles.image, users.userLog FROM articles INNER JOIN users ON articles.userId = users.id';
$sth = $dbh->prepare($query);
$sth->execute();
$article = $sth->fetchAll();

//var_dump($_POST);

if(!empty($_POST)){
    $query2 = 'SELECT id, userLog, userKey FROM users WHERE userLog=:usl';
    $sth2 = $dbh->prepare($query2);
    $sth2->bindValue(':usl', trim($_POST['inpL']), PDO::PARAM_STR);
    $sth2->execute();
    $usl = $sth2->fetch();

    //var_dump($usl);

    if($usl !== false && password_verify(trim($_POST['inpP']), $usl['userKey'])){
        session_start();
        $_SESSION['userId'] = $usl['id'];
        $_SESSION['userLog'] = $usl['userLog'];
        header('Location:account.php');
        exit;
    }
    else{
        header('Location:./');
    }
}
include('./phtml/head.phtml');
include('./phtml/articles.phtml');
include('./phtml/foot.phtml');
?>