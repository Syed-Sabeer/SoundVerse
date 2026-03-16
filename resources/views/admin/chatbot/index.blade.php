@extends('layouts.app.master')

@section('title', 'Chatbot Conversations')

@section('css')
<style>
    .chatbot-stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .chatbot-stats-card h5 {
        color: white;
        margin-bottom: 10px;
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    .chatbot-stats-card .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
    }

    .chatbot-stats-card.success {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .chatbot-stats-card.info {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .chatbot-stats-card.warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .user-item {
        background: white;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
    }

    .user-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: #667eea;
    }

    .user-item.active {
        border-color: #667eea;
        background: #f0f4ff;
    }

    .user-name {
        font-weight: 600;
        color: #495057;
        margin-bottom: 5px;
        font-size: 1rem;
    }

    .user-email {
        color: #6c757d;
        font-size: 0.85rem;
        margin-bottom: 5px;
    }

    .user-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.75rem;
        color: #868e96;
        margin-top: 8px;
    }

    .conversation-container {
        background: white;
        border-radius: 8px;
        padding: 20px;
        max-height: 600px;
        overflow-y: auto;
        border: 1px solid #e9ecef;
    }

    .conversation-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
    }

    .conversation-header h4 {
        color: #495057;
        margin-bottom: 5px;
    }

    .conversation-header p {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 0;
    }

    .message {
        margin-bottom: 15px;
        padding: 12px 16px;
        border-radius: 18px;
        max-width: 80%;
        word-wrap: break-word;
    }

    .message.user {
        background: #667eea;
        color: white;
        margin-left: auto;
        border-bottom-right-radius: 6px;
    }

    .message.bot {
        background: #f1f3f4;
        color: #495057;
        margin-right: auto;
        border-bottom-left-radius: 6px;
    }

    .message-header {
        font-size: 0.75rem;
        margin-bottom: 5px;
        opacity: 0.8;
    }

    .message-content {
        line-height: 1.5;
    }

    .no-conversation {
        text-align: center;
        color: #6c757d;
        padding: 60px 20px;
        font-size: 1rem;
    }

    .loading {
        text-align: center;
        color: #6c757d;
        padding: 40px 20px;
    }

    .error-message {
        background: #f8d7da;
        color: #721c24;
        padding: 15px;
        border-radius: 8px;
        margin: 20px 0;
    }

    .users-list-container {
        max-height: 600px;
        overflow-y: auto;
    }
</style>
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Chatbot Conversations</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('AdminAssets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg></a></li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Chatbot Conversations</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="chatbot-stats-card">
                    <h5>Total Users</h5>
                    <div class="stat-value">{{ $totalUsers }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chatbot-stats-card success">
                    <h5>Total Messages</h5>
                    <div class="stat-value">{{ $totalMessages }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chatbot-stats-card info">
                    <h5>Active FAQs</h5>
                    <div class="stat-value">{{ $totalFAQs }}</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>👥 User List</h5>
                    </div>
                    <div class="card-body">
                        <div class="users-list-container" id="usersList">
                            @if($recentUsers->count() > 0)
                                @foreach($recentUsers as $user)
                                    <div class="user-item" data-session-id="{{ $user->session_id }}">
                                        <div class="user-name">{{ $user->name }}</div>
                                        <div class="user-email">{{ $user->email }}</div>
                                        <div class="user-meta">
                                            <span>{{ $user->message_count }} messages</span>
                                            <span>{{ \Carbon\Carbon::parse($user->last_message_at)->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="no-conversation">No users found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>💬 Conversation</h5>
                    </div>
                    <div class="card-body">
                        <div id="conversationContainer">
                            <div class="no-conversation">
                                Select a user to view their conversation
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

@endsection

@section('script')
<script>
    class AdminChatbotDashboard {
        constructor() {
            this.usersList = document.getElementById('usersList');
            this.conversationContainer = document.getElementById('conversationContainer');
            this.currentSessionId = null;
            
            this.init();
        }

        init() {
            this.bindEvents();
        }

        bindEvents() {
            // Handle user item clicks
            this.usersList.addEventListener('click', (e) => {
                const userItem = e.target.closest('.user-item');
                if (userItem) {
                    const sessionId = userItem.dataset.sessionId;
                    this.selectUser(sessionId);
                }
            });
        }

        selectUser(sessionId) {
            // Remove active class from all users
            document.querySelectorAll('.user-item').forEach(item => {
                item.classList.remove('active');
            });

            // Add active class to selected user
            const selectedUser = document.querySelector(`[data-session-id="${sessionId}"]`);
            if (selectedUser) {
                selectedUser.classList.add('active');
            }

            this.currentSessionId = sessionId;
            this.loadConversation(sessionId);
        }

        async loadConversation(sessionId) {
            this.conversationContainer.innerHTML = '<div class="loading">Loading conversation...</div>';
            
            try {
                const response = await fetch(`{{ route('admin.chatbot.conversation') }}?session_id=${sessionId}`);
                const data = await response.json();
                
                if (data.success) {
                    this.renderConversation(data.user_info, data.messages);
                } else {
                    this.showError('Failed to load conversation: ' + (data.error || 'Unknown error'));
                }
            } catch (error) {
                this.showError('Error loading conversation: ' + error.message);
            }
        }

        renderConversation(userInfo, messages) {
            if (!userInfo || messages.length === 0) {
                this.conversationContainer.innerHTML = '<div class="no-conversation">No conversation found</div>';
                return;
            }

            const conversationHTML = `
                <div class="conversation-header">
                    <h4>${this.escapeHtml(userInfo.name)}</h4>
                    <p>${this.escapeHtml(userInfo.email)}</p>
                </div>
                ${messages.map(message => `
                    <div class="message ${message.type}">
                        <div class="message-header">
                            ${this.escapeHtml(message.name)} • ${this.formatDate(message.created_at)}
                        </div>
                        <div class="message-content">
                            ${message.type === 'bot' ? message.message : this.escapeHtml(message.message)}
                        </div>
                    </div>
                `).join('')}
            `;

            this.conversationContainer.innerHTML = conversationHTML;
            // Scroll to bottom
            this.conversationContainer.scrollTop = this.conversationContainer.scrollHeight;
        }

        formatDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffTime = Math.abs(now - date);
            const diffMinutes = Math.floor(diffTime / (1000 * 60));
            const diffHours = Math.floor(diffTime / (1000 * 60 * 60));
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffMinutes < 1) {
                return 'Just now';
            } else if (diffMinutes < 60) {
                return `${diffMinutes} minute${diffMinutes > 1 ? 's' : ''} ago`;
            } else if (diffHours < 24) {
                return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
            } else if (diffDays === 1) {
                return 'Yesterday';
            } else if (diffDays < 7) {
                return `${diffDays} days ago`;
            } else {
                return date.toLocaleDateString();
            }
        }

        escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        showError(message) {
            this.conversationContainer.innerHTML = `
                <div class="error-message">
                    ${this.escapeHtml(message)}
                </div>
            `;
        }
    }

    // Initialize dashboard when page loads
    document.addEventListener('DOMContentLoaded', () => {
        new AdminChatbotDashboard();
    });
</script>
@endsection
