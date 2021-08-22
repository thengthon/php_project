<?php include_once('../partial/header.php'); ?>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="w-50 m-auto text-center border border-danger p-5">
        <img src="../pictures/logo3.png" alt="LOGO" id="l-logo" style="width: 200; height: 100px;">
        <div>
            <?php
                include_once('../database/db.php');
                $id = $_GET['id'];
                $data = get_edit_news($id);
                foreach($data as $news):
            ?>
            <form action="edit_post_model.php" method="POST" enctype="multipart/form-data" class="p-3">
                <input type="hidden" value="<?= $news['postID'] ?>" name="id">
                <div class="form-group">
                    <textarea class="form-control" name="title" placeholder="Title..."><?= $news['title'] ?></textarea>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="content" placeholder="Content..."><?= $news['content'] ?></textarea>
                </div>
                <div class="form-group">
                    <select name="ministryID" id="" class="form-control">
                        <option disabled selected>Under Ministry...</option>
                        <?php
                            $data = get_ministries();
                            foreach($data as $ministry):
                                ?>
                        <option value="<?= $ministry['ministryID'] ?>"><?= $ministry['ministryName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-danger">Update ministry?</span>
                </div>
                <div class="form-group">
                    <!-- <label class="btn btn-info" for="file">Choose image (PNG, JPG)</label> -->
                    <input class="form-control" type="file" id="file" name="image" accept=".jpg, .jpeg, .png">
                    <span class="text-danger">Update image? (PNG, JPG, JPEG)</span>
                </div>
                <div class="text-right">
                    <a href="http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231#news" type="reset" class="btn btn-warning">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include_once('../partial/footer.php'); ?>