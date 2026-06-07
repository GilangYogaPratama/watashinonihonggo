const fs = require('fs');
const path = require('path');

const files = [
    'resources/views/n3/kanji.blade.php',
    'resources/views/n3/bunpo.blade.php',
    'resources/views/n3/kotoba.blade.php',
    'resources/views/kanji.blade.php',
    'resources/views/bunpo.blade.php',
    'resources/views/kotoba.blade.php',
    'resources/views/kana.blade.php',
    'resources/views/reading.blade.php',
    'resources/views/flashcard.blade.php'
];

for (const file of files) {
    const filePath = path.join(__dirname, file);
    if (!fs.existsSync(filePath)) {
        console.log(`Not found: ${file}`);
        continue;
    }
    
    let content = fs.readFileSync(filePath, 'utf8');

    // 1. Update :root
    content = content.replace(
        /--bg-card: #ffffff;/g,
        '--bg-card: rgba(255, 255, 255, 0.95);'
    );
    content = content.replace(
        /--border-color: #e2e8f0;/g,
        '--border-color: rgba(226, 232, 240, 0.8);'
    );

    // 2. Update body
    content = content.replace(
        /background-color: var\(--bg-main\);/g,
        `background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);\n            position: relative;\n            overflow-x: hidden;`
    );

    // 3. Add blobs below body definition
    if (!content.includes('pulse-blob')) {
        content = content.replace(
            /(user-select: none;\n\s+position: relative;\n\s+overflow-x: hidden;\n\s+})/,
            `$1\n\n        body::before, body::after {\n            content: '';\n            position: absolute;\n            width: 40vw;\n            height: 40vw;\n            border-radius: 50%;\n            filter: blur(100px);\n            z-index: -1;\n            opacity: 0.5;\n            animation: pulse-blob 10s infinite alternate;\n        }\n\n        body::before {\n            top: -10vw;\n            left: -10vw;\n            background: rgba(139, 92, 246, 0.2);\n        }\n\n        body::after {\n            bottom: -10vw;\n            right: -10vw;\n            background: rgba(16, 185, 129, 0.15);\n            animation-delay: -5s;\n        }\n\n        @keyframes pulse-blob {\n            0% { transform: scale(1) translate(0, 0); }\n            100% { transform: scale(1.1) translate(20px, 20px); }\n        }`
        );
    }

    // 4. Update card-face backdrop filter (for flashcards)
    if (!content.includes('backdrop-filter') && content.includes('.card-face {')) {
        content = content.replace(
            /background: var\(--bg-card\);\s+border: 1px solid var\(--border-color\);\s+border-radius: 16px;/g,
            'background: var(--bg-card);\n            backdrop-filter: blur(12px);\n            -webkit-backdrop-filter: blur(12px);\n            border: 1px solid var(--border-color);\n            border-radius: 20px;'
        );
    }

    // 5. Update box-shadow
    content = content.replace(
        /box-shadow: 0 10px 15px -3px rgba\(0, 0, 0, 0\.05\), 0 4px 6px -4px rgba\(0, 0, 0, 0\.05\);/g,
        'box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.05), 0 10px 15px -5px rgba(0, 0, 0, 0.02);'
    );

    // 6. Kana specific (it uses .kana-card instead of .card-face)
    if (!content.includes('backdrop-filter') && content.includes('.kana-card {')) {
        content = content.replace(
            /background: var\(--bg-card\);\s+border: 1px solid var\(--border-color\);\s+border-radius: 8px;/g,
            'background: var(--bg-card);\n            backdrop-filter: blur(12px);\n            -webkit-backdrop-filter: blur(12px);\n            border: 1px solid var(--border-color);\n            border-radius: 12px;'
        );
    }

    // 7. Reading specific (it uses .reading-card)
    if (!content.includes('backdrop-filter') && content.includes('.reading-card {')) {
        content = content.replace(
            /background: var\(--bg-card\);\s+border: 1px solid var\(--border-color\);\s+border-radius: 16px;/g,
            'background: var(--bg-card);\n            backdrop-filter: blur(12px);\n            -webkit-backdrop-filter: blur(12px);\n            border: 1px solid var(--border-color);\n            border-radius: 20px;'
        );
    }

    fs.writeFileSync(filePath, content, 'utf8');
    console.log(`Updated ${file}`);
}
