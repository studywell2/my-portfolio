@extends('admin.layouts.app')

@section('title', 'Live Chat Reply')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <h4 class="fw-bold mb-0"><i class="bi bi-chat-dots-fill me-2"></i>Live Chat Reply</h4>
</div>

<div class="row g-4">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label text-muted small text-uppercase fw-600">session_id</label>
                    <input
                        id="lc-session-id"
                        type="text"
                        class="form-control"
                        placeholder="guest-... (from the visitor browser)"
                    >
                    <div class="form-text">Enter the visitor session_id you want to reply to.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small text-uppercase fw-600">Reply message</label>
                    <textarea
                        id="lc-reply-message"
                        class="form-control"
                        rows="4"
                        placeholder="Type reply..."
                    ></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button id="lc-send-reply" class="btn btn-gold" type="button">
                        <i class="bi bi-send me-2"></i>Send Reply

                    </button>
                    <button id="lc-clear" type="button" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg me-1"></i>Clear
                    </button>
                </div>

                <div id="lc-result" class="mt-3"></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-body">
                <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i>How to get session_id</h6>
                <ol class="text-muted" style="line-height:1.8">
                    <li>Open the site in the visitor browser.</li>
                    <li>Open DevTools → Console and run:</li>
                </ol>

                <div class="p-3 rounded" style="background:#121212;border:1px solid #2a2a2a;font-family:monospace;color:#e0e0e0">
                    localStorage.getItem('lc-session-id')
                </div>

                <p class="text-muted mt-3" style="line-height:1.8">
                    Copy that value into the session_id field and send your reply.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sendBtn = document.getElementById('lc-send-reply');
        const clearBtn = document.getElementById('lc-clear');
        const sessionEl = document.getElementById('lc-session-id');
        const messageEl = document.getElementById('lc-reply-message');
        const resultEl = document.getElementById('lc-result');
        const csrfToken = (function () {
            const meta = document.querySelector('meta[name="csrf-token"]');
            if (meta && meta.getAttribute('content')) return meta.getAttribute('content');
            return '{{ csrf_token() }}';
        })();


        function setResult(html, type) {
            resultEl.innerHTML = html;
            if (type === 'success') {
                resultEl.className = 'mt-3 alert alert-success';
            } else if (type === 'error') {
                resultEl.className = 'mt-3 alert alert-danger';
            } else if (type === 'info') {
                resultEl.className = 'mt-3 alert alert-info';
            } else {
                resultEl.className = 'mt-3';
            }
        }

        sendBtn.addEventListener('click', async function () {
            const sessionId = (sessionEl.value || '').trim();
            const message = (messageEl.value || '').trim();

            if (!sessionId) {
                setResult('Please enter session_id.', 'error');
                return;
            }
            if (!message) {
                setResult('Please type a reply message.', 'error');
                return;
            }

            sendBtn.disabled = true;
            setResult('Sending...', 'info');

            try {
                const res = await fetch('{{ route('admin.live-chat.reply') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },

                    body: new URLSearchParams({
                        session_id: sessionId,
                        message: message,
                    }).toString(),


                });

                let data = null;
                try {
                    data = await res.json();
                } catch (e) {}

                if (res.ok && data && data.success) {
                    setResult('Reply sent successfully. Visitor will see it shortly.', 'success');
                    messageEl.value = '';
                } else {
                    const msg = (data && (data.message || data.error)) ? (data.message || data.error) : `HTTP ${res.status}`;
                    setResult(`Failed to send reply: ${msg}`, 'error');
                }
            } catch (e) {
                setResult('Network error while sending reply.', 'error');
            } finally {
                sendBtn.disabled = false;
            }
        });

        clearBtn.addEventListener('click', function () {
            sessionEl.value = '';
            messageEl.value = '';
            resultEl.innerHTML = '';
            resultEl.className = 'mt-3';
        });
    });
</script>
@endsection

