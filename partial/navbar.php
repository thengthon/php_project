<header>
    <div class="polygon">
    </div>
    <div class="menu-container d-flex justify-content-end">
        <div class="logo">
            <img src="pictures/logo3.png" alt="LOGO" id="logo">
        </div>
        <div class="navbar d-flex justify-content-between">
            <div class="menu">
                <a href="http://localhost/php_project">ទំព័រដើម</a>
                <a href="#news">ព្រឹត្តិការណ៍</a>
                <a href="#ministry">ក្រសួង</a>
                <a href="#donate">បរិច្ចាក</a>
            </div>
            <?php if(isset($_SESSION['user'])) : ?>
                <div class="s-l">
                    <a class="text-light"><?= $_SESSION['user'] ?></a>
                    <a class="btn btn-info"  data-toggle="modal" data-target="#add-post">បង្កើតពត៌មាន+</a>
                    <a href="authentication/logout.php" class="btn btn-warning">ចេញ</a>
                </div>
            <?php else : ?>
                <div class="s-l">
                    <a href="?page=signup" class="btn btn-warning">បង្កើតគណនី</a>
                    <a href="?page=login" class="btn btn-primary">ចូល</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>
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
                    <input type="hidden" value="0" name="activated">
                    <input type="hidden" value="<?= $_SESSION['userID'] ?>" name="userID">
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
                        <button type="reset" class="btn btn-warning">លុបចោល</button>
                        <button type="submit" class="btn btn-primary">បង្កើត+</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>