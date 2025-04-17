/* Compile using:
g++ -Wall -I/usr/include/cppconn -o odbc odbc_insert_restaurant.cpp -L/usr/lib -lmysqlcppconn 
run: 
./odbc */
#include "odbc_db.h"
#include <iostream>
#include <string>
#include <vector>
using namespace std;

void add_restaurant(odbc_db myDB, vector <string> values)
{
   // Parse input string to get restaurant Name and Type and  City
    string rest_id = values[0];
    string name = values[1];
    string city = values[2];
    string address = values[3];
    string rating = values[4];


   // Insert the new restaurant
   string input = "'" + rest_id + "','" + name + "','" + city + "','" + address + "','" + rating + "'";

   // DEBUG:
   // printf("%s", input.c_str());
   myDB.insert("Restaurants", input);    // insert new restaurant
 
   //For debugging purposes: Show the database after insert
   string builder = "<br><br><br> Table Restaurants after:" + myDB.query("SELECT * from Restaurants;") +"<br>";
   cout << builder; 
       
   myDB.disConnect();//disconect Database
}

void add_hours(odbc_db myDB, vector <string> values)
{
   // Parse input string to get restaurant Name and Type and  City
    string rest_id = values[0];
    string days = values[1];
    string openBreak = values[2];
    string openLunch = values[3];
    string openDinner = values[4];

   // Insert the new restaurant
   string input = "'" + rest_id + "','" + days + "','" + openBreak + "','" + openLunch + "','" + openDinner + "'";

   // DEBUG:
   // printf("%s", input.c_str());
   myDB.insert("Hours", input);    // insert new restaurant
 
   //For debugging purposes: Show the database after insert
   string builder = "<br><br><br> Table Hours after:" + myDB.query("SELECT * from Hours;") +"<br>";
   cout << builder; 
       
   myDB.disConnect();//disconect Database
}

void add_menu(odbc_db myDB, vector <string> values)
{
   // Parse input string to get restaurant Name and Type and  City
    string rest_id = values[0];
    string cuisineType = values[1];
    string priceRange = values[2]; // CAST TO INT
    string isVegetarian = values[3];
    string isGlutenFree = values[4];
    string isVegan = values[4];

   

   // Insert the new restaurant
   string input = "'" + rest_id + "','" + cuisineType + "','" + priceRange + "','" + isVegetarian + "','" + isGlutenFree + + "','" + isVegan + "'";

   // DEBUG:
   // printf("%s", input.c_str());
   myDB.insert("Menu", input);    // insert new restaurant
 
   //For debugging purposes: Show the database after insert
   string builder = "<br><br><br> Table Menu after:" + myDB.query("SELECT * from Menu;") +"<br>";
   cout << builder; 
       
   myDB.disConnect();//disconect Database
}

void remove_restaurant(odbc_db myDB, vector <string> values)
{
   string rest_id = values[0];
   string name = values[1];

   cout << "STUFF: " << rest_id << name << endl;

   if(rest_id.length() == 0) myDB.remove("Restaurants", "name", name);
   else if(name.length() == 0) myDB.remove("Restaurants", "restaurantID", rest_id);
   
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
   
   string queryType = argv[1];

   for(int i = 2; i < argc; i++){
      values.push_back(argv[i]);
      cout << argv[i] << endl;
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
   return 0;
}


