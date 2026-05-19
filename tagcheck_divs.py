import glob
import re
import pathlib

for path in glob.glob('resources/views/**/*.blade.php', recursive=True):
    with open(path, 'r', encoding='utf-8') as f:
        txt = f.read()
    opens = len(re.findall(r'<div\b', txt, re.I))
    closes = len(re.findall(r'</div>', txt, re.I))
    if opens != closes:
        print(f'{path}: opens={opens}, closes={closes}')
