
@extends('layouts.app1')

@section('content')
<style>
    .ps-chat-board {
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05) !important;
        background: #ffffff !important;
    }
    .ps-sidebar {
        background-color: #ffffff !important;
    }
    .ps-contact-link {
        border-bottom: 1px solid #f1f5f9 !important;
        transition: all 0.2s ease !important;
        background: #ffffff !important;
    }
    .ps-contact-link:hover {
        background-color: #f8fafc !important;
    }
    .ps-contact-link.ps-active {
        background-color: #e2e8f0 !important;
        border-left: 4px solid #0d6efd !important;
    }
    .ps-viewport {
        background-color: #f8fafc !important;
    }
    .ps-scroll::-webkit-scrollbar {
        width: 6px !important;
    }
    .ps-scroll::-webkit-scrollbar-track {
        background: transparent !important;
    }
    .ps-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1 !important;
        border-radius: 4px !important;
    }
    .ps-bubble-them {
        background-color: #ffffff !important;
        color: #1e293b !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 4px 16px 16px 16px !important;
        font-size: 0.95rem !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03) !important;
        padding: 10px 16px !important;
        display: inline-block !important;
    }
    .ps-bubble-me {
        background-color: #0d6efd !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 16px 16px 4px 16px !important;
        font-size: 0.95rem !important;
        box-shadow: 0 2px 4px 0 rgba(13, 110, 253, 0.15) !important;
        padding: 10px 16px !important;
        display: inline-block !important;
    }
</style>

