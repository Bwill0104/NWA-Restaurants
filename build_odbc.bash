#!/bin/bash
set -e -v

chmod o+x odbc_insert_item.exe
chmod 755 odbc_insert_item.exe

g++ -c odbc_insert_item.cpp
g++ -c odbc_db.cpp
g++ -Wall -I/usr/include/cppconn -o odbc_insert_item.exe odbc_insert_item.o odbc_db.o -L/usr/lib -lmysqlcppconn
