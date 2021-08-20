<?php 
    include_once('database/db.php');
    $data = get_users();
?>
<div class="user-container container" id="user">
    <div class="line d-flex justify-content-between mb-3">
        <div class="box-title-crud bg-dark text-center text-light fs-6 p-2">User <span class="bg-danger rounded-circle h-75 p-1 text-light"><?= mysqli_num_rows($data) ?></span></div>
        <div><a href="" class="btn btn-dark text-light" data-toggle="modal" data-target="#add-user">Add+</a></div>
        <!-- Modal -->
        <div class="modal fade" id="add-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Create User
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="model/create_model.php" method="POST" class="p-3">
                            <input type="hidden" value="user" name="table">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username..." name="username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Password..." name="password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email..." name="email" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <select name="role" id="" class="form-control">
                                    <option disabled selected>Role...</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="text-right">
                                <button type="reset" class="btn btn-warning">CLEAR</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Active</th>
                <th scope="col"  class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $user): ?>
            <tr>
                <th scope="row"><?= $user['userID'] ?></th>
                <td><?= $user['username'] ?></td>
                <td><?= $user['password'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['role'] ?></td>
                <td><?= $user['active'] ?></td>
                <td class="text-right">
                    <?php  if ($user['role'] == 'admin'): ?>
                        <h5>Administrator</h5>
                        <?php  else: ?>
                            <?php  if ($user['active']): ?>
                                <a href="" class="btn btn-warning">Disable</a>
                            <?php  else: ?>
                                <a href="" class="btn btn-info">Enable</a>
                            <?php  endif; ?>
                            <a href="model/delete_model.php?table=user&id=<?= $user['userID'] ?>" class="btn btn-danger">Remove</a>
                    <?php  endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>