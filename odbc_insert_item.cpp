/* Compile using:
g++ -Wall -I/usr/include/cppconn -o odbc odbc_insert_restaurant.cpp -L/usr/lib -lmysqlcppconn 
run: 
./odbc */
#include "odbc_db.h"
#include <iostream>
#include <string>
using namespace std;

int main(int argc, char *argv[])
{
string Username = "bryanw";   // Change to your own username
string mysqlPassword = "Chooc8ai";  // Change to your mysql password
string SchemaName = "bryanw"; // Change to your username

   odbc_db myDB;
   myDB.Connect(Username, mysqlPassword, SchemaName);
   myDB.initDatabase();
 
   // For debugging purposes:  Show the database before insert
   string builder = "";
   string query1 = "SELECT * from ITEM;";
   builder.append("<br><br><br> ITEM table before:" + myDB.query(query1) +"<br>");
 
   // Parse input string to get restaurant Name and Type and  City
    string rest_id;
    string name;
    string city;
    string address;
    string rating;

   // Read command line arguments
   // First arg, arg[0] is the name of the program
   // Next args are the parameters
   rest_id = argv[1];
   name = argv[2];
   city = argv[3];
   address = argv[4];
   rating = argv[5];

   // Get the next id
   string q = "select IFNULL(max(ID), 0) as max_id from Restaurants";
   sql::ResultSet *result = myDB.rawQuery(q);
   int next_id = 1;
   if (result->next()) // get first row of result set
      next_id += result->getInt("max_id");

   // Insert the new restaurant
   string input = "'" + to_string(next_id) + "','" + rest_id + "','" + name + "','" + city + "','" + address + "','" + rating + "'";

   // DEBUG:
   // printf("%s", input.c_str());
   myDB.insert("Restaurants", input);    // insert new restaurant
 
   //For debugging purposes: Show the database after insert
   builder.append("<br><br><br> Table Restaurants after:" + myDB.query(query1));
   cout << builder; 
       
   myDB.disConnect();//disconect Database

   return 0;
}


