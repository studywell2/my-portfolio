// =============================================================
// Live Code Playground — Monaco Editor + Live Preview
// =============================================================

(function () {
    var pgPage = document.getElementById('playground-page');
    if (!pgPage) return;

    // ---- Sample Templates ----
    var TEMPLATES = {
        landing: {
            html: '<div class="hero">\n' +
                  '  <h1>Welcome to <span>Acme</span></h1>\n' +
                  '  <p>Build something amazing today.</p>\n' +
                  '  <button onclick="cta()">Get Started</button>\n' +
                  '</div>\n' +
                  '<div class="features">\n' +
                  '  <div class="feature"><h3>Fast</h3><p>Lightning quick performance.</p></div>\n' +
                  '  <div class="feature"><h3>Secure</h3><p>Enterprise-grade security.</p></div>\n' +
                  '  <div class="feature"><h3>Scalable</h3><p>Grows with your business.</p></div>\n' +
                  '</div>',
            css:  '* { margin: 0; padding: 0; box-sizing: border-box; }\n' +
                  'body { font-family: sans-serif; background: #f5f5f5; color: #222; }\n' +
                  '.hero { text-align: center; padding: 4rem 1rem; background: linear-gradient(135deg, #667eea, #764ba2); color: #fff; }\n' +
                  '.hero h1 { font-size: 2.5rem; margin-bottom: 0.5rem; }\n' +
                  '.hero h1 span { color: #ffd700; }\n' +
                  '.hero p { font-size: 1.2rem; opacity: 0.9; margin-bottom: 1.5rem; }\n' +
                  '.hero button { padding: 0.75rem 2rem; font-size: 1rem; border: none; border-radius: 50px; background: #ffd700; color: #333; cursor: pointer; font-weight: 600; }\n' +
                  '.hero button:hover { transform: scale(1.05); }\n' +
                  '.features { display: flex; gap: 1.5rem; padding: 3rem 2rem; max-width: 900px; margin: 0 auto; }\n' +
                  '.feature { flex: 1; text-align: center; background: #fff; padding: 2rem 1rem; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }\n' +
                  '.feature h3 { color: #667eea; margin-bottom: 0.5rem; }',
            js:   'function cta() {\n' +
                  '  alert("Thanks for your interest! We\'ll be in touch soon.");\n' +
                  '}\n' +
                  '\n' +
                  'console.log("Landing page loaded!");'
        },
        login: {
            html: '<div class="login-card">\n' +
                  '  <h2>Login</h2>\n' +
                  '  <form onsubmit="return handleSubmit(event)">\n' +
                  '    <div class="field">\n' +
                  '      <label>Email</label>\n' +
                  '      <input type="email" id="email" placeholder="you@example.com" required>\n' +
                  '    </div>\n' +
                  '    <div class="field">\n' +
                  '      <label>Password</label>\n' +
                  '      <input type="password" id="password" placeholder="********" required>\n' +
                  '    </div>\n' +
                  '    <button type="submit">Sign In</button>\n' +
                  '  </form>\n' +
                  '  <p class="hint">No account? <a href="#">Sign up</a></p>\n' +
                  '</div>',
            css:  '* { margin: 0; padding: 0; box-sizing: border-box; }\n' +
                  'body { font-family: sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; background: #1a1a2e; }\n' +
                  '.login-card { background: #fff; padding: 2.5rem; border-radius: 16px; width: 360px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }\n' +
                  '.login-card h2 { text-align: center; margin-bottom: 1.5rem; color: #333; }\n' +
                  '.field { margin-bottom: 1.25rem; }\n' +
                  '.field label { display: block; font-size: 0.85rem; color: #666; margin-bottom: 0.35rem; font-weight: 600; }\n' +
                  '.field input { width: 100%; padding: 0.7rem 0.8rem; border: 2px solid #ddd; border-radius: 8px; font-size: 0.95rem; transition: border-color 0.2s; }\n' +
                  '.field input:focus { outline: none; border-color: #667eea; }\n' +
                  'button[type="submit"] { width: 100%; padding: 0.75rem; border: none; border-radius: 8px; background: #667eea; color: #fff; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background 0.2s; }\n' +
                  'button[type="submit"]:hover { background: #5568d3; }\n' +
                  '.hint { text-align: center; margin-top: 1rem; font-size: 0.85rem; color: #999; }\n' +
                  '.hint a { color: #667eea; text-decoration: none; }',
            js:   'function handleSubmit(e) {\n' +
                  '  e.preventDefault();\n' +
                  '  var email = document.getElementById("email").value;\n' +
                  '  var pw = document.getElementById("password").value;\n' +
                  '  if (email && pw.length >= 6) {\n' +
                  '    console.log("Login submitted for: " + email);\n' +
                  '    alert("Login successful!");\n' +
                  '  } else {\n' +
                  '    console.error("Password must be at least 6 characters.");\n' +
                  '    alert("Password must be at least 6 characters.");\n' +
                  '  }\n' +
                  '  return false;\n' +
                  '}\n' +
                  '\n' +
                  'console.log("Login form ready.");'
        },
        calculator: {
            html: '<div class="calc">\n' +
                  '  <div class="display" id="display">0</div>\n' +
                  '  <div class="keys">\n' +
                  '    <button class="btn-clear" onclick="clearAll()">C</button>\n' +
                  '    <button onclick="del()">&#9003;</button>\n' +
                  '    <button onclick="append(\'/\')">&#247;</button>\n' +
                  '    <button onclick="append(\'*\')">&#215;</button>\n' +
                  '    <button onclick="append(\'7\')">7</button>\n' +
                  '    <button onclick="append(\'8\')">8</button>\n' +
                  '    <button onclick="append(\'9\')">9</button>\n' +
                  '    <button onclick="append(\'-\')">-</button>\n' +
                  '    <button onclick="append(\'4\')">4</button>\n' +
                  '    <button onclick="append(\'5\')">5</button>\n' +
                  '    <button onclick="append(\'6\')">6</button>\n' +
                  '    <button onclick="append(\'+\')">+</button>\n' +
                  '    <button onclick="append(\'1\')">1</button>\n' +
                  '    <button onclick="append(\'2\')">2</button>\n' +
                  '    <button onclick="append(\'3\')">3</button>\n' +
                  '    <button class="btn-equal" onclick="calculate()">=</button>\n' +
                  '    <button class="btn-zero" onclick="append(\'0\')">0</button>\n' +
                  '    <button onclick="append(\'.\')">.</button>\n' +
                  '  </div>\n' +
                  '</div>',
            css:  '* { margin: 0; padding: 0; box-sizing: border-box; }\n' +
                  'body { display: flex; align-items: center; justify-content: center; min-height: 100vh; background: #1a1a2e; font-family: monospace; }\n' +
                  '.calc { background: #222; padding: 1.25rem; border-radius: 16px; width: 300px; box-shadow: 0 10px 40px rgba(0,0,0,0.4); }\n' +
                  '.display { background: #0a0a0a; color: #0f0; font-size: 2rem; text-align: right; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; min-height: 60px; overflow: hidden; }\n' +
                  '.keys { display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem; }\n' +
                  '.keys button { padding: 1rem; font-size: 1.1rem; border: none; border-radius: 8px; background: #444; color: #fff; cursor: pointer; transition: background 0.15s; }\n' +
                  '.keys button:hover { background: #555; }\n' +
                  '.btn-clear { background: #e74c3c !important; }\n' +
                  '.btn-clear:hover { background: #c0392b !important; }\n' +
                  '.btn-equal { background: #f39c12 !important; }\n' +
                  '.btn-equal:hover { background: #d68910 !important; }\n' +
                  '.btn-zero { grid-column: span 2; }',
            js:   'var display = document.getElementById("display");\n' +
                  'var current = "0";\n' +
                  '\n' +
                  'function append(val) {\n' +
                  '  if (current === "0" && val !== ".") current = "";\n' +
                  '  current += val;\n' +
                  '  display.textContent = current;\n' +
                  '}\n' +
                  '\n' +
                  'function clearAll() {\n' +
                  '  current = "0";\n' +
                  '  display.textContent = current;\n' +
                  '}\n' +
                  '\n' +
                  'function del() {\n' +
                  '  current = current.slice(0, -1) || "0";\n' +
                  '  display.textContent = current;\n' +
                  '}\n' +
                  '\n' +
                  'function calculate() {\n' +
                  '  try {\n' +
                  '    var result = eval(current);\n' +
                  '    current = String(result);\n' +
                  '    display.textContent = current;\n' +
                  '    console.log("Result: " + result);\n' +
                  '  } catch (e) {\n' +
                  '    console.error("Invalid expression");\n' +
                  '    display.textContent = "Error";\n' +
                  '    current = "0";\n' +
                  '  }\n' +
                  '}\n' +
                  '\n' +
                  'console.log("Calculator ready.");'
        },
        todo: {
            html: '<div class="app">\n' +
                  '  <h1>Todo List</h1>\n' +
                  '  <div class="input-row">\n' +
                  '    <input type="text" id="todoInput" placeholder="Add a task..." onkeydown="if(event.key===\'Enter\')addTodo()">\n' +
                  '    <button onclick="addTodo()">Add</button>\n' +
                  '  </div>\n' +
                  '  <ul id="todoList"></ul>\n' +
                  '</div>',
            css:  '* { margin: 0; padding: 0; box-sizing: border-box; }\n' +
                  'body { font-family: sans-serif; background: #f0f4f8; display: flex; justify-content: center; padding: 2rem; }\n' +
                  '.app { width: 100%; max-width: 420px; background: #fff; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }\n' +
                  'h1 { text-align: center; color: #333; margin-bottom: 1.5rem; font-size: 1.5rem; }\n' +
                  '.input-row { display: flex; gap: 0.5rem; margin-bottom: 1rem; }\n' +
                  '.input-row input { flex: 1; padding: 0.6rem 0.8rem; border: 2px solid #ddd; border-radius: 8px; font-size: 0.95rem; }\n' +
                  '.input-row input:focus { outline: none; border-color: #667eea; }\n' +
                  '.input-row button { padding: 0.6rem 1.2rem; border: none; border-radius: 8px; background: #667eea; color: #fff; cursor: pointer; font-weight: 600; }\n' +
                  '.input-row button:hover { background: #5568d3; }\n' +
                  'ul { list-style: none; }\n' +
                  'li { display: flex; align-items: center; gap: 0.6rem; padding: 0.6rem 0.5rem; border-bottom: 1px solid #eee; }\n' +
                  'li.done span { text-decoration: line-through; opacity: 0.5; }\n' +
                  'li input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; }\n' +
                  'li span { flex: 1; color: #333; }\n' +
                  'li button { background: none; border: none; color: #e74c3c; cursor: pointer; font-size: 1.1rem; }',
            js:   'var todoList = document.getElementById("todoList");\n' +
                  'var todoInput = document.getElementById("todoInput");\n' +
                  'var todos = [];\n' +
                  '\n' +
                  'function addTodo() {\n' +
                  '  var text = todoInput.value.trim();\n' +
                  '  if (!text) return;\n' +
                  '  todos.push({ text: text, done: false });\n' +
                  '  todoInput.value = "";\n' +
                  '  render();\n' +
                  '  console.log("Added: " + text);\n' +
                  '}\n' +
                  '\n' +
                  'function toggleTodo(i) {\n' +
                  '  todos[i].done = !todos[i].done;\n' +
                  '  render();\n' +
                  '}\n' +
                  '\n' +
                  'function deleteTodo(i) {\n' +
                  '  todos.splice(i, 1);\n' +
                  '  render();\n' +
                  '}\n' +
                  '\n' +
                  'function render() {\n' +
                  '  todoList.innerHTML = "";\n' +
                  '  todos.forEach(function(t, i) {\n' +
                  '    var li = document.createElement("li");\n' +
                  '    if (t.done) li.className = "done";\n' +
                  '    li.innerHTML = \'<input type="checkbox" \' + (t.done ? "checked" : "") + \' onchange="toggleTodo(\' + i + \')">\' +\n' +
                  '      "<span>" + t.text + "</span>" +\n' +
                  '      \'<button onclick="deleteTodo(\' + i + \')">&#10005;</button>\';\n' +
                  '    todoList.appendChild(li);\n' +
                  '  });\n' +
                  '}\n' +
                  '\n' +
                  'console.log("Todo app ready.");'
        },
        navbar: {
            html: '<nav class="navbar">\n' +
                  '  <div class="nav-brand">MyBrand</div>\n' +
                  '  <button class="nav-toggle" onclick="toggleMenu()">&#9776;</button>\n' +
                  '  <ul class="nav-links" id="navLinks">\n' +
                  '    <li><a href="#">Home</a></li>\n' +
                  '    <li><a href="#">About</a></li>\n' +
                  '    <li><a href="#">Services</a></li>\n' +
                  '    <li><a href="#">Contact</a></li>\n' +
                  '  </ul>\n' +
                  '</nav>\n' +
                  '<div class="content">\n' +
                  '  <h1>Responsive Navbar</h1>\n' +
                  '  <p>Resize the window to see the mobile menu in action.</p>\n' +
                  '</div>',
            css:  '* { margin: 0; padding: 0; box-sizing: border-box; }\n' +
                  'body { font-family: sans-serif; }\n' +
                  '.navbar { display: flex; align-items: center; justify-content: space-between; background: #1a1a2e; padding: 1rem 2rem; position: relative; }\n' +
                  '.nav-brand { color: #fff; font-size: 1.3rem; font-weight: 700; }\n' +
                  '.nav-links { display: flex; list-style: none; gap: 1.5rem; }\n' +
                  '.nav-links a { color: #ccc; text-decoration: none; font-size: 0.95rem; transition: color 0.2s; }\n' +
                  '.nav-links a:hover { color: #ffd700; }\n' +
                  '.nav-toggle { display: none; background: none; border: none; color: #fff; font-size: 1.5rem; cursor: pointer; }\n' +
                  '.content { padding: 3rem 2rem; text-align: center; }\n' +
                  '.content h1 { color: #333; margin-bottom: 0.5rem; }\n' +
                  '.content p { color: #666; }\n' +
                  '@media (max-width: 768px) {\n' +
                  '  .nav-toggle { display: block; }\n' +
                  '  .nav-links { display: none; flex-direction: column; position: absolute; top: 100%; left: 0; right: 0; background: #1a1a2e; padding: 1rem 2rem; gap: 0.75rem; }\n' +
                  '  .nav-links.open { display: flex; }\n' +
                  '}',
            js:   'function toggleMenu() {\n' +
                  '  var links = document.getElementById("navLinks");\n' +
                  '  links.classList.toggle("open");\n' +
                  '}\n' +
                  '\n' +
                  'console.log("Navbar loaded.");'
        }
    };

    // ---- DOM refs ----
    var layout = document.getElementById('playground-layout');
    var resizer = document.getElementById('pg-resizer');
    var iframe = document.getElementById('preview-iframe');
    var runBtn = document.getElementById('pg-run-btn');
    var resetBtn = document.getElementById('pg-reset-btn');
    var copyBtn = document.getElementById('pg-copy-btn');
    var downloadBtn = document.getElementById('pg-download-btn');
    var refreshPreviewBtn = document.getElementById('pg-refresh-preview');
    var templateBtns = document.querySelectorAll('.template-btn');
    var editorTabs = document.querySelectorAll('.editor-tab');
    var editorWrappers = document.querySelectorAll('.editor-wrapper');
    var consolePanel = document.getElementById('console-panel');
    var consoleHeader = document.getElementById('console-header');
    var consoleBody = document.getElementById('console-body');
    var consoleClearBtn = document.getElementById('console-clear-btn');

    // ---- Monaco editors storage ----
    var editors = {};
    var activeEditor = 'html';
    var monacoReady = false;
    var previewTimer = null;

    // ---- Init Monaco ----
    function initMonaco() {
        if (typeof require === 'undefined') {
            console.error('Monaco loader not found');
            return;
        }

        require.config({
            paths: { vs: 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.52.2/min/vs' }
        });

        require(['vs/editor/editor.main'], function () {
            var sharedOpts = {
                automaticLayout: true,
                fontSize: 14,
                minimap: { enabled: false },
                wordWrap: 'on',
                lineNumbers: 'on',
                autoIndent: 'full',
                tabSize: 2,
                formatOnPaste: true,
                scrollBeyondLastLine: false,
                smoothScrolling: true,
                fontFamily: 'JetBrains Mono, monospace',
                padding: { top: 8 }
            };

            var currentTheme = document.documentElement.getAttribute('data-bs-theme') === 'light' ? 'vs' : 'vs-dark';

            editors.html = monaco.editor.create(document.getElementById('editor-html'), {
                language: 'html',
                theme: currentTheme,
                value: TEMPLATES.landing.html,
                ...sharedOpts
            });

            editors.css = monaco.editor.create(document.getElementById('editor-css'), {
                language: 'css',
                theme: currentTheme,
                value: TEMPLATES.landing.css,
                ...sharedOpts
            });

            editors.js = monaco.editor.create(document.getElementById('editor-js'), {
                language: 'javascript',
                theme: currentTheme,
                value: TEMPLATES.landing.js,
                ...sharedOpts
            });

            monacoReady = true;

            // Live update on content change (debounced)
            ['html', 'css', 'js'].forEach(function (lang) {
                editors[lang].onDidChangeModelContent(function () {
                    schedulePreview();
                });
            });

            // Initial preview
            updatePreview();
        });
    }

    // ---- Build preview HTML ----
    function buildPreviewHTML() {
        var html = editors.html ? editors.html.getValue() : '';
        var css = editors.css ? editors.css.getValue() : '';
        var js = editors.js ? editors.js.getValue() : '';

        return '<!DOCTYPE html>\n' +
               '<html>\n<head>\n<meta charset="UTF-8">\n' +
               '<style>' + css + '</style>\n' +
               '</head>\n<body>\n' +
               html + '\n' +
               '<script>(function(){\n' +
               '  window.onerror = function(msg, src, line, col, err){\n' +
               '    parent.postMessage({type:"pg-error", message: msg, line: line, col: col}, "*");\n' +
               '  };\n' +
               '  try {\n' + js + '\n' +
               '  } catch(e){\n' +
               '    window.onerror(e.message, "", 0, 0, e);\n' +
               '  }\n' +
               '})();<\/script>\n' +
               '</body>\n</html>';
    }

    // ---- Update preview iframe ----
    function updatePreview() {
        if (!monacoReady) return;
        iframe.srcdoc = buildPreviewHTML();
    }

    // ---- Debounced preview ----
    function schedulePreview() {
        if (previewTimer) clearTimeout(previewTimer);
        previewTimer = setTimeout(updatePreview, 500);
    }

    // ---- Console ----
    function clearConsole() {
        consoleBody.innerHTML = '<div class="console-empty">Console cleared.</div>';
    }

    function addConsoleLine(message, type) {
        var empty = consoleBody.querySelector('.console-empty');
        if (empty) empty.remove();

        var line = document.createElement('div');
        line.className = 'console-line ' + (type || 'error');

        var icon = type === 'info' ? 'bi-info-circle' : type === 'success' ? 'bi-check-circle' : 'bi-x-circle-fill';
        line.innerHTML = '<i class="bi ' + icon + ' console-icon"></i><span class="console-msg"></span>';
        line.querySelector('.console-msg').textContent = message;

        consoleBody.appendChild(line);
        consoleBody.scrollTop = consoleBody.scrollHeight;
    }

    // Listen for errors from iframe
    window.addEventListener('message', function (e) {
        if (e.data && e.data.type === 'pg-error') {
            var msg = e.data.message;
            if (e.data.line) msg += ' (line ' + e.data.line + ')';
            addConsoleLine(msg, 'error');
        }
    });

    // ---- Tab switching ----
    editorTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var target = this.dataset.editor;

            editorTabs.forEach(function (t) { t.classList.remove('active'); });
            editorWrappers.forEach(function (w) { w.classList.remove('active'); });

            this.classList.add('active');
            document.getElementById('editor-' + target).classList.add('active');

            activeEditor = target;

            // Force Monaco to recalculate layout
            if (editors[target]) {
                editors[target].layout();
            }
        });
    });

    // ---- Resizer ----
    var isResizing = false;

    resizer.addEventListener('mousedown', function (e) {
        isResizing = true;
        layout.classList.add('resizing');
        e.preventDefault();
    });

    document.addEventListener('mousemove', function (e) {
        if (!isResizing) return;
        var rect = layout.getBoundingClientRect();
        var pct = ((e.clientX - rect.left) / rect.width) * 100;
        pct = Math.max(20, Math.min(80, pct));
        layout.style.gridTemplateColumns = pct + '% 6px ' + (100 - pct) + '%';
    });

    document.addEventListener('mouseup', function () {
        if (isResizing) {
            isResizing = false;
            layout.classList.remove('resizing');
            // Re-layout all editors
            Object.keys(editors).forEach(function (k) { editors[k].layout(); });
        }
    });

    // ---- Console collapse ----
    consoleHeader.addEventListener('click', function () {
        consolePanel.classList.toggle('collapsed');
    });

    consoleClearBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        clearConsole();
    });

    // ---- Run button ----
    runBtn.addEventListener('click', function () {
        updatePreview();
        if (window.showToast) showToast('Preview refreshed.', 'info');
    });

    // ---- Refresh preview button ----
    refreshPreviewBtn.addEventListener('click', function () {
        updatePreview();
    });

    // ---- Reset button ----
    resetBtn.addEventListener('click', function () {
        if (!monacoReady) return;
        var activeTemplate = document.querySelector('.template-btn.active');
        var templateKey = activeTemplate ? activeTemplate.dataset.template : 'landing';
        var tpl = TEMPLATES[templateKey] || TEMPLATES.landing;

        editors.html.setValue(tpl.html);
        editors.css.setValue(tpl.css);
        editors.js.setValue(tpl.js);

        clearConsole();
        updatePreview();

        if (window.showToast) showToast('Editor reset to template.', 'info');
    });

    // ---- Copy button ----
    copyBtn.addEventListener('click', function () {
        if (!monacoReady) return;
        var combined = '<!-- HTML -->\n' + editors.html.getValue() +
            '\n\n<!-- CSS -->\n<style>\n' + editors.css.getValue() +
            '\n</style>\n\n<!-- JS -->\n<script>\n' + editors.js.getValue() + '\n<\/script>';

        navigator.clipboard.writeText(combined).then(function () {
            if (window.showToast) showToast('Code copied to clipboard!', 'success');
        }).catch(function () {
            if (window.showToast) showToast('Failed to copy. Try again.', 'error');
        });
    });

    // ---- Download ZIP button ----
    downloadBtn.addEventListener('click', function () {
        if (!monacoReady) return;
        if (typeof JSZip === 'undefined') {
            if (window.showToast) showToast('ZIP library not loaded.', 'error');
            return;
        }

        var zip = new JSZip();
        zip.file('index.html', '<!DOCTYPE html>\n<html>\n<head>\n<meta charset="UTF-8">\n<link rel="stylesheet" href="style.css">\n</head>\n<body>\n' + editors.html.getValue() + '\n<script src="script.js"><\/script>\n</body>\n</html>');
        zip.file('style.css', editors.css.getValue());
        zip.file('script.js', editors.js.getValue());

        zip.generateAsync({ type: 'blob' }).then(function (content) {
            var url = URL.createObjectURL(content);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'playground-project.zip';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);

            if (window.showToast) showToast('Project ZIP downloaded!', 'success');
        }).catch(function () {
            if (window.showToast) showToast('Failed to create ZIP.', 'error');
        });
    });

    // ---- Template loader ----
    templateBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var key = this.dataset.template;
            var tpl = TEMPLATES[key];
            if (!tpl || !monacoReady) return;

            templateBtns.forEach(function (b) { b.classList.remove('active'); });
            this.classList.add('active');

            editors.html.setValue(tpl.html);
            editors.css.setValue(tpl.css);
            editors.js.setValue(tpl.js);

            clearConsole();
            updatePreview();

            if (window.showToast) showToast('Template loaded: ' + this.textContent.trim(), 'info');
        });
    });

    // ---- Theme sync ----
    // Watch for data-bs-theme changes on <html>
    var themeObserver = new MutationObserver(function (mutations) {
        mutations.forEach(function (m) {
            if (m.attributeName === 'data-bs-theme') {
                var newTheme = document.documentElement.getAttribute('data-bs-theme') === 'light' ? 'vs' : 'vs-dark';
                if (monacoReady && typeof monaco !== 'undefined') {
                    monaco.editor.setTheme(newTheme);
                }
            }
        });
    });
    themeObserver.observe(document.documentElement, { attributes: true });

    // ---- Init ----
    initMonaco();
})();