<div class="col-lg-12 card flex-row overflow-hidden ps-chat-board" style="height: 82vh;">

    <aside class="ps-sidebar col-4 border-end d-flex flex-column p-0">
        <div class="p-3 border-bottom bg-white">
            <div class="input-group input-group-sm bg-light rounded-2 border p-1" style="border-color: #e2e8f0 !important;">
                <span class="input-group-text bg-transparent border-0 pe-2 text-muted">
                    <i class="bi bi-search"></i>
                </span>
                <input type="search" id="contact-search-input" class="form-control bg-transparent border-0 shadow-none ps-0" placeholder="Search contacts…">
            </div>
        </div>

        <div class="flex-grow-1 overflow-auto ps-scroll list-group list-group-flush">
            @foreach($conversations as $staff)
                @php $isActive = isset($activeUser) && $activeUser->id == $staff->id; @endphp
                <a href="{{ route('chat.index') }}?user_id={{ $staff->id }}"
                   class="ps-contact-link list-group-item d-flex align-items-center gap-3 p-3 border-0 {{ $isActive ? 'ps-active' : '' }}">

                    <span class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; font-weight: 600;">
                        {{ strtoupper(substr($staff->name, 0, 2)) }}
                    </span>

                    <div class="flex-grow-1 overflow-hidden">
                        <p class="mb-0 text-truncate fw-semibold ps-search-name {{ $isActive ? 'text-primary' : 'text-dark' }}" style="font-size: 0.95rem;">
                            {{ $staff->name }}
                        </p>
                        <small class="text-truncate text-secondary d-block mt-1" style="font-size: 12px;">
                            {{ $isActive ? 'Active chat logs' : 'Click to open chat' }}
                        </small>
                    </div>
                </a>
            @endforeach
        </div>
    </aside>

    <div class="col-8 d-flex flex-column p-0 bg-white">
        @if(isset($activeConversation) && isset($activeUser))
            <section class="d-flex flex-column h-100 w-100">

                <header class="p-3 border-bottom d-flex align-items-center justify-content-between bg-white flex-shrink-0" style="height: 71px;">
                    <div class="d-flex align-items-center gap-3">
                        <span class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: 600;">
                            {{ strtoupper(substr($activeUser->name, 0, 2)) }}
                        </span>
                        <div>
                            <p class="mb-0 fw-semibold text-dark" style="font-size: 0.95rem;">{{ $activeUser->name }}</p>
                            <small class="text-success d-flex align-items-center gap-1 mt-0 fw-medium" style="font-size: 11px;">
                                <i class="bi bi-circle-fill" style="font-size: 0.4rem;"></i> Online
                            </small>
                        </div>
                    </div>

                    <div class="btn-group btn-group-sm">
                        <button class="btn text-secondary border-0 p-2" type="button"><i class="bi bi-telephone"></i></button>
                        <button class="btn text-secondary border-0 p-2" type="button"><i class="bi bi-camera-video"></i></button>
                        <button class="btn text-secondary border-0 p-2" type="button"><i class="bi bi-three-dots-vertical"></i></button>
                    </div>
                </header>

                <div class="ps-viewport flex-grow-1 overflow-auto p-4 d-flex flex-column ps-scroll" id="chat-messages" style="height: 0;">
                    <div id="chat-messages-wrapper" class="d-flex flex-column gap-3 w-100">
                        @foreach($historicalMessages as $msg)
                            @php $isMe = ($msg->user_id == auth()->id()); @endphp
                            <div class="d-flex {{ $isMe ? 'justify-content-end' : 'justify-content-start' }} w-100">
                                <div class="d-flex flex-column {{ $isMe ? 'align-items-end' : 'align-items-start' }}" style="max-width: 70%;">
                                    <div class="{{ $isMe ? 'ps-bubble-me' : 'ps-bubble-them' }}">
                                        <p class="m-0" style="white-space: pre-wrap; line-height: 1.4;">{{ $msg->body }}</p>
                                    </div>
                                    <small class="text-muted mt-1 px-1" style="font-size: 10px; font-weight: 500;">
                                        {{ \Carbon\Carbon::parse($msg->created_at)->format('h:i A') }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="chat-anchor"></div>
                </div>

                <div class="p-3 border-top bg-white flex-shrink-0">
                    <div class="input-group bg-light rounded-3 border p-1" style="border-color: #e2e8f0 !important;">
                        <button class="btn btn-link text-secondary border-0 px-2" type="button"><i class="bi bi-paperclip" style="font-size: 1.15rem;"></i></button>

                        <input type="hidden" id="active_conversation_id" value="{{ $activeConversation->id }}">
                        <input type="text" id="message-body-input" class="form-control bg-transparent shadow-none border-0 py-2 ps-2" placeholder="Type a message…" autocomplete="off" required>

                        <button class="btn btn-link text-secondary border-0 px-2" type="button"><i class="bi bi-emoji-smile" style="font-size: 1.15rem;"></i></button>
                        <button class="btn btn-primary px-3 rounded-2 shadow-sm d-flex align-items-center justify-content-center" type="button" onclick="handleChatSubmit(event)" style="margin-left: 4px;">
                            <i class="bi bi-send-fill" style="font-size: 0.9rem;"></i>
                        </button>
                    </div>
                </div>

            </section>
        @else
            <div class="flex-grow-1 d-flex flex-column align-items-center justify-content-center text-muted gap-2 ps-viewport">
                <div class="p-3 rounded-circle bg-white shadow-sm border mb-1" style="font-size: 32px; width: 72px; height: 72px; display: flex; align-items: center; justify-content: center;">💬</div>
                <h6 class="m-0 fw-semibold text-dark" style="font-size: 1rem;">No Conversation Selected</h6>
                <p class="m-0 text-muted text-center px-4" style="font-size: 13px; max-width: 340px;">Select a colleague from the contact list to start a conversation log.</p>
            </div>
        @endif
    </div>

</div>

<script>
window.lastMessageId = "{{ isset($historicalMessages) && $historicalMessages->count() > 0 ? $historicalMessages->last()->id : 0 }}";
window.currentUserId = "{{ auth()->id() }}";

function scrollToBottom() {
    const anchor = document.getElementById('chat-anchor');
    if (anchor) {
        anchor.scrollIntoView({ behavior: 'smooth', block: 'end' });
    }
}

function appendNewBubble(body, userId, timestamp, msgId) {
    const wrapper = document.getElementById('chat-messages-wrapper');
    if (!wrapper) return;

    const isMe = (userId == window.currentUserId);

    const bubbleHtml = `
        <div class="d-flex ${isMe ? 'justify-content-end' : 'justify-content-start'} w-100">
            <div class="d-flex flex-column ${isMe ? 'align-items-end' : 'align-items-start'}" style="max-width: 70%;">
                <div class="${isMe ? 'ps-bubble-me' : 'ps-bubble-them'}">
                    <p class="m-0" style="white-space: pre-wrap; line-height: 1.4;">${body}</p>
                </div>
                <small class="text-muted mt-1 px-1" style="font-size: 10px; font-weight: 500;">${timestamp}</small>
            </div>
        </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', bubbleHtml);

    if (msgId && parseInt(msgId) > parseInt(window.lastMessageId)) {
        window.lastMessageId = msgId;
    }
}

function handleChatSubmit(e) {
    if (e) e.preventDefault();

    const conversationId = document.getElementById('active_conversation_id')?.value;
    const inputField = document.getElementById('message-body-input');
    const textPayload = inputField?.value.trim();

    if (!textPayload || !conversationId) return;

    inputField.value = '';

    fetch("{{ route('ajax.chat.send') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            conversation_id: conversationId,
            body: textPayload
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            appendNewBubble(data.message.body, data.message.user_id, data.message.time, data.message.id);
            scrollToBottom();
        }
    })
    .catch(error => console.error("Error sending message:", error));
}

document.addEventListener("DOMContentLoaded", function() {
    const inputField = document.getElementById('message-body-input');
    const conversationId = document.getElementById('active_conversation_id')?.value;
    const searchInput = document.getElementById('contact-search-input');

    setTimeout(scrollToBottom, 150);

    if (inputField) {
        inputField.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                e.preventDefault();
                handleChatSubmit(e);
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase().trim();
            const contacts = document.querySelectorAll('.ps-contact-link');

            contacts.forEach(contact => {
                const name = contact.querySelector('.ps-search-name').textContent.toLowerCase();
                if (name.includes(query)) {
                    contact.style.setProperty('display', 'flex', 'important');
                } else {
                    contact.style.setProperty('display', 'none', 'important');
                }
            });
        });
    }

    if (conversationId) {
        setInterval(function() {
            fetch(`{{ route('ajax.chat.fetch') }}?conversation_id=${conversationId}&last_message_id=${window.lastMessageId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.messages && data.messages.length > 0) {
                    data.messages.forEach(function(msg) {
                        if (msg.user_id != window.currentUserId) {
                            appendNewBubble(msg.body, msg.user_id, msg.time, msg.id);
                        } else {
                            if (parseInt(msg.id) > parseInt(window.lastMessageId)) {
                                window.lastMessageId = msg.id;
                            }
                        }
                    });
                    scrollToBottom();
                }
            })
            .catch(error => console.error("Error polling messages:", error));
        }, 2000);
    }
});
</script>
@endsection
