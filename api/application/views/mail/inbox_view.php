<section id="content-wrapper">
    <!-- START PAGE TITLE -->
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
    <!-- END PAGE TITLE -->
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
                    <div class="col-xl-10 col-lg-9 col-md-9 right_sidebar_contain">
                        <div class="mailbox_right_contain">
                            <table class="table mail_table">
                                <tbody>
                                <tbody>
                                    <tr class="active-table" ng-repeat="mails in mailList" >
                                        <td class="mail_message" ng-click="viewMail(mails.parent_mail_id,mails.user_id)">

                                            <div class="inbox-left float-xs-left">
                                                <img src="assets/global/image/image4-profile.jpg"
                                                     alt="Profile image">
                                            </div>
                                            <div class="float-xs-left user-name-mail">{{ mails.name}}</div>
                                            <div class="float-xs-right main-title-mailbox">
                                                <span class="float-xs-left">
                                                    <span class="mail_title">{{ mails.message | limitTo: 10 }}</span></a>
                                                    <span
                                                        class="tag square-tag tag-danger float-xs-left">Friend</span>
                                                    <span class="des-mail-box">{{ mails.message | limitTo: 30 }}</span>
                                            </div>

                                        </td>
                                        <td class="mail_link text-xs-center">
                                            <a href="javascript:void(0)"><i class="icon icon_link_alt"></i></a>
                                        </td>
                                        <td class="mail-time text-xs-right">
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>
        <div class="mail_compose_main pop">
            <div class="content">
                <div class="mail_view_title compose_title">
                    <div class="compose-inputbox"><span>To :</span><input type="text" name="email"><a href="javascript:void(0)" class="compose_close float-xs-right"><i
                                class="icon icon_close"></i></a></div>
                    <div class="compose_inputbox">
                        <span>Subject :</span><input type="text" name="subject">
                    </div>
                    <div class="compose-inputbox"><span>Cc/Bcc :</span><input type="text" name="email"></div>
                </div>
                <div class="compose_message">
                    <textarea id="send-mail" data-height="150" data-plugin="simplemarkdown"
                              data-spell-checker="false"></textarea>
                </div>
                <div class="compose_btn">
                    <button type="button" class="btn btn-primary">Send</button>
                    <input name="file_link[]" id="file_link" multiple="" type="file">
                    <label for="file_link" class="btn btn-primary"><i
                            class="icon icon_link_alt"></i></label>
                    <a href="javascript:void(0)" class="mail_trash float-xs-right"><i
                            class="icon icon_trash_alt"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>