# Amazon Price Matching
This is an open-source repository containing code and setup instructions for an Amazon price-matching tool. The tool compares product prices to other online storefronts and utilizes a LAMP stack through EC2 instances on AWS.

The below instructions detail how to recreate the stack for this tool in AWS. Each folder in this repository has the necessary .html, .php, and .sql code for each instance.

<br/><br/>

# EC2 Instance Setup
**Repeat all of the steps in this section for 3 separate instances (webserver, apiserver, databaseserver)**

## Navigating to instance creation
1. From "AWS Console Home", click the menu in the top-left
2. Click "All services", then click "EC2" under "Compute"
3. In the left menu, click "Instances" under its category of the same name
4. Click "Launch instances" in the top-right

## Creating instance
1. Set a name for the instance (webserver, apiserver, databaseserver)
2. Under "Quick Start", click "Ubuntu"
3. Under "Key pair (login)", click "Create a new key pair" and enter a key pair name
4. Make sure the private key file format is .pem
5. Click "Create key pair" and save it to your local machine
6. Under "Network settings", check "Allow HTTP traffic from the internet"
7. Under "Summary", click "Launch instance"

## Allocating an elastic public IP address
By default, AWS dynamically assigns a public IP to EC2 instances, which will break code referencing public IP addresses.
1. Under "Network & Security" in the left menu, click "Elastic IPs"
2. Click "Allocate Elastic IP address"
3. At the bottom of the page, click "Allocate"
4. Click the underlined link for the IP in the list that shows up
5. In the top-right, click "Associate Elastic IP address"
6. Under "Instance", select the instance to be associated with this IP
7. Click "Associate" in the bottom-right

## View instance details/connect
1. In the left menu, click "Instances" under its category of the same name
2. Click the underlined instance ID for the server instance in the list that shows up
3. In the top-right, click "Connect", then the following "Connect" button in the bottom-right

<br/><br/>

# Web Server Setup

## Installing Apache
1. If not already done, connect to the web server instance (see above on [View instance details/connect](https://github.com/jno-de/AmazonPriceMatching#view-instance-detailsconnect))
2. Run the following lines of code in the Ubuntu CLI to install Apache:
```
sudo apt update
sudo apt install apache2
sudo apt install php libapache2-mod-php
```

## Importing .html files
1. Run this to change directories to the html for the instance:
```
cd /var/www/html
```
2. Run this to replace the default Apache index.html with a blank copy:
```
sudo rm index.html
sudo nano index.html
```
3. Copy-paste (ctrl + shift + v) the code from webserver/index.html from this repo to the instance.
4. Replace `API_Server_Public_IP` in the code to the public IP of the API server
5. Exit the nano text editor and save changes (ctrl + x, then y)
6. Run this line to create a file for displaying the data in html from the API:
```
sudo nano api-link.html
```
7. Repeat steps 3-5 except using webserver/api-link.html

<br/><br/>

# Database Server Setup

## Creating the database
1. If not already done, connect to the database server instance (see above on [View instance details/connect](https://github.com/jno-de/AmazonPriceMatching#view-instance-detailsconnect))
2. Run this to install and launch MySQL:
```
sudo apt update
sudo apt install mysql-server
sudo mysql
```
3. Copy-paste and run all the SQL from databaseserver/data.sql to create the database
4. Run this to create a MySQL user for the database (you may change the username and password):
```
CREATE USER 'username'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON PriceData.* TO 'username'@'%';
FLUSH PRIVILEGES;
```
## Adding inbound MySQL port for database server
1. Click the underlined ID for the database server instance in the list that shows up
2. Click the "Security" tab in the menu below the instance summary
3. Click the blue link under "Security groups"
4. In the top-right of the "Inbound rules" section, click "Edit inbound rules"
5. Click "Add rule" at the end of the list
6. Click the text input for "Type", then search for "MYSQL/Aurora"
7. Click the text input for "Source", then select "0.0.0.0/0"
8. Click "Save rules"

<br/><br/>

# API Server Setup

## Installing Apache, PHP, and MySQL client
1. If not already done, connect to the API server instance (see above on [View instance details/connect](https://github.com/jno-de/AmazonPriceMatching#view-instance-detailsconnect))
2. Run the following to install Apache, PHP, and the MySQL client:
```
sudo apt update
sudo apt install apache2 php php-mysql
```

## Importing .php files
1. Run this to change directories to the html for the instance:
```
cd /var/www/html
```
2. Run this to remove the default index.html:
```
sudo rm index.html
```
3. Run this to create a new file for the data.php:
```
sudo nano data.php
```
4. Copy-paste the code from apiserver/data.php from this repo to the instance
5. Replace `Database_Server_Private_IP` with the private IP of the database server
6. Replace `"username"` and `"password"` with the username and password of the MySQL user
7. Exit nano (ctrl + x, then y)
8. Repeat steps 3-7 except using apiserver/api.php
