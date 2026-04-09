<?php
// ============================================================
// 🔥 BIHARI NUMBER BOT - ULTIMATE ADMIN PANEL 2026 🔥
// SINGLE FILE VERSION | DEPLOY ON RENDER | HACKER STYLE
// ============================================================

session_start();

// ========== CONFIGURATION ==========
define('ADMIN_PASSWORD', 'Vikram@8936');  // ⚠️ CHANGE THIS!
define('BOT_API_URL', 'https://your-bot.onrender.com'); // Your bot webhook URL

// ========== CHECK AUTH ==========
$isLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// ========== HANDLE API REQUESTS ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Login
    if (isset($input['action']) && $input['action'] === 'login') {
        if ($input['password'] === ADMIN_PASSWORD) {
            $_SESSION['admin_logged_in'] = true;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid password']);
        }
        exit;
    }
    
    // Logout
    if (isset($input['action']) && $input['action'] === 'logout') {
        session_destroy();
        echo json_encode(['success' => true]);
        exit;
    }
    
    // Check auth for all other actions
    if (!$isLoggedIn) {
        echo json_encode(['error' => 'Unauthorized', 'login_required' => true]);
        exit;
    }
    
    // Get data from bot (you'll need to implement bot API calls)
    if (isset($input['action']) && $input['action'] === 'get_stats') {
        echo json_encode([
            'success' => true,
            'stats' => [
                'total_users' => 1247,
                'banned_users' => 23,
                'premium_users' => 89,
                'total_searches' => 15234,
                'total_credits' => 45200,
                'active_today' => 156
            ]
        ]);
        exit;
    }
    
    if (isset($input['action']) && $input['action'] === 'get_users') {
        echo json_encode([
            'success' => true,
            'users' => [
                ['id' => 5207471711, 'name' => 'Bihari Admin', 'credits' => 9999, 'premium' => true, 'searches' => 5000, 'joined' => '2024-01-01'],
                ['id' => 1234567890, 'name' => 'User1', 'credits' => 50, 'premium' => false, 'searches' => 120, 'joined' => '2024-06-15'],
                ['id' => 9876543210, 'name' => 'User2', 'credits' => 10, 'premium' => false, 'searches' => 45, 'joined' => '2024-07-20']
            ]
        ]);
        exit;
    }
    
    echo json_encode(['success' => false, 'error' => 'Unknown action']);
    exit;
}

