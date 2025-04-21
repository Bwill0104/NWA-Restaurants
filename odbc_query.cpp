/* Compile using:
g++ -Wall -I/usr/include/cppconn -o odbc odbc_insert_restaurant.cpp -L/usr/lib -lmysqlcppconn 
run: 
./odbc */
#include "odbc_db.h"
#include <iostream>
#include <string>
#include <vector>
#include <sstream>
#include <ctime>
#include <iomanip>
using namespace std;

// ADD A RESTAURANT
void add_restaurant(odbc_db myDB, vector <string> values)
{  
   if (values.size() < 5) {
    cerr << "Error: Not enough arguments." << endl;
    return;
   }
   // Parse input string to get restaurant Name and Type and  City
   string rest_id = values[0];
   string name = values[1];
   string city = values[2];
   string address = values[3];
   string rating = values[4];

   // Insert the new restaurant
   string input = "'" + rest_id + "','" + name + "','" + city + "','" + address + "','" + rating + "'";

   myDB.insert("Restaurants", input);    // insert new restaurant
       
   myDB.disConnect(); //disconect Database
}

// ADD RESTAURANT HOURS
void add_hours(odbc_db myDB, vector <string> values)
{
   if (values.size() < 5) {
    cerr << "Error: Not enough arguments." << endl;
    return;
   }
   // Parse input string to get restaurant Name and Type and  City
   string rest_id = values[0];
   string days = values[1];
   string openBreak = values[2];
   string openLunch = values[3];
   string openDinner = values[4];

   // Insert the new restaurant
   string input = "'" + rest_id + "','" + days + "','" + openBreak + "','" + openLunch + "','" + openDinner + "'";

   myDB.insert("Hours", input); // insert new restaurant
       
   myDB.disConnect(); // disconect Database
}

// ADD A MENU
void add_menu(odbc_db myDB, vector <string> values)
{
    if (values.size() < 5) {
    cerr << "Error: Not enough arguments." << endl;
    return;
   }
   // Parse input string to get restaurant Name and Type and  City
   string rest_id = values[0];
   string cuisineType = values[1];
   string priceRange = values[2]; 
   string isVegetarian = values[3];
   string isGlutenFree = values[4];
   string isVegan = values[5];

   // Insert the new restaurant
   string input = "'" + rest_id + "','" + cuisineType + "','" + priceRange + "','" + isVegetarian + "','" + isGlutenFree + + "','" + isVegan + "'";

   myDB.insert("Menu", input); // insert new restaurant
 
   myDB.disConnect(); // disconect Database
}

// FIND RESTAURANT BY CITY
void findByCity(odbc_db myDB, vector <string> values)
{
   if (values.size() < 1) {
    cerr << "Error: Not enough arguments." << endl;
    return;
   }
   string city = values[0];

   string rawQuery = "SELECT Restaurants.name, Restaurants.city, Restaurants.address FROM Restaurants WHERE Restaurants.city = '" + city + "';";

   string result = myDB.print(myDB.rawQuery(rawQuery));
   if(result.length() == 0){
      cout << "No restaurants found" << endl;
   }
   else{
      cout << result;
   }
}

// REMOVE A RESTAURANT
void remove_restaurant(odbc_db myDB, vector <string> values)
{
   if (values.size() < 2) {
    cerr << "Error: Not enough arguments." << endl;
    return;
   }
   string rest_id = values[0];
   string name = values[1];

   if(rest_id.length() == 0) myDB.remove("Restaurants", "name", name);
   else if(name.length() == 0) myDB.remove("Restaurants", "restaurantID", rest_id);
   
}

// CONVERT STRING TIME TO MINUTES
int timeStringToMinutes(const string& timeStr) {
    struct tm tm = {};
    char* result = strptime(timeStr.c_str(), "%I:%M %p", &tm); // %I = 12-hour, %p = AM/PM

   if (result == nullptr) {
      return -1; // Invalid format
   }

   return tm.tm_hour * 60 + tm.tm_min;
}

