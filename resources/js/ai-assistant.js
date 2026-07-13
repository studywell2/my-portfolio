// ===========================================
// AI Portfolio Assistant
// ===========================================

document.addEventListener('DOMContentLoaded', function () {
    const chatToggle = document.getElementById('ai-chat-toggle');
    const chatWindow = document.getElementById('ai-chat-window');
    const chatClose = document.getElementById('ai-chat-close');
    const chatMessages = document.getElementById('ai-chat-messages');
    const chatInput = document.getElementById('ai-chat-input');
    const chatSend = document.getElementById('ai-chat-send');
    const quickActions = document.getElementById('ai-quick-actions');

    if (!chatToggle || !chatWindow) return;

    // ---- Build knowledge base from page data ----
    const dataEl = document.getElementById('ai-knowledge-base');
    let kb = {};

    if (dataEl) {
        try {
            kb = JSON.parse(dataEl.textContent);
        } catch (e) {
            console.warn('AI: Failed to parse knowledge base');
        }
    }

    const settings = kb.settings || {};
    const projects = kb.projects || [];
    const skills = kb.skills || {};

    // ---- Quick action buttons ----
    const quickActionsList = [
        { label: 'About Me', keywords: 'about background' },
        { label: 'My Services', keywords: 'services' },
        { label: 'View Projects', keywords: 'projects portfolio' },
        { label: 'Get a Project Estimate', keywords: 'pricing cost estimate' },
        { label: 'My Tech Stack', keywords: 'tech stack technologies' },
        { label: 'Download CV', keywords: 'cv resume' },
        { label: 'Contact Me', keywords: 'contact email phone' },
        { label: 'Book a Consultation', keywords: 'consultation book hire' },
    ];

    quickActionsList.forEach(action => {
        const btn = document.createElement('button');
        btn.className = 'quick-btn';
        btn.textContent = action.label;
        btn.addEventListener('click', () => {
            sendUserMessage(action.label);
        });
        quickActions.appendChild(btn);
    });

    // ---- Chat state ----
    let chatHistory = [];

    // Restore from session storage
    try {
        const saved = sessionStorage.getItem('ai-chat-history');
        if (saved) {
            chatHistory = JSON.parse(saved);
            chatHistory.forEach(msg => renderMessage(msg.text, msg.sender, msg.time, false));
        }
    } catch (e) {}

    // Welcome message if no history
    if (chatHistory.length === 0) {
        const welcomeText = `Hi! I'm the AI assistant for ${settings.hero_title || 'Abideen'}. Ask me about my background, skills, projects, services, pricing, or anything else!`;
        addMessage(welcomeText, 'ai');
    }

    // ---- Event listeners ----
    chatToggle.addEventListener('click', toggleChat);
    chatClose.addEventListener('click', closeChat);

    chatSend.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    function toggleChat() {
        chatWindow.classList.toggle('open');
        chatToggle.classList.toggle('active');
        if (chatWindow.classList.contains('open')) {
            setTimeout(() => chatInput.focus(), 300);
            scrollToBottom();
        }
    }

    function closeChat() {
        chatWindow.classList.remove('open');
        chatToggle.classList.remove('active');
    }

    function sendMessage() {
        const text = chatInput.value.trim();
        if (!text) return;
        chatInput.value = '';
        sendUserMessage(text);
    }

    function sendUserMessage(text) {
        addMessage(text, 'user');
        showTyping();

        setTimeout(() => {
            hideTyping();
            const response = getAIResponse(text);
            addMessage(response, 'ai');
        }, 600 + Math.random() * 600);
    }

    // ---- Message rendering ----
    function addMessage(text, sender) {
        const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        chatHistory.push({ text, sender, time });
        saveHistory();
        renderMessage(text, sender, time, true);
    }

    function renderMessage(text, sender, time, animate) {
        const msgEl = document.createElement('div');
        msgEl.className = `ai-msg ${sender}`;

        const avatar = document.createElement('div');
        avatar.className = 'ai-msg-avatar';
        if (sender === 'ai') {
            avatar.innerHTML = '<i class="bi bi-robot"></i>';
        } else {
            avatar.textContent = 'You';
        }

        const contentWrap = document.createElement('div');
        const bubble = document.createElement('div');
        bubble.className = 'ai-msg-bubble';
        bubble.innerHTML = text;

        const timeEl = document.createElement('div');
        timeEl.className = 'ai-msg-time';
        timeEl.textContent = time;

        contentWrap.appendChild(bubble);
        contentWrap.appendChild(timeEl);
        msgEl.appendChild(avatar);
        msgEl.appendChild(contentWrap);

        chatMessages.appendChild(msgEl);
        if (animate) scrollToBottom();
    }

    function showTyping() {
        const existing = document.querySelector('.ai-typing');
        if (existing) return;

        const typingEl = document.createElement('div');
        typingEl.className = 'ai-typing';
        typingEl.innerHTML = `
            <div class="ai-msg-avatar"><i class="bi bi-robot"></i></div>
            <div class="ai-typing-bubble">
                <div class="ai-typing-dot"></div>
                <div class="ai-typing-dot"></div>
                <div class="ai-typing-dot"></div>
            </div>
        `;
        chatMessages.appendChild(typingEl);
        scrollToBottom();
    }

    function hideTyping() {
        const typing = document.querySelector('.ai-typing');
        if (typing) typing.remove();
    }

    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function saveHistory() {
        try {
            sessionStorage.setItem('ai-chat-history', JSON.stringify(chatHistory.slice(-50)));
        } catch (e) {}
    }

    // ---- AI Response Engine ----
    function getAIResponse(query) {
        const q = query.toLowerCase().trim();

        // Background / About
        if (matchAny(q, ['about', 'background', 'who are', 'who is', 'tell me about', 'bio'])) {
            let resp = `${settings.hero_title || 'Abideen'} is a ${settings.hero_subtitle || 'Full-Stack Developer & Project Manager'}.`;
            if (settings.current_role) resp += `<br><br>${settings.current_role}`;
            if (settings.about_bio) {
                const firstPara = settings.about_bio.split("\n\n")[0];
                resp += `<br><br>${firstPara}`;
            }
            if (settings.location) resp += `<br><br>📍 Location: ${settings.location}`;
            return resp;
        }

        // Skills
        if (matchAny(q, ['skill', 'tech stack', 'technologies', 'expertise', 'what can you do', 'what do you know'])) {
            let resp = `Here are ${settings.hero_title || 'Abideen'}'s technical skills:<br><br>`;
            const cats = { backend: 'Backend', frontend: 'Frontend', tools: 'Tools' };
            Object.keys(cats).forEach(cat => {
                if (skills[cat] && skills[cat].length > 0) {
                    resp += `<strong>${cats[cat]}:</strong> `;
                    resp += skills[cat].map(s => `${s.name} (${s.proficiency}%)`).join(', ');
                    resp += '<br>';
                }
            });
            return resp;
        }

        // Services
        if (matchAny(q, ['service', 'what do you offer', 'what do you do', 'help with'])) {
            const services = [
                'Custom Web Development', 'Laravel Application Development', 'School Management Systems',
                'Business Websites', 'Company Portals', 'Inventory Management Systems',
                'Dashboard Development', 'API Integration', 'Website Maintenance',
                'Database Design', 'Website Deployment', 'Technical Support'
            ];
            return `${settings.hero_title || 'Abideen'} offers the following services:<br><br>• ${services.join('<br>• ')}`;
        }

        // Projects
        if (matchAny(q, ['project', 'portfolio', 'work', 'case study', 'case studies', 'what have you built'])) {
            if (projects.length === 0) return 'No projects are listed yet, but check back soon!';
            let resp = `Here are the featured projects:<br><br>`;
            projects.forEach(p => {
                resp += `<strong>${p.title}</strong>`;
                if (p.category) resp += ` <span style="opacity:0.6">(${p.category})</span>`;
                resp += `<br>${p.description}<br>`;
                if (p.url) resp += `<a href="${p.url}" target="_blank">View Project →</a><br>`;
                resp += '<br>';
            });
            resp += `You can also check the <a href="#projects">Projects section</a> above for more details!`;
            return resp;
        }

        // Pricing / Cost
        if (matchAny(q, ['price', 'pricing', 'cost', 'estimate', 'budget', 'how much', 'quote', 'charge', 'fee'])) {
            return `Project pricing varies based on type and features. Here are base prices:<br><br>
                • Landing Page: ₦${formatNum(settings.calc_base_landing || 50000)}<br>
                • Business Website: ₦${formatNum(settings.calc_base_business || 80000)}<br>
                • School Website: ₦${formatNum(settings.calc_base_school || 150000)}<br>
                • E-commerce: ₦${formatNum(settings.calc_base_ecommerce || 200000)}<br>
                • Web Application: ₦${formatNum(settings.calc_base_webapp || 300000)}<br><br>
                Use the <a href="#calculator">Cost Calculator</a> for a detailed estimate!`;
        }

        // Timeline
        if (matchAny(q, ['timeline', 'how long', 'delivery', 'turnaround', 'deadline', 'when'])) {
            return `Typical project timelines:<br><br>
                • Landing Page: 3-7 days<br>
                • Business Website: 2-4 weeks<br>
                • School Management System: 4-8 weeks<br>
                • E-commerce: 3-6 weeks<br>
                • Web Application: 6-12 weeks<br><br>
                Timelines depend on complexity and requirements. <a href="#contact">Contact me</a> for a detailed timeline!`;
        }

        // Availability
        if (matchAny(q, ['available', 'availability', 'freelance', 'hire', 'work with', 'open to', 'looking for'])) {
            return `Yes! ${settings.hero_title || 'Abideen'} is currently <strong>open for freelance work</strong> and full-time opportunities. Ready to start on new projects. <a href="#contact">Get in touch</a> to discuss!`;
        }

        // Experience
        if (matchAny(q, ['experience', 'years', 'how long', 'been doing'])) {
            return `${settings.hero_title || 'Abideen'} has ${settings.stat_experience || '5+'} years of experience with ${settings.stat_projects || '50+'} projects completed and ${settings.stat_clients || '30+'} happy clients. Experienced in building secure, scalable web applications with Laravel, PHP, MySQL, JavaScript, and more.`;
        }

        // Contact
        if (matchAny(q, ['contact', 'reach', 'email', 'phone', 'whatsapp', 'connect', 'social'])) {
            let resp = `Here's how you can reach ${settings.hero_title || 'Abideen'}:<br><br>`;
            if (settings.email) resp += `📧 Email: <a href="mailto:${settings.email}">${settings.email}</a><br>`;
            if (settings.phone) resp += `📱 Phone: <a href="tel:${settings.phone}">${settings.phone}</a><br>`;
            if (settings.whatsapp) resp += `💬 WhatsApp: <a href="https://wa.me/${settings.whatsapp.replace(/[^0-9]/g, '')}" target="_blank">${settings.whatsapp}</a><br>`;
            if (settings.github_url) resp += `💻 GitHub: <a href="${settings.github_url}" target="_blank">${settings.github_url}</a><br>`;
            if (settings.linkedin_url) resp += `🔗 LinkedIn: <a href="${settings.linkedin_url}" target="_blank">${settings.linkedin_url}</a><br>`;
            resp += `<br>You can also use the <a href="#contact">contact form</a> on this page!`;
            return resp;
        }

        // CV / Resume
        if (matchAny(q, ['cv', 'resume', 'download cv'])) {
            if (settings.cv_path) {
                return `You can download the CV/resume <a href="/download-cv" target="_blank">here</a>.`;
            }
            return `The CV will be available soon! In the meantime, <a href="#contact">contact me</a> directly for more information.`;
        }

        // Consultation
        if (matchAny(q, ['consultation', 'consult', 'book', 'meeting', 'appointment', 'call'])) {
            return `Great! You can book a consultation by:<br><br>
                1. Using the <a href="#contact">contact form</a> on this page<br>
                2. Sending an email to <a href="mailto:${settings.email || 'me'}">${settings.email || ''}</a><br>
                3. Messaging on WhatsApp${settings.whatsapp ? `: <a href="https://wa.me/${settings.whatsapp.replace(/[^0-9]/g, '')}" target="_blank">${settings.whatsapp}</a>` : ''}<br><br>
                I typically respond within 24 hours!`;
        }

        // Location
        if (matchAny(q, ['location', 'where', 'based', 'country', 'city'])) {
            return `${settings.hero_title || 'Abideen'} is based in ${settings.location || 'Nigeria'}. Available for remote work worldwide!`;
        }

        // Greetings
        if (matchAny(q, ['hello', 'hi', 'hey', 'good morning', 'good afternoon', 'good evening', 'greetings'])) {
            return `Hello! 👋 How can I help you today? Ask me about projects, skills, services, pricing, or anything else!`;
        }

        // Thank you
        if (matchAny(q, ['thank', 'thanks', 'thank you', 'appreciate'])) {
            return `You're welcome! 😊 Is there anything else you'd like to know?`;
        }

        // Fallback
        return `I'm not sure about that, but I'd love to help! You can reach ${settings.hero_title || 'Abideen'} directly:<br><br>
            📧 <a href="mailto:${settings.email || ''}">${settings.email || 'Email'}</a><br>
            💬 <a href="https://wa.me/${(settings.whatsapp || '').replace(/[^0-9]/g, '')}" target="_blank">WhatsApp</a><br>
            📝 <a href="#contact">Contact Form</a><br><br>
            Or try one of the quick action buttons below!`;
    }

    // ---- Helpers ----
    function matchAny(query, keywords) {
        return keywords.some(kw => query.includes(kw));
    }

    function formatNum(n) {
        return parseInt(n).toLocaleString('en-US');
    }
});
