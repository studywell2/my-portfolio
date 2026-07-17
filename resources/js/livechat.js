// ===========================================
// Live Chat Widget
// ===========================================

document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('lc-toggle');
    const windowEl = document.getElementById('lc-window');
    const closeBtn = document.getElementById('lc-close');
    const messagesEl = document.getElementById('lc-messages');
    const typingEl = document.getElementById('lc-typing');
    const inputEl = document.getElementById('lc-input');
    const nameEl = document.getElementById('lc-name');
    const sendBtn = document.getElementById('lc-send');
    const dotEl = document.getElementById('lc-dot');
    const statusTextEl = document.getElementById('lc-status-text');

    if (!toggle || !windowEl) return;

    // ---- Session & identity ----
    const STORAGE_SESSION = 'lc-session-id';
    const STORAGE_NAME = 'lc-display-name';
    const STORAGE_HISTORY = 'lc-history';

    let sessionId = localStorage.getItem(STORAGE_SESSION);
    if (!sessionId) {
        sessionId = 'guest-' + Date.now() + '-' + Math.random().toString(36).slice(2, 10);
        localStorage.setItem(STORAGE_SESSION, sessionId);
    }

    let displayName = localStorage.getItem(STORAGE_NAME) || '';
    if (nameEl) nameEl.value = displayName;

    // ---- State ----
    let lastMessageId = 0;
    let isOpen = false;
    let pollInterval = null;
    let typingTimeout = null;
    let isTypingSent = false;

    // Restore chat history from localStorage
    try {
        const saved = sessionStorage.getItem(STORAGE_HISTORY);
        if (saved) {
            const history = JSON.parse(saved);
            if (history && history.lastId) {
                lastMessageId = history.lastId;
            }
        }
    } catch (e) {}

    // ---- CSRF token ----
    const csrfToken = document.querySelector('meta[name="csrf-token"]')
        ? document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        : '';

    // ---- Toggle open/close ----
    toggle.addEventListener('click', function () {
        if (isOpen) {
            closeChat();
        } else {
            openChat();
        }
    });

    closeBtn.addEventListener('click', closeChat);

    function openChat() {
        windowEl.classList.add('open');
        toggle.classList.add('active');
        isOpen = true;
        setTimeout(() => inputEl.focus(), 300);
        scrollToBottom();
        startPolling();
        fetchStatus();
    }

    function closeChat() {
        windowEl.classList.remove('open');
        toggle.classList.remove('active');
        isOpen = false;
        stopPolling();
    }

    // ---- Send message ----
    sendBtn.addEventListener('click', sendMessage);

    inputEl.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    // ---- Auto-resize textarea ----
    inputEl.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';

        // Send typing status
        if (this.value.trim() && !isTypingSent) {
            sendTypingStatus(true);
            isTypingSent = true;
        }

        clearTimeout(typingTimeout);
        typingTimeout = setTimeout(function () {
            if (isTypingSent) {
                sendTypingStatus(false);
                isTypingSent = false;
            }
        }, 2000);
    });

    // ---- Name persistence ----
    nameEl.addEventListener('change', function () {
        displayName = this.value.trim();
        if (displayName) {
            localStorage.setItem(STORAGE_NAME, displayName);
        } else {
            localStorage.removeItem(STORAGE_NAME);
        }
    });

    // ---- Send message function ----
    function sendMessage() {
        const text = inputEl.value.trim();
        if (!text) return;

        // Save display name if changed
        const name = nameEl.value.trim();
        if (name !== displayName) {
            displayName = name;
            if (displayName) {
                localStorage.setItem(STORAGE_NAME, displayName);
            }
        }

        // Clear input
        inputEl.value = '';
        inputEl.style.height = 'auto';

        // Stop typing indicator
        if (isTypingSent) {
            sendTypingStatus(false);
            isTypingSent = false;
        }

        // Remove welcome message
        const welcome = messagesEl.querySelector('.lc-welcome');
        if (welcome) welcome.remove();

        // Render message immediately (optimistic)
        renderMessage(text, true, getTime(), 0);

        // Send to server
        fetch('/live-chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                message: text,
                display_name: displayName || null,
                session_id: sessionId,
            }),
        })
        .then(res => res.json())
        .then(data => {
            if (data.success && data.message) {
                lastMessageId = data.message.id;
                saveHistory();
            }
        })
        .catch(err => {
            console.warn('Live chat: failed to send message', err);
        });
    }

    // ---- Render message ----
    function renderMessage(text, isVisitor, time, id) {
        if (id && id <= lastMessageId) return;

        const msgEl = document.createElement('div');
        msgEl.className = 'lc-msg ' + (isVisitor ? 'visitor' : 'agent');

        const avatar = document.createElement('div');
        avatar.className = 'lc-msg-avatar';
        if (isVisitor) {
            avatar.textContent = displayName ? displayName.charAt(0).toUpperCase() : 'Y';
        } else {
            avatar.innerHTML = '<i class="bi bi-headset"></i>';
        }

        const contentWrap = document.createElement('div');

        const bubble = document.createElement('div');
        bubble.className = 'lc-msg-bubble';
        bubble.textContent = text;

        const meta = document.createElement('div');
        meta.className = 'lc-msg-meta ' + (isVisitor ? 'visitor' : '');
        meta.textContent = time;

        contentWrap.appendChild(bubble);
        contentWrap.appendChild(meta);
        msgEl.appendChild(avatar);
        msgEl.appendChild(contentWrap);

        messagesEl.appendChild(msgEl);

        if (id > lastMessageId) {
            lastMessageId = id;
            saveHistory();
        }

        scrollToBottom();
    }

    // ---- Typing indicator ----
    function showTyping() {
        typingEl.style.display = 'flex';
        scrollToBottom();
    }

    function hideTyping() {
        typingEl.style.display = 'none';
    }

    // ---- Auto-scroll ----
    function scrollToBottom() {
        messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    // ---- Polling ----
    function startPolling() {
        fetchMessages();
        pollInterval = setInterval(fetchMessages, 3000);
    }

    function stopPolling() {
        if (pollInterval) {
            clearInterval(pollInterval);
            pollInterval = null;
        }
    }

    function fetchMessages() {
        const params = new URLSearchParams({
            session_id: sessionId,
            after_id: lastMessageId,
        });

        fetch('/live-chat/fetch?' + params.toString(), {
            headers: { 'Accept': 'application/json' },
        })
        .then(res => res.json())
        .then(data => {
            if (data.is_typing) {
                showTyping();
            } else {
                hideTyping();
            }

            if (data.messages && data.messages.length > 0) {
                // Remove welcome message if present
                const welcome = messagesEl.querySelector('.lc-welcome');
                if (welcome) welcome.remove();

                data.messages.forEach(msg => {
                    renderMessage(msg.message, msg.is_from_visitor, msg.time, msg.id);
                });
            }
        })
        .catch(() => {});
    }

    // ---- Online/offline status ----
    function fetchStatus() {
        fetch('/live-chat/status', {
            headers: { 'Accept': 'application/json' },
        })
        .then(res => res.json())
        .then(data => {
            if (data.is_online) {
                dotEl.classList.remove('offline');
                statusTextEl.textContent = 'Online';
            } else {
                dotEl.classList.add('offline');
                statusTextEl.textContent = 'Offline';
            }
        })
        .catch(() => {
            dotEl.classList.add('offline');
            statusTextEl.textContent = 'Offline';
        });
    }

    // ---- Send typing status ----
    function sendTypingStatus(isTyping) {
        fetch('/live-chat/typing', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                session_id: sessionId,
                is_typing: isTyping,
            }),
        }).catch(() => {});
    }

    // ---- Helpers ----
    function getTime() {
        return new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    function saveHistory() {
        try {
            sessionStorage.setItem(STORAGE_HISTORY, JSON.stringify({ lastId: lastMessageId }));
        } catch (e) {}
    }
});
