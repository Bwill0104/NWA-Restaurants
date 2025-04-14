mysql <<EOFMYSQL
use bryanw;
show tables;

DROP TABLE IF EXISTS Menu;
DROP TABLE IF EXISTS Times;
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
INSERT INTO Restaurants (restaurantID, name, city, address, rating)  VALUES (0715, 'Homegrown', 'Springgdale', '202 E Emma Ave', 4.7 );
INSERT INTO Restaurants (restaurantID, name, city, address, rating)  VALUES (0809, 'Waffle House', 'Centerton', '960 E Centerton Blvd', 4.2 );
SELECT * FROM Restaurants;



CREATE TABLE Times (
restaurantID int NOT NULL,
day CHAR(15) NOT NULL,
openBreak BOOLEAN NOT NULL,
openLunch BOOLEAN NOT NULL,
openDinner BOOLEAN,
PRIMARY KEY (restaurantID),
FOREIGN KEY (restaurantID) REFERENCES Restaurants(restaurantID) ON DELETE CASCADE
);
INSERT INTO Times (restaurantID,day, openBreak, openLunch, openDinner) VALUES (0116, 'M,T,W,Th,F,S,Su' , 0,1,1);
INSERT INTO Times (restaurantID,day, openBreak, openLunch, openDinner) VALUES (0601, 'M,T,W,Th,F,S,Su' , 0,0,1);
INSERT INTO Times (restaurantID,day, openBreak, openLunch, openDinner) VALUES (0630, 'M,T,W,Th,F,S,Su' , 0,1,1);
INSERT INTO Times (restaurantID,day, openBreak, openLunch, openDinner) VALUES (0319, 'M,T,W,Th,F,S,Su' , 1,1,0);
INSERT INTO Times (restaurantID,day, openBreak, openLunch, openDinner) VALUES (0809, 'M,T,W,Th,F,S,Su' , 1,1,1);
select * from Times;



CREATE TABLE Menu (
restaurantID int NOT NULL,
cuisineType CHAR(25) NOT NULL,
priceRange ENUM('low','med', 'high') NOT NULL,
isVegetarian BOOLEAN,
isGlutenFree BOOLEAN,
isVegan BOOLEAN,
PRIMARY KEY (restaurantID),
FOREIGN KEY (restaurantID) REFERENCES Restaurants(restaurantID) ON DELETE CASCADE
);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0116, 'steakhouse', 'med', 1, 1, 1);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0601, 'new american' , 'high', 1,1,1);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0630, 'gastropub' , 'med', 1,1,0);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0319, 'pizza' , 'low', 1,1,0);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0715, 'brunch' , 'med', 1,1,0);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0809, 'brunch' , 'low', 1,1,0);

select * from Menu;

EOFMYSQL
