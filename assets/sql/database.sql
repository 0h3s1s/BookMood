create database bookmood;

use bookmood;

drop table users;
create table users (
	id       int(255) auto_increment not null,
	role     varchar(255) not null,
	name     varchar(100) not null,
	surname  varchar(100) not null,
	email    varchar(255) not null,
	password varchar(255) not null,
	date     date not null,
	constraint pk_users primary key (id),
	constraint uq_email unique (email)
) engine = InnoDb;

drop table categories;
create table categories (
	id   int(255) auto_increment not null,
	name varchar(100) not null,
	constraint pk_categories primary key (id)
) engine = InnoDb;

drop table entries;
create table entries (
	id          int(255) auto_increment not null,
	user_id     int(255) not null,
	category_id int(255) not null,
	title       varchar(255) not null,
	description text not null,
	content     mediumtext not null,
	cover       varchar(255) not null,
	date        date not null,
	constraint pk_entries primary key (id),
	constraint fk_entry_user foreign key (user_id) references users (id),
	constraint fk_entry_category foreign key (category_id) references categories (id) on delete no action
) engine = InnoDb;
