use skladiste; 


CREATE TABLE Users ( 
	IdUser int AUTO_INCREMENT,
    ime varchar(255) not null,
    prezime varchar(255) not null,
    Username varchar(100) UNIQUE not null,
    PasswordUser varchar(255) not null, 
    UserCreatedAt datetime,
    PRIMARY KEY (IdUser)
); 

CREATE TABLE products (
    IdProduct int AUTO_INCREMENT,
    NameProduct varchar(255),
    Quantity int, 
    Price float, 
    ProductCreatedAt datetime DEFAULT current_timestamp,
    ProductUpdatedAt datetime default current_timestamp,
    PRIMARY KEY (IdProduct)
); 


select * from users; 
select * from products; 