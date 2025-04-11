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
hours CHAR(10),
PRIMARY KEY(restaurantID)
);
INSERT INTO Restaurants (restaurantID, name, city, address, hours) VALUES (0, 'Texas Roadhouse', 'Rogers', '2922 S 26th st', '3-10');
INSERT INTO Restaurants (restaurantID, name, city, address, hours)  VALUES (1,'The Preacher''s Son', 'Bentonville', '201 NW A st', '5-9' );
SELECT * FROM Restaurants;



CREATE TABLE Reviews (
reviewID int,
restaurantID int NOT NULL,
rating int NOT NULL,
PRIMARY KEY(reviewID),
FOREIGN KEY (restaurantID) REFERENCES Restaurants(restaurantID) 
);
INSERT INTO Reviews (reviewID, restaurantID, rating) VALUES (0, 0, 9);
INSERT INTO Reviews (reviewID, restaurantID, rating) VALUES (1, 0, 8);
INSERT INTO Reviews (reviewID, restaurantID, rating) VALUES (2, 1, 10);
INSERT INTO Reviews (reviewID, restaurantID, rating) VALUES (3, 1, 9);
INSERT INTO Reviews (reviewID, restaurantID, rating) VALUES (4, 0, 7);
SELECT * FROM Reviews;



CREATE TABLE Menu (
restaurantID int NOT NULL,
cuisineType CHAR(25) NOT NULL,
priceRange ENUM('low','med', 'high') NOT NULL,
isVegetarian BOOLEAN,
isGlutenFree BOOLEAN,
isVegan BIT,
PRIMARY KEY (restaurantID),
FOREIGN KEY (restaurantID) REFERENCES Restaurants(restaurantID) ON DELETE CASCADE
);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (0, 'idk', 'med', 1, 1, 1);
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES (1, 'idk' , 'high', 1,1,1);
select * from Menu;

EOFMYSQL
