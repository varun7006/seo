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
                <div class="mailbox-header">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="inbox-left float-xs-left"><img alt="Profile image"
                                                                       src="assets/global/image/user.jpg">
                            </div>
                            <div class="right-mailbox float-xs-left">
                                <h3>Miler Hussey</h3>
                                <h4>Contact List</h4>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <form action="#" class="mail_search float-xs-right">
                                <div class="input-group">
                                    <input id="search" type="text" class="form-control" name="search"
                                           placeholder="search..">
                                    <a href="#" class="input-group-addon search_icon"><i
                                            class="icon icon_search"></i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mailbox-contain">
                    <div class="col-xl-10 col-lg-9 col-md-9 right_sidebar_contain">
                        <div class="mailbox_right_contain">
                            <table class="table mail_table">
                                <tbody>
                                <tbody>
                                    <tr class="active-table" ng-repeat="mails in mailList" >
                                        <td class="mail_message" ng-click="viewMail(mails.message_by)">

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
                                            7 Nov 2016
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!--                            <div class="pagination_with_gap text-xs-right mail_pagination">
                                                            <ul class="pagination">
                                                                <li class="page-item">
                                                                    <a href="javascript:void(0)"
                                                                       class="page-link pagination_link" aria-label="Previous">
                                                                        <span aria-hidden="true">«</span>
                                                                    </a>
                                                                </li>
                                                                <li class="page-item active"><a href="javascript:void(0)"
                                                                                                class="page-link pagination_link">1</a>
                                                                </li>
                                                                <li class="page-item"><a href="javascript:void(0)"
                                                                                         class="page-link pagination_link">2</a></li>
                                                                <li class="page-item"><a href="javascript:void(0)"
                                                                                         class="page-link pagination_link">3</a></li>
                                                                <li class="page-item"><a href="javascript:void(0)"
                                                                                         class="page-link pagination_link">4</a></li>
                                                                <li class="page-item">
                                                                    <a href="javascript:void(0)"
                                                                       class="page-link pagination_link" aria-label="Next">
                                                                        <span aria-hidden="true">»</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>-->
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