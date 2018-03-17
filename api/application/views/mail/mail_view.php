<div ng-if="isAjax == true"  id="loading-block"></div>
<section id="content-wrapper">
    <!-- START PAGE TITLE -->
    <div class="site-content-title">
        <h2 class="float-xs-left content-title-main">View Mail</h2>
        <!-- START BREADCRUMB -->
        <ol class="breadcrumb float-xs-right">
            <li class="breadcrumb-item">
                <span class="fs1" aria-hidden="true" data-icon=""></span>
                <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active"></li>
        </ol>
        <!-- END BREADCRUMB -->
    </div>
    <!-- END PAGE TITLE -->
    <div class="mailbox_main">
        <div class="col-xl-12 col-lg-12 col-md-12">

            <div class="content">
                <div class="mailbox-header">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="inbox-left float-xs-left"><img alt="Profile image" src="assets/global/image/user.jpg"></div>
                            <div class="right-mailbox float-xs-left">
                                <h3>Miler Hussey</h3>
                                <h4>Mailbox</h4>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <div class="col-xl-10 col-lg-9 col-md-9 right-sidebar_block mail_view_block">
                        <div class="mailbox_right_contain">

                            <div class="mail_massage">
                                <div class="accordion-test">
                                    <accordion close-others="oneAtATime">
                                        <accordion-group is-open="true" heading="{{mail.username}}" ng-repeat="mail in mailList">
                                            <div class="col-xl-12">
                                                <div class="row">
                                                    <div class="inbox-left float-xs-left"><img alt="Profile image" src="assets/global/image/user.jpg"></div>
                                                    <div class="mail_view_title">
                                                        <span class="float-xs-left">From :</span><h6>Derick -
                                                            derick@example.com</h6>
                                                        <span class="float-xs-left">Subject :</span>
                                                        <p>Lorem ipsum dolor noretek imit set. <span class="tag square-tag tag-success">example</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            {{mail.message}}
                                        </accordion-group>
                                    </accordion>
                                </div>    
                            </div>
                            <div class="mail_reply_button float-xs-left">
                                <button type="button" class="btn btn-primary mail_reply_btn" id="mail_reply" ng-click="sendReply()"><i class="icon fa fa-mail-reply"></i>Reply</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12" ng-show="reply==true">
                            <div class="row">
                                <div class="reply_main_block show_relpy">
                                    <div class="reply_to">
                                        <span class="float-xs-left">To :</span><h6>{{ replyMailId }}</h6>
                                    </div>
                                    <div class="reply_massage">
                                        <div style="border: 1px solid #e2e2e2 !important;margin-top: 2%;height: 400px;overflow-y: auto;" text-angular ng-model="message"   name="message" ta-text-editor-class="border-around container" ta-html-editor-class="border-around" required></div>
                                    </div>
                                    <div class="reply_bottom">
                                        <button type="button" class="btn btn-primary" ng-click="sendReplyMail()">Send</button>
                                        <button type="button" class="btn btn-primary" id="mail_reply_cancel" ng-click="hideReply()">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>