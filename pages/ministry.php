<div class="ministry-container container">
    <div class="line d-flex justify-content-center mb-3">
        <div class="box-title bg-dark text-center text-light fs-6 p-2">... អំពីក្រសួង ...</div>
    </div>
    <div class="all-ministries d-flex justify-content-center flex-wrap">
        <?php 
            include_once('database/db.php');
            $data = get_ministries();
            foreach($data as $ministry):
        ?>

        <div class="ministry mb-3 p-3 ml-2 mr-2 d-flex flex-column justify-content-between">
                <div>
                    <div class="min-logo text-center">
                        <img src="<?= $ministry['logo'] ?>" alt="">
                    </div>
                    <div class="minister mb-2">
                        <div class="min-profile d-flex align-items-end">
                            <img src="<?= $ministry['profile'] ?>" alt="">
                            <span class="ml-3 text-uppercase"><b><?= $ministry['ministerName'] ?></b></span>
                        </div>
                    </div>
                    <p><b>Mission: </b><?= $ministry['mission'] ?></p>
                </div>
                <div class="text-right">
                    <a href="<?= $ministry['website'] ?>" class="btn btn-warning" target="_blank">គេហទំព័រ</a></a>
                    <a href="" class="btn btn-danger gonews">ព្រឹត្តិការណ៍</a>
                </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>