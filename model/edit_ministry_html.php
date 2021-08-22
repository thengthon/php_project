<?php include_once('../partial/header.php'); ?>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="w-50 m-auto text-center border border-danger p-5">
        <img src="../pictures/logo3.png" alt="LOGO" id="l-logo" style="width: 200; height: 100px;">
        <div>
            <?php
                include_once('../database/db.php');
                $id = $_GET['id'];
                $data = get_edit_ministry($id);
                foreach($data as $ministry):
            ?>
            <form action="edit_ministry_model.php" method="POST" enctype="multipart/form-data" class="p-3">
                <input type="hidden" value="<?= $ministry['ministryID'] ?>" name="id">
                <div class="form-group">
                    <input type="text" class="form-control" name="ministryName" placeholder="Name..." autocomplete="off" value="<?= $ministry['ministryName'] ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="website" placeholder="Website..." autocomplete="off" value="<?= $ministry['website'] ?>">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="mission" placeholder="Mission..."><?= $ministry['mission'] ?></textarea>
                </div>
                <div class="form-group">
                    <select name="ministerID" id="" class="form-control">
                        <option disabled selected>Minister...</option>
                        <?php 
                            include_once('database/db.php');
                            $ministers = get_ministers();
                            foreach($ministers as $minister):
                        ?>
                        <option value="<?= $minister['ministerID'] ?>"><?= $minister['ministerName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-danger">Update minister?</span>
                </div>
                <div class="form-group">
                    <!-- <label class="btn btn-info" for="file">Choose Logo (PNG, JPG)</label> -->
                    <input class="form-control" type="file" id="file" name="image" accept=".jpg, .jpeg, .png">
                    <span class="text-danger">Update logo? (PNG, JPG, JPEG)</span>
                </div>
                <div class="text-right">
                    <a href="http://localhost/php_project/?page=jokxiuhiusr23r23bb&s=sffsf234231#ministry" type="reset" class="btn btn-warning">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include_once('../partial/footer.php'); ?>