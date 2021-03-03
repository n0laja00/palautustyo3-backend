drop database if exists ostoslista;

create database ostoslista;

use ostoslista;

create table lista (
        id int primary key auto_increment,
        kuvaus text not null,
        maara int not null
);

insert into lista (kuvaus, maara) values ('Maito', 2);
insert into lista (kuvaus, maara) values ('Voi', 1);