<?php 
    include_once('database/db.php');
    $data = get_ministers();
?>
<div class="minister-container container" id="minister">
    <div class="line d-flex justify-content-between mb-3">
        <div class="box-title-crud bg-dark text-center text-light fs-6 p-2">Minister <span class="bg-danger rounded-circle h-75 p-1 text-light"><?= mysqli_num_rows($data) ?></span></div>
        <div><a href="" class="btn btn-dark text-light" data-toggle="modal" data-target="#add-minister">Add+</a></div>
        <!-- Modal -->
        <div class="modal fade" id="add-minister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Add Minister
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="model/add_minister_model.php" method="POST" enctype="multipart/form-data" class="p-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name..." autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Email..." autocomplete="off">
                            </div>
                            <div class="form-group">
                                <!-- <label class="btn btn-info" for="file">Choose Profile (PNG, JPG)</label> -->
                                <input class="form-control" type="file" id="file" name="image" accept=".jpg, .jpeg, .png">
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
    <div class="all-ministers d-flex justify-content-center flex-wrap">
        <?php foreach($data as $minister): ?>
        <div class="minister-card mb-3 p-3 ml-2 mr-2">
            <table>
                <tr>
                    <td rowspan="4" class="pr-3"><img src="<?= $minister['profile'] ?>" alt=""></td>
                    <td>Name</td>
                    <td class="pl-2 pr-2">:</td>
                    <td><?= $minister['ministerName'] ?></td>
                </tr>
                <tr>
                    <td>Ministry</td>
                    <td class="pl-2 pr-2">:</td>
                    <?php if(isset($minister['ministryName'])): ?> 
                        <td><?= $minister['ministryName'] ?></td>
                    <?php else: ?> 
                        <td>N/A</td>
                    <?php endif; ?> 
                </tr>
                <tr>
                    <td>Email</td>
                    <td class="pl-2 pr-2">:</td>
                    <td><?= $minister['email'] ?></td>
                </tr>
                <tr>
                    <td>#ID</td>
                    <td class="pl-2 pr-2">:</td>
                    <td><?= $minister['ministerID'] ?></td>
                </tr>
            </table>
            <div class="text-right">
                <a href="model/edit_minister_html.php?id=<?= $minister['ministerID'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                <a href="model/delete_model.php?table=minister&id=<?= $minister['ministerID'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>