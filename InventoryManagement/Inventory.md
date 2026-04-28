# Inventory Management
## Instruction
1. Clone [this](https://github.com/jspace418/Portfolio/tree/main/InventoryManagement). Make sure you are using UNIX such as WSL, or any Linux distro. 
2. Install Apache, PHP, and MySQL
```bash
sudo apt update
sudo apt install apache2 php libapache2-mod-php php-mysql mysql-server -y
``` 
3. Start Apache and MySQL
```bash
sudo service apache2 start
sudo service mysql start
```
4. Then, copy code into `/var/www/html`
```bash
sudo cp -r /path/to/project /var/www/html
```
5. In your web browser, go to http://localhost/mainmenu.php
