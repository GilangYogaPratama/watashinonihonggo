<?php
$filePath = 'KotobaN4.csv';
$content = file_get_contents($filePath, false, null, 0, 1000);

echo "Raw (first 1000 bytes):\n";
echo bin2hex($content) . "\n\n";

echo "Attempting UTF-8:\n";
echo $content . "\n\n";

echo "Attempting Shift-JIS to UTF-8:\n";
echo mb_convert_encoding($content, 'UTF-8', 'SJIS') . "\n\n";
