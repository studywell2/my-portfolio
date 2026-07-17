{{-- Live Chat Widget --}}
<div id="lc-toggle" class="lc-toggle">
    <i class="bi bi-chat-dots-fill"></i>
    <span class="lc-badge">Chat</span>
</div>

<div id="lc-window" class="lc-window">
    {{-- Header --}}
    <div class="lc-header">
        <div class="d-flex align-items-center gap-2">
            <div class="lc-avatar">
                <i class="bi bi-headset"></i>
            </div>
            <div>
                <div class="lc-name">Live Chat</div>
                <div class="lc-status">
                    <span class="lc-dot" id="lc-dot"></span>
                    <span id="lc-status-text">Online</span>
                </div>
            </div>
        </div>

        <button id="lc-close" class="lc-close" aria-label="Close chat">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    {{-- Messages --}}
    <div id="lc-messages" class="lc-messages">
        <div class="lc-welcome">
            <div class="lc-welcome-icon">
                <i class="bi bi-chat-heart-fill"></i>
            </div>

            <p class="lc-welcome-title">
                Welcome to Live Chat!
            </p>

            <p class="lc-welcome-text">
                Feel free to send a message and I'll get back to you as soon as possible.
            </p>
        </div>
    </div>

    {{-- Typing Indicator --}}
    <div id="lc-typing" class="lc-typing" style="display:none">
        <div class="lc-typing-avatar">
            <i class="bi bi-headset"></i>
        </div>

        <div class="lc-typing-bubble">
            <span class="lc-typing-dot"></span>
            <span class="lc-typing-dot"></span>
            <span class="lc-typing-dot"></span>
        </div>
    </div>

    {{-- Input Area --}}
    <div class="lc-input-area">

        <input
            type="text"
            id="lc-name"
            class="lc-name-input"
            placeholder="Your name (optional)"
            maxlength="50"
            autocomplete="off"
        >

        <div class="lc-input-row">
            <textarea
                id="lc-input"
                class="lc-input"
                placeholder="Type a message..."
                rows="1"
                autocomplete="off"
            ></textarea>

            <button id="lc-send" class="lc-send-btn" aria-label="Send message">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>

        <div class="lc-hint">
            Press Enter to send · Shift + Enter for new line
        </div>

    </div>
</div>