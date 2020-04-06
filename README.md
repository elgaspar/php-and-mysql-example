# PHP and MySQL Example

An example of a web application using:
* PHP 7.4.4
* MySQL
* Bootstrap.


## The problem
You work for a company that has tripled in size over the past few years and the way the vacation process works is no longer efficient, as it requires a combination of hand written applications, approvals, storage and maintenace. You are asked to create a portal where employees can request their cavaction online, the manager receives a notification to approve or decline that request, and the information (time used, balances) is stored withing the portal.


## Database
`database.sql` file contains the SQL statements to create the database tables.

### EER Diagram
![alt text](https://github.com/elgaspar/php-and-mysql-example/blob/master/eer_diagram.png "EER Diagram")


## Configuration File
`config.ini` file contains the essential variables that should be set:

* *db_host*: Hostname or IP address of MySQL server.
* *db_user*, *db_password*: Username and password that will be used to connect to MySQL server.
* *db_name*: Database name.
* *admin_email*: Administrator's e-mail that will be receiving the e-mails to approve/reject the employee's applications 