// ========== IF NOT LOGGED IN, SHOW LOGIN PAGE ==========
if (!$isLoggedIn) {
    ?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIHARI BOT | ADMIN LOGIN</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: radial-gradient(circle at 30% 10%, #0a0a0a 0%, #050510 100%);
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        /* Matrix Rain Effect */
        .matrix-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .matrix-bg::before {
            content: "01";
            position: absolute;
            font-family: monospace;
            font-size: 14px;
            color: rgba(0, 255, 0, 0.05);
            white-space: nowrap;
            animation: matrixRain 20s linear infinite;
        }

        @keyframes matrixRain {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(100%); }
        }

        /* Login Card */
        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: rgba(5, 5, 15, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            border: 1px solid rgba(255, 0, 0, 0.4);
            box-shadow: 0 0 50px rgba(255, 0, 0, 0.2);
            overflow: hidden;
            transition: all 0.3s;
        }

        .login-card:hover {
            border-color: #ff0000;
            box-shadow: 0 0 70px rgba(255, 0, 0, 0.3);
        }

        .card-header {
            background: linear-gradient(135deg, #ff0000, #660000);
            padding: 35px;
            text-align: center;
        }

        .logo-icon {
            font-size: 70px;
            color: white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); text-shadow: 0 0 20px white; }
            50% { transform: scale(1.05); text-shadow: 0 0 40px white; }
        }

        .card-header h1 {
            font-family: 'Orbitron', monospace;
            font-size: 28px;
            color: white;
            margin-top: 15px;
            letter-spacing: 4px;
        }

        .card-header p {
            color: rgba(255,255,255,0.7);
            font-size: 12px;
            margin-top: 5px;
        }

        .card-body {
            padding: 40px;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ff0000;
            font-size: 18px;
        }

        .input-group input {
            width: 100%;
            padding: 15px 15px 15px 50px;
            background: rgba(0,0,0,0.6);
            border: 1px solid rgba(255,0,0,0.3);
            border-radius: 15px;
            color: white;
            font-size: 16px;
            transition: all 0.3s;
        }

        .input-group input:focus {
            outline: none;
            border-color: #ff0000;
            box-shadow: 0 0 15px rgba(255,0,0,0.3);
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #ff0000, #660000);
            border: none;
            border-radius: 15px;
            color: white;
            font-size: 18px;
            font-weight: 600;
            font-family: 'Orbitron', monospace;
            cursor: pointer;
            transition: all 0.3s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255,0,0,0.4);
        }

        .error-msg {
            background: rgba(255,0,0,0.2);
            border: 1px solid #ff0000;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 20px;
            text-align: center;
            color: #ff6666;
            display: none;
        }

        .powered {
            text-align: center;
            margin-top: 20px;
            color: rgba(255,255,255,0.3);
            font-size: 11px;
        }

        @media (max-width: 480px) {
            .card-body { padding: 30px 25px; }
            .card-header h1 { font-size: 22px; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <i class="fas fa-skull logo-icon"></i>
                <h1>BIHARI BOT</h1>
                <p>ADMIN CONTROL PANEL v2.0</p>
            </div>
            <div class="card-body">
                <div class="error-msg" id="errorMsg">
                    <i class="fas fa-exclamation-triangle"></i> Invalid password!
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" placeholder="ENTER ADMIN PASSWORD" autocomplete="off">
                </div>
                
                <button class="login-btn" onclick="login()">
                    <i class="fas fa-sign-in-alt"></i> ACCESS PANEL
                </button>
                
                <div class="powered">
                    🔒 SECURE CONNECTION • ENCRYPTED SESSION
                </div>
            </div>
        </div>
        <div class="powered">
            POWERED BY BIHARI NUMBER BOT • ULTIMATE EDITION 2026
        </div>
    </div>

    <script>
        async function login() {
            const password = document.getElementById('password').value;
            const errorMsg = document.getElementById('errorMsg');
            
            if (!password) {
                errorMsg.textContent = '⚠️ Enter password first!';
                errorMsg.style.display = 'block';
                setTimeout(() => errorMsg.style.display = 'none', 2000);
                return;
            }
            
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'login', password: password })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    window.location.reload();
                } else {
                    errorMsg.textContent = '❌ ACCESS DENIED! Wrong password.';
                    errorMsg.style.display = 'block';
                    setTimeout(() => errorMsg.style.display = 'none', 3000);
                }
            } catch (err) {
                errorMsg.textContent = '⚠️ Connection error!';
                errorMsg.style.display = 'block';
            }
        }
        
        document.getElementById('password').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') login();
        });
    </script>
</body>
</html>
    <?php
    exit;
}

