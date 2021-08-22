<?php 
    include_once('database/db.php');
    $data = get_inactivated_news();
?>
<div class="news-container container">
    <div class="line d-flex justify-content-between mb-3">
        <div class="box-title-crud inactivated bg-dark text-center text-light fs-6 p-2">Need Your Check <span class="bg-danger rounded-circle h-75 p-1 text-light"><?= mysqli_num_rows($data) ?></span></div>
    </div>

    <?php
        $n_id = -1;
        if(isset($_GET['n_a_id'])) {
            $n_id = $_GET['n_a_id'];
        }
        $d_a_data = get_detail_a_post($n_id);
        foreach($d_a_data as $d_a_news):
    ?>
    <div class="d-news-card mb-3 p-3"​ style="width: 100%; border: 2px solid red; border-radius: 15px;">
        <div class="d-flex border-bottom border-dark pb-3">
            <div class="mr-2">
                <img src="<?= $d_a_news['photo'] ?>" alt="" 
                    style="width: 200px;
                        height: 155px;
                        border-radius: 5px;
                        border: 2px solid blue;">
            </div>
            <div>
                <em><b><?= $d_a_news['title'] ?> .....</b></em><br><br>
                <p><?= $d_a_news['content'] ?></p>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <p><b>ដោយ</b> <?= $d_a_news['username'] ?></p>
            <p><i class="fa fa-clock-o"></i> <?= $d_a_news['date'] ?></p>
        </div>
        <p><b>ស្ថិតក្រោម</b> <?= $d_a_news['ministryName'] ?></p>
    </div>
    <?php endforeach; ?>

    <div class="all-news d-flex justify-content-center flex-wrap">
        <?php foreach($data as $news): ?>
        <div class="news-card mb-3 p-3 ml-2 mr-2 d-flex flex-column justify-content-between"​>
            <div>
                <div class="d-flex flex-wrap border-bottom border-dark pb-3">
                    <div class="mr-2">
                        <img src="<?= $news['photo'] ?>" alt="">
                    </div>
                    <div>
                        <em><b><?= $news['title'] ?> .....</b></em><br><br>
                        <p><?= substr($news['content'], 0, 300) ?></p>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <p><b>ដោយ</b> <?= $news['username'] ?></p>
                    <p><i class="fa fa-clock-o"></i> <?= $news['date'] ?></p>
                </div>
                <p><b>ស្ថិតក្រោម</b> <?= $news['ministryName'] ?></p>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <a href="http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231&n_a_id=<?= $news['postID'] ?>" class="btn btn-info">Detail</i></a>
                    <a href="model/enable_news.php?id=<?= $news['postID'] ?>" class="btn btn-primary">Enable</i></a>

                </div>
                <div>
                    <a href="model/edit_post_html.php?id=<?= $news['postID'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                    <a href="model/delete_model.php?table=post&id=<?= $news['postID'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>