// FIND BY OPEN TIMES
int findByTime(odbc_db myDB, vector <string> values)
{
   if (values.size() < 3) {
    cerr << "Error: Not enough arguments." << endl;
    return -1;
   }
   //
   string first = values[0];
   string second = values[1];
   string third = values[2];
   string rawQuery;
   string timeToUse;

   // USE ENTERED TIME
   if (first.length() == 0) {
    timeToUse = second + " " + third;
   } 
   // USE CURRENT TIME
   else {
      timeToUse = first + " " + second;
   }

   int minutes = timeStringToMinutes(timeToUse);

   // INVALID TIME FORMAT ERROR
    if (minutes == -1) {
        cout << "Invalid time format" << endl;
        return 1;
    }
    if (minutes >= 0 && minutes <= 600) { // 12:00 AM - 10:00 AM
        rawQuery = "SELECT Restaurants.name, Restaurants.city, Restaurants.address FROM Restaurants "
                   "JOIN Hours ON Restaurants.restaurantID = Hours.restaurantID "
                   "WHERE Hours.openBreak = 'yes';";
         cout << "Restaurant Open for Breakfast:" << endl;
    }
    else if ((minutes >= 1380 && minutes <= 1439) || (minutes >= 0 && minutes <= 900)) { // 11:00 PM - 3:00 PM (wraps around midnight)
        rawQuery = "SELECT Restaurants.name, Restaurants.city, Restaurants.address FROM Restaurants "
                   "JOIN Hours ON Restaurants.restaurantID = Hours.restaurantID "
                   "WHERE Hours.openLunch = 'yes';";
         cout << "Restaurant Open for Lunch:" << endl;
    }
    else if (minutes > 900) { // After 3:00 PM
        rawQuery = "SELECT Restaurants.name, Restaurants.city, Restaurants.address FROM Restaurants "
                   "JOIN Hours ON Restaurants.restaurantID = Hours.restaurantID "
                   "WHERE Hours.openDinner = 'yes';";
         cout << "Restaurant Open for Dinner:" << endl;     
    }

   string result = myDB.print(myDB.rawQuery(rawQuery));
   if(result.length() == 0){
      cout << "No restaurants found" << endl;
   }
   else{
      cout << result;
   }
   myDB.disConnect();//disconect Database
}

// USED SEARCH BAR
void searchBar(odbc_db myDB, vector <string> values) 
{
   if (values.size() < 1) {
    cerr << "Error: Not enough arguments." << endl;
    return;
   }
   string restName = values[0];

   string rawQuery = "SELECT * from Restaurants WHERE Restaurants.name = '" + restName + "';";

   string result = myDB.print(myDB.rawQuery(rawQuery));
   if(result.length() == 0){
      cout << "No restaurants found" << endl;
   }
   else{
      cout << result;
   }
   myDB.disConnect();//disconect Database
}

// SERACH FOR SPECIFIC RESTAURANT
void search(odbc_db myDB, vector <string> values) 
{
   if (values.size() < 4) {
    cerr << "Error: Not enough arguments." << endl;
    return;
   }
   string meal = values[0];
   string vegetarian = values[1];
   string gluten = values[2];
   string vegan = values[3];

   string rawQuery = "SELECT Restaurants.name, Restaurants.city, Restaurants.address, Restaurants.rating FROM Restaurants "
                     "JOIN Hours on Restaurants.restaurantID = Hours.restaurantID "
                     "JOIN Menu on Menu.restaurantID = Restaurants.restaurantID "
                     "WHERE Hours." + meal + " = 'yes' AND "
                     "Menu.isVegetarian = '" + vegetarian + "' AND "
                     "Menu.isGlutenFree = '" + gluten + "' AND "
                     "Menu.isVegan = '" + vegan + "';";

   string result = myDB.print(myDB.rawQuery(rawQuery));
   if(result.length() == 0){
      cout << "No restaurants found" << endl;
   }
   else{
      cout << result;
   }
   myDB.disConnect();//disconect Database
}

// EDIT RATING OF RESTAURANT
void review(odbc_db myDB, vector <string> values) 
{
   if (values.size() < 2) {
    cerr << "Error: Not enough arguments." << endl;
    return;
   }
   string rest_id = values[0];
   string ratingString = values[1];
   int newRating = stoi(ratingString);

   stringstream ss;
   ss << "UPDATE Restaurants "
      << "SET rating = (rating + " << newRating << ") / 2 "
      << "WHERE restaurantID = " << rest_id << ";";
   string rawQuery = ss.str();
   string checkQuery = "SELECT * FROM Restaurants;";

   myDB.rawQuery(rawQuery);
  
   myDB.disConnect();//disconect Database
}


int main(int argc, char *argv[])
{
   string Username = "bryanw";   // Change to your own username
   string mysqlPassword = "Chooc8ai";  // Change to your mysql password
   string SchemaName = "bryanw"; // Change to your username

   odbc_db myDB;
   myDB.Connect(Username, mysqlPassword, SchemaName);
   myDB.initDatabase();

   std::vector<std::string> values;
   if (argc < 2) {
    cerr << "Usage: ./odbc <queryType> <params...>" << endl;
    return 1;
   }

   string queryType = argv[1];

   for(int i = 2; i < argc; i++){
      values.push_back(argv[i]);
   }

   if(queryType == "restaurant"){
      
      add_restaurant(myDB,values);
   }
   else if(queryType == "hours"){
      add_hours(myDB,values);
   }
   else if(queryType == "menu"){
      add_menu(myDB,values);
   }
   else if(queryType == "remove"){
      remove_restaurant(myDB,values);
   }
   else if(queryType == "city"){
      findByCity(myDB, values);
   }
   else if(queryType == "time"){
      findByTime(myDB, values);
   }
   else if(queryType == "searchBar"){
      searchBar(myDB, values);
   }
   else if(queryType == "search"){
      search(myDB, values);
   }
   else if(queryType == "review"){
      review(myDB, values);
   }

   return 0;
}


