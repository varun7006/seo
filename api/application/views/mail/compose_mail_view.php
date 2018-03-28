<div ng-if="isAjax == true"  id="loading-block"></div>
<section id="content-wrapper">
    <div class="site-content-title">
        <h2 class="float-xs-left content-title-main">Messages</h2>
        <!-- START BREADCRUMB -->
        <ol class="breadcrumb float-xs-right">
            <li class="breadcrumb-item">
                <span class="fs1" aria-hidden="true" data-icon=""></span>
                <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Layout</a></li>
            <li class="breadcrumb-item active">Messages</li>
        </ol>
        <!-- END BREADCRUMB -->
    </div>
    <div class="mailbox_main">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="content">
                <div class="mailbox-contain">
                    <div class="col-xl-2 col-lg-3 col-md-3 sidebar_block">
                        <div class="row">
                            <button aria-controls="collapseExample" aria-expanded="false"
                                    data-target="#collapseExample" data-toggle="collapse" type="button"
                                    class="mail-toggle">
                                Mailbox <span class="icon arrow_carrot-down float-xs-right"></span>
                            </button>
                            <div class="sidebar_contain collapse" id="collapseExample">
                                <div class="mail_btn">
                                    <button type="submit" class="btn btn-primary btn-block mail_compose_btn"
                                            id="compose_mail">Mail Box
                                    </button>
                                </div>
                                <ul class="mailbox_sidebar_contain">
                                    <li><a ui-sref=composemail><span class="icon_mail_alt" aria-hidden="true"></span>Compose</a></li>
                                    <li><a ui-sref=inbox><span class="icon_wallet" aria-hidden="true"></span>Inbox</a></li>
                                    <!--<li><a ui-sref=sentmail><span class="icon_mail_alt" aria-hidden="true"></span>Sent</a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-9 col-md-9 mail_view_block">
                        <div class="mailbox_right_contain">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="mail_view_title compose_title">
                                        <div class="compose-inputbox"><span>To :</span><input type="text" name="email" ng-model="mail.email"></div>
                                        <div class="compose_inputbox">
                                            <span>Subject:</span><input type="text" name="subject" ng-model="mail.subject">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-xs-12">
                                <div style="border: 1px solid #e2e2e2 !important;margin-top: 2%;height: 400px;overflow-y: auto;" text-angular ng-model="mail.message"   name="message" ta-text-editor-class="border-around container" ta-html-editor-class="border-around" required></div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group file-control-upload">
                                    <input ng-model="excelFile" style="height:35px;width:400px;padding:0px;" type="file" class="form-control  btn btn-success fileinput-button"  onchange="angular.element(this).scope().uploadedFile(this)">
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="reply_bottom">
                                    <button type="button" class="btn btn-primary" ng-click="sendNewMail('NEW')">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>

    </div>
</section>

