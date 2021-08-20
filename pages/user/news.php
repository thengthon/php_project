<div class="news-container container" id="news">
    <div class="line d-flex justify-content-center mb-3">
        <div class="box-title bg-dark text-center text-light fs-6 p-2">... ព្រឹត្តិកាណ៍ ...</div>
    </div>
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
                    <td><a href="" class="btn btn-primary">Detail</a></td>
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
                <li class="page-item"><a class="page-link" href="?p=<?= $i ?>#news"><?= $i ?></a></li>
            <?php endfor ?>
            <li class="page-item"><a class="page-link disabled">></a></li>
        </ul>
    </div>
</div>