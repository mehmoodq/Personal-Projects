drop table if exists login;
CREATE TABLE IF NOT EXISTS Login(userID VARCHAR(255), pass VARCHAR(255) NOT NULL, 
PRIMARY KEY (userID));

DROP TABLE if exists clientinfo;
CREATE TABLE IF NOT EXISTS ClientInfo(userID VARCHAR(255) NOT NULL, fullname CHAR(50), 
address1 VARCHAR (100) NOT NULL, address2 VARCHAR (100), city CHAR(100), state CHAR (2), 
zipcode INT (9) NOT NULL, PRIMARY KEY (userID), FOREIGN KEY (userID) REFERENCES
login (userID));

drop table if exists fuelquote;
CREATE TABLE IF NOT EXISTS fuelQuote (ID VARCHAR (255), gallons DOUBLE, address VARCHAR (100)
NOT NULL, deliverydate DATE, suggestedprice FLOAT, totalamountdue FLOAT, 
PRIMARY KEY (ID, deliverydate), FOREIGN KEY (ID) REFERENCES ClientInfo (userID));

drop view if exists quoteHistory;
CREATE VIEW quoteHistory AS SELECT * FROM fuelQuote F WHERE ID = F.ID;