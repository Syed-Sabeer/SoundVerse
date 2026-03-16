 <!-- Start of Background Animation -->
 <!-- <div id="vantajs-bg"></div> -->
    <!-- End of Background Animation -->

    <div class="overlay-body">
        <!-- Start of Page Loader-->
        <!-- <div class="page-loader">
            <img src="{{asset('FrontendAssets/images/singWithMe/logo-trans.png')}}" alt="" >
        </div> -->
        <!-- End of Page Loader-->

        <div class="chatbot-container">
            <div class="chatbot-toggle" id="chatbotToggle">
                <img  style="cursor:pointer;" src="{{asset('FrontendAssets/images/singWithMe/Sayhinow.gif')}}" alt="" width="100px">
            </div>
            
            <div class="chatbot-widget" id="chatbotWidget">
                <!-- User Info Form (shown before chat starts) -->
                <div class="chatbot-user-info" id="chatbotUserInfo">
                    <div class="chatbot-header">
                        <div class="bot-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="bot-info">
                            <h3>Welcome to Chat Support</h3>
                            <p>Please provide your details to continue</p>
                        </div>
                        <button class="close-btn" id="closeChatbotForm">×</button>
                    </div>
                    <div class="chatbot-form-body">
                        <form id="userInfoForm">
                            <div class="form-group">
                                <label for="userName">Your Name <span class="text-danger">*</span></label>
                                <input type="text" id="userName" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <label for="userEmail">Your Email <span class="text-danger">*</span></label>
                                <input type="email" id="userEmail" name="email" placeholder="Enter your email" required>
                            </div>
                            <button type="submit" class="btn-start-chat">Start Chat</button>
                        </form>
                    </div>
                </div>

                <!-- Chat Interface (shown after user info is provided) -->
                <div class="chatbot-chat-interface" id="chatbotChatInterface" style="display: none;">
                    <div class="chatbot-header">
                        <div class="bot-icon">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="bot-info">
                            <h3>Customer Support</h3>
                            <p>• Online</p>
                        </div>
                        <button class="close-btn" id="closeChatbot">×</button>
                    </div>
                    
                    <div class="chatbot-body" id="chatbotBody">
                        <div class="welcome-message">
                            👋 Hello! How can I help you today?
                        </div>
                        <div class="chat-messages" id="chatMessages"></div>
                        <div class="typing-indicator" id="typingIndicator">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    
                    <div class="chatbot-input">
                        <div class="input-group">
                            <input type="text" id="messageInput" placeholder="Type your message..." maxlength="1000">
                            <button id="sendButton">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>