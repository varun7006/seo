<section id="content-wrapper">
   
    <div class="site-content-title">
        <h2 class="float-xs-left content-title-main">Messages</h2>
        
        <ol class="breadcrumb float-xs-right">
            <li class="breadcrumb-item">
                <span class="fs1" aria-hidden="true" data-icon=""></span>
                <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="#">Layout</a></li>
            <li class="breadcrumb-item active">Messages</li>
        </ol>
        
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="dashboard-header content">
                <h4 class="page-content-title float-xs-left">Chat</h4>
                <div class="dashboard-action">
                    <ul class="right-action float-xs-right">
                        <li data-widget="collapse"><a aria-hidden="true" href="javascript:void(0)"><span aria-hidden="true" class="icon_minus-06"></span></a></li>
                        <li data-widget="close"><a href="javascript:void(0)"><span aria-hidden="true" class="icon_close"></span></a></li>
                    </ul>
                </div>
                <div class="dashboard-box">
                    <div class="message-page">
                        <div class="message-rightbar">
                            <div class="row">
                                <div  ng-repeat="mails in mailList track by $index"> 
                                    <div class="col-md-12" ng-show="mails.message_by == client_id">
                                        <div class="chat-sender">
                                            <div class="row">
                                                <div class="col-xl-1 col-md-2 col-xs-3 col-sm-2 left-side">
                                                    <div class="chat-image">
                                                        <img alt="Friend image" src="assets/global/image/image3-profile.jpg" class="active-user">
                                                    </div>
                                                </div>
                                                <div class="col-xl-10 col-md-10 col-xs-9 col-sm-10 right-side">
                                                    <div class="chat-detail chat-arrow float-xs-left">
                                                        <h6>{{ mails.username}}</h6>
                                                        <p>{{ mails.message }}</p>
                                                        <!--<span class="chat-time">5.24pm</span>-->
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" ng-show ="mails.message_by != client_id">
                                        <div class="chat-receiver">
                                            <div class="row" >
                                                <div class="col-xl-11 col-md-10 col-xs-9 col-sm-10 right-side">
                                                    <div class="chat-detail chat-arrow float-xs-right">
                                                        <h6>{{ mails.username}}</h6>
                                                         <p>{{ mails.message }}</p>
                                                        <!--<span class="chat-time">5.30pm</span>-->
                                                    </div>

                                                </div>
                                                <div class="col-xl-1 col-md-2 col-xs-3 col-sm-2 left-side">
                                                    <div class="chat-image float-xs-right">
                                                        <img alt="Friend image" src="assets/global/image/image4-profile.jpg">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="type-message">
                                        <input ng-model="message" placeholder="Type a Messages" class="chat-input float-xs-left">
                                        <span class="chat-type float-xs-right"><a ng-click="sendNewMessage()"><i class="fa fa-paper-plane-o"></i></a></span>
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