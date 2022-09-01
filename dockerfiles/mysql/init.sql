create table users
(
    id           int auto_increment primary key,
    hash_id      varchar(36) not null,
    email        varchar(255) not null,
    password     varchar(255) not null,
    display_name varchar(255) null,
    avatar       varchar(255) null,
    constraint users_email_uindex unique (email)
);

