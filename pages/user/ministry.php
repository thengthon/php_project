<div class="ministry-container container" id="ministry">
    <div class="line d-flex justify-content-center mb-3">
        <div class="box-title bg-dark text-center text-light fs-6 p-2">... អំពីក្រសួង ...</div>
    </div>
    <div class="all-ministries d-flex justify-content-center flex-wrap">
        <?php 
            include_once('database/db.php');
            $data = get_ministry();
            foreach($data as $ministry):
        ?>

        <div class="ministry mb-3 p-3 ml-2 mr-2 d-flex flex-column justify-content-between">
                <div>
                    <div class="min-logo text-center mb-3">
                        <img src="<?= $ministry['logo'] ?>" alt="">
                    </div>
                    <div class="minister mb-2">
                        <div class="min-profile d-flex align-items-end">
                            <img src="<?= $ministry['profile'] ?>" alt="">
                            <span class="ml-3 text-uppercase"><b><?= $ministry['ministerName'] ?></b></span>
                        </div>
                    </div>
                    <p><b>Ministry: </b><?= $ministry['ministryName'] ?></p>
                    <p><b>Mission: </b><?= $ministry['mission'] ?></p>
                </div>
                <div class="text-right">
                    <a href="<?= $ministry['website'] ?>" class="btn btn-warning mb-2" target="_blank">គេហទំព័រ</a></a>
                    <a href="#news" class="btn btn-danger gonews mb-2">ព្រឹត្តិការណ៍</a>
                </div>
        </div>

        <?php endforeach; ?>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <ul class="pagination m-auto">
            <li class="page-item"><a class="page-link disabled"><</a></li>
            <?php  
                $pages = get_numOf_pages_ministry();
                for($i = 1; $i <= $pages + 1; $i++):
            ?>
                <?php if((isset($_GET['pm']) && ($_GET['pm'] == $i)) || (!isset($_GET['pm']) && $i == 1)): ?>
                    <li style="z-index: -1;" class="page-item active"><a class="page-link" href="?pm=<?= $i ?>#ministry"><?= $i ?></a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="?pm=<?= $i ?>#ministry"><?= $i ?></a></li>
                <?php endif ?>
            <?php endfor ?>
            <li class="page-item"><a class="page-link disabled">></a></li>
        </ul>
    </div>
</div>