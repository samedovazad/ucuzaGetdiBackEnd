<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>
    @include('admin.layouts.head')
</head>
<body data-open="click" data-menu="vertical-menu" data-col="1-column"
      class="vertical-layout vertical-menu 1-column  blank-page blank-page">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 m-0">
                        <div class="card-header no-border">
                            <div class="card-title text-xs-center">
                                <div class="p-1"><img src="{{ asset('assets/admin/images/logo/robust-logo-dark.png') }}"
                                                      alt="branding logo"></div>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block">
                                <form class="form-horizontal form-simple" action="{{ route('admin.login.process') }}" novalidate method="post">
                                    {{ csrf_field() }}
                                    <fieldset class="form-group position-relative has-icon-left mb-0" style="margin-bottom: 20px !important;">
                                        <input type="text" class="form-control form-control-lg input-lg" id="user-name"
                                               placeholder="Your Username" required name="username">
                                        <div class="form-control-position">
                                            <i class="icon-head"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="password" class="form-control form-control-lg input-lg"
                                               id="user-password" placeholder="Enter Password" required name="password">
                                        <div class="form-control-position">
                                            <i class="icon-key3"></i>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group row">
                                        <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                            <fieldset>
                                                <input type="checkbox" id="remember-me" class="chk-remember">
                                                <label for="remember-me"> Remember Me</label>
                                            </fieldset>
                                        </div>
                                    </fieldset>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i
                                                class="icon-unlock2"></i> Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

@include('admin.layouts.scripts')
</body>
</html>
