<?php include_once('../partial/header.php'); ?>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="w-50 m-auto text-center border border-danger p-5">
        <img src="../pictures/logo3.png" alt="LOGO" id="l-logo" style="width: 200; height: 100px;">
        <div>
            <?php
                include_once('../database/db.php');
                $id = $_GET['id'];
                $data = get_edit_minister($id);
                foreach($data as $minister):
            ?>
            <form action="edit_minister_model.php" method="POST" enctype="multipart/form-data" class="p-3">
                <input type="hidden" value="<?= $minister['ministerID'] ?>" name="id">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name..." autocomplete="off" value="<?= $minister['ministerName'] ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email..." autocomplete="off" value="<?= $minister['email'] ?>">
                </div>
                <div class="form-group">
                    <!-- <label class="btn btn-info" for="file">Choose Profile (PNG, JPG)</label> -->
                    <input class="form-control" type="file" id="file" name="image" accept=".jpg, .jpeg, .png">
                    <span class="text-danger">Update Profile? (PNG, JPG, JPEG)</span>
                </div>
                <div class="text-right">
                    <a href="http://localhost/php_project/?page=1&s=1#minister" type="reset" class="btn btn-warning">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include_once('../partial/footer.php'); ?>