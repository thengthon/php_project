<?php 
    include_once('database/db.php');
    $data = get_news();
?>
<div class="news-container container" id="post">
    <div class="line d-flex justify-content-between mb-3">
        <div class="box-title-crud bg-dark text-center text-light fs-6 p-2">News <span class="bg-danger rounded-circle h-75 p-1 text-light"><?= mysqli_num_rows($data) ?></span></div>
        <div><a class="btn btn-dark text-light" data-toggle="modal" data-target="#add-post">Add+</a></div>
        <!--Create Modal -->
        <div class="modal fade" id="add-post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Create Post
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="model/create_post_model.php" method="POST" enctype="multipart/form-data" class="p-3">
                            <div class="form-group">
                                <textarea class="form-control" name="title" placeholder="Title..."></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="content" placeholder="Content..."></textarea>
                            </div>
                            <div class="form-group">
                                <select name="ministryID" id="" class="form-control">
                                    <option disabled selected>Under Ministry...</option>
                                    <?php 
                                        include_once('database/db.php');
                                        $ministries = get_ministries();
                                        foreach($ministries as $ministry):
                                            ?>
                                    <option value="<?= $ministry['ministryID'] ?>"><?= $ministry['ministryName'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger">Which ministry are you talking about?</span>
                            </div>
                            <div class="form-group">
                                <!-- <label class="btn btn-info" for="file">Choose image (PNG, JPG)</label> -->
                                <input class="form-control" type="file" id="file" name="image" accept=".jpg, .jpeg, .png">
                                <span class="text-danger">Choose image (PNG, JPG, JPEG)</span>
                            </div>
                            <div class="text-right">
                                <button type="reset" class="btn btn-warning">CLEAR</button>
                                <button type="submit" class="btn btn-primary">POST</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="all-news d-flex justify-content-center flex-wrap">
        <?php foreach($data as $news): ?>
        <div class="news-card mb-3 p-3 ml-2 mr-2 d-flex flex-column justify-content-between"​ style="width:47%;">
            <div>
                <div class="d-flex border-bottom border-dark pb-3">
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
            <div class="text-right">
                <a href="" class="btn btn-info">Detail</i></a>
                <a href="model/edit_post_html.php?id=<?= $news['postID'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                <a href="model/delete_model.php?table=post&id=<?= $news['postID'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>