// ========== DASHBOARD PAGE (LOGGED IN) ==========
?>
<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIHARI BOT | Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #0a0a0f;
            color: #fff;
            overflow-x: hidden;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #1a1a1a; }
        ::-webkit-scrollbar-thumb { background: #ff0000; border-radius: 10px; }

        /* App Container */
        .app {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #0f0f1a 0%, #05050a 100%);
            border-right: 1px solid rgba(255,0,0,0.2);
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            transition: all 0.3s;
            z-index: 100;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .logo span,
        .sidebar.collapsed .nav-item span,
        .sidebar.collapsed .footer-text {
            display: none;
        }

        .sidebar.collapsed .nav-item {
            justify-content: center;
            padding: 15px;
        }

        .sidebar.collapsed .nav-item i {
            margin-right: 0;
            font-size: 22px;
        }

        /* Sidebar Header */
        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,0,0,0.2);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Orbitron', monospace;
            font-size: 22px;
            font-weight: 700;
        }

        .logo i {
            color: #ff0000;
            font-size: 32px;
        }

        .logo span {
            background: linear-gradient(135deg, #fff, #ff4444);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .version {
            font-size: 10px;
            color: rgba(255,255,255,0.4);
            margin-top: 5px;
        }

        /* Navigation */
        .sidebar-nav {
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 12px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .nav-item i {
            width: 24px;
        }

        .nav-item:hover {
            background: rgba(255,0,0,0.1);
            color: #fff;
        }

        .nav-item.active {
            background: linear-gradient(135deg, #ff0000, #8b0000);
            color: white;
            box-shadow: 0 5px 15px rgba(255,0,0,0.3);
        }

        .badge {
            margin-left: auto;
            background: #ff0000;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 11px;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            border-top: 1px solid rgba(255,0,0,0.2);
        }

        .logout-btn {
            width: 100%;
            background: rgba(255,0,0,0.15);
            border: 1px solid rgba(255,0,0,0.3);
            padding: 12px;
            border-radius: 12px;
            color: #ff6666;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background: rgba(255,0,0,0.3);
            color: white;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            transition: all 0.3s;
        }

        .sidebar.collapsed + .main-content {
            margin-left: 80px;
        }

        /* Top Bar */
        .top-bar {
            background: rgba(10,10,20,0.95);
            backdrop-filter: blur(10px);
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255,0,0,0.2);
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .menu-toggle {
            background: transparent;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
        }

        .menu-toggle:hover {
            background: rgba(255,0,0,0.2);
        }

        .live-badge {
            background: rgba(255,0,0,0.2);
            padding: 5px 12px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
        }

        .live-badge i {
            color: #ff0000;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        /* Content Area */
        .content-area {
            padding: 25px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(20,20,35,0.9), rgba(10,10,20,0.9));
            border-radius: 20px;
            padding: 25px;
            border: 1px solid rgba(255,0,0,0.2);
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255,0,0,0.5);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .stat-icon {
            font-size: 40px;
            color: #ff0000;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            font-family: 'Orbitron', monospace;
        }

        .stat-label {
            color: rgba(255,255,255,0.6);
            font-size: 14px;
            margin-top: 5px;
        }

        /* Charts */
        .chart-container {
            background: rgba(20,20,35,0.9);
            border-radius: 20px;
            padding: 20px;
            border: 1px solid rgba(255,0,0,0.2);
            margin-bottom: 30px;
        }

        .chart-title {
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        /* Tables */
        .data-table {
            background: rgba(20,20,35,0.9);
            border-radius: 20px;
            padding: 20px;
            border: 1px solid rgba(255,0,0,0.2);
            overflow-x: auto;
        }

        .data-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .data-table th {
            color: #ff0000;
            font-weight: 600;
        }

        .premium-badge {
            background: linear-gradient(135deg, #ffd700, #ff8c00);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            color: #000;
            font-weight: 600;
        }

        .ban-btn {
            background: rgba(255,0,0,0.2);
            border: 1px solid #ff0000;
            padding: 5px 12px;
            border-radius: 8px;
            color: #ff6666;
            cursor: pointer;
            font-size: 12px;
        }

        .ban-btn:hover {
            background: #ff0000;
            color: white;
        }

        .add-credits {
            background: rgba(0,255,0,0.2);
            border: 1px solid #00ff00;
            padding: 5px 12px;
            border-radius: 8px;
            color: #00ff00;
            cursor: pointer;
            font-size: 12px;
        }

        /* Settings Panel */
        .settings-panel {
            background: rgba(20,20,35,0.9);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid rgba(255,0,0,0.2);
        }

        .setting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .setting-label {
            font-weight: 500;
        }

        .setting-value {
            font-family: monospace;
            color: #ff6666;
        }

        .edit-btn {
            background: rgba(255,0,0,0.2);
            border: none;
            padding: 5px 15px;
            border-radius: 8px;
            color: #ff6666;
            cursor: pointer;
        }

        /* Toggle Switch */
        .toggle-switch {
            width: 50px;
            height: 24px;
            background: #333;
            border-radius: 30px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s;
        }

        .toggle-switch.active {
            background: #ff0000;
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            top: 2px;
            left: 3px;
            transition: all 0.3s;
        }

        .toggle-switch.active::after {
            left: 27px;
        }

        /* Loader */
        .loader {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border: 3px solid #333;
            border-top-color: #ff0000;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            z-index: 1000;
        }

        @keyframes spin {
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.mobile-open { transform: translateX(0); }
            .main-content { margin-left: 0 !important; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="loader" id="loader"></div>

    <div class="app">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-skull"></i>
                    <span>BIHARI<span style="color:#ff0000">BOT</span></span>
                </div>
                <div class="version">ULTIMATE EDITION 2026</div>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-item active" data-page="dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </div>
                <div class="nav-item" data-page="users">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                    <span class="badge" id="userBadge">0</span>
                </div>
                <div class="nav-item" data-page="settings">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </div>
                <div class="nav-item" data-page="messages">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                </div>
                <div class="nav-item" data-page="force-chats">
                    <i class="fas fa-link"></i>
                    <span>Force Chats</span>
                </div>
                <div class="nav-item" data-page="whitelist">
                    <i class="fas fa-list-ul"></i>
                    <span>Whitelist</span>
                </div>
                <div class="nav-item" data-page="apis">
                    <i class="fas fa-plug"></i>
                    <span>APIs</span>
                </div>
                <div class="nav-item" data-page="admins">
                    <i class="fas fa-user-shield"></i>
                    <span>Admins</span>
                </div>
                <div class="nav-item" data-page="logs">
                    <i class="fas fa-history"></i>
                    <span>Logs</span>
                </div>
            </nav>
            
            <div class="sidebar-footer">
                <button class="logout-btn" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="footer-text">Logout</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="top-bar">
                <button class="menu-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="live-badge">
                    <i class="fas fa-circle"></i>
                    <span>SYSTEM ONLINE</span>
                </div>
            </div>

            <div class="content-area" id="contentArea">
                <!-- Dynamic content loads here -->
                <div style="text-align: center; padding: 50px;">
                    <i class="fas fa-spinner fa-spin" style="font-size: 40px; color: #ff0000;"></i>
                    <p style="margin-top: 20px;">Loading dashboard...</p>
                </div>
            </div>
        </main>
    </div>

    <script>
        // ========== GLOBAL VARIABLES ==========
        let currentPage = 'dashboard';
        let statsChart = null;

        // ========== INITIALIZE ==========
        document.addEventListener('DOMContentLoaded', function() {
            loadPage('dashboard');
            
            // Add click listeners to nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', function() {
                    const page = this.dataset.page;
                    if (page) {
                        loadPage(page);
                    }
                });
            });
        });

        // ========== TOGGLE SIDEBAR ==========
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
            
            // For mobile
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('mobile-open');
            }
        }

        // ========== LOAD PAGE ==========
        async function loadPage(page) {
            currentPage = page;
            
            // Update active nav item
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
                if (item.dataset.page === page) {
                    item.classList.add('active');
                }
            });
            
            // Show loader
            document.getElementById('loader').style.display = 'block';
            
            // Load page content
            switch(page) {
                case 'dashboard':
                    await loadDashboard();
                    break;
                case 'users':
                    await loadUsers();
                    break;
                case 'settings':
                    await loadSettings();
                    break;
                case 'messages':
                    await loadMessages();
                    break;
                case 'force-chats':
                    await loadForceChats();
                    break;
                case 'whitelist':
                    await loadWhitelist();
                    break;
                case 'apis':
                    await loadApis();
                    break;
                case 'admins':
                    await loadAdmins();
                    break;
                case 'logs':
                    await loadLogs();
                    break;
            }
            
            document.getElementById('loader').style.display = 'none';
        }

        // ========== DASHBOARD ==========
        async function loadDashboard() {
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'get_stats' })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const stats = data.stats;
                    
                    document.getElementById('userBadge').textContent = stats.total_users;
                    
                    const html = `
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-users"></i></div>
                                <div class="stat-value">${formatNumber(stats.total_users)}</div>
                                <div class="stat-label">Total Users</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-ban"></i></div>
                                <div class="stat-value">${formatNumber(stats.banned_users)}</div>
                                <div class="stat-label">Banned Users</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-crown"></i></div>
                                <div class="stat-value">${formatNumber(stats.premium_users)}</div>
                                <div class="stat-label">Premium Users</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-search"></i></div>
                                <div class="stat-value">${formatNumber(stats.total_searches)}</div>
                                <div class="stat-label">Total Searches</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-coins"></i></div>
                                <div class="stat-value">${formatNumber(stats.total_credits)}</div>
                                <div class="stat-label">Total Credits</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                                <div class="stat-value">${formatNumber(stats.active_today)}</div>
                                <div class="stat-label">Active Today</div>
                            </div>
                        </div>
                        
                        <div class="chart-container">
                            <div class="chart-title"><i class="fas fa-chart-line"></i> User Growth</div>
                            <canvas id="growthChart" height="100"></canvas>
                        </div>
                        
                        <div class="data-table">
                            <div class="chart-title"><i class="fas fa-trophy"></i> Top Users</div>
                            <table>
                                <thead>
                                    <tr><th>Rank</th><th>User ID</th><th>Searches</th><th>Status</th></tr>
                                </thead>
                                <tbody id="topUsersList"></tbody>
                            </table>
                        </div>
                    `;
                    
                    document.getElementById('contentArea').innerHTML = html;
                    
                    // Load top users
                    await loadTopUsers();
                    
                    // Create chart
                    createChart();
                }
            } catch (err) {
                console.error(err);
                document.getElementById('contentArea').innerHTML = '<div style="text-align:center;padding:50px;color:#ff6666;">❌ Failed to load dashboard</div>';
            }
        }

        async function loadTopUsers() {
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'get_users' })
                });
                
                const data = await response.json();
                
                if (data.success && data.users) {
                    const sorted = [...data.users].sort((a,b) => b.searches - a.searches).slice(0,5);
                    const tbody = document.getElementById('topUsersList');
                    tbody.innerHTML = sorted.map((user, i) => `
                        <tr>
                            <td>${i+1}</td>
                            <td>${user.id}</td>
                            <td>${formatNumber(user.searches)}</td>
                            <td>${user.premium ? '<span class="premium-badge">PREMIUM</span>' : 'Normal'}</td>
                        </tr>
                    `).join('');
                }
            } catch (err) {
                console.error(err);
            }
        }

        function createChart() {
            const ctx = document.getElementById('growthChart').getContext('2d');
            if (statsChart) statsChart.destroy();
            
            statsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'New Users',
                        data: [45, 62, 78, 95, 120, 145, 170, 200, 230, 260, 290, 320],
                        borderColor: '#ff0000',
                        backgroundColor: 'rgba(255, 0, 0, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: { labels: { color: '#fff' } }
                    },
                    scales: {
                        y: { grid: { color: 'rgba(255,255,255,0.1)' }, ticks: { color: '#fff' } },
                        x: { grid: { color: 'rgba(255,255,255,0.1)' }, ticks: { color: '#fff' } }
                    }
                }
            });
        }

        // ========== USERS PAGE ==========
        async function loadUsers() {
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'get_users' })
                });
                
                const data = await response.json();
                
                if (data.success && data.users) {
                    const html = `
                        <div class="data-table">
                            <div class="chart-title">
                                <i class="fas fa-users"></i> All Users
                                <input type="text" id="searchUser" placeholder="🔍 Search user..." style="float:right;padding:8px 15px;border-radius:10px;border:none;background:#1a1a2e;color:white;">
                            </div>
                            <div style="overflow-x:auto;">
                                <table>
                                    <thead>
                                        <tr><th>ID</th><th>Name</th><th>Credits</th><th>Premium</th><th>Searches</th><th>Joined</th><th>Actions</th></tr>
                                    </thead>
                                    <tbody id="usersTableBody"></tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div style="margin-top:20px;display:flex;gap:10px;flex-wrap:wrap;">
                            <input type="number" id="creditUserId" placeholder="User ID" style="padding:10px;border-radius:10px;border:none;background:#1a1a2e;color:white;">
                            <input type="number" id="creditAmount" placeholder="Amount" style="padding:10px;border-radius:10px;border:none;background:#1a1a2e;color:white;">
                            <button onclick="addCredits()" class="add-credits" style="padding:10px 20px;">➕ Add Credits</button>
                        </div>
                    `;
                    
                    document.getElementById('contentArea').innerHTML = html;
                    
                    const tbody = document.getElementById('usersTableBody');
                    tbody.innerHTML = data.users.map(user => `
                        <tr>
                            <td>${user.id}</td>
                            <td>${user.name || 'User'}</td>
                            <td>${user.credits}</td>
                            <td>${user.premium ? '<span class="premium-badge">PREMIUM</span>' : 'Normal'}</td>
                            <td>${formatNumber(user.searches)}</td>
                            <td>${user.joined}</td>
                            <td>
                                <button class="ban-btn" onclick="banUser(${user.id})">🔨 Ban</button>
                                <button class="add-credits" onclick="quickAddCredits(${user.id})">💰 Add</button>
                            </td>
                        </tr>
                    `).join('');
                    
                    // Search functionality
                    document.getElementById('searchUser').addEventListener('input', function(e) {
                        const search = e.target.value.toLowerCase();
                        const rows = tbody.getElementsByTagName('tr');
                        for (let row of rows) {
                            const text = row.textContent.toLowerCase();
                            row.style.display = text.includes(search) ? '' : 'none';
                        }
                    });
                }
            } catch (err) {
                console.error(err);
                document.getElementById('contentArea').innerHTML = '<div style="text-align:center;padding:50px;color:#ff6666;">❌ Failed to load users</div>';
            }
        }

        // ========== SETTINGS PAGE ==========
        async function loadSettings() {
            const html = `
                <div class="settings-panel">
                    <div class="chart-title"><i class="fas fa-cog"></i> Bot Settings</div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Default Credits (New User)</div>
                        <div><span class="setting-value" id="defaultCredits">2</span> <button class="edit-btn" onclick="editSetting('default_credits')">Edit</button></div>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Referrer Bonus (Credits)</div>
                        <div><span class="setting-value" id="referrerBonus">3</span> <button class="edit-btn" onclick="editSetting('referrer_bonus')">Edit</button></div>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Premium Price (Credits/30 days)</div>
                        <div><span class="setting-value" id="premiumPrice">50</span> <button class="edit-btn" onclick="editSetting('premium_price')">Edit</button></div>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Rate Limit (Seconds between searches)</div>
                        <div><span class="setting-value" id="rateLimit">1</span> <button class="edit-btn" onclick="editSetting('rate_limit_seconds')">Edit</button></div>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Spam Threshold (Reports to mark spam)</div>
                        <div><span class="setting-value" id="spamThreshold">3</span> <button class="edit-btn" onclick="editSetting('spam_threshold')">Edit</button></div>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Credit Per Search</div>
                        <div><span class="setting-value" id="creditPerSearch">1</span> <button class="edit-btn" onclick="editSetting('credit_per_search')">Edit</button></div>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Force Subscription</div>
                        <div><div class="toggle-switch" id="forceSubToggle" onclick="toggleSetting('force_sub_enabled')"></div></div>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Whitelist Mode</div>
                        <div><div class="toggle-switch" id="whitelistToggle" onclick="toggleSetting('whitelist_enabled')"></div></div>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Maintenance Mode</div>
                        <div><div class="toggle-switch" id="maintenanceToggle" onclick="toggleSetting('maintenance_mode')"></div></div>
                    </div>
                </div>
            `;
            
            document.getElementById('contentArea').innerHTML = html;
            
            // Load current settings
            await loadCurrentSettings();
        }

        async function loadCurrentSettings() {
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'get_settings' })
                });
                
                const data = await response.json();
                
                if (data.success && data.settings) {
                    const s = data.settings;
                    document.getElementById('defaultCredits').textContent = s.default_credits || 2;
                    document.getElementById('referrerBonus').textContent = s.referrer_bonus || 3;
                    document.getElementById('premiumPrice').textContent = s.premium_price || 50;
                    document.getElementById('rateLimit').textContent = s.rate_limit_seconds || 1;
                    document.getElementById('spamThreshold').textContent = s.spam_threshold || 3;
                    document.getElementById('creditPerSearch').textContent = s.credit_per_search || 1;
                    
                    const forceToggle = document.getElementById('forceSubToggle');
                    if (s.force_sub_enabled) forceToggle.classList.add('active');
                    else forceToggle.classList.remove('active');
                    
                    const whitelistToggle = document.getElementById('whitelistToggle');
                    if (s.whitelist_enabled) whitelistToggle.classList.add('active');
                    else whitelistToggle.classList.remove('active');
                    
                    const maintenanceToggle = document.getElementById('maintenanceToggle');
                    if (s.maintenance_mode) maintenanceToggle.classList.add('active');
                    else maintenanceToggle.classList.remove('active');
                }
            } catch (err) {
                console.error(err);
            }
        }

        // ========== MESSAGES PAGE ==========
        async function loadMessages() {
            const html = `
                <div class="settings-panel">
                    <div class="chart-title"><i class="fas fa-envelope"></i> Bot Messages</div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Welcome Message</div>
                        <button class="edit-btn" onclick="editMessage('welcome')">Edit</button>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Force Subscription Message</div>
                        <button class="edit-btn" onclick="editMessage('force_sub')">Edit</button>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Not Allowed Message</div>
                        <button class="edit-btn" onclick="editMessage('not_allowed')">Edit</button>
                    </div>
                    
                    <div class="setting-item">
                        <div class="setting-label">Maintenance Message</div>
                        <button class="edit-btn" onclick="editMessage('maintenance')">Edit</button>
                    </div>
                </div>
            `;
            document.getElementById('contentArea').innerHTML = html;
        }

        // ========== FORCE CHATS PAGE ==========
        async function loadForceChats() {
            const html = `
                <div class="settings-panel">
                    <div class="chart-title"><i class="fas fa-link"></i> Force Subscription Chats</div>
                    
                    <div id="forceChatsList"></div>
                    
                    <div style="margin-top:20px;">
                        <h4>Add New Chat</h4>
                        <input type="text" id="newChatId" placeholder="Chat ID" style="width:100%;padding:10px;margin:5px 0;border-radius:10px;border:none;background:#1a1a2e;color:white;">
                        <input type="text" id="newChatLink" placeholder="Invite Link" style="width:100%;padding:10px;margin:5px 0;border-radius:10px;border:none;background:#1a1a2e;color:white;">
                        <input type="text" id="newChatName" placeholder="Chat Name" style="width:100%;padding:10px;margin:5px 0;border-radius:10px;border:none;background:#1a1a2e;color:white;">
                        <button onclick="addForceChat()" class="add-credits" style="margin-top:10px;padding:10px 20px;">➕ Add Chat</button>
                    </div>
                </div>
            `;
            document.getElementById('contentArea').innerHTML = html;
            await loadForceChatsList();
        }

        async function loadForceChatsList() {
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'get_force_chats' })
                });
                
                const data = await response.json();
                
                if (data.success && data.force_chats) {
                    const container = document.getElementById('forceChatsList');
                    container.innerHTML = data.force_chats.map((chat, i) => `
                        <div class="setting-item">
                            <div><strong>${chat.name}</strong><br><small>ID: ${chat.id}</small></div>
                            <button class="ban-btn" onclick="removeForceChat(${i})">Remove</button>
                        </div>
                    `).join('');
                }
            } catch (err) {
                console.error(err);
            }
        }

        // ========== WHITELIST PAGE ==========
        async function loadWhitelist() {
            const html = `
                <div class="settings-panel">
                    <div class="chart-title"><i class="fas fa-list-ul"></i> Whitelisted Groups</div>
                    
                    <div id="whitelistList"></div>
                    
                    <div style="margin-top:20px;">
                        <input type="text" id="newGroupId" placeholder="Group ID (e.g., -1001234567890)" style="width:100%;padding:10px;border-radius:10px;border:none;background:#1a1a2e;color:white;">
                        <button onclick="addToWhitelist()" class="add-credits" style="margin-top:10px;padding:10px 20px;">➕ Add Group</button>
                    </div>
                </div>
            `;
            document.getElementById('contentArea').innerHTML = html;
            await loadWhitelistList();
        }

        async function loadWhitelistList() {
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'get_whitelist' })
                });
                
                const data = await response.json();
                
                if (data.success && data.whitelist) {
                    const container = document.getElementById('whitelistList');
                    if (data.whitelist.length === 0) {
                        container.innerHTML = '<p style="color:#666;">No whitelisted groups yet.</p>';
                    } else {
                        container.innerHTML = data.whitelist.map((gid, i) => `
                            <div class="setting-item">
                                <div><code>${gid}</code></div>
                                <button class="ban-btn" onclick="removeFromWhitelist(${i})">Remove</button>
                            </div>
                        `).join('');
                    }
                }
            } catch (err) {
                console.error(err);
            }
        }

        // ========== APIS PAGE ==========
        async function loadApis() {
            const html = `
                <div class="settings-panel">
                    <div class="chart-title"><i class="fas fa-plug"></i> API Configuration</div>
                    
                    <h3>📞 Number Lookup APIs</h3>
                    <div id="numberApisList"></div>
                    
                    <h3 style="margin-top:20px;">🚗 Vehicle Lookup APIs</h3>
                    <div id="vehicleApisList"></div>
                </div>
            `;
            document.getElementById('contentArea').innerHTML = html;
            await loadApisList();
        }

        async function loadApisList() {
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'get_apis' })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const numberContainer = document.getElementById('numberApisList');
                    if (data.number_apis && data.number_apis.length) {
                        numberContainer.innerHTML = data.number_apis.map((api, i) => `
                            <div class="setting-item">
                                <div><strong>API ${i+1}</strong><br><small>${api.base}</small></div>
                                <button class="ban-btn" onclick="testApi(${i}, 'number')">Test</button>
                            </div>
                        `).join('');
                    } else {
                        numberContainer.innerHTML = '<p style="color:#666;">No number APIs configured.</p>';
                    }
                    
                    const vehicleContainer = document.getElementById('vehicleApisList');
                    if (data.vehicle_apis && data.vehicle_apis.length) {
                        vehicleContainer.innerHTML = data.vehicle_apis.map((api, i) => `
                            <div class="setting-item">
                                <div><strong>API ${i+1}</strong><br><small>${api.base}</small></div>
                                <button class="ban-btn" onclick="testApi(${i}, 'vehicle')">Test</button>
                            </div>
                        `).join('');
                    } else {
                        vehicleContainer.innerHTML = '<p style="color:#666;">No vehicle APIs configured.</p>';
                    }
                }
            } catch (err) {
                console.error(err);
            }
        }

        // ========== ADMINS PAGE ==========
        async function loadAdmins() {
            const html = `
                <div class="settings-panel">
                    <div class="chart-title"><i class="fas fa-user-shield"></i> Admin Management</div>
                    
                    <div id="adminsList"></div>
                    
                    <div style="margin-top:20px;">
                        <input type="text" id="newAdminId" placeholder="User ID to add as admin" style="width:100%;padding:10px;border-radius:10px;border:none;background:#1a1a2e;color:white;">
                        <button onclick="addAdmin()" class="add-credits" style="margin-top:10px;padding:10px 20px;">➕ Add Admin</button>
                    </div>
                </div>
            `;
            document.getElementById('contentArea').innerHTML = html;
            await loadAdminsList();
        }

        async function loadAdminsList() {
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'get_admins' })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const container = document.getElementById('adminsList');
                    const mainAdmin = data.admins ? data.admins[0] : 5207471711;
                    const subAdmins = data.admins ? data.admins.slice(1) : [];
                    
                    container.innerHTML = `
                        <div class="setting-item">
                            <div><strong>👑 MAIN ADMIN</strong><br><small>ID: ${mainAdmin}</small></div>
                            <span class="premium-badge">Full Access</span>
                        </div>
                        ${subAdmins.map(admin => `
                            <div class="setting-item">
                                <div><strong>👤 Sub-Admin</strong><br><small>ID: ${admin}</small></div>
                                <button class="ban-btn" onclick="removeAdmin(${admin})">Remove</button>
                            </div>
                        `).join('')}
                    `;
                }
            } catch (err) {
                console.error(err);
            }
        }

        // ========== LOGS PAGE ==========
        async function loadLogs() {
            const html = `
                <div class="settings-panel">
                    <div class="chart-title"><i class="fas fa-history"></i> System Logs</div>
                    <pre id="logsContent" style="background:#0a0a0f;padding:15px;border-radius:10px;overflow-x:auto;font-size:12px;max-height:500px;overflow-y:auto;"></pre>
                    <button onclick="refreshLogs()" class="add-credits" style="margin-top:10px;padding:10px 20px;">🔄 Refresh Logs</button>
                </div>
            `;
            document.getElementById('contentArea').innerHTML = html;
            await refreshLogs();
        }

        async function refreshLogs() {
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'get_logs' })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    document.getElementById('logsContent').textContent = data.logs || 'No logs available.';
                }
            } catch (err) {
                console.error(err);
            }
        }

        // ========== HELPER FUNCTIONS ==========
        function formatNumber(num) {
            if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
            if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
            return num.toString();
        }

        async function logout() {
            try {
                await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'logout' })
                });
                window.location.reload();
            } catch (err) {
                window.location.reload();
            }
        }

        // User actions
        async function addCredits() {
            const userId = document.getElementById('creditUserId').value;
            const amount = document.getElementById('creditAmount').value;
            
            if (!userId || !amount) {
                alert('Please enter User ID and Amount');
                return;
            }
            
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'add_credits', user_id: userId, amount: parseInt(amount) })
                });
                
                const data = await response.json();
                if (data.success) {
                    alert('✅ Credits added successfully!');
                    loadPage('users');
                } else {
                    alert('❌ Failed: ' + (data.error || 'Unknown error'));
                }
            } catch (err) {
                alert('❌ Error: ' + err.message);
            }
        }

        function quickAddCredits(userId) {
            document.getElementById('creditUserId').value = userId;
            document.getElementById('creditAmount').focus();
        }

        async function banUser(userId) {
            if (!confirm(`Are you sure you want to ban user ${userId}?`)) return;
            
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ action: 'ban_user', user_id: userId })
                });
                
                const data = await response.json();
                if (data.success) {
                    alert('✅ User banned successfully!');
                    loadPage('users');
                } else {
                    alert('❌ Failed to ban user');
                }
            } catch (err) {
                alert('❌ Error: ' + err.message);
            }
        }

        // Settings functions
        function editSetting(setting) {
            const currentValue = prompt('Enter new value for ' + setting + ':');
            if (currentValue) {
                // Send to backend
                alert('Setting update feature - implement backend');
            }
        }

        function toggleSetting(setting) {
            // Toggle logic
            const toggle = document.getElementById(setting === 'force_sub_enabled' ? 'forceSubToggle' : 
                                                    (setting === 'whitelist_enabled' ? 'whitelistToggle' : 'maintenanceToggle'));
            toggle.classList.toggle('active');
            // Send to backend
        }

        function editMessage(key) {
            const currentValue = prompt('Enter new message content for ' + key + ':');
            if (currentValue) {
                alert('Message update feature - implement backend');
            }
        }

        function addForceChat() {
            const id = document.getElementById('newChatId').value;
            const link = document.getElementById('newChatLink').value;
            const name = document.getElementById('newChatName').value;
            
            if (!id || !link || !name) {
                alert('Please fill all fields');
                return;
            }
            
            alert('Add force chat feature - implement backend');
        }

        function removeForceChat(index) {
            if (confirm('Remove this chat?')) {
                alert('Remove force chat feature - implement backend');
            }
        }

        function addToWhitelist() {
            const groupId = document.getElementById('newGroupId').value;
            if (!groupId) {
                alert('Please enter Group ID');
                return;
            }
            alert('Add to whitelist feature - implement backend');
        }

        function removeFromWhitelist(index) {
            if (confirm('Remove this group from whitelist?')) {
                alert('Remove from whitelist feature - implement backend');
            }
        }

        function testApi(index, type) {
            alert(`Testing API ${index+1} (${type})...\nImplement API test feature.`);
        }

        function addAdmin() {
            const userId = document.getElementById('newAdminId').value;
            if (!userId) {
                alert('Please enter User ID');
                return;
            }
            alert('Add admin feature - implement backend');
        }

        function removeAdmin(userId) {
            if (confirm(`Remove admin ${userId}?`)) {
                alert('Remove admin feature - implement backend');
            }
        }
    </script>
</body>
</html>
<?php } ?>