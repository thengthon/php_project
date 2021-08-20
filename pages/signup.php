<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="w-50 m-auto text-center border border-danger p-5">
        <img src="pictures/logo3.png" alt="LOGO" id="l-logo">
        <div>
            <form action="authentication/signup_model.php" method="POST" class="p-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="s-username" placeholder="Username/ឈ្មោះ"​ autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="s-password" placeholder="Password/លេខសម្ងាត់" autocomplete="off">
                </div>
                <div class="text-right">
                    <a href="http://localhost/php_project"​ class="btn btn-warning">ត្រឡប់</a>
                    <button type="submit" class="btn btn-primary">ចុះឈ្មោះ</button>
                </div>
            </form>
        </div>
    </div>
</div>