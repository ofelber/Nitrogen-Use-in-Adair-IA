Nitrogen Use in Adair County version 2.0 01/02/2020

PROVIDED FILES
--------------
- farmNitrogenAdair.php
- IAFertData.csv (Reorganized data)
- CreateLocationAmountTable.sql

GENERAL USAGE NOTES
-------------------
This program is a time-series visualization of a data set 
that is read from a SQL Server database using php. The plot
is built using PHP and JavaScript, and is drawn using HTML 
Canvas. 

REQUIRED SKILLS
---------------
- Installation of PHP and SQL Server
- Basic queries and scripting in SQL Server
- Ability to set up and connect to database
- Some basic web server understanding

*Note: These instructions use Windows, IIS, and SQL Server*

INSTALLATION AND USE REQUIREMENTS
---------------------------------
Enable IIS and place the following file in the web server root:
- assignment5FarmAdair.php

This program runs on a browser and requires working versions of 
PHP and SQL Server.
- PHP: https://www.php.net/manual/en/install.php
- SQL Server: https://docs.microsoft.com/en-us/sql/database-engine/install-windows/install-sql-server?view=sql-server-ver15

The database and tables will need to be set up according to the provided table-building scripts.
-   The core data is in a csv file: IAFertData-OneSheet2-oldcopy.csv
-   Use the provided table-building scripts to build the necessary tables in SQL Server. 
        - Table building script: CreateLocationAmountTable.sql
-   Import the provided data into the location_amount table created by the script above.
    Use the SQL Server import tool to do this.

In the file assignment5FarmAdair.php: 
- For the variable $serverName change the name to match the name of your server.
- For the variable $connectionInfo change your database and password to match your database name and password.

The program should now be ready to run

FERTILIZER DATA INFORMATION
---------------------------
Original Data provided by USGS as a public service: https://water.usgs.gov/GIS/metadata/usgswrd/XML/sir2012-5207_county_fertilizer.xml#stdorder
-   The original data for each county was provided in two Microsoft Access
    tables by the DOI and USGS; one for nitrogen, and one for phosphorus.
-   The columns for each table consist of FIPS state and county codes, 
    state abbreviation, county name, and columns for farm and nonfarm use
    for each year spanning from 1987 to 2006. This program only uses the farm-use data. 
-   Data was reorganized by transposing the years from columns to rows within a single column. 

CONTACT
-------
Website: https://www.olo-arted.com/
Email: oliviafelber@gmail.com

Copyright 2018-2020
