create database ogiri_sns_php;

grant all on ogiri_sns_php.* to dbuser@localhost identified by 'hx7L2208';

use ogiri_sns_php

create table users (
  id int auto_increment primary key,
  name varchar(200) not null,
  email varchar(255) unique,
  password varchar(255)
);

create table posts (
  id int auto_increment primary key,
  user_id int not null,
  content varchar(300) not null,
  create_at timestamp,
  foreign key(user_id) references users(id)
);

create table comments (
  id int auto_increment primary key,
  user_id int not null,
  content varchar(300) not null,
  create_at timestamp,
  foreign key(user_id) references users(id)
);

create table board(
    id int not null auto_increment primary key,
    name varchar(20),
    comment text
);

desc users;


insert into users values(null, '屋宜', 'hunter44shop@gmail.com', '8888');
