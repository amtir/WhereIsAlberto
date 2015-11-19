/*
First we create the database
*/

create database whereisalberto;

/* 
Next we switch to that database 
*/
use whereisalberto;

/*
Then we create different entities and their relationships (third normal form should be enough)
*/
CREATE TABLE banknotes (
id INT NOT NULL AUTO_INCREMENT ,
serial_number VARCHAR(10) NOT NULL ,
PRIMARY KEY (id)
);

CREATE TABLE users (
id INT NOT NULL AUTO_INCREMENT,
email VARCHAR(40) NOT NULL,
first_name VARCHAR(20) NOT NULL ,
last_name VARCHAR(20) NOT NULL ,
/* address and phone */
PRIMARY KEY (id) 
);

CREATE TABLE traces (
id INT NOT NULL AUTO_INCREMENT,
sn_id INT NOT NULL ,
user_id INT NOT NULL ,
trace_date date NOT NULL,
location VARCHAR(30) NOT NULL ,
gps_lat DECIMAL(10, 8) NOT NULL , 
gps_long DECIMAL(11, 8) NOT NULL , 
PRIMARY KEY (id) ,
CONSTRAINT sn_fk FOREIGN KEY (sn_id) REFERENCES banknotes(id)
ON UPDATE CASCADE
ON DELETE CASCADE,
CONSTRAINT user_fk FOREIGN KEY (user_id) REFERENCES users(id)
ON UPDATE CASCADE
ON DELETE CASCADE
);

show tables;
describe banknotes;
describe users;
describe traces;

/*
Eventually, we initiate and populate these tables with dummy random data.
*/


/* banknotes table */
insert into banknotes (serial_number) values ('00K5911063');
insert into banknotes (serial_number) values ('00M6302456');
insert into banknotes (serial_number) values ('00R1356063');
insert into banknotes (serial_number) values ('00S8576357');
insert into banknotes (serial_number) values ('00A4259035');

/* users table */
insert into users (email, first_name,last_name) values ('tom.john@gmail.com','Tom', 'Johnson');
insert into users (email, first_name,last_name) values ('peter.smith@hotmail.com','Peter', 'Smith');
insert into users (email, first_name,last_name) values ('hans.jackson@gmail.com','Hans', 'Jackson');
insert into users (email, first_name,last_name) values ('john.lee@yahoo.com','John', 'Lee');
insert into users (email, first_name,last_name) values ('sandy.lewis@hotmail.com','Sandy', 'Lewis');
insert into users (email, first_name,last_name) values ('alice.miler@hotmail.com','Alice', 'Miler');
insert into users (email, first_name,last_name) values ('albert.martinez@gmail.com','Albert', 'Martinez');

/* traces tables */ '2015-03-08'

insert into traces (sn_id, user_id, trace_date, location, gps_lat, gps_long ) 
values (1, 1, '2015-03-08' , 'Zurich' , 47.42305555555555 , 8.521666666666668 );

insert into traces (sn_id, user_id, trace_date, location, gps_lat, gps_long ) 
values (1, 2, '2015-03-25' , 'Geneva' , 46.18805555555555  , 6.198888888888889 );

insert into traces (sn_id, user_id, trace_date, location, gps_lat, gps_long ) 
values (1, 3, '2015-04-12' , 'Bern' , 46.913888888888884 , 7.496944444444445  );

insert into traces (sn_id, user_id, trace_date, location, gps_lat, gps_long ) 
values (1, 4, '2015-04-18' , 'Lucerne' , 47.05027777777777 , 8.306111111111111 );

insert into traces (sn_id, user_id, trace_date, location, gps_lat, gps_long ) 
values (1, 5, '2015-05-04' , 'Basel' , 47.56666666666667 , 7.614999999999999 );

insert into traces (sn_id, user_id, trace_date, location, gps_lat, gps_long ) 
values (1, 6, '2015-05-18' , 'Saint Gallen' , 47.42388888888889 , 9.374722222222223 );

insert into traces (sn_id, user_id, trace_date, location, gps_lat, gps_long ) 
values (1, 7, '2015-06-05' , 'Lugano' , 46.01138888888889 , 8.995833333333332  );

/*-------------------*/

insert into traces (sn_id, user_id, trace_date, location, gps_lat, gps_long ) 
values (4, 1, '2015-03-08' , 'Zurich' , 47.42305555555555 , 8.521666666666668 );

insert into traces (sn_id, user_id, trace_date, location, gps_lat, gps_long ) 
values (4, 2, '2015-03-25' , 'Geneva' , 46.18805555555555  , 6.198888888888889 );

insert into traces (sn_id, user_id, trace_date, location, gps_lat, gps_long ) 
values (4, 5, '2015-05-04' , 'Basel' , 47.56666666666667 , 7.614999999999999 );

/*-------------------*/


/* Query to trace the banknote SN 00K5911063 */
select trace_date, first_name, last_name, email, serial_number, location, gps_lat, gps_long
from users, banknotes, traces
where users.id=traces.user_id and banknotes.id=traces.sn_id and banknotes.serial_number='00K5911063' and  users.email='akram.mtir@gmail.com'
order by trace_date asc 
limit 10;

/* tracing the banknote SN 00S8576357 */
select trace_date, first_name, last_name, email, serial_number, location, gps_lat, gps_long
from users, banknotes, traces
where users.id=traces.user_id and banknotes.id=traces.sn_id and banknotes.serial_number='00S8576357'
order by trace_date asc 
limit 10;


/*  alter/change the location column to contain a full/complete address  */
alter table traces modify column location varchar(70);




