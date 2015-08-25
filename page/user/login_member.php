
<div class="ui-content" data-role="main">
    <h3>Login Pembeli</h3>
    <form action="index.php?user=login_member_finish" method="post" id="form-login">
        <div class="ui-field-contain">
            <label for="username">Username :</label>
            <input type="text" name="username" data-clear-btn="true" id="username" placeholder="Username" class="required"/>
        </div>
        <div class="ui-field-contain">
            <label for="password">Password :</label>
            <input type="password" name="password" data-clear-btn="true" id="password" placeholder="Password" class="required"/>
        </div>
        <button type="submit"class="ui-shadow ui-btn ui-corner-all ui-icon-forward ui-btn-icon-left ui-btn-inline ui-mini" name="Login">Login</button>
    </form>
    <script type="text/javascript">
        $('#form-login').validate({
            messages:{
                username:{
                    required:"Username harus diisi !!"
                },
                password:{
                    required:"Password harus diisi !!"
                }
            }
        });
    </script>
</div>