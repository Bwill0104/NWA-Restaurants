mysql <<EOFMYSQL
use bryanw;
show tables;

DROP TABLE IF EXISTS Menu;
DROP TABLE IF EXISTS Reviews;
DROP TABLE IF EXISTS Restaurants;



CREATE TABLE Restaurants (
restaurantID int,
name CHAR(25) NOT NULL,
city CHAR(25) NOT NULL,
address CHAR(40) NOT NULL,
hours CHAR(15),
PRIMARY KEY(restaurantID)
);
INSERT INTO Restaurants (restaurantID, name, city, address, hours) VALUES (0116, 'Texas Roadhouse', 'Rogers', '2922 S 26th st', '3pm-10pm');
INSERT INTO Restaurants (restaurantID, name, city, address, hours)  VALUES (0601,'The Preacher''s Son', 'Bentonville', '201 NW A st', '5pm-9pm' );
INSERT INTO Restaurants (restaurantID, name, city, address, hours)  VALUES (0630,'Feed and Folly', 'Fayetteville', '110 S College Ave', '11am-10pm' );
INSERT INTO Restaurants (restaurantID, name, city, address, hours)  VALUES (0319,'The Rail', 'Rogers', '218 S 1st st', '11am-9pm' );
INSERT INTO Restaurants (restaurantID, name, city, address, hours)  VALUES (0715, 'Homegrown', 'Springgdale', '202 E Emma Ave', '7am-2:30pm' );
INSERT INTO Restaurants (restaurantID, name, city, address, hours)  VALUES (0809, 'Waffle House', 'Centerton', '960 E Centerton Blvd', '12am-12am' );


SELECT * FROM Restaurants;



CREATE TABLE Reviews (
reviewID int,
restaurantID int NOT NULL,
rating int NOT NULL,
PRIMARY KEY(reviewID),
FOREIGN KEY (restaurantID) REFERENCES Restaurants(restaurantID) 
);
INSERT INTO Reviews (reviewID, restaurantID, rating) VALUES (0, 0116, 7);
INSERT INTO Reviews (reviewID, restaurantID, rating) VALUES (1, 0601, 8);
INSERT INTO Reviews (reviewID, restaurantID, rating) VALUES (2, 0601, 9);
INSERT INTO Reviews (reviewID, restaurantID, rating) VALUES (3, 0630, 9);
INSERT INTO Reviews (reviewID, restaurantID, rating) VALUES (4, 0319, 7);
INSERT INTO Reviews (reviewID, restaurantID, rating) VALUES (5, 0809, 7);

SELECT * FROM Reviews;



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
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0116, 'idk', 'med', 1, 1, 1);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0601, 'idk' , 'high', 1,1,1);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0630, 'idk' , 'high', 1,1,0);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0319, 'idk' , 'high', 1,1,0);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0809, 'idk' , 'high', 1,1,0);

select * from Menu;

EOFMYSQL
