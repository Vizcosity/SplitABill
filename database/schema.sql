DROP TABLE users;
CREATE TABLE users(id integer primary key AUTOINCREMENT, username varchar(25), group_id integer, name text, email varchar(50), password varchar(25), salt text, created_at datetime);

DROP TABLE groups;
CREATE TABLE groups(id integer primary key AUTOINCREMENT, group_id integer, name text, description text);

DROP TABLE bills;
CREATE TABLE bills(id integer primary key AUTOINCREMENT, name text, description text, cost integer, owner_id integer, group_id integer, hasGroup boolean);
