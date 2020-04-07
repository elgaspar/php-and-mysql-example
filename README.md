# PHP and MySQL Example

An example of a web application using:
* PHP 7.4.4
* MySQL
* Bootstrap.


## The problem
You work for a company that has tripled in size over the past few years and the way the vacation process works is no longer efficient, as it requires a combination of handwritten applications, approvals, storage, and maintenance. You are asked to create a portal where employees can request their vacation online, the manager receives a notification to approve or decline that request, and the information (time used, balances) is stored within the portal.


## Database
`database.sql` file contains the SQL statements to create the database tables.

### EER Diagram
![alt text](https://github.com/elgaspar/php-and-mysql-example/blob/master/eer_diagram.png "EER Diagram")


## Installation
* Run `database.sql` file in MySQL server to create tables.
* Add an administrator user with e-mail `admin@mail.com` and password `123` using the query:
    ```
    INSERT INTO users (first_name, last_name, email, password_hash, is_admin) VALUES ('John', 'Doe', 'admin@mail.com', '$2y$10$ExUqrgC2jjBAlMiqqfLICeq7TBw2AUcHDVsXIH3dii50NmDeF6GTK', '1')
    ```
* Set the variables in the [configuration file](#configuration-file)


## Configuration File
`config.ini` file contains the essential variables that should be set:

* *db_host*: Hostname or IP address of MySQL server.
* *db_user*, *db_password*: Username and password that will be used to connect to MySQL server.
* *db_name*: Database name.
* *admin_email*: Administrator's e-mail that will be receiving the e-mails to approve/reject the employee's applications 