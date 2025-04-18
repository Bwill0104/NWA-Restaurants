mysql <<EOFMYSQL
use bryanw;
show tables;

DROP TABLE IF EXISTS Menu;
DROP TABLE IF EXISTS Hours;
DROP TABLE IF EXISTS Restaurants;



CREATE TABLE Restaurants (
restaurantID int,
name CHAR(25) NOT NULL,
city CHAR(25) NOT NULL,
address CHAR(40) NOT NULL,
rating int,
PRIMARY KEY(restaurantID)
);
INSERT INTO Restaurants (restaurantID, name, city, address, rating) VALUES (0116, 'Texas Roadhouse', 'Rogers', '2922 S 26th st', 4.4);
INSERT INTO Restaurants (restaurantID, name, city, address, rating)  VALUES (0601,'The Preacher''s Son', 'Bentonville', '201 NW A st', 4.4 );
INSERT INTO Restaurants (restaurantID, name, city, address, rating)  VALUES (0630,'Feed and Folly', 'Fayetteville', '110 S College Ave', 4.1 );
INSERT INTO Restaurants (restaurantID, name, city, address, rating)  VALUES (0319,'The Rail', 'Rogers', '218 S 1st st', 4.5 );
INSERT INTO Restaurants (restaurantID, name, city, address, rating)  VALUES (0715, 'Homegrown', 'Springdale', '202 E Emma Ave', 4.7 );
INSERT INTO Restaurants (restaurantID, name, city, address, rating)  VALUES (0809, 'Waffle House', 'Centerton', '960 E Centerton Blvd', 4.2 );
SELECT * FROM Restaurants;



CREATE TABLE Hours (
restaurantID int NOT NULL,
day CHAR(15) NOT NULL,
openBreak ENUM('yes', 'no') NOT NULL,
openLunch ENUM('yes', 'no') NOT NULL,
openDinner ENUM('yes', 'no') NOT NULL,
PRIMARY KEY (restaurantID),
FOREIGN KEY (restaurantID) REFERENCES Restaurants(restaurantID) ON DELETE CASCADE
);
INSERT INTO Hours (restaurantID,day, openBreak, openLunch, openDinner) VALUES (0116, 'M,T,W,Th,F,S,Su' , 'no','yes','yes');
INSERT INTO Hours (restaurantID,day, openBreak, openLunch, openDinner) VALUES (0601, 'M,T,W,Th,F,S,Su' , 'no','no','yes');
INSERT INTO Hours (restaurantID,day, openBreak, openLunch, openDinner) VALUES (0630, 'M,T,W,Th,F,S,Su' , 'no','yes','yes');
INSERT INTO Hours (restaurantID,day, openBreak, openLunch, openDinner) VALUES (0319, 'M,T,W,Th,F,S,Su' , 'yes','yes','no');
INSERT INTO Hours (restaurantID,day, openBreak, openLunch, openDinner) VALUES (0809, 'M,T,W,Th,F,S,Su' , 'yes','yes','yes');
select * from Hours;



CREATE TABLE Menu (
restaurantID int NOT NULL,
cuisineType CHAR(25) NOT NULL,
priceRange ENUM('low','med', 'high') NOT NULL,
isVegetarian ENUM('yes', 'no'),
isGlutenFree ENUM('yes', 'no'),
isVegan ENUM('yes', 'no'),
PRIMARY KEY (restaurantID),
FOREIGN KEY (restaurantID) REFERENCES Restaurants(restaurantID) ON DELETE CASCADE
);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0116, 'steakhouse', 'med', 'yes','yes','yes');
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0601, 'new american' , 'high', 'yes','yes','yes');
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0630, 'gastropub' , 'med', 'yes','yes','no');
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0319, 'pizza' , 'low', 'yes','yes','no');
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0715, 'brunch' , 'med', 'yes','yes','no');
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0809, 'brunch' , 'low', 'yes','yes','no');

select * from Menu;

EOFMYSQL
