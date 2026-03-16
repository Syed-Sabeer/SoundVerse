
     
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('FrontendAssets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('FrontendAssets/css/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('FrontendAssets/css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('FrontendAssets/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('FrontendAssets/css/style.css')}}">

        <style>
      
        
        //.header {
            //background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            //color: white;
           // padding: 40px;
           // text-align: center;
       // }
        
        .header h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }
        
        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .content {
            padding: 40px;
            min-height: 400px;
        }
        
        .chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        #messageInput{
            color: black;
        }
        .chatbot-toggle {
            width: 100px;
            height: 60px;
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        
        .chatbot-toggle:hover {
            transform: scale(1.1);
        }
        
        .chatbot-toggle svg {
            width: 30px;
            height: 30px;
            color: white;
        }
        
        .chatbot-widget {
            position: absolute;
            bottom: 80px;
            right: 0;
            width: 350px;
            height: 500px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            display: none;
            flex-direction: column;
            overflow: hidden;
        }
        
        .chatbot-widget.active {
            display: flex;
        }
        
        .chatbot-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .chatbot-header .bot-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .chatbot-header .bot-info h3 {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }
        
        .chatbot-header .bot-info p {
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .chatbot-header .close-btn {
            margin-left: auto;
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .chatbot-body {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f8f9fa;
        }
        
        .chat-messages {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .message {
            max-width: 80%;
            padding: 12px 16px;
            border-radius: 18px;
            word-wrap: break-word;
        }
        
        .message.user {
            background: #667eea;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 6px;
        }
        
        .message.bot {
            background: white;
            color: #333;
            align-self: flex-start;
            border-bottom-left-radius: 6px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .chatbot-input {
            padding: 20px;
            background: white;
            border-top: 1px solid #eee;
        }
        
        .input-group {
            display: flex;
            gap: 10px;
        }
        
        .input-group input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid #eee;
            border-radius: 25px;
            outline: none;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        
        .input-group input:focus {
            border-color: #667eea;
        }
        
        .input-group button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .input-group button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .input-group button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        
        .typing-indicator {
            display: none;
            align-self: flex-start;
            background: white;
            padding: 12px 16px;
            border-radius: 18px;
            border-bottom-left-radius: 6px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .typing-indicator span {
            display: inline-block;
        }

        /* User Info Form Styles */
        .chatbot-user-info {
            display: block;
        }

        .chatbot-chat-interface {
            display: none;
        }

        .chatbot-form-body {
            padding: 20px;
            background: white;
        }

        .chatbot-form-body .form-group {
            margin-bottom: 20px;
        }

        .chatbot-form-body .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .chatbot-form-body .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #eee;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        .chatbot-form-body .form-group input:focus {
            border-color: #667eea;
        }

        .chatbot-form-body .text-danger {
            color: #e74c3c;
        }

        .btn-start-chat {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-start-chat:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-start-chat:active {
            transform: translateY(0);
        }
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #999;
            margin: 0 2px;
            animation: typing 1.4s infinite ease-in-out;
        }
        
        .typing-indicator span:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .typing-indicator span:nth-child(3) {
            animation-delay: 0.4s;
        }
        
        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-10px); }
        }
        
        .welcome-message {
            text-align: center;
            color: #666;
            font-style: italic;
            margin: 20px 0;
        }
        @media only screen and (max-width: 660px) {
        .chatbot-toggle {
            display: none;
        }
    </style>
<style>
</style>
@yield('css')
@yield('styles')
