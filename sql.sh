mysql <<EOFMYSQL
use bryanw;
show tables;

DROP TABLE IF EXISTS Restaurants; 
DROP TABLE IF EXISTS Reviews;
DROP TABLE IF EXISTS Menu;


CREATE TABLE Restaurants (
restaurantID int,
name varchar(25) NOT NULL,
city varchar(25) NOT NULL,
address varchar(25) NOT NULL
hours varchar(10)
PRIMARY KEY(restaurantID)
);
DESC Restaurants;
INSERT INTO Restaurants (restaurantID, name, city, address, hours) VALUES ();
INSERT INTO Restaurants (restaurantID, name, city, address, hours)  VALUES ();
INSERT INTO Restaurants (restaurantID, name, city, address, hours)  VALUES ();
SELECT * FROM Restaurants;



CREATE TABLE Reviews (
reviewID int NOT NULL,
restaurantID int NOT NULL,
rating int NOT NULL,
PRIMARY KEY(reviewID),
FOREIGN KEY (restaurantID) REFERENCES Restaurants(restaurantID) ON DELETE CASCADE
);
DESC Review;
INSERT INTO Review (reviewID, restaurantID, rating) VALUES ();
INSERT INTO Review (reviewID, restaurantID, rating) VALUES ();
INSERT INTO Review (reviewID, restaurantID, rating) VALUES ();
INSERT INTO Review (reviewID, restaurantID, rating) VALUES ();
INSERT INTO Review (reviewID, restaurantID, rating) VALUES ();
SELECT * FROM PROFESSOR;



CREATE TABLE Menu (
restaurantID int NOT NULL,
cuisineType varchar(25) NOT NULL,
priceRange ENUM('low','med', 'high') NOT NULL,
isVegetarian BIT,
isGlutenFree BIT,
isVegan BIT,
PRIMARY KEY (itemID),
FOREIGN KEY (restaurantID) REFERENCES Restaurants(restaurantID) ON DELETE CASCADE
);
DESC Menu;
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES ();
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES ();
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES ();
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES ();
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES ();
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES ();
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES ();
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES ();
INSERT INTO Menu (restaurantID,cuisineType, priceRange, isVegetarian, isGlutenFree, isVegan) VALUES ();
SELECT * FROM Menu;

EOFMYSQL
