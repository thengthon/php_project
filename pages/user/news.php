<div class="news-container container" id="news">
    <div class="line d-flex justify-content-center mb-3">
        <div class="box-title bg-dark text-center text-light fs-6 p-2">... ព្រឹត្តិកាណ៍ ...</div>
    </div>
    <?php include_once('news_detail.php'); ?>
    <div class="all-news d-flex justify-content-center flex-wrap">
        <?php 
            include_once('database/db.php');
            $data = get_post();
            foreach($data as $news):
        ?>

        <div class="news mb-3 p-3 ml-2 mr-2">
            <table>
                <tr>
                    <td colspan="2" class="text-center pb-2"><img src="<?= $news['photo'] ?>" alt=""></td>
                </tr>
                <tr>
                    <td><b><?= $news['title'] ?> .....<br><br></b></td>
                </tr>
                <tr>
                    <td><div class="border-bottom border-dark pt-3​​ mb-2"></div><td>
                </tr>
                <tr class="d-flex justify-content-between">
                    <td><i class="fa fa-clock-o"></i> <?= $news['date'] ?></td>
                    <td><a href="?n_id=<?= $news['postID'] ?>#news" class="btn btn-primary">Detail</a></td>
                </tr>
            </table>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <ul class="pagination m-auto">
            <li class="page-item"><a class="page-link disabled"><</a></li>
            <?php  
                $pages = get_numOf_pages_post();
                for($i = 1; $i <= $pages + 1; $i++):
            ?>
                <?php if((isset($_GET['p']) && ($_GET['p'] == $i)) || (!isset($_GET['p']) && $i == 1)): ?>
                    <li style="z-index: -1;" class="page-item active"><a class="page-link" href="?p=<?= $i ?>#news"><?= $i ?></a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="?p=<?= $i ?>#news"><?= $i ?></a></li>
                <?php endif ?>
            <?php endfor ?>
            <li class="page-item"><a class="page-link disabled">></a></li>
        </ul>
    </div>
</div>





<!-- <div class="col-sm-6 mb-4">
    <div class="card">
        <img class="card-img-top" src="assets/images/<?=$item['img_url']?>" alt="Card image cap" width="200px" height="300px">
        <div class="card-body">
                <h5 class="card-title"><?=$item['title']?></h5>
                <small><?=$item['date']?></small>
                <p class="card-text"><?= substr($item['description'],0,150)?>...</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?= $i; ?>">
                Read more
                </button>
                <div class="modal fade bd-example-modal-lg" id="myModal-<?= $i; ?>" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><?=$item['title']?></h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <p class="card-text ml-2"><small class="text-muted"><?=$item['date']?></small></p>
                        <img class="card-img-top" src="assets/images/<?=$item['img_url']?>" alt="Card image cap">
                        <div class="modal-body">
                        <?= $item['description']?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div> -->