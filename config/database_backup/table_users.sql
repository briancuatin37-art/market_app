CREATE TABLE users(
            id BIGSERIAL PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            mobile_number VARCHAR(20) NOT NULL,
            ide_number VARCHAR(15) NULL UNIQUE,
            address TEXT NULL,
            birthday DATE NULL,
            email VARCHAR(200) NOT NULL UNIQUE,
            password TEXT NOT NULL,
            status BOOLEAN NOT NULL DEFAULT TRUE,
            created_at TIMESTAMPTZ NOT NULL DEFAULT now(),
            updated_at TIMESTAMPTZ NOT NULL DEFAULT now(),
            deleted_at TIMESTAMPTZ NULL


);

insert into users(firstname, lastname, mobile_number, email, password) 
values('Joan C','Ayala','465133','joan@mail.com','1234');

CREATE TABLE countries (
  id SERIAL PRIMARY KEY,
  name VARCHAR(100),
  abbrev VARCHAR(10),
  code VARCHAR(10)
);

CREATE TABLE regions (
  id SERIAL PRIMARY KEY,
  name VARCHAR(100),
  abbrev VARCHAR(10),
  code VARCHAR(10),
  country_id INT REFERENCES countries(id)
);

CREATE TABLE cities (
  id SERIAL PRIMARY KEY,
  name VARCHAR(100),
  abbrev VARCHAR(10),
  code VARCHAR(10),
  region_id INT REFERENCES regions(id)
);
