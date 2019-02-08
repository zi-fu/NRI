<?php
$sql =  "select * from board";

$comment = array();
foreach($dbh->query($sql) as $row){
    array_push($comment,$rows);
} 

var_dump($comment);



//ページング機能
define("PER_PAGE", 50);//定数


//$page = 1;
if (preg_match('/^[1-9][0-9]*$/', $_GET['page'])){
    $page = (int)$_GET['page'];
}else{
    $page = 1;
}



//select * from comments limit OFFSET,count
$offset = PER_PAGE * ($page - 1);
$sql =  "select * from board limit " .$offset.",".PER_PAGE;

$comment = array();
foreach($dbh->query($sql) as $row){
    array_push($comment,$rows);
} 

$total = $dbh->query("select count(*) from board limit ")->fetchColuumn();
$totalPages = ceil($total / PER_PAGE);


var_dump($comment);



$from = $offset + 1;
$to = ($offset + PER_PAGE) < $total ? ($offset + PER_PAGE) : $total;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<p>全<?php echo $total; ?>件中、<?php echo $from; ?>件〜<?php echo $to; ?>件を表示しています。</p>


<!-- //ページが１より大きいとき表示 -->
<?php if ($page > 1) : ?>
    <a href="url=<?php echo $page-1; ?>">前</a>
<?php endif; ?>

<!-- //ページの表示 -->
<?php for ($i = 1; $i <= $totalPages; $i++) : ?>

<!-- //現在のページを太字にする -->
    <?php if ($page ==$i) : ?>
        <strong><a href="url=<?php echo $i; ?>" ><?php echo $i; ?></a></strong>
    <?php else : ?>
        <a href="url=<?php echo $i; ?>" ><?php echo $i; ?></a>
    <?php endif ; ?>

<?php endfor; ?>

<!-- //最後のページでないとき -->
<?php if ($page < $totalPages) : ?>
    <a href="url=<?php echo $page+1; ?>">次</a>
<?php endif; ?>
</body>
</html>