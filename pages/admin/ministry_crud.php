<?php 
    include_once('database/db.php');
    $data = get_ministries();
?>
<div class="ministry-container container" id="ministry">
    <div class="line d-flex justify-content-between mb-3">
        <div class="box-title-crud bg-dark text-center text-light fs-6 p-2">Ministry <span class="bg-danger rounded-circle h-75 p-1 text-light"><?= mysqli_num_rows($data) ?></span></div>
        <div><a href="" class="btn btn-dark text-light" data-toggle="modal" data-target="#add-ministry">Add+</a></div>
        <!-- Modal -->
        <div class="modal fade" id="add-ministry" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add Ministry
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="model/add_ministry_model.php" method="POST" enctype="multipart/form-data" class="p-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Ministry name..." autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="website" placeholder="Website..." autocomplete="off">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="mission" placeholder="Mission..."></textarea>
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
                                <span class="text-danger">Please add minister of this ministry first!</span>
                            </div>
                            <div class="form-group">
                                <!-- <label class="btn btn-info" for="file">Choose Logo (PNG, JPG)</label> -->
                                <input class="form-control" type="file" id="file" name="image" accept=".jpg, .jpeg, .png">
                                <span class="text-danger">Choose logo (PNG, JPG, JPEG)</span>
                            </div>
                            <div class="text-right">
                                <button type="reset" class="btn btn-warning">CLEAR</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="all-ministries d-flex justify-content-center flex-wrap">
        <?php foreach($data as $ministry): ?>
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
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="<?= $ministry['website'] ?>" target="_blank">Official</a></a>
                        <a href="" class="gonews pl-2">News</a>
                    </div>
                    <div>
                        <a href="model/edit_ministry_html.php?id=<?= $ministry['ministryID'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <a href="model/delete_model.php?table=ministry&id=<?= $ministry['ministryID'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>