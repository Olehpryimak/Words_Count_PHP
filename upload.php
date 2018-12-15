<?php
include_once './app/header.php';

if (!isset($_SESSION['logged_user'])) {
    header("Location: /");
}
$id = $_SESSION['logged_user'];
$user = R::findOne('users', 'id = ?', array($id));
$data = $_POST;
include_once './app/header2.php';
$errors;
if ($_FILES) {

    if ($_FILES['filename']['type'] == "text/plain") {

        if (move_uploaded_file($_FILES['filename']['tmp_name'], $_FILES['filename']['name'])) {
            $t = file_get_contents($_FILES['filename']['name']);
            $get = mb_detect_encoding($t, array('utf-8', 'cp1251'));
            $t = iconv($get, 'UTF-8', $t);

            $num_chars = iconv_strlen($t);
            $file_array = file($_FILES['filename']['name']);
            $num_str = count($file_array);
            $path = $_FILES['filename']['name'];
            $words = str_word_count($t, 0 , 'ЙйЦцУуКкЕеНнГгШшЩщЗзХхЇїЇФфІіВвАаПпРрОоЛлДдЖжЄєЯяЧчСсМмИиТтЬьБбЮюЫыЭэ');
            unlink($_FILES['filename']['name']);
        }
    } else {
        $errors [] = "Виберіть файл з розширенням txt!";
    }
}
?>
<div class="container" style="margin-top: 4%">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5">

            <?php if (!empty($errors) && $_FILES): ?>
                <div class="bg-warning" style="text-align: center; font-weight: bold">
                    <?php echo array_shift($errors); ?>
                </div>             
            <?php elseif ($_FILES): ?>
                <div class="bg-success" style="text-align: center; font-weight: bold">
                    <?php echo $path . ' Слова - ' . $words . ' Символів - ' . $num_chars . ' Кількість стрічок - ' . $num_str ?>
                </div>
            <?php endif ?>

            <div class="well">
                <div style="text-align: center; display: inline-block; width: 48%; font-size:xx-large ;">
                    <?php echo $user['name']; ?>
                </div>
                <div style="text-align: center; display: inline-block; width: 48%;font-size:xx-large ; ">
                    <form action="/logout.php" method="post">
                        <button name="do_logout" class="btn btn-danger btn-lg" type="submit">Вихід</button>
                    </form>
                </div>
            </div>    
            <div class="well">

                <div class="form-group">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <br>
                        <input type="file" name="filename" size="9" class="form-control"/>    
                        <br>
                        <div style="text-align: center">
                            <button type="submit" class="btn btn-success btn-md" >Завантажити</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3"></div>
    </div>
</div>