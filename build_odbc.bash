#!/bin/bash
set -e -v

g++ -c odbc_query.cpp
g++ -c odbc_db.cpp
g++ -Wall -I/usr/include/cppconn -o odbc_query.exe odbc_query.o odbc_db.o -L/usr/lib -lmysqlcppconn

chmod o+x odbc_query.exe
chmod 755 odbc_query.exe