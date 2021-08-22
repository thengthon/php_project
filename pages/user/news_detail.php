<?php 
    include_once('database/db.php');
    $id = -1;
    if(isset($_GET['n_id'])) {
        $id = $_GET['n_id'];
    }
    $d_data = get_detail_post($id);
    foreach($d_data as $d_news):
?>
<div class="d-news-card mb-3 p-3"​ style="width: 100%; border: 2px solid red; border-radius: 15px;">
    <div class="d-flex border-bottom border-dark pb-3">
        <div class="mr-2">
            <img src="<?= $d_news['photo'] ?>" alt="" 
                style="width: 200px;
                    height: 155px;
                    border-radius: 5px;
                    border: 2px solid blue;">
        </div>
        <div>
            <em><b><?= $d_news['title'] ?> .....</b></em><br><br>
            <p><?= $d_news['content'] ?></p>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <p><b>ដោយ</b> <?= $d_news['username'] ?></p>
        <p><i class="fa fa-clock-o"></i> <?= $d_news['date'] ?></p>
    </div>
    <p><b>ស្ថិតក្រោម</b> <?= $d_news['ministryName'] ?></p>
</div>
<?php endforeach; ?>