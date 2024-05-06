<?php
    session_start();
    $mode = 'input';
    if( isset($_POST['back']) && $_POST['back'] ){
        //何もしない
    } else if( isset($_POST['confirm']) && $_POST['confirm'] ){
        $_SESSION['date']    = $_POST['date'];
        $_SESSION['title']   = $_POST['title'];
        $_SESSION['message'] = $_POST['message'];
        $mode = 'confirm';
    } else if( isset($_POST['send']) && $_POST['send'] ){
        $mode = 'send';
    } else {
        $_SESSION = array();
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./newsform.css">
    <title>お知らせ入力画面(従業員専用)</title>
</head>
<body>
    <div class="logo">
        <img class="logo-img" src="./image/home_img/IMG_logo.jpg" alt="ロゴ">
    </div>
    <div class="hedder-title">
        お知らせ入力画面
    </div>
    <?php if( $mode == 'input' ){?>
            <!-- 入力画面 -->
            <form class="body-input" action="./newsform.php" method="post">
                <div class="input-date">
                    日付<br>
                    <input type="date" name="date" value="<?php echo date('Y-m-j'); ?>"><br>
                </div>
                <div class="input-title">
                    タイトル<br>
                    <input type="text" name="title" value="<?php echo $_SESSION['title'] ?>"><br>
                </div>
                <div class="input-message">
                    お知らせ内容<br>
                    <textarea cols="40" rows="8" name="message"><?php echo $_SESSION['message'] ?></textarea><br>
                </div>
                <div class="input-submit">
                    <input type="submit" name="confirm" value="確認">
                </div>
            </form>

    <?php } else if( $mode == 'confirm' ){ ?>
        <!-- 確認画面 -->
        <form action="./newsform.php" method="post">
            <?php echo $_SESSION['date'] ?><br><br>
            <?php echo $_SESSION['title'] ?><br><br>
            ■お知らせ<br>
            <?php echo nl2br($_SESSION['message']) ?><br>
            <input type="submit" name="back" value="戻る">
            <input type="submit" name="send" value="送信">
        </form>

    <?php } else if ( $mode == 'send' ){ ?>
        <!-- 完了画面 -->
        <form action="./newsform.php" method="post">
            送信しました。<br>
            <input type="submit" name="sent" value="入力画面に戻る">
    <?php } else {?>
                    <!-- 入力画面 -->
                    <form action="./newsform.php" method="post">
                日付<input type="text" name="date" value="<?php echo $_SESSION['date'] ?>"><br>
                タイトル<input type="text" name="title" value="<?php echo $_SESSION['title'] ?>"><br>
                お知らせ内容<br>
                <textarea cols="40" rows="8" name="message"><?php echo $_SESSION['message'] ?></textarea><br>
                <input type="submit" name="confirm" value="確認">
            </form>
    <?php } ?>

</body>
</html>