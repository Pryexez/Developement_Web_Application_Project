import requests
import json
import html_to_json
import os
import sys


class bcolors:
    YELLOW = '\033[93m'
    PINK = '\033[95m'
    RED = '\033[91m'
    GREEN = '\033[92m'
    RESET = '\033[0m'


url = "http://www.htmllint.net/en/html-lint/htmllint.cgi"


def scanDir(path):
    fileList = []
    for files in os.listdir(path):
        if os.path.isdir(os.path.join(path, files)):
            getRecursiv = scanDir(os.path.join(path, files))
            for element in getRecursiv:
                fileList.append(os.path.join(files, element))
        if os.path.isfile(os.path.join(path, files)):
            if files.endswith(".html"):
                fileList.append(files)
    return fileList


print("Severity from 0 to 9. 0 is okay, 9 is bad. Everything from 4 raises an error")

if len(sys.argv) < 2:
    path = "./"
else:
    path = sys.argv[1]

allFiles = scanDir(path)
print("Scanned Files: ")
print(allFiles)
print()

allIsFine = True

for page in allFiles:
    print("File: " + os.path.join(path, page))

    file = open(os.path.join(path, page), encoding="utf-8")
    payload = {"Data": file.read()}
    file.close()

    response = requests.request("POST", url, headers={}, data=payload)

    lintAnswer = response.text

    tables = html_to_json.convert_tables(lintAnswer)

    if len(tables) > 0:
        for error in tables[0]:
            color = bcolors.YELLOW
            if int(error["Severity"]) > 3:
                allIsFine = False
                color = bcolors.PINK
            if int(error["Severity"]) > 6:
                color = bcolors.RED
            # print("no: " + error["No"])
            print(color + "Severity: " + error["Severity"])
            print(error["Line"] + " " + error["Error"] + bcolors.RESET)
            print()
        # print(json.dumps(tables[0], indent=2))
    else:
        print(bcolors.GREEN + "OK" + bcolors.RESET)
        print()

if not allIsFine:
    exit(1)
  
exit(0)
