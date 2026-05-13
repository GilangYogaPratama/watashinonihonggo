<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>N4 Core Sync</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=JetBrains+Mono:wght@400;700&family=Noto+Sans+JP:wght@700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #fcfcfc;
            --bg-grid: #eeeeee;
            --primary-blue: #3b82f6;
            --primary-green: #22c55e;
            --primary-red: #ef4444;
            --accent-yellow: #facc15;
            --accent-gray: #94a3b8;
            --text-main: #334155;
            --text-muted: #64748b;
        }

        * { 
            box-sizing: border-box; 
            margin: 0; 
            padding: 0; 
            -webkit-tap-highlight-color: transparent; /* Remove mobile tap highlight */
        }

        body {
            font-family: 'JetBrains Mono', monospace;
            background-color: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow-x: hidden; /* Prevent horizontal scroll on mobile */
            position: relative;
            touch-action: manipulation; /* Disable double-tap zoom */
            user-select: none; /* Prevent text selection during interaction */
        }

        /* Subtle Matte Grid */
        .background-grid {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: 
                linear-gradient(var(--bg-grid) 1px, transparent 1px),
                linear-gradient(90deg, var(--bg-grid) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: -1;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            padding: 2rem;
            z-index: 10;
        }

        .header {
            margin-bottom: 5rem;
            position: relative;
            padding-left: 1.5rem;
            border-left: 4px solid var(--accent-yellow);
        }

        .header h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 0.3rem;
            text-transform: uppercase;
            color: var(--text-main);
        }

        .header .sub {
            font-size: 0.75rem;
            color: var(--accent-gray);
            letter-spacing: 4px;
            margin-top: 0.2rem;
        }

        /* Menu Grid */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
        }

        @media (max-width: 900px) {
            .menu-grid { grid-template-columns: 1fr; }
        }

        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            padding: 4rem 2rem;
            position: relative;
            text-decoration: none;
            color: inherit;
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card:hover {
            border-color: var(--card-color);
            transform: translateY(-2px);
            background: #fafafa;
        }

        .card-icon {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: 5rem;
            font-weight: 900;
            margin-bottom: 2rem;
            color: var(--card-color);
            opacity: 0.9;
        }

        .card-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            letter-spacing: 2px;
            color: var(--text-main);
            font-weight: 700;
        }

        .card.kanji { --card-color: var(--primary-red); }
        .card.kotoba { --card-color: var(--primary-green); }
        .card.bunpo { --card-color: var(--primary-blue); }

        /* Techy Accents */
        .accent-corner {
            position: absolute;
            width: 10px; height: 10px;
            border: 2px solid var(--accent-gray);
            opacity: 0.5;
        }
        .tl { top: 10px; left: 10px; border-right: 0; border-bottom: 0; }
        .tr { top: 10px; right: 10px; border-left: 0; border-bottom: 0; }
        .bl { bottom: 10px; left: 10px; border-right: 0; border-top: 0; }
        .br { bottom: 10px; right: 10px; border-left: 0; border-top: 0; }

        .accent-bar {
            position: absolute;
            top: 0; left: 50%;
            width: 30px; height: 4px;
            background: var(--accent-yellow);
            transform: translateX(-50%);
        }

        .status-badge {
            position: absolute;
            bottom: -1px;
            right: 20px;
            background: var(--card-color);
            color: #fff;
            font-size: 0.5rem;
            padding: 2px 10px;
            letter-spacing: 1px;
            font-weight: 700;
        }

    </style>
</head>
<body>
    <div class="background-grid"></div>

    <div class="container">
        <header class="header">
            <h1>N4_INTERFACE</h1>
            <div class="sub">CORE_SYSTEM_SYNC_OPERATIONAL</div>
        </header>

        <div class="menu-grid">
            <a href="{{ route('kanji') }}" class="card kanji">
                <div class="accent-corner tl"></div><div class="accent-corner tr"></div>
                <div class="accent-corner bl"></div><div class="accent-corner br"></div>
                <div class="accent-bar"></div>
                <div class="card-icon">漢</div>
                <h2 class="card-title">KANJI</h2>
                <div class="status-badge">RED_MODULE</div>
            </a>

            <a href="{{ route('kotoba') }}" class="card kotoba">
                <div class="accent-corner tl"></div><div class="accent-corner tr"></div>
                <div class="accent-corner bl"></div><div class="accent-corner br"></div>
                <div class="accent-bar"></div>
                <div class="card-icon">言</div>
                <h2 class="card-title">KOTOBA</h2>
                <div class="status-badge">GREEN_MODULE</div>
            </a>

            <a href="{{ route('bunpo') }}" class="card bunpo">
                <div class="accent-corner tl"></div><div class="accent-corner tr"></div>
                <div class="accent-corner bl"></div><div class="accent-corner br"></div>
                <div class="accent-bar"></div>
                <div class="card-icon">文</div>
                <h2 class="card-title">BUNPO</h2>
                <div class="status-badge">BLUE_MODULE</div>
            </a>
        </div>
    </div>
</body>
</html>
