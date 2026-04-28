# Portfolio
## Profile
Seongmin Park, Western University (Expected Graduation: 2027)

B. Sc. Major in Data Science, Minor in Computer Science

## [Household Expenditure Report](https://github.com/jspace418/Portfolio/tree/main/HouseholdExpenditure)
- Analysis using Python
- Group Project/Assignment for Data Science (Machine Learning) course
- Examines how Canadian households allocate their disposable income toward shelter-related expenditures at the dissemination area level

## [Item Inventory Management](https://github.com/jspace418/Portfolio/blob/main/InventoryManagement/Inventory.md)
- Created using HTML, CSS, PHP, SQL
- Assignment for Computer Science (Database) course
- Connecting SQL database into website using php

### Demo Video
[![Demo Preview](https://img.youtube.com/vi/In62zRKPesg/maxresdefault.jpg)](https://youtu.be/In62zRKPesg)

### Instruction
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
6. When finished, close Apache and MySQL
```bash
sudo service apache2 stop
sudo service mysql stop
```
