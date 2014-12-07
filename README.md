#My Library

Contributors: Ludovic Roland ([http://www.rolandl.fr](http://www.rolandl.fr))<br/>
Stable tag: 1.4.2.1<br/>
License: GNU GPL v2.0<br/>
License URI: http://www.gnu.org/licenses/gpl-2.0.html

##Description

My Library is a light PHP website to manage your virtual library. 

Each member can :
* add / remove / edit authors
* add / remove / edit book styles
* add / remove / edit books
* tag a book as read
* tag a book as got
* tag a book as wanted
* export the list of book he gets / read / wants in PDF
* see a list of suggested books

You also have the possibility to :
* do a research by author, title, year, style, etc
* export the list of books that all the user have in PDF

##Installation & configuration

###The database

In order to create the database, open your SGBD and execute the SQL script 'Documents/sql/my_library_x.x.sql'.

Open the php file 'Library/PDOFactory.class.php' and edit the line 9 with your own database information.

###The website

Copy the following directories on your FTP :
* Applications
* Errors
* Library
* Web

###Configuration

In order to work, your domain name has to target the directory 'Web'.

###Add a user

Users have to be add directly in the database. Passwords have to be encrypted with SHA1.

##Changelog

###1.4.2.1
* Fixed syntax error

###1.4.2

* Updated the SQL script
* Added the missing 'upload' directory


###1.4.1

* Updated the code with the latest version of the rolandl PHP Framework (v1.1.1)

###1.4

* UI improvement
* Fixed the issue with the generated PDF files
* Cleaned up the code
* Added the possibility to export a list of all the books users have

###1.3.3

* First public version of the project
