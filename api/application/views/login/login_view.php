<!--<div class="login_page">
    <div class="page-wrapper" >
        <div class="container-fluid">

             Title 
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-default card-view" style="align-content: center !important;">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">default form</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="form-wrap">
                                    <form name="loginForm">
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="email_de">email:</label>
                                            <input type="email" class="form-control" id="email_de" name="email" ng-model="email" ng-pattern = "/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" required>
                                            <span style="color:Red" ng-show="loginForm.email.$dirty&&loginForm.email.$error.pattern">Please Enter Valid Email</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-10" for="pwd_de" >Password:</label>
                                            <input type="password" class="form-control" id="pwd_de" name="password" ng-model="password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox_de" type="checkbox">
                                                <label for="checkbox_de">
                                                    remember me
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <button type="button" class="btn btn-success btn-anim" ng-disabled="email == '' || password =='' || loginForm.email.$error.pattern" ng-click="checkUserLogin()"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                                        </div>	
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>
    </div>

</div>-->

<link rel="stylesheet" href="assets/pages/global/css/global.css" />
<link rel="stylesheet" href="assets/pages/login/login-v2/css/login_v2.css" />

<div class="login_v2">
    <div class="login_v2_main">
        <div class="login_v2_contain">
            <div class="login_v2_form text-xs-center">
                <i class="login_v2_profile_icon icon icon_lock"></i>
                <h5>Sign into your account</h5>
                <form name="loginForm">
                    <div class="login_v2_text_field">
                        <input type="text" id='email' name="email" placeholder="Enter email" ng-model="email" ng-pattern = "/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" required><i class="icon icon_mail"></i>
<!--                        <span style="color:Red" ng-show="loginForm.email.$dirty && loginForm.email.$error.pattern">Please Enter Valid Email</span>-->
                    </div>
                    <div class="login_v2_text_field">
                        <input type="password" id='password' name='password' placeholder="Password" ng-model="password" required>
                        <i class="icon icon_key"></i>
                    </div>
                    <div class="checkbox-login login_v2_check">
                        <div class="checkbox-squared">
                            <input value="None" id="checkbox-squared1" name="check" type="checkbox">
                            <label for="checkbox-squared1"></label>
                            <span>Remember me</span>
                        </div>
                    </div>
                    <div class="login_v2_forget_text">
                        <a href="forgot_password_v2.html">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" ng-disabled="email == '' || password =='' || loginForm.email.$error.pattern" ng-click="checkUserLogin()">Sign in</button>
                    <div class="login_v2_sign_link">
                        <i class="arrow_back"></i>
                        Create A New Account? Go to <a href="register_v2.html">register.</a>
                    </div>
                </form>
            </div>
            <div class="login_v2_reserved_text text-xs-center bold-fonts">
                <p>© 2017. all right reserved.</p>
            </div>
        </div>
    </div>
</div>



