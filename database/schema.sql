DROP TABLE users;
CREATE TABLE users(
  id integer primary key AUTOINCREMENT,
  username varchar(25),
  group_id integer,
  name text,
  email varchar(50),
  imageURL text,
  password varchar(25),
  salt integer,
  created_at datetime
);

DROP TABLE groups;
CREATE TABLE groups(
  id integer primary key AUTOINCREMENT,
  owner_id integer,
  name text,
  imageURL text,
  size integer,
  description text,
  joinToken text
);

DROP TABLE usersInGroup;
CREATE TABLE usersInGroup(
  userID integer,
  groupID integer
);

DROP TABLE usersInBill;
CREATE TABLE usersInBill(
  userID integer,
  billID integer,
  selfCost integer
);

DROP TABLE bills;
CREATE TABLE bills(
  id integer primary key
  AUTOINCREMENT,
  name text,
  description text,
  cost integer,
  remaining integer,
  owner_id integer,
  group_id integer
);
