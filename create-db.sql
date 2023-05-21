
create database app;

create table users(
    id bigint primary key auto increment,
    username varchar(255),
    pass varchar(255